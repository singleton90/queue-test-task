<?php

namespace Tests\Unit;

use App\Exceptions\EmptyUrlException;
use App\Exceptions\WrongUrlException;
use App\Models\Interfaces\UrlInterface;
use App\Models\VO\Url;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Models\VO\Url
 * @package Tests\Unit
 */
class UrlTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function test_empty_url()
    {
        $this->expectException(EmptyUrlException::class);
        new Url('');
    }

    /**
     * @covers ::__construct
     */
    public function test_wrong_url()
    {
        $this->expectException(WrongUrlException::class);
        new Url('wrong.url');
    }

    /**
     * @covers ::urlString
     * @covers ::__toString
     */
    public function test_url_string()
    {
        $url = 'https://google.com';
        $urlObj = new Url($url);
        $this->assertEquals($url, $urlObj->urlString());
        $this->assertEquals($url, strval($urlObj));
    }

    public function test_url_interface()
    {
        $url = 'https://google.com';
        $urlObj = new Url($url);
        $this->assertInstanceOf(UrlInterface::class, $urlObj);
    }
}
