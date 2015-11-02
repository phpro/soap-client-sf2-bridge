<?php

namespace Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type;

use Phpro\SoapClient\Type\ResultInterface;

class GetWeatherInformationResponse implements ResultInterface
{
    /**
     * @var ArrayOfWeatherDescription
     */
    protected $GetWeatherInformationResult;

    /**
     * @return ArrayOfWeatherDescription
     */
    public function getGetWeatherInformationResult()
    {
        return $this->GetWeatherInformationResult;
    }
}

