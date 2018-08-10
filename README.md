
[![Build Status](https://travis-ci.org/cleaniquecoders/laravel-helper.svg?branch=master)](https://travis-ci.org/cleaniquecoders/laravel-helper) [![Latest Stable Version](https://poser.pugx.org/cleaniquecoders/laravel-helper/v/stable)](https://packagist.org/packages/cleaniquecoders/laravel-helper) [![Total Downloads](https://poser.pugx.org/cleaniquecoders/laravel-helper/downloads)](https://packagist.org/packages/cleaniquecoders/laravel-helper) [![License](https://poser.pugx.org/cleaniquecoders/laravel-helper/license)](https://packagist.org/packages/cleaniquecoders/laravel-helper)

## About Your Package

A collection of helpers for your application.

## Installation

1. In order to install `cleaniquecoders/laravel-helper` in your Laravel project, just run the *composer require* command from your terminal:

```
$ composer require cleaniquecoders/laravel-helper
```

2. Then in your `config/app.php` add the following to the providers array:

```php
CleaniqueCoders\LaravelHelper\LaravelHelperServiceProvider::class,
```

3. In the same `config/app.php` add the following to the aliases array:

```php
'LaravelHelper' => CleaniqueCoders\LaravelHelper\LaravelHelperFacade::class,
```

4. Publish Laravel Helper config file:

```
$ php artisan vendor:publish --tag=laravel-helper
```

## Usage

*Generate Sequence*

`generate_sequence(313)`  will generate `000313`. This is quiet useful if you want to standardised the generate sequence number.

*Abbreviation*

`abbrv('your words')` will generate `YRWDS`.

You may configure `abbrv()` helper via helper config file.

*Fully Qualified Class Name, FQCN*

`fqcn($user)` - will return `App\User`. This will be useful if you dealing with Polymorph relationship.

*Slugged Name of FQCN*

`str_slug_fqcn($user)` - will generate `app-user`, kebab case of the FQCN. This will be useful if you want to have sluggable name of an object and use it as identifier in the database, instead of the FQCN.

## Test

To run the test, type `vendor/bin/phpunit` in your terminal.

To have codes coverage, please ensure to install PHP XDebug then run the following command:

```
$ vendor/bin/phpunit -v --coverage-text --colors=never --stderr
```

## Contributing

Thank you for considering contributing to the `cleaniquecoders/laravel-helper`!

### Bug Reports

To encourage active collaboration, it is strongly encourages pull requests, not just bug reports. "Bug reports" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

`cleaniquecoders/laravel-helper` follows the PSR-2 coding standard and the PSR-4 autoloading standard. 

You may use PHP CS Fixer in order to keep things standardised. PHP CS Fixer configuration can be found in `.php_cs`.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).