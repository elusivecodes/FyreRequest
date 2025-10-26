<?php
declare(strict_types=1);

namespace Fyre\Http\Exceptions;

use RuntimeException;

/**
 * RequestException
 */
class RequestException extends RuntimeException
{
    public static function forInvalidMethod(string $method): self
    {
        return new self('Invalid HTTP method: '.$method);
    }

    public static function forInvalidRequestTarget(string $requestTarget): self
    {
        return new self('Invalid request target: '.$requestTarget);
    }
}
