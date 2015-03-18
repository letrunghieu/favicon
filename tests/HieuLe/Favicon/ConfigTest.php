<?php

namespace HieuLe\Favicon;

/**
 * Description of ConfigTest
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{

    public function testGetSizes()
    {
        $sizes = Config::getSizes();
        $this->assertCount(23, $sizes);
    }

    public function testGetSizesNoOldApple()
    {
        $sizes = Config::getSizes(true);
        $this->assertCount(19, $sizes);
        $this->assertArrayNotHasKey('apple-touch-icon-57x57.png', $sizes);
        $this->assertArrayNotHasKey('apple-touch-icon-60x60.png', $sizes);
        $this->assertArrayNotHasKey('apple-touch-icon-72x72.png', $sizes);
        $this->assertArrayNotHasKey('apple-touch-icon-144x144.png', $sizes);
    }

    public function testgetSizesNoAndroid()
    {
        $sizes = Config::getSizes(false, true);
        $this->assertCount(18, $sizes);
        $this->assertArrayNotHasKey('android-chrome-36x36.png', $sizes);
        $this->assertArrayNotHasKey('android-chrome-48x48.png', $sizes);
        $this->assertArrayNotHasKey('android-chrome-72x72.png', $sizes);
        $this->assertArrayNotHasKey('android-chrome-96x96.png', $sizes);
        $this->assertArrayNotHasKey('android-chrome-144x144.png', $sizes);
    }

    public function testGetSizesNoMs()
    {
        $sizes = Config::getSizes(false, true);
        $this->assertCount(18, $sizes);
        $this->assertArrayNotHasKey('mstile-70x70', $sizes);
        $this->assertArrayNotHasKey('mstile-144x144', $sizes);
        $this->assertArrayNotHasKey('mstile-150x150', $sizes);
        $this->assertArrayNotHasKey('mstile-310x310', $sizes);
        $this->assertArrayNotHasKey('mstile-310x150', $sizes);
    }

    public function testGetSizesNoAll()
    {
        $sizes = Config::getSizes(true, true, true);
        $this->assertCount(9, $sizes);
    }

}
