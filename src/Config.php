<?php

namespace HieuLe\Favicon;

/**
 * Description of Config
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class Config
{

    /**
     * Name of PNG sizes that we want to generate favicon
     *
     * @var array
     */
    private $_turnedOnSizes = array();

    /**
     * The background color of Windows tite
     *
     * @var type 
     */
    private $_msapplicationTileColor = '#FFFFFF';

    /**
     * Supported PNG sizes and its description
     *
     * @var type 
     */
    private static $_sizes = array(
        // general icons
        'touch'     => array(
            'size'  => 152,
            'label' => 'Touch icon for iOS 2.0+ and Android 2.1+',
        ),
        'fav'       => array(
            'size'  => 32,
            'label' => 'Favicons targeted to any additional png sizes',
        ),
        'fav-57'    => array(
            'size'  => 57,
            'label' => 'For non-Retina iPhone, iPod Touch, and Android 2.1+ devices',
        ),
        'ms'        => array(
            'size'  => 144,
            'label' => 'IE 10 Metro tile icon (Metro equivalent of apple-touch-icon)',
        ),
        // touch icons
        'touch-152' => array(
            'size'  => 152,
            'label' => 'For iPad with high-resolution Retina display running iOS ≥ 7',
        ),
        'touch-144' => array(
            'size'  => 144,
            'label' => 'For iPad with high-resolution Retina display running iOS ≤ 6',
        ),
        'touch-120' => array(
            'size'  => 120,
            'label' => 'For iPhone with high-resolution Retina display running iOS ≥ 7',
        ),
        'touch-114' => array(
            'size'  => 114,
            'label' => 'For iPhone with high-resolution Retina display running iOS ≤ 6',
        ),
        'touch-72'  => array(
            'size'  => 72,
            'label' => 'For first- and second-generation iPad',
        ),
    );

    /**
     * Generate PNG favicon for all sizes
     * 
     * @return \HieuLe\Favicon\Config
     */
    public function allOn()
    {
        foreach (self::$_sizes as $name => $_)
        {
            $this->_turnedOnSizes[$name] = true;
        }
        return $this;
    }

    /**
     * Do not generate any PNG favicon
     * 
     * @return \HieuLe\Favicon\Config
     */
    public function allOff()
    {
        $this->_turnedOnSizes = array();
        return $this;
    }

    /**
     * Generate PNG favicon for this size
     * 
     * @param string $size
     * @return \HieuLe\Favicon\Config
     */
    public function turnOn($size)
    {
        if (isset(self::$_sizes[$size]))
        {
            $this->_turnedOnSizes[$size] = true;
        }
        return $this;
    }

    /**
     * Do not generate PNG for this size
     * 
     * @param string $size
     * @return \HieuLe\Favicon\Config
     */
    public function turnOff($size)
    {
        if (isset($this->_turnedOnSizes[$size]))
        {
            unset($this->_turnedOnSizes[$size]);
        }
        return $this;
    }

    /**
     * Set the background color for Windows tile
     * 
     * @param string $hexColor hex value of background color (e.g: #000000)
     * @return \HieuLe\Favicon\Config
     */
    public function setTileBackground($hexColor)
    {
        $this->_msapplicationTileColor = $hexColor;
        return $this;
    }

    /**
     * Get Windows tile background color
     * 
     * @return string
     */
    public function getTileBackground()
    {
        return $this->_msapplicationTileColor;
    }

    /**
     * Get turned on sizes name and width as an array (name => width)
     * 
     * @return type
     */
    public function getTurnedOnSizes()
    {
        $result = array();
        foreach ($this->_turnedOnSizes as $size => $on)
        {
            if ($on)
            {
                $result[$size] = self::$_sizes[$size];
            }
        }
        return $result;
    }

    /**
     * Get supported PNG sizes and description
     * 
     * @return array
     */
    public static function getSizes()
    {
        return self::$_sizes;
    }

}
