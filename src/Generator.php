<?php

namespace HieuLe\Favicon;

/**
 * Description of Generator
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class Generator
{

    /**
     * The config object
     *
     * @var Config
     */
    private $_config;

    public function __construct(Config $config)
    {
        $this->_config = $config;
    }

    /**
     * Generate favicons
     * 
     * @param string $inputFile
     */
    public function run($inputFile)
    {
        $this->_generateIco($inputFile);
        $this->_generatePngs($inputFile);
    }

    private function _generateIco($inputFile)
    {
        $imagine = new \Imagine\Imagick\Imagine();

        $originalImage = $imagine->open($inputFile)->strip();
        $originalImage->copy()
                ->resize(new \Imagine\Image\Box(32, 32))
                ->save('tmp-32.bmp');
        $originalImage->copy()
                ->resize(new \Imagine\Image\Box(16, 16))
                ->save('tmp-16.bmp');

        $icon = $imagine->open('tmp-16.bmp');
        $icon->layers()
                ->add($imagine->open('tmp-32.bmp'));

        $icon->save('favicon.ico', array(
            'flatten' => false
        ));

        unlink('tmp-32.bmp');
        unlink('tmp-16.bmp');
    }

    private function _generatePngs($inputFile)
    {
        $imagine = new \Imagine\Imagick\Imagine();

        $originalImage = $imagine->open($inputFile)->strip();

        $sizes = $this->_config->getTurnedOnSizes();
        foreach ($sizes as $size)
        {
            $originalImage->copy()
                    ->resize(new \Imagine\Image\Box($size, $size))
                    ->save("favicon-{$size}.png");
        }
    }

}
