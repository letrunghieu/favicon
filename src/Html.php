<?php

namespace HieuLe\Favicon;

/**
 * Output HTML tags based on a config
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class Html
{

    public static function output($noOldApple = false, $noAndroid = false, $noMs = false, $tileColor = '#FFF', $browserConfigFile = '', $appName = '')
    {
        $result = array();
        if (!$browserConfigFile)
        {
            $result[] = '<meta name="msapplication-config" content="none"/>';
        }
        else
        {
            $result[] = '<meta name="msapplication-config" content="' . $browserConfigFile . '" />';
        }
        if (!$noOldApple)
        {
            $result[] = '<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">';
            $result[] = '<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">';
            $result[] = '<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">';
            $result[] = '<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">';
        }
        $result[] = '<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">';
        $result[] = '<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">';
        $result[] = '<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">';
        $result[] = '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">';
        $result[] = '<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">';
        $result[] = '<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">';
        $result[] = '<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">';
        if (!$noAndroid)
        {
            $result[] = '<link rel="manifest" href="/manifest.json">';
        }
        if (!$noMs)
        {
            if ($appName)
            {
                $result[] = '<meta name="application-name" content="' . $appName . '">';
            }
            $result[] = '<meta name="msapplication-TileColor" content="' . $tileColor . '">';
            $result[] = '<meta name="msapplication-TileImage" content="/mstile-144x144.png">';
            $result[] = '<meta name="msapplication-square70x70logo" content="/mstile-70x70.png">';
            $result[] = '<meta name="msapplication-square150x150logo" content="/mstile-150x150.png">';
            $result[] = '<meta name="msapplication-wide310x150logo" content="/mstile-310x150.png">';
            $result[] = '<meta name="msapplication-square310x310logo" content="/mstile-310x310.png">';
        }

        return implode("\n", $result);
    }

}
