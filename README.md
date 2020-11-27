> ## Repository abandoned 2020-11-27
>
> This repository has been archived since we are not using it anymore internally.
> Feel free to use it AS-IS, we won't be providing any support anymore.

[![Build status](https://api.travis-ci.org/phpro/soap-client-sf2-bridge.svg)](http://travis-ci.org/phpro/soap-client-sf2-bridge)
[![Packagist](https://img.shields.io/packagist/v/phpro/soap-client-sf2-bridge.svg)](https://packagist.org/packages/phpro/soap-client-sf2-bridge)
# SOAP Client Symfony Bridge

This package contains a Symfony Bridge for the [soap-client](https://github.com/phpro/soap-client).

The SOAP requests and responses will be logged in the profiler page. 

A stopwatch is collecting information about runtime and memory usage.

This version is compatible with Symfony 3.2


## Installation

```sh
$ composer require --dev phpro/soap-client-sf2-bridge
```

```php
<?php
// AppKernel.php

if (in_array($this->getEnvironment(), array('dev', 'test'))) {
    $bundles[] = new Phpro\SoapClient\BridgeBundle\PhproSoapClientBridgeBundle();
}
```

## Registering additional event dispatchers

The DataCollector listens to the default event dispatcher. 

If you configured the soap-client to use another event dispatcher, you can mark it with the tag: `phpro_soap_client.event_dispatcher`.

```yml
# services.yml
services:
    app.event_dispatcher:
        class: Symfony\Component\EventDispatcher\EventDispatcher
        tags:
            - { name: phpro_soap_client.event_dispatcher }
```

## Register dispatcher

Don't forget to register the EventDispatcher on your ClientBuilder as in the example below.

```php
$clientBuilder->withEventDispatcher($dispatcher);
```
