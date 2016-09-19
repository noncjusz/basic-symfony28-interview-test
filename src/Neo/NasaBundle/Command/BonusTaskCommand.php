<?php

namespace Neo\NasaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class BonusTaskCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName("test:command")
            ->setDescription("Retrieves selected document.")
            ->setHelp("By this command you can get NEO data for given ID (neo_reference_id)")
            ->addArgument("neo_id", InputArgument::REQUIRED, "The ID (neo_reference_id) of requested NEO.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formatter = $this->getHelper("formatter");
        $prompt = $this->getHelper("question");
        $question = new ConfirmationQuestion("This is a test. Do you want to continue (y/N)? ", false);

        if (!$prompt->ask($input, $output, $question)) {
            $output->writeln($formatter->formatBlock("Nothing done. Exiting...", "error"));
            return;
        }

        $em = $this->getContainer()->get("doctrine_mongodb")->getManager();

        $asteroid = $em->getRepository("NeoNasaBundle:Asteroid")->findOneByNeoReferenceId($input->getArgument("neo_id"));

        if ($asteroid) {
            $output->writeln($formatter->formatBlock("Document exists", "info"));
        } else {
            $output->writeln($formatter->formatBlock("ERROR! Document doesn't exist", "error"));
        }

        return;
    }
}
