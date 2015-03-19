<?php

if (!function_exists('favicon'))
{

    /**
     * Include all available options
     */
    define('FAVICON_ENABLE_ALL', 0);

    /**
     * exclude old apple touch link
     */
    define('FAVICON_NO_OLD_APPLE', 1);

    /**
     * exclude android manifest.json file
     */
    define('FAVICON_NO_ANDROID', 2);

    /**
     * exclude msapplication meta tags
     */
    define('FAVICON_NO_MS', 4);

    /**
     * Helper function to write <code>link</code> and <code>meta</code> tags for favicons
     * 
     * @param int $option decide which type of favicon will be included in the final result. Default will be <code>FAVICON_ENABLE_ALL</code> to include any thing. The old apple touch link tags will be exclude with <code>FAVICON_NO_OLD_APPLE</code> bit, the android <code>manifest.json</code> link tag will be exclude with <code>FAVICON_NO_ANDROID</code> bit and the Microsoft Windows and IE msapplication meta tags will be excluded with <code>FAVICON_NO_MS</code> bit.
     * @param array $msOptions more information for Windows and IE msapplication meta tags. The input array can have these field:
     * <ul>
     *   <li><code>tile_color</code>: the background of live tile when this site is pinned, default is white (#ffffff)</li>
     *   <li><code>browser_config_file</code>: the path to browser config XML file if you have it. By default, it is set to an empty string to prevent IE from auto looking <code>browserconfig.xml</code> file</li>
     *   <li><code>application_name</code>: the default application name displayed when user pinned this site</li>
     * </ul>
     * 
     * @return string the output HTML
     */
    function favicon($option = FAVICON_ENABLE_ALL, array $msOptions = array())
    {
        $noOldApple        = FAVICON_NO_OLD_APPLE & $option;
        $noAndroid         = FAVICON_NO_ANDROID & $option;
        $noMs              = FAVICON_NO_MS & $option;
        $tileColor         = strtoupper(isset($msOptions['tile_color']) ? $msOptions['tile_color'] : '#ffffff');
        $browserConfigFile = isset($msOptions['browser_config_file']) ? $msOptions['browser_config_file'] : '';
        $appName           = isset($msOptions['application_name']) ? $msOptions['application_name'] : '';
        return HieuLe\Favicon\Html::output($noOldApple, $noAndroid, $noMs, $tileColor, $browserConfigFile, $appName);
    }

}

