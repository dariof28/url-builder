<?php

declare(strict_types=1);

namespace DariofDev\UrlBuilder;

use DariofDev\UrlBuilder\Exceptions\InvalidProtocolException;

class Url
{
    private string $protocol = 'https';

    private string $host;

    private ?int $port = null;

    private ?string $path = null;

    private array $params;

    public function __construct(string $host, array $params = [])
    {
        $this->host = $host;
        $this->params = $params;
    }

    public function __toString(): string
    {
        $url = $this->protocol.'://'.$this->host;

        if (!empty($this->port)) {
            $url = trim($url, '/');
            $url .= ':'.$this->port;
        }

        if (!empty($this->path)) {
            $url = trim($url, '/');
            $url .= '/'.$this->path;
        }

        if (!empty($this->params)) {
            $url = trim($url, '/');
            $params = http_build_query($this->params);
            $url .= "?${params}";
        }

        return $url;
    }

    /**
     * @param string $protocol
     *
     * @return $this
     *
     * @throws InvalidProtocolException
     */
    public function setProtocol(string $protocol): self
    {
        if (!in_array($protocol, Protocols::all())) {
            throw new InvalidProtocolException('Protocol must be one of '.json_encode(Protocols::all()));
        }

        $this->protocol = $protocol;

        return $this;
    }

    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @param string $path
     * @param array  $values if path contains string placeholder they will be replaced by these values
     *
     * @return $this
     */
    public function setPath(string $path, array $values = []): self
    {
        $this->path = vsprintf($path, $values);

        return $this;
    }

    public function addParam(string $name, $value): self
    {
        $this->params[$name] = $value;

        return $this;
    }
}
