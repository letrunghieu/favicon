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

    /**
     * Exclude old apple touch images
     *
     * @var type 
     */
    private $_noOldApple;

    /**
     * Exclude manifest.json and Android images
     * 
     * @var type 
     */
    private $_noAndroid;

    /**
     * Exclude Windows and IE tile images
     *
     * @var type 
     */
    private $_noMs;

    /**
     * Android manifest app name
     *
     * @var string
     */
    private $_appName;

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
                ->addOption('no-old-apple', null, InputOption::VALUE_NONE, 'Exclude old apple touch images')
                ->addOption('no-android', null, InputOption::VALUE_NONE, 'Exclude manifest.json and Android images')
                ->addOption('no-ms', null, InputOption::VALUE_NONE, 'Exclude Windows and IE tile images')
                ->addOption('app-name', null, InputOption::VALUE_REQUIRED, 'Android manifest app name', "My Application")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_prepare($input, $output);

        $this->_generateIco($output);

        $this->_generatePngs($output);

        if (!$this->_noAndroid)
        {
            $this->_generateManifestJson($output);
        }
    }

    private function _prepare(InputInterface $input, OutputInterface $output)
    {
        $this->_imagine      = $this->_getImagine($input, $output);
        $this->_outputFolder = rtrim($input->getArgument('output'), " /") . "/";
        $this->_inputFile    = $input->getArgument('input');
        $this->_use64Icon    = $input->getOption('ico-64');
        $this->_use48Icon    = $input->getOption('ico-48');
        $this->_noOldApple   = $input->getOption('no-old-apple');
        $this->_noAndroid    = $input->getOption('no-android');
        $this->_noMs         = $input->getOption('no-ms');
        $this->_appName      = $input->getOption('app-name');

        if (!file_exists($this->_inputFile) && !is_file($this->_inputFile))
        {
            $output->writeln("<error>Input file does not exist: {$this->_inputFile}</error>");
        }

        mkdir($this->_outputFolder, 0755, true);
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


        $originalImage = $this->_imagine->open($this->_inputFile)->strip();
        $originalImage->copy()
                ->resize(new \Imagine\Image\Box(16, 16))
                ->save('tmp-16.bmp');

        $icon = $this->_imagine->open('tmp-16.bmp');
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

    private function _generatePngs(OutputInterface $output)
    {
        $sizes = Config::getSizes($this->_noOldApple, $this->_noAndroid, $this->_noMs);
        foreach ($sizes as $imageName => $size)
        {
            $output->writeln("Creating: <info>{$imageName}</info>");
            $imagePath = $this->_outputFolder . $imageName;
            if (!is_array($size))
            {
                $originalImage = $this->_imagine->open($this->_inputFile)->strip();
                $originalImage->copy()
                        ->resize(new \Imagine\Image\Box($size, $size))
                        ->save($imagePath);
            }
        }
    }

    private function _generateManifestJson(OutputInterface $output)
    {
        $output->writeln("Creating: <info>manifest.json</info>");
        $manifest = array(
            'name'  => $this->_appName,
            'icons' => array(),
        );
        foreach (array(36, 48, 72, 96, 144, 192) as $size)
        {
            $manifest['icons'][] = array(
                'src'     => "/android-chrome-{$size}x{$size}.png",
                'sizes'   => "{$size}x{$size}",
                'type'    => "image/png",
                'density' => round($size / 48.0, 2)
            );
        }
        $json         = json_encode($manifest, JSON_PRETTY_PRINT);
        $jsonFilePath = $this->_outputFolder . "manifest.json";
        file_put_contents($jsonFilePath, $json);
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
