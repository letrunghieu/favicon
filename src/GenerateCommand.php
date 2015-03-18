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

    /**
     * Input file path
     *
     * @var string
     */
    private $_inputFile;

    /**
     * Output folder which contains ico and png files
     * 
     */
    private $_outputFolder;

    /**
     * Imagine object
     *
     * @var \Imagine\Image\AbstractImagine
     */
    private $_imagine;

    /**
     * Include the 64x64 image in the ICO or not
     *
     * @var bool 
     */
    private $_use64Icon;

    /**
     * Include the 48x48 image in the ICO or not
     *
     * @var bool 
     */
    private $_use48Icon;
    
    protected function configure()
    {
        $this
                ->setName('generate')
                ->setDescription('Generate favicons from an original PNG image')
                ->addArgument('input', InputArgument::REQUIRED, 'Input PNG image')
                ->addArgument('output', InputArgument::OPTIONAL, 'Output folder', './')
                ->addOption('use-gd', 'g', InputOption::VALUE_NONE, 'Use GD extension instead of default Imagick extension')
                ->addOption('ico-64', null, InputOption::VALUE_NONE, 'Include 64x64 image in the ICO file (larger file size)')
                ->addOption('ico-48', null, InputOption::VALUE_NONE, 'Include 48x48 image in the ICO file (larger file size)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_prepare($input, $output);

        $this->_generateIco($output);
    }

    private function _prepare(InputInterface $input, OutputInterface $output)
    {
        $this->_imagine      = $this->_getImagine($input, $output);
        $this->_outputFolder = rtrim($input->getArgument('output'), " /") . "/";
        $this->_inputFile    = $input->getArgument('input');
        $this->_use64Icon    = $input->getOption('ico-64');
        $this->_use48Icon    = $input->getOption('ico-48');

        if (!file_exists($this->_inputFile) && !is_file($this->_inputFile))
        {
            $output->writeln("<error>Input file does not exist: {$this->_inputFile}</error>");
        }
    }

    /**
     * Generate ICO icon
     * 
     * @param OutputInterface $output
     * 
     * @return bool
     */
    private function _generateIco(OutputInterface $output)
    {
        $filename = $this->_outputFolder . "favicon.ico";
        $output->writeln("Creating: <info>{$filename}</info>");

        $imagine = new \Imagine\Imagick\Imagine();

        $originalImage = $imagine->open($this->_inputFile)->strip();
        $originalImage->copy()
                ->resize(new \Imagine\Image\Box(16, 16))
                ->save('tmp-16.bmp');

        $icon = $imagine->open('tmp-16.bmp');
        $icon->layers()
                ->add($originalImage->copy()->resize(new \Imagine\Image\Box(32, 32)));
        
        if ($this->_use48Icon)
        {
            $icon->layers()->add($originalImage->copy()->resize(new \Imagine\Image\Box(48, 48)));
        }
        if ($this->_use64Icon)
        {
            $icon->layers()->add($originalImage->copy()->resize(new \Imagine\Image\Box(64, 64)));
        }

        $icon->save($filename, array(
            'flatten' => false
        ));

        unlink('tmp-16.bmp');
        return true;
    }

    /**
     * Get the imagine object based on the options. Default will use Imagick
     * extension
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return \Imagine\Image\AbstractImagine
     */
    private function _getImagine(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('use-gd'))
        {
            $output->writeln('GD extension is used.');
            return new \Imagine\Gd\Imagine();
        }
        $output->writeln('Imagick extension is used.');
        return new \Imagine\Imagick\Imagine();
    }

}
