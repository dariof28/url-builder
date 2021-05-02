# UrlBuilder

This php package help to build urls.

![GitHub](https://img.shields.io/github/license/dariof28/url-builder) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/dariof28/url-builder) ![Packagist Downloads](https://img.shields.io/packagist/dt/dariof28/url-builder) ![Packagist Version](https://img.shields.io/packagist/v/dariof28/url-builder) [![LinkedIn](https://img.shields.io/badge/-LinkedIn-blue.svg?style=flat-square&logo=linkedin)](https://linkedin.com/in/dariof28)

## Installation

```shell
composer require dariof28/url-builder
```

## Usage

The simpler case is when you want to build an url from a host. By default, protocol is automatically set to `https`.

```php
use DariofDev\UrlBuilder\Url;

$url = new Url('foo.bar'); // https://foo.bar 
```

The host should not contain the protocol.

### Protocol
If you want to use another protocol you can use the `->setProtocol()` method

```php
use DariofDev\UrlBuilder\Url;

$url = (new Url('foo.bar'))
    ->setProtocol('sftp'); // sftp://foo.bar
```

Allowed protocols are:
- 'ftp'
- 'sftp'
- 'http'
- 'https'
- 'smtp'

If an invalid protocol is provided an `InvalidProtocolException` is thrown.

### Port

You can specify an arbitrary port. By default, no port is implied.

```php
use DariofDev\UrlBuilder\Url;

$url = (new Url('foo.bar'))
    ->setPort(8000); // https://foo.bar:8000
```

### Path

To define the path you can use `setPath()` method

```php
use DariofDev\UrlBuilder\Url;

$url = (new Url('foo.bar'))
    ->setPath('baz'); // https://foo.bar/baz
```

Path can also contain placeholder that will be replaced with given values

```php
use DariofDev\UrlBuilder\Url;

$url = (new Url('foo.bar'))
    ->setPath('baz/%s', [1]); // https://foo.bar/baz/1
```

### Params
Params can be simple strings as like as arrays.

You can add params in 2 ways:

- directly in the constructor:
```php
use DariofDev\UrlBuilder\Url;

$url = new Url('foo.bar', ['foo' => 'bar']); // https://foo.bar?foo=bar
```

- with fluent setter
```php
use DariofDev\UrlBuilder\Url;

$url = (new Url('foo.bar'))
    ->addParam('foo', 'bar')
    ->addParam('bar', ['baz' => 'foo']); // https://foo.bar?foo=bar&bar%5Bbaz%5D=foo
```
