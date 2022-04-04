# FyreRequest

**FyreRequest** is a free, HTTP request library for *PHP*.


## Table Of Contents
- [Installation](#installation)
- [Request Creation](#request-creation)
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


## Request Creation

- `$uri` is a [*Uri*](https://github.com/elusivecodes/FyreURI) and will default to *null*.

```php
$request = new Request($uri);
```


## Methods

This class extends the [*Message*](https://github.com/elusivecodes/FyreMessage) class.

**Get Method**

Get the request method.

```php
$method = $request->getMethod();
```

**Get Uri**

Get the request URI.

```php
$uri = $request->getUri();
```

This method will return a [*Uri*](https://github.com/elusivecodes/FyreURI).

**Set Method**

Set the request method.

- `$method` is a string representing the request method.

```php
$request->setMethod($method);
```