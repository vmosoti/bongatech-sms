# BongaTech SMS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vmosoti/bongatech-sms.svg?style=flat-square)](https://packagist.org/packages/vmosoti/bongatech-sms)
[![Build Status](https://img.shields.io/travis/vmosoti/bongatech-sms/master.svg?style=flat-square)](https://travis-ci.org/spatie/:package_name)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/xxxxxxxxx.svg?style=flat-square)](https://insight.sensiolabs.com/projects/xxxxxxxxx)
[![Total Downloads](https://img.shields.io/packagist/dt/vmosoti/bongatech-sms.svg?style=flat-square)](https://packagist.org/packages/vmosoti/bongatech-sms)


This is a PHP client library to be used with BongaTech's SMS API [See Bonga Tech's Website for more](http://bongatech.co.ke)

## Installation

You can install the package via composer:

``` bash
composer require vmosoti/bongatech-sms
```

## Usage

``` php
$sms = new VMosoti\BongaTech\SMS();
echo $sms->send('+254722123456', 'This is a Message');
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email vincent@vmosoti.com instead of using the issue tracker.

## Credits

- [Vincent Mosoti](https://github.com/vmosoti)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.