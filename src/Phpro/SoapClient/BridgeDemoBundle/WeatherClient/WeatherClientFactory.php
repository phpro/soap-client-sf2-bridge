<?php
/**
 * Created by PhpStorm.
 * User: janvernieuwe
 * Date: 7/10/15
 * Time: 23:07
 */

namespace Phpro\SoapClient\BridgeDemoBundle\WeatherClient;

use Phpro\SoapClient\ClientBuilder;
use Phpro\SoapClient\ClientFactory as PhproClientFactory;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WeatherClientFactory
{
    public static function factory(EventSubscriberInterface $subscriber = null)
    {
        $wsdl = 'http://wsf.cdyne.com/WeatherWS/Weather.asmx?WSDL';
        $factory = new PhproClientFactory(
            'Phpro\SoapClient\BridgeDemoBundle\WeatherClient\WeatherClient'
        );
        $builder = new ClientBuilder($factory, $wsdl, []);
        $builder->withClassMaps(WeatherClassmapFactory::factory());
        // Add debugger if set
        dump($subscriber);
        if ($subscriber instanceof EventSubscriberInterface) {
            $dispatcher = new EventDispatcher();
            $dispatcher->addSubscriber($subscriber);
            $builder->withEventDispatcher($dispatcher);
        }
        $client = $builder->build();
        return $client;
    }
}
