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
     * @param array $options The request options.
     */
    public function __construct(Uri|null $uri = null, array $options = [])
    {
        parent::__construct($options);

        $uri ??= new Uri();
        $options['method'] ??= 'get';

        $this->method = static::filterMethod($options['method']);

        $this->uri = $uri;
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
     */
    public function setMethod(string $method): static
    {
        $temp = clone $this;

        $temp->method = static::filterMethod($method);

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

    /**
     * Filter the method.
     * @param string $method The method.
     * @return string The filtered method.
     * @throws InvalidArgumentException if the method is not valid.
     */
    protected static function filterMethod(string $method): string
    {
        $method = strtolower($method);

        if (!in_array($method, static::VALID_METHODS)) {
            throw new InvalidArgumentException('Invalid method: '.$method);
        }

        return $method;
    }

}
