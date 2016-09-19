<?php

namespace Neo\NasaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:get-data')
            ->setDescription("Gets data from Nasa site.")
            ->setHelp("By this command you can get data from Nasa site");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formatter = $this->getHelper('formatter');
        $fetcher = $this->getContainer()->get('neo_data_fetcher');

        $results = json_decode($fetcher->fetchData(), true);

        $em = $this->getContainer()->get('doctrine_mongodb')->getManager();

        foreach ($results["near_earth_objects"] as $date => $asteroids) {
            foreach ($asteroids as $asteroid) {
                $em->createQueryBuilder("NeoNasaBundle:Asteroid")
                    ->findAndUpdate()
                    ->field("neo_reference_id")->equals($asteroid["neo_reference_id"])
                    ->field("date")->set($date)
                    ->field("name")->set($asteroid['name'])
                    ->field("kilometers_per_hour")->set($asteroid["close_approach_data"][0]["relative_velocity"]["kilometers_per_hour"])
                    ->field("is_potentially_hazardous_asteroid")->set($asteroid["is_potentially_hazardous_asteroid"])
                    ->upsert()
                    ->getQuery()
                    ->execute();
            }
        }

        $output->writeln($formatter->formatBlock("Element count: {$results["element_count"]}", 'info'));
        return;
    }
}
