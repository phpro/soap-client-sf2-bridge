<?php

namespace Phpro\SoapClient\BridgeDemoBundle\WeatherClient;

use Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type;
use Phpro\SoapClient\Client;

/**
 * Created by PhpStorm.
 * User: janvernieuwe
 * Date: 7/10/15
 * Time: 23:00
 */
class WeatherClient extends Client
{
    public function getInformation()
    {
        $request = new Type\GetWeatherInformation();
        return $this->call('GetWeatherInformation', $request);
    }
}
