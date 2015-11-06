<?php

namespace Phpro\SoapClient\BridgeDemoBundle\Controller;

use Phpro\SoapClient\BridgeDemoBundle\WeatherClient\Type\Forecast;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $forecastRequest = new Forecast();
        $forecast = $this->get('phpro_soap_client_bridge_demo.weather')
            ->getInformation();
        //dump($this->get('debug.event_dispatcher'));
        return $this->render('PhproSoapClientBridgeDemoBundle:Default:index.html.twig', array('name' => $name));
    }
}
