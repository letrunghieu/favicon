<?php

namespace HieuLe\Favicon;

/**
 * Description of HtmlTest
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class HtmlTest extends \PHPUnit_Framework_TestCase
{

    public function testOutputNoConfig()
    {
        $expected = array(
            '<meta name="msapplication-config" content="none" />',
            '<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />',
            '<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />',
            '<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />',
            '<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />',
            '<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />',
            '<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />',
            '<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />',
            '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />',
            '<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />',
            '<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192" />',
            '<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />',
            '<link rel="manifest" href="/manifest.json" />',
            '<meta name="msapplication-TileColor" content="#FFFFFF" />',
            '<meta name="msapplication-TileImage" content="/mstile-144x144.png" />',
            '<meta name="msapplication-square70x70logo" content="/mstile-70x70.png" />',
            '<meta name="msapplication-square150x150logo" content="/mstile-150x150.png" />',
            '<meta name="msapplication-wide310x150logo" content="/mstile-310x150.png" />',
            '<meta name="msapplication-square310x310logo" content="/mstile-310x310.png" />',
        );
        $html     = Html::output();
        $this->assertEquals(implode("\n", $expected), $html);
    }

    public function testOutputNoOldApple()
    {
        $expected = array(
            '<meta name="msapplication-config" content="none" />',
            '<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />',
            '<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />',
            '<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />',
            '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />',
            '<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />',
            '<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192" />',
            '<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />',
            '<link rel="manifest" href="/manifest.json" />',
            '<meta name="msapplication-TileColor" content="#FFFFFF" />',
            '<meta name="msapplication-TileImage" content="/mstile-144x144.png" />',
            '<meta name="msapplication-square70x70logo" content="/mstile-70x70.png" />',
            '<meta name="msapplication-square150x150logo" content="/mstile-150x150.png" />',
            '<meta name="msapplication-wide310x150logo" content="/mstile-310x150.png" />',
            '<meta name="msapplication-square310x310logo" content="/mstile-310x310.png" />',
        );
        $html     = Html::output(true);
        $this->assertEquals(implode("\n", $expected), $html);
    }

    public function testOutputNoAndroid()
    {
        $expected = array(
            '<meta name="msapplication-config" content="none" />',
            '<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />',
            '<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />',
            '<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />',
            '<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />',
            '<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />',
            '<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />',
            '<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />',
            '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />',
            '<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />',
            '<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192" />',
            '<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />',
            '<meta name="msapplication-TileColor" content="#FFFFFF" />',
            '<meta name="msapplication-TileImage" content="/mstile-144x144.png" />',
            '<meta name="msapplication-square70x70logo" content="/mstile-70x70.png" />',
            '<meta name="msapplication-square150x150logo" content="/mstile-150x150.png" />',
            '<meta name="msapplication-wide310x150logo" content="/mstile-310x150.png" />',
            '<meta name="msapplication-square310x310logo" content="/mstile-310x310.png" />',
        );
        $html     = Html::output(false, true);
        $this->assertEquals(implode("\n", $expected), $html);
    }

    public function testOutputNoMs()
    {
        $expected = array(
            '<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />',
            '<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />',
            '<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />',
            '<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />',
            '<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />',
            '<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />',
            '<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />',
            '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />',
            '<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />',
            '<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192" />',
            '<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />',
            '<link rel="manifest" href="/manifest.json" />',
        );
        $html     = Html::output(false, false, true);
        $this->assertEquals(implode("\n", $expected), $html);
    }

    public function testOutputFullMsInfo()
    {
        $expected = array(
            '<meta name="msapplication-config" content="/IEConfig.xml" />',
            '<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />',
            '<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />',
            '<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />',
            '<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />',
            '<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />',
            '<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />',
            '<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />',
            '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />',
            '<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />',
            '<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192" />',
            '<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />',
            '<link rel="manifest" href="/manifest.json" />',
            '<meta name="application-name" content="Foo App" />',
            '<meta name="msapplication-TileColor" content="#F0F0F0" />',
            '<meta name="msapplication-TileImage" content="/mstile-144x144.png" />',
            '<meta name="msapplication-square70x70logo" content="/mstile-70x70.png" />',
            '<meta name="msapplication-square150x150logo" content="/mstile-150x150.png" />',
            '<meta name="msapplication-wide310x150logo" content="/mstile-310x150.png" />',
            '<meta name="msapplication-square310x310logo" content="/mstile-310x310.png" />',
        );
        $html     = Html::output(false, false, false, '#F0F0F0', 'IEConfig.xml', 'Foo App');
        $this->assertEquals(implode("\n", $expected), $html);
    }

    public function testHelperFunctionWithMs()
    {
        $expected = array(
            '<meta name="msapplication-config" content="/IEConfig.xml" />',
            '<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />',
            '<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />',
            '<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />',
            '<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />',
            '<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />',
            '<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />',
            '<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />',
            '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />',
            '<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />',
            '<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192" />',
            '<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />',
            '<link rel="manifest" href="/manifest.json" />',
            '<meta name="application-name" content="Foo App" />',
            '<meta name="msapplication-TileColor" content="#F0F0F0" />',
            '<meta name="msapplication-TileImage" content="/mstile-144x144.png" />',
            '<meta name="msapplication-square70x70logo" content="/mstile-70x70.png" />',
            '<meta name="msapplication-square150x150logo" content="/mstile-150x150.png" />',
            '<meta name="msapplication-wide310x150logo" content="/mstile-310x150.png" />',
            '<meta name="msapplication-square310x310logo" content="/mstile-310x310.png" />',
        );
        $html     = favicon(FAVICON_ENABLE_ALL, array(
            'tile_color'          => '#F0F0F0',
            'browser_config_file' => 'IEConfig.xml',
            'application_name'    => 'Foo App'
        ));
        $this->assertEquals(implode("\n", $expected), $html);
    }

    public function testHelperFunctionMinimal()
    {
        $expected = array(
            '<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />',
            '<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />',
            '<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />',
            '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />',
            '<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />',
            '<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192" />',
            '<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />',
        );
        $html     = favicon(FAVICON_NO_OLD_APPLE | FAVICON_NO_ANDROID | FAVICON_NO_MS);
        $this->assertEquals(implode("\n", $expected), $html);
    }

}
