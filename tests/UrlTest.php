<?php

declare(strict_types=1);

namespace DariofDev\UrlBuilder\Tests;

use DariofDev\UrlBuilder\Exceptions\InvalidProtocolException;
use DariofDev\UrlBuilder\Url;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class UrlTest extends TestCase
{
    public function testDefault()
    {
        $url = new Url('foo.bar');

        $this->assertEquals('https://foo.bar/', (string) $url);
    }

    public function testWithDefaultParams()
    {
        $url = new Url('foo.bar', ['foo' => 'bar', 'bar' => 'foo']);

        $this->assertEquals('https://foo.bar?foo=bar&bar=foo', (string) $url);
    }

    public function testWithProtocol()
    {
        $url = (new Url('foo.bar'))->setProtocol('http');

        $this->assertEquals('http://foo.bar', (string) $url);
    }

    public function testWithPort()
    {
        $url = (new Url('foo.bar'))->setPort(443);

        $this->assertEquals('https://foo.bar:443', (string) $url);
    }

    public function testWithPath()
    {
        $url = (new Url('foo.bar'))->setPath('baz');

        $this->assertEquals('https://foo.bar/baz', (string) $url);
    }

    public function testAddParam()
    {
        $url = (new Url('foo.bar'))->addParam('foo', 'bar');

        $this->assertEquals('https://foo.bar?foo=bar', (string) $url);
    }

    public function testAddParamWithDefault()
    {
        $url = (new Url('foo.bar', ['bar' => 'foo']))
            ->addParam('foo', 'bar');

        $this->assertEquals('https://foo.bar?bar=foo&foo=bar', (string) $url);
    }

    public function testHostCanHaveTrailingSlashWithoutPortOrPath()
    {
        $url = new Url('foo.bar/');

        $this->assertEquals('https://foo.bar/', (string) $url);
    }

    public function testRemoveTrailingSlashIfPortIsProvided()
    {
        $url = (new Url('foo.bar/'))->setPort(443);

        $this->assertEquals('https://foo.bar:443', (string) $url);
    }

    public function testAvoidDoubleTrailingSlashIfPathIsProvided()
    {
        $url = (new Url('foo.bar/'))->setPath('baz');

        $this->assertEquals('https://foo.bar/baz', (string) $url);
    }

    public function testAvoidTrailingSlashIfParamIsProvided()
    {
        $url = new Url('foo.bar/', ['foo' => 'bar']);

        $this->assertEquals('https://foo.bar?foo=bar', (string) $url);
    }

    public function testFullUrl()
    {
        $url = (new Url('foo.bar'))
            ->setProtocol('http')
            ->setPort(80)
            ->setPath('baz/dev');

        $this->assertEquals('http://foo.bar:80/baz/dev', (string) $url);
    }

    public function testUrlParamsAreEncoded()
    {
        $url = new Url('foo.bar', ['email' => 'email@example.com']);

        $this->assertEquals('https://foo.bar?email=email%40example.com', (string) $url);
    }

    public function testArrayAsParameter()
    {
        $url = new Url('foo.bar', ['foo' => ['bar', 'baz']]);

        $this->assertEquals('https://foo.bar?foo%5B0%5D=bar&foo%5B1%5D=baz', (string) $url);
    }

    public function testAssociativeArrayAsParameter()
    {
        $url = new Url('foo.bar', ['foo' => ['bar' => 'baz']]);

        $this->assertEquals('https://foo.bar?foo%5Bbar%5D=baz', (string) $url);
    }

    public function testInvalidProtocolGiven()
    {
        $this->expectException(InvalidProtocolException::class);

        (new Url('foo.bar'))->setProtocol('foo');
    }

    public function testCanUsePlaceholderInPath()
    {
        $url = (new Url('foo.bar'))->setPath('posts/%s/comments', [1]);

        $this->assertEquals('https://foo.bar/posts/1/comments', (string) $url);
    }
}
