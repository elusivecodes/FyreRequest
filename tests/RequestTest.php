<?php
declare(strict_types=1);

namespace Tests;

use
    Fyre\Message\Message,
    Fyre\Request\Request,
    Fyre\Uri\Uri,
    PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{

    protected Request $request;

    public function testRequestMessage(): void
    {
        $this->assertInstanceOf(
            Message::class,
            $this->request
        );
    }

    public function testRequestUri(): void
    {
        $uri = new Uri();
        $request = new Request($uri);

        $this->assertEquals(
            $uri,
            $request->getUri()
        );
    }

    public function testRequestGetMethod(): void
    {
        $this->assertEquals(
            'get',
            $this->request->getMethod()
        );
    }

    public function testRequestGetUri(): void
    {
        $this->assertInstanceOf(
            Uri::class,
            $this->request->getUri()
        );
    }

    public function testRequestSetMethod(): void
    {
        $this->assertEquals(
            $this->request,
            $this->request->setMethod('post')
        );

        $this->assertEquals(
            'post',
            $this->request->getMethod()
        );
    }

    public function testRequestSetMethodUppercase(): void
    {
        $this->request->setMethod('POST');

        $this->assertEquals(
            'post',
            $this->request->getMethod()
        );
    }

    public function setUp(): void
    {
        $this->request = new Request();
    }

}
