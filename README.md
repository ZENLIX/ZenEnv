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
$env = new ZenEnv('/Users/rustem/Sites/Code/envfile.txt');
```

Delete by keys
```php
$env->delete(['KEY1', 'KEY2']);
```

Add key/value
```php
$env->add([
'KEY'=>'VAL',
'KEY2'=>'VAL2'
]);
```

Get array of key/values
```php
$env->get();
```

Change key/value
```php
$env->set([
'PARAM1'=>'VALUE',
'PARAM2'=>'VALUE'
]);
```
