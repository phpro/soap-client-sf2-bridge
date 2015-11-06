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
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class WeatherClientFactory
{
    public static function factory(EventDispatcherInterface $dispatcher = null)
    {
        $wsdl = 'http://wsf.cdyne.com/WeatherWS/Weather.asmx?WSDL';
        $factory = new PhproClientFactory(
            'Phpro\SoapClient\BridgeDemoBundle\WeatherClient\WeatherClient'
        );
        $builder = new ClientBuilder($factory, $wsdl, []);
        $builder->withClassMaps(WeatherClassmapFactory::factory());
        if ($dispatcher instanceof EventDispatcherInterface) {
            $builder->withEventDispatcher($dispatcher);
        }
        $client = $builder->build();
        return $client;
    }
}
