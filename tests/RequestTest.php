<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Http\Message,
    Fyre\Http\Request,
    Fyre\Uri\Uri,
    PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{

    protected Request $request;

    public function testMessage(): void
    {
        $this->assertInstanceOf(
            Message::class,
            $this->request
        );
    }

    public function testUri(): void
    {
        $uri = new Uri();
        $request = new Request($uri);

        $this->assertSame(
            $uri,
            $request->getUri()
        );
    }

    public function testGetMethod(): void
    {
        $this->assertSame(
            'get',
            $this->request->getMethod()
        );
    }

    public function testGetUri(): void
    {
        $this->assertInstanceOf(
            Uri::class,
            $this->request->getUri()
        );
    }

    public function testSetMethod(): void
    {
        $this->assertSame(
            $this->request,
            $this->request->setMethod('post')
        );

        $this->assertSame(
            'post',
            $this->request->getMethod()
        );
    }

    public function testSetMethodUppercase(): void
    {
        $this->request->setMethod('POST');

        $this->assertSame(
            'post',
            $this->request->getMethod()
        );
    }

    protected function setUp(): void
    {
        $this->request = new Request();
    }

}
