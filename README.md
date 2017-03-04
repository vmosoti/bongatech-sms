# BongaTech SMS

[![Latest Stable Version](https://poser.pugx.org/vmosoti/bongatech-sms/v/stable)](https://packagist.org/packages/vmosoti/bongatech-sms)
[![Latest Unstable Version](https://poser.pugx.org/vmosoti/bongatech-sms/v/unstable)](https://packagist.org/packages/vmosoti/bongatech-sms)
[![StyleCI](https://styleci.io/repos/83431204/shield?branch=master)](https://styleci.io/repos/83431204)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/VMosoti/bongatech-sms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/VMosoti/bongatech-sms/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/598f97e6-bb46-4883-ae19-29820926b081/mini.png)](https://insight.sensiolabs.com/projects/598f97e6-bb46-4883-ae19-29820926b081)
[![Total Downloads](https://poser.pugx.org/vmosoti/bongatech-sms/downloads)](https://packagist.org/packages/vmosoti/bongatech-sms)
[![License](https://poser.pugx.org/vmosoti/bongatech-sms/license)](https://packagist.org/packages/vmosoti/bongatech-sms)


This is a PHP client library to be used with BongaTech's SMS API [See Bonga Tech's Website for more](http://bongatech.co.ke)

## Installation

You can install the package via composer:

``` bash
composer require vmosoti/bongatech-sms
```

## Usage

### Providing variables

The Config class requires to fetch some variable from the system environment. 
These variables are the ones used in initialization of the SMS class.
In your .env file:

```
BONGATECH_USER_ID=
BONGATECH_PASSWORD=
BONGATECH_SENDER_ID=
BONGATECH_CALL_BACK_URL=
```

### Initializing the SMS class

To initialize:
``` php
$sms = new  \VMosoti\BongaTech\SMS();

```
or simply use the magic helper function:

```php
sms()  // you have the SMS object
```
### Recipients and Messages
Each of them is an array of arrays.
i.e
```php
$recipients = array(
        array(
            'MSISDN' => '0722123456',
            'LinkID' => '',
            'SourceID' => 'your source id here'
        ),
        array(
            'MSISDN' => '0775345678',
            'LinkID' => '',
            'SourceID' => 'source id for this here'
        )
    );
```
and messages

```php
$messages = array(
        array(
            'Text' => 'Message 1 goes here'
        ),
        array(
            'Text' => 'Message 2 goes here'
        )
    );
```
### Sending for single recipient
```php
$message = array(
        array(
            'Text' => 'This message is for a single recipient'
        )
    );
    
$recipient = array(
        array(
            'MSISDN' => '0722123456',
            'LinkID' => '',
            'SourceID' => 'your source id here'
        )
    );
    
$response = $sms->messageTypeBulk()->batchTypeNoBatch()->send($recipient, $message);
```
or use helper function

```php
$response = sms()->messageTypeBulk()->batchTypeNoBatch()->send($recipient, $message);
```
The above returns a single [Response](https://github.com/VMosoti/bongatech-sms/blob/master/src/Response.php) object

### Sending 1 sms to many recipients
```php
$message = array(
        array(
            'Text' => 'This message goes to many recipients'
        )
    );
    
$recipients = array(
        array(
            'MSISDN' => '0722123456',
            'LinkID' => '',
            'SourceID' => 'source id for recipient 1'
        ),
        array(
            'MSISDN' => '0713678900',
            'LinkID' => '',
            'SourceID' => 'source id for recipient 2'
            ),
    );
    
$responses = $sms->messageTypeBulk()->batchTypeSameMessage()->send($recipients, $message);
```
### Sending different message for each recipient
```php
$messages = array(
        array(
            'Text' => 'This is message for recipient 1'
        ),
        array(
             'Text' => 'This is message for recipient 2'
        )
    );
    
$recipients = array(
        array(
            'MSISDN' => '0722123456',
            'LinkID' => '',
            'SourceID' => 'source id for recipient 1'
        ),
        array(
            'MSISDN' => '0713678900',
            'LinkID' => '',
            'SourceID' => 'source id for recipient 2'
            ),
    );
    
$responses = $sms->messageTypeBulk()->batchTypeDifferentMessages()->send($recipients, $messages);
```
The above two examples returns an array of the [Response](https://github.com/VMosoti/bongatech-sms/blob/master/src/Response.php) object.
Thus:
```php
foreach($responses as $response){
$response->getCode();
------
}
```

### Querying SMS units balance

```php
$response = SMS::getBalance();
```
or just throw in the helper function

```php
get_balance();
```
`$response` is [Response](https://github.com/VMosoti/bongatech-sms/blob/master/src/Response.php) object. thus 

```php
$response->getBalance()
```

## Delivery Reports

In your callback,
```php
$response = \VMosoti\BongaTech\DeliveryReport::get();
````
It returns [Response](https://github.com/VMosoti/bongatech-sms/blob/master/src/Response.php) object,

thus:

```
$response->getReport();
$response->getMessageID();
$response->getCorrelator();
$response->getSourceID();
```
See all possible reports [here](DELIVERYREPORTS.md)
## Exceptions

catch `\VMosoti\BongaTech\Exceptions\BongaTechException;`

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Suggestions, pull requests , bug reporting and code improvements are all welcome. Feel free to get in touch.

## Security

If you discover any security related issues, please email vincent@vmosoti.com instead of using the issue tracker.

## Credits

- [Vincent Mosoti](https://github.com/vmosoti)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
