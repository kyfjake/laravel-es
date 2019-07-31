# README

Laravel elastic search service provider.

# Install

```bash
composer require kyfjake/laravel-es
php artisan laravel-es publish

``` 

# Config

edit file ``config/laravel-es.php``
```php
<?php

return [
    # es host
    'hosts' => explode(',', env('ES_HOST', 'localhost')),
    # retries times
    'retries' => 2,
];
```
[More](https://www.elastic.co/guide/en/elasticsearch/client/php-api/6.5.x/configuration.html#_building_the_client_from_a_configuration_hash) Config

# Usage

``app('es')`` return  ``\Elasticsearch\Client`` object

```php
app('es')->search([
        'index' => 'twitter',
        'type' => '_doc' 
        'body' => [],     
    ])
```

[More](https://www.elastic.co/guide/en/elasticsearch/client/php-api/6.5.x/index.html) Usage About ``\Elasticsearch\Client``