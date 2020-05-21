<?php
/**
 * NewsHeadline class
 *
 * @package  ShahariaAzam\NewsAggregator\Cli\Commands
 */


namespace ShahariaAzam\NewsAggregator\Cli\Commands;


use Shaharia\NewsAggregator\Aggregator;
use ShahariaAzam\NewsAggregator\Cli\SourceMaps;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NewsHeadline extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'news:headlines';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Show headlines of news')
            ->setDefinition(
                new InputDefinition([
                    new InputOption('list', 'l', InputOption::VALUE_REQUIRED),
                    new InputOption('with-url', 'u')
                ])
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('list')) {
            $providerSlug = $input->getOption('list');

            $sourceMaps = new SourceMaps();
            $provider = $sourceMaps->getHeadLineProviderBySlug($providerSlug);

            $aggregator = Aggregator::init();
            $headlines = $aggregator->getHeadlines(
                $provider['provider_class'],   // News provider class
                $provider['provider_parser']  // Parser class
            );

            foreach ($headlines as $headline){
                $output->writeln($headline->getTitle());
            }
        }

        return 0;
    }
}