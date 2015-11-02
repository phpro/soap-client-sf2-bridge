<?php

namespace Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type;

use Phpro\SoapClient\Type\ResultInterface;

class ForecastReturn implements ResultInterface
{

    /**
     * @var bool
     */
    protected $Success;

    /**
     * @var string
     */
    protected $ResponseText;

    /**
     * @var string
     */
    protected $State;

    /**
     * @var string
     */
    protected $City;

    /**
     * @var string
     */
    protected $WeatherStationCity;

    /**
     * @var ArrayOfForecast
     */
    protected $ForecastResult;

}
