<?php

namespace HieuLe\Favicon;

/**
 * Description of HtmlTest
 *
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 */
class HtmlTest extends \PHPUnit_Framework_TestCase
{

//    public function testGetLinkTag()
//    {
//        $config = new Config;
//        $config->allOn();
//        $html   = new Html($config, 'foo');
//
//        $tag = $html->getLinkTag('bar');
//        $this->assertEquals('', $tag);
//
//        $tag = $html->getLinkTag('ms');
//        $this->assertEquals("<meta name='msapplication-TileColor' content='#FFFFFF'>\n<meta name='msapplication-TileImage' content='foo/favicon-144.png'>", $tag);
//
//        $tag = $html->getLinkTag('fav');
//        $this->assertEquals("<link rel='icon href='foo/favicon-32.png' sizes='32x32>", $tag);
//
//        $tag = $html->getLinkTag('fav-57');
//        $this->assertEquals("<link rel='apple-touch-icon-precomposed' href='foo/favicon-57.png'>", $tag);
//
//        $tag = $html->getLinkTag('touch');
//        $this->assertEquals("<link rel='apple-touch-icon-precomposed' href='foo/favicon-152.png'>", $tag);
//
//        $tag = $html->getLinkTag('touch-72');
//        $this->assertEquals("<link rel='apple-touch-icon-precomposed' sizes='72x72' href='foo/favicon-72.png'>", $tag);
//
//        $tag = $html->getLinkTag('touch-114');
//        $this->assertEquals("<link rel='apple-touch-icon-precomposed' sizes='114x114' href='foo/favicon-114.png'>", $tag);
//    }
//
//    public function testOutput()
//    {
//        $config = new Config;
//        $config->setTileBackground('#f0f0f0')
//                ->turnOn('ms')
//                ->turnOn('fav');
//        $html   = new Html($config, 'foo');
//
//        $expected = "<meta name='msapplication-TileColor' content='#F0F0F0'>\n<meta name='msapplication-TileImage' content='foo/favicon-144.png'>\n<link rel='icon href='foo/favicon-32.png' sizes='32x32>";
//
//        $this->assertEquals($expected, $html->output());
//    }

}
