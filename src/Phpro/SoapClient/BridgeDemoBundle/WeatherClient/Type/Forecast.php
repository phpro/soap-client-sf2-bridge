<?php

namespace Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type;

use Phpro\SoapClient\Type\RequestInterface;

class Forecast implements RequestInterface
{

    /**
     * @var \DateTime
     */
    protected $Date;

    /**
     * @var short
     */
    protected $WeatherID;

    /**
     * @var string
     */
    protected $Desciption;

    /**
     * @var temp
     */
    protected $Temperatures;

    /**
     * @var POP
     */
    protected $ProbabilityOfPrecipiation;

    /**
     * @param \DateTime $Date
     * @return Forecast
     */
    public function setDate($Date)
    {
        $this->Date = $Date;
        return $this;
    }

    /**
     * @param short $WeatherID
     * @return Forecast
     */
    public function setWeatherID($WeatherID)
    {
        $this->WeatherID = $WeatherID;
        return $this;
    }

    /**
     * @param string $Desciption
     * @return Forecast
     */
    public function setDesciption($Desciption)
    {
        $this->Desciption = $Desciption;
        return $this;
    }

    /**
     * @param temp $Temperatures
     * @return Forecast
     */
    public function setTemperatures($Temperatures)
    {
        $this->Temperatures = $Temperatures;
        return $this;
    }

    /**
     * @param POP $ProbabilityOfPrecipiation
     * @return Forecast
     */
    public function setProbabilityOfPrecipiation($ProbabilityOfPrecipiation)
    {
        $this->ProbabilityOfPrecipiation = $ProbabilityOfPrecipiation;
        return $this;
    }
}
