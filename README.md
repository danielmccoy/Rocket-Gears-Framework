# Rocket Gears Framework

An extremely minimal PHP web framework.

Heavily inspired by the awesome http://www.slimframework.com/ and http://laravel.com/ frameworks.

## Requirements

* [Composer](http://getcomposer.org)

## Installing Dependencies

To fetch dependencies into your local project, just run the install command of composer.phar.

```bash
$ php composer.phar install
```

OR

```bash
$ composer install
```

## PHPUnit

Run phpunit to check everything is working.

```bash
$ php vendor/bin/phpunit
```

## Basic Usage

```php
<?php
	
	// Class autoloader
	include_once('vendor/autoload.php');

	// Initialize framework
	$app = new RocketGears\Application();

	// Set up route (ie: /daniel)
	$app->get('/{name}', function($name){
		// Route response
		echo "Hello {$name}";
	})->where('name', '[a-z]+');

	// Run app
	$app->run();

```
