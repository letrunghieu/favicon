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

    public function testToArray()
    {
        $config = new Config;
        $array  = $config->turnOn('touch-144')
                ->setTileBackground('#f0f0f0')
                ->toArray();

        $this->assertArrayHasKey('sizes', $array);
        $this->assertCount(1, $array['sizes']);
        $this->assertArrayHasKey('touch-144', $array['sizes']);
        $this->assertEquals(1, $array['sizes']['touch-144']);
        $this->assertArrayHasKey('ms-tile-color', $array);
        $this->assertEquals('#F0F0F0', $array['ms-tile-color']);
    }

    public function testFromArray()
    {
        $array  = array(
            'ms-tile-color' => '#f0f0f0',
            'bar'           => 'baz',
            'sizes'         => array(
                'touch' => 1,
                'fav'   => false,
                'foo'   => 'bar',
            ),
        );
        $config = Config::fromArray($array);
        $sizes  = $config->getTurnedOnSizes();
        $this->assertEquals('#F0F0F0', $config->getTileBackground());
        $this->assertCount(1, $sizes);
        $this->assertArrayHasKey('touch', $sizes);
        $this->assertEquals(152, $sizes['touch']);
    }

}
