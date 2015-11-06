<?php

namespace Phpro\SoapClient\BridgeDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $client = $this->get('phpro_soap_client_bridge_demo.weather');
        $forecast = $client->getInformation();
        return $this->render('PhproSoapClientBridgeDemoBundle:Default:index.html.twig', ['forecast' => $forecast]);
    }
}
