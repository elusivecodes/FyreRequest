<?php
declare(strict_types=1);

namespace Fyre\Request;

use
    Fyre\Message\Message,
    Fyre\Uri\Uri;

use function
    strtolower;

/**
 * Request
 */
class Request extends Message
{

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
    public function getURI(): Uri
    {
        return $this->uri;
    }

    /**
     * Set the request method.
     * @param string $method The request method.
     * @return Request The Request.
     */
    public function setMethod(string $method): self
    {
        $this->method = strtolower($method);

        return $this;
    }

}
