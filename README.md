# SOAP Client Symfony Bridge

This package contains a Symfony Bridge for the [soap-client](https://github.com/phpro/soap-client).
The SOAP requests and responses will be logged in the profiler page. 
A stopwatch is collecting information about runtime and memory usage.


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

```$clientBuilder->withEventDispatcher($dispatcher);
```