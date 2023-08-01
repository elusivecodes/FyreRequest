<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Http\Message;
use Fyre\Http\Request;
use Fyre\Http\Uri;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{

    public function testMessage(): void
    {
        $request = new Request();

        $this->assertInstanceOf(
            Message::class,
            $request
        );
    }

    public function testConstructor(): void
    {
        $uri = new Uri();

        $request = new Request($uri, [
            'method' => 'post',
            'body' => 'test',
            'headers' => [
                'test' => 'value'
            ],
            'protocolVersion' => '2.0'
        ]);

        $this->assertSame(
            $uri,
            $request->getUri()
        );

        $this->assertSame(
            'post',
            $request->getMethod()
        );

        $this->assertSame(
            'test',
            $request->getBody()
        );

        $this->assertSame(
            [
                'value'
            ],
            $request->getHeader('test')->getValue()
        );

        $this->assertSame(
            '2.0',
            $request->getProtocolVersion()
        );
    }

    public function testGetMethod(): void
    {
        $request = new Request();

        $this->assertSame(
            'get',
            $request->getMethod()
        );
    }

    public function testGetUri(): void
    {
        $request = new Request();

        $this->assertInstanceOf(
            Uri::class,
            $request->getUri()
        );
    }

    public function testSetMethod(): void
    {
        $request1 = new Request();
        $request2 = $request1->setMethod('post');

        $this->assertSame(
            'get',
            $request1->getMethod()
        );

        $this->assertSame(
            'post',
            $request2->getMethod()
        );
    }

    public function testSetMethodUppercase(): void
    {
        $request1 = new Request();
        $request2 = $request1->setMethod('POST');

        $this->assertSame(
            'get',
            $request1->getMethod()
        );

        $this->assertSame(
            'post',
            $request2->getMethod()
        );
    }

    public function testSetMethodInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $request = new Request();
        $request->setMethod('invalid');
    }

    public function testSetUri(): void
    {
        $uri1 = new Uri();
        $uri2 = new Uri();

        $request1 = new Request($uri1);
        $request2 = $request1->setUri($uri2);

        $this->assertSame(
            $uri1,
            $request1->getUri()
        );

        $this->assertSame(
            $uri2,
            $request2->getUri()
        );
    }

}
