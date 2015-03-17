<?php

namespace HieuLe\Favicon;

/**
 * Output HTML tags based on a config
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class Html
{

    /**
     * The prefix of `href` attribute before the favicon file name
     *
     * @var string
     */
    private $_urlPrefix;

    /**
     * The config object
     *
     * @var \HieuLe\Favicon\Config
     */
    private $_config;

    /**
     * Availabel PNG sizes
     * 
     * @var array
     */
    private $_availabelSizes = array();

    public function __construct(Config $config, $prefix = '')
    {
        $this->_config         = $config;
        $this->_urlPrefix      = $prefix;
        $this->_availabelSizes = Config::getSizes();
    }

    /**
     * Output HTML link tags for all turned on favicon sizes
     * 
     * @return string
     */
    public function output()
    {
        return implode("\n", array_map([$this, 'getLinkTag'], array_keys($this->_config->getTurnedOnSizes())));
    }

    /**
     * Get tjhe Link tag for a favicon size
     * 
     * @param string $pngSizeName
     * @return string
     */
    public function getLinkTag($pngSizeName)
    {
        if (!isset($this->_availabelSizes[$pngSizeName]))
        {
            return '';
        }
        if ($pngSizeName === 'ms')
        {
            $color  = $this->_config->getTileBackground();
            $tags[] = "<meta name='msapplication-TileColor' content='{$color}'>";
            $tags[] = "<meta name='msapplication-TileImage' content='{$this->_urlPrefix}/favicon-144.png'>";
            return implode("\n", $tags);
        }
        if ($pngSizeName === 'fav')
        {
            return "<link rel='icon href='{$this->_urlPrefix}/favicon-32.png' sizes='32x32>";
        }
        $size = $this->_availabelSizes[$pngSizeName]['size'];
        if ($pngSizeName === 'fav-57' || $pngSizeName == 'touch')
        {
            return "<link rel='apple-touch-icon-precomposed' href='{$this->_urlPrefix}/favicon-{$size}.png'>";
        }
        return "<link rel='apple-touch-icon-precomposed' sizes='{$size}x{$size}' href='{$this->_urlPrefix}/favicon-{$size}.png'>";
    }

}
