<?php
declare(strict_types=1);

namespace Fyre\Http;

use InvalidArgumentException;

use function in_array;
use function strtolower;

/**
 * Request
 */
class Request extends Message
{

    protected const VALID_METHODS = [
        'connect',
        'delete',
        'get',
        'head',
        'options',
        'patch',
        'post',
        'put',
        'trace'
    ];

    protected string $method = 'get';

    protected Uri $uri;

    /**
     * New Request constructor.
     * @param Uri|null $uri The request URI.
     */
    public function __construct(Uri|null $uri = null)
    {
        $this->uri = $uri ?? new Uri();
    }

    /**
     * Get the request method.
     * @return string The request method.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Get the request URI.
     * @return Uri The request URI.
     */
    public function getUri(): Uri
    {
        return $this->uri;
    }

    /**
     * Set the request method.
     * @param string $method The request method.
     * @return Request A new Request.
     * @throws InvalidArgumentException if the method is not valid.
     */
    public function setMethod(string $method): static
    {
        $method = strtolower($method);

        if (!in_array($method, static::VALID_METHODS)) {
            throw new InvalidArgumentException('Invalid method: '.$method);
        }

        $temp = clone $this;

        $temp->method = $method;

        return $temp;
    }

    /**
     * Set the request URI.
     * @param Uri $uri The URI.
     * @return Request A new Request.
     */
    public function setUri(Uri $uri): static
    {
        $temp = clone $this;

        $temp->uri = $uri;

        return $temp;
    }

}
