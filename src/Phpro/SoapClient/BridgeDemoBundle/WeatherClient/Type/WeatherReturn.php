<?php

namespace Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type;

class WeatherReturn
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
     * @var short
     */
    protected $WeatherID;

    /**
     * @var string
     */
    protected $Description;

    /**
     * @var string
     */
    protected $Temperature;

    /**
     * @var string
     */
    protected $RelativeHumidity;

    /**
     * @var string
     */
    protected $Wind;

    /**
     * @var string
     */
    protected $Pressure;

    /**
     * @var string
     */
    protected $Visibility;

    /**
     * @var string
     */
    protected $WindChill;

    /**
     * @var string
     */
    protected $Remarks;

}
