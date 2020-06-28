# A basic WYSIWYG content editor which allows users to easily design and edit web content in the browser

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/content-editor-laravel.svg?style=flat-square)](https://packagist.org/packages/spatie/content-editor-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/content-editor-laravel/run-tests?label=tests)](https://github.com/spatie/content-editor-laravel/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/content-editor-laravel.svg?style=flat-square)](https://packagist.org/packages/spatie/content-editor-laravel)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

Stuff I think that needs to be done:
1) Install vue scaffolding for laravel ui
    ```bash
    php artisan ui vue
    ```
2) Add content-editor app.js to application app.js (I'm sure this can be cleaner)
    ```bash
    require( './../../vendor/weberlei/content-editor-laravel/dist/js/app')
    ```

You can install the package via composer:

```bash
composer require weberlei/content-editor-laravel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="WEBerlei\ContentEditorLaravel\ContentEditorServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="WEBerlei\ContentEditorLaravel\ContentEditorServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
$skeleton = new Spatie\Skeleton();
echo $skeleton->echoPhrase('Hello, Spatie!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Oliver Eberlei](https://github.com/OliverEberlei)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
