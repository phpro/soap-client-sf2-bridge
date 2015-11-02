<?php
/**
 * Created by PhpStorm.
 * User: janvernieuwe
 * Date: 7/10/15
 * Time: 23:05
 */

namespace Phpro\SoapClient\BridgeDemoBundle\WeatherClient;

use Phpro\SoapClient\Soap\ClassMap\ClassMap;
use Phpro\SoapClient\Soap\ClassMap\ClassMapCollection;

class WeatherClassmapFactory
{
    /**
     * @return ClassMapCollection
     */
    public static function factory()
    {
        return new ClassMapCollection([
            new ClassMap('GetWeatherInformation', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\GetWeatherInformation::class),
            new ClassMap('GetWeatherInformationResponse', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\GetWeatherInformationResponse::class),
            new ClassMap('ArrayOfWeatherDescription', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\ArrayOfWeatherDescription::class),
            new ClassMap('WeatherDescription', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\WeatherDescription::class),
            new ClassMap('GetCityForecastByZIP', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\GetCityForecastByZIP::class),
            new ClassMap('GetCityForecastByZIPResponse', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\GetCityForecastByZIPResponse::class),
            new ClassMap('ForecastReturn', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\ForecastReturn::class),
            new ClassMap('ArrayOfForecast', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\ArrayOfForecast::class),
            new ClassMap('Forecast', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\Forecast::class),
            new ClassMap('temp', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\Temp::class),
            new ClassMap('POP', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\POP::class),
            new ClassMap('GetCityWeatherByZIP', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\GetCityWeatherByZIP::class),
            new ClassMap('GetCityWeatherByZIPResponse', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\GetCityWeatherByZIPResponse::class),
            new ClassMap('WeatherReturn', \Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\WeatherReturn::class),
        ]);
    }
}
