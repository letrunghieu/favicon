<?php

if (!function_exists('favicon'))
{

    /**
     * Write meta and link tags
     * 
     * @param bool $noOldApple exclude old apple touch link
     * @param bool $noAndroid exclude android manifest.json file
     * @param bool $noMs exclude msapplication meta tags
     * @param tring $tileColor the color of Windows tile
     * @param string $browserConfigFile the path to browserconfig.xml file or null to disable this
     * @param string $appName the name of application when pinned
     * 
     * @return string 
     */
    function favicon($noOldApple = false, $noAndroid = false, $noMs = false, $tileColor = '#FFFFFF', $browserConfigFile = '', $appName = '')
    {
        return HieuLe\Favicon\Html::output($noOldApple, $noAndroid, $noMs, $tileColor, $browserConfigFile, $appName);
    }

}

