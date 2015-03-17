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
        $this->assertCount(9, $sizes);
        $this->assertArrayHasKey('size', end($sizes));
        $this->assertArrayHasKey('label', end($sizes));
    }

    public function testTurnOn()
    {
        $config = new Config;
        $sizes  = $config->turnOn('touch')
                ->turnOn('fav')
                ->turnOn('foo')
                ->getTurnedOnSizes();

        $this->assertCount(2, $sizes);
        $this->assertArrayHasKey('touch', $sizes);
        $this->assertArrayHasKey('fav', $sizes);
        $this->assertArrayNotHasKey('foo', $sizes);
        $this->assertEquals($sizes['touch'], 152);
        $this->assertEquals($sizes['fav'], 32);
    }

    public function testTurnOff()
    {
        $config = new Config;
        $sizes  = $config->turnOn('touch')
                ->turnOn('fav')
                ->turnOff('touch')
                ->getTurnedOnSizes();

        $this->assertCount(1, $sizes);
        $this->assertArrayNotHasKey('touch', $sizes);
        $this->assertArrayHasKey('fav', $sizes);
        $this->assertEquals($sizes['fav'], 32);
    }

    public function testAllOn()
    {
        $config = new Config;
        $sizes  = $config->allOn()
                ->getTurnedOnSizes();
        $this->assertCount(9, $sizes);
        $this->assertArrayHasKey('fav', $sizes);
        $this->assertEquals($sizes['fav'], 32);
        $this->assertArrayHasKey('ms', $sizes);
        $this->assertEquals($sizes['ms'], 144);
    }

    public function testAllOff()
    {
        $config = new Config;
        $sizes  = $config->allOn()
                ->allOff()
                ->getTurnedOnSizes();
        $this->assertEmpty($sizes);
    }

}
