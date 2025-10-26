<?php
declare(strict_types=1);

namespace Fyre\Http;

use Fyre\Http\Exceptions\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

use function in_array;
use function is_string;
use function preg_match;
use function strtoupper;

/**
 * Request
 */
class Request extends Message implements RequestInterface
{
    protected const VALID_METHODS = [
        'CONNECT',
        'DELETE',
        'GET',
        'HEAD',
        'OPTIONS',
        'PATCH',
        'POST',
        'PUT',
        'TRACE',
    ];

    protected string $method = 'GET';

    protected string|null $requestTarget = null;

    protected UriInterface $uri;

    /**
     * New Request constructor.
     *
     * @param string|UriInterface|null $uri The request URI.
     * @param array $options The request options.
     */
    public function __construct(string|UriInterface|null $uri = null, array $options = [])
    {
        parent::__construct($options);

        if (is_string($uri)) {
            $uri = new Uri($uri);
        } else {
            $uri ??= new Uri();
        }

        $options['method'] ??= 'GET';

        $this->method = static::filterMethod($options['method']);
        $this->uri = $uri;

        if (!$this->hasHeader('host') && $this->uri->getHost()) {
            $host = $this->uri->getHost();
            $port = $this->uri->getPort();

            $this->headerNames['host'] = 'Host';
            $this->headers['host'] = [$host.($port ? ':'.$port : '')];
        }
    }

    /**
     * Get the request method.
     *
     * @return string The request method.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Get the request target.
     *
     * @return string The request target.
     */
    public function getRequestTarget(): string
    {
        if ($this->requestTarget !== null) {
            return $this->requestTarget;
        }

        $target = $this->uri->getPath();

        if ($this->uri->getQuery()) {
            $target .= '?'.$this->uri->getQuery();
        }

        return $target ?: '/';
    }

    /**
     * Get the request URI.
     *
     * @return UriInterface The request URI.
     */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    /**
     * Clone the Request with a new method.
     *
     * @param string $method The request method.
     * @return Request A new Request.
     */
    public function withMethod(string $method): static
    {
        $temp = clone $this;

        $temp->method = static::filterMethod($method);

        return $temp;
    }

    /**
     * Clone the Request with a new request target.
     *
     * @param string $requestTarget The request target.
     * @return RequestInterface A new Request.
     */
    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        $temp = clone $this;

        $temp->requestTarget = static::filterRequestTarget($requestTarget);

        return $temp;
    }

    /**
     * Clone the Request with a new URI.
     *
     * @param UriInterface $uri The URI.
     * @return Request A new Request.
     */
    public function withUri(UriInterface $uri, bool $preserveHost = false): static
    {
        $temp = clone $this;

        $temp->uri = $uri;

        if ((!$preserveHost || !$temp->hasHeader('Host')) && $temp->uri->getHost()) {
            $host = $temp->uri->getHost();
            $port = $temp->uri->getPort();

            $temp->headerNames['host'] = 'Host';
            $temp->headers['host'] = [$host.($port ? ':'.$port : '')];
        }

        return $temp;
    }

    /**
     * Filter the method.
     *
     * @param string $method The method.
     * @return string The filtered method.
     *
     * @throws RequestException if the method is not valid.
     */
    protected static function filterMethod(string $method): string
    {
        $method = strtoupper($method);

        if (!in_array($method, static::VALID_METHODS)) {
            throw RequestException::forInvalidMethod($method);
        }

        return $method;
    }

    /**
     * Filter the request target.
     *
     * @param string $requestTarget The request target.
     * @return string The filtered request target.
     *
     * @throws RequestException if the request target is not valid.
     */
    protected static function filterRequestTarget(string $requestTarget): string
    {
        if (preg_match('/\s/', $requestTarget)) {
            throw RequestException::forInvalidRequestTarget($requestTarget);
        }

        return $requestTarget;
    }
}
