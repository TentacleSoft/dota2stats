<?php

namespace Dota2Stats\Bundle\WebBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Description of RetrieveMatchesCommand
 *
 * @author Alex Carol
 */
class RetrieveMatchesCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('dota2stats:retrieveMatches')
            ->setDescription('Retrieves the matches from the dota2 web API and stores them in your local database')
            //->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
            //->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
        
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $matchDataService = $this->getContainer()->get('dota2_stats.service.match_data');

        $text = $matchDataService->processMatches();
        
        $output->writeln($text);
    }
}
