# FyreRequest

**FyreRequest** is a free, open-source immutable HTTP request library for *PHP*.


## Table Of Contents
- [Installation](#installation)
- [Basic Usage](#basic-usage)
- [Methods](#methods)



## Installation

**Using Composer**

```
composer require fyre/request
```

In PHP:

```php
use Fyre\Http\Request;
```


## Basic Usage

- `$uri` is a string or *UriInterface* and will default to *null*.
- `$options` is an array containing the message options.
    - `method` is a string representing the request method, and will default to "*get*".
    - `body` is a string or *StreamInterface* representing the message body, and will default to "".
    - `headers` is an array containing headers to set, and will default to *[]*.
    - `protocolVersion` is a string representing the protocol version, and will default to "*1.1*".

```php
$request = new Request($uri, $options);
```


## Methods

This class extends the [*Message*](https://github.com/elusivecodes/FyreMessage) class.

**Get Method**

Get the request method.

```php
$method = $request->getMethod();
```

**Get Request Target**

Get the request target.

```php
$requestTarget = $request->getRequestTarget();
```

**Get Uri**

Get the request URI.

```php
$uri = $request->getUri();
```

This method will return a [*Uri*](https://github.com/elusivecodes/FyreURI).

**With Method**

Clone the *Request* with a new method.

- `$method` is a string representing the request method.

```php
$newRequest = $request->withMethod($method);
```

**With Request Target**

Clone the *Request* with a new request target.

- `$requestTarget` is a string representing the request target.

```php
$newRequest = $request->withRequestTarget($requestTarget);
```

**With Uri**

Clone the *Request* with a new URI.

- `$uri` is a [*Uri*](https://github.com/elusivecodes/FyreURI).
- `$preserveHost` is a boolean indicating whether to preserve the host header, and will default to *false*.

```php
$newRequest = $request->withUri($uri, $preserveHost);
```