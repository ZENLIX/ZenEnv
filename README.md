[![License](https://poser.pugx.org/zenlix/zenenv/license)](https://packagist.org/packages/zenlix/zenenv)
[![Total Downloads](https://poser.pugx.org/zenlix/zenenv/downloads)](https://packagist.org/packages/zenlix/zenenv)

# ZenEnv
PHP class that helps work with .env
----

Install
```sh
composer require zenlix/zenenv
```

Use
```php
use ZenEnv\ZenEnv;
```


Initializing ZenEnv
```php
$env = new ZenEnv('/home/rustem/web/public_html/.env');
```


Get array of key/values
```php
$env->get();
```
Result:
```php
print_r($env-get());
```
```php
['PARAM1'=>'VALUE1','PARAM2'=>'VALUE2']
```


Delete by keys
```php
$env->delete(['KEY1', 'KEY2']);
```
Before:
```shell
PARAM1=VALUE1
PARAM2=VALUE2
PARAM3=VALUE3
```
After:
```shell
PARAM3=VALUE3
```


Add key/value
```php
$env->add([
'KEY'=>'VAL',
'KEY2'=>'VAL2'
]);
```
Before:
```shell
PARAM1=VALUE1
PARAM2=VALUE2
PARAM3=VALUE3
```
After:
```shell
PARAM1=VALUE1
PARAM2=VALUE2
PARAM3=VALUE3
KEY=VAL
KEY2=VAL2
```


Change key/value
```php
$env->set([
'PARAM1'=>'VALUE',
'PARAM2'=>'VALUE'
]);
```
Before:
```shell
PARAM1=VALUE1
PARAM2=VALUE2
PARAM3=VALUE3
```
After:
```shell
PARAM1=VALUE
PARAM2=VALUE
PARAM3=VALUE3
```
