# phpspec Silex Extension

[phpspec](http://www.phpspec.net/) Extension for testing [Silex](http://silex.sensiolabs.org)
applications.

## Installation

```bash
$ composer require --dev fdmweb/phpspec-silex
```

then add this to your `phpspec.yml`:

```yaml
extensions:
    PhpSpec\Silex\Extension\SilexExtension: ~
```

## Why this extension?

This extension provides you with a bootstrapped Silex environment when writing
your phpspec tests.

## Configuration

By default, the extension will bootstrap your app by looking for `app/bootstrap.php`. 

You can manually specify the path to the bootstrap file, like so:

```yaml
silex_extension:
    bootstrap_path: "/your/path/bootstrap.php"
```
Note: the given path is appended to the project root path, so should be preceded with a slash.

**Example of bootstrap.php**

```php
<?php

$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

return $app;

```

## Usage

If you want use silex $app extend your specs
from `PhpSpec\Silex\SilexObjectBehavior`.

**Example**

```php
<?php
namespace spec;

use PhpSpec\Silex\SilexObjectBehavior;

class ProductSpec extends SilexObjectBehavior
{
    function it_let()
    {
        $this->app #this is silex application
    }
}
```
