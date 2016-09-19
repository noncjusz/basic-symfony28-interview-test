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

        $this->getContainer()->get('doctrine_mongodb')
            ->getRepository('NeoNasaBundle:Asteroid')
            ->saveAsteroidsData($results["near_earth_objects"]);

        $output->writeln($formatter->formatBlock("Element count: {$results["element_count"]}", 'info'));
        return;
    }
}
