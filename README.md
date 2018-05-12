# IcoBench Client

This library is an API client for https://icobench.com

## Installation
```bash
composer require kami/icobench-client
```

## Usage
```php
<?php

$publicKey = 'your-key';
$privateKey = 'your-key';

$client = new \Kami\IcoBench\Client($privateKey, $publicKey);

$client->getIco($id, $data);
$client->getIcos($type, $data);
$client->getOther($type);
$client->getPeople($type, $data);
``` 