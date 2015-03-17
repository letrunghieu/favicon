<?php

namespace HieuLe\Favicon;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of GenerateCommand
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class GenerateCommand extends Command
{

    /**
     * Configuration object
     *
     * @var Config
     */
    private $_config;

    protected function configure()
    {
        $this
                ->setName('generate')
                ->setDescription('Generate favicons from an original PNG image')
                ->addArgument('input-file', InputArgument::REQUIRED, 'Input PNG image')
                ->addOption('config', 'c', InputOption::VALUE_NONE, 'Use a JSON config file to load config instead of command line options')
                ->addOption('config-file', 'f', InputOption::VALUE_OPTIONAL, 'Path to the JSON config file', 'favicon.json')
                ->addOption('all', 'a', InputOption::VALUE_NONE, 'Generate all available sizes')
                ->addOption('ms-tile-color', null, InputOption::VALUE_REQUIRED, 'The Windows tile background color', '#FFFFFF')
        ;
        $availableSizes = Config::getSizes();
        foreach ($availableSizes as $size => $data)
        {
            $this->addOption($size, null, InputOption::VALUE_NONE, $data['label']);
        }
        $this->addOption('save', 's', InputOption::VALUE_NONE, 'Save current settings to a JSON config file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_prepareConfig($input, $output);

        $generator = new Generator($this->_config);
        $generator->run($input->getArgument('input-file'));
        
        if ($input->getOption('save'))
        {
            $this->_saveJsonConfig($input, $output);
        }
    }

    private function _prepareConfig(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('config'))
        {
            return $this->_parseJsonConfigFromFile($input, $output);
        }
        $this->_config = new Config;
        $this->_config->setTileBackground($input->getOption('ms-tile-color'));
        if ($input->getOption('all'))
        {
            $this->_config->allOn();
        }
        else
        {
            $availableSizes = Config::getSizes();
            foreach ($availableSizes as $size => $_)
            {
                if ($input->getOption($size))
                {
                    $this->_config->turnOn($size);
                }
            }
        }
        return true;
    }

    private function _parseJsonConfigFromFile(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getOption('config-file');
        if (!file_exists($file) || is_file($file))
        {
            $output->writeln('<error>The JSON input file does not exist or is not a regular file.</error>');
            $output->writeln("Current setting: " . $file);
            die(1);
        }
        $this->_config = Config::fromFile($file);
        return true;
    }

    private function _saveJsonConfig(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getOption('config-file');
        $this->_config->toFile($file);
        $output->writeln('<info>Configurations are written to:</info> ' . $file);
        return true;
    }

}
