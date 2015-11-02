<?php

namespace Phpro\SoapClient\BridgeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PhproSoapClientBridgeBundle:Default:index.html.twig', array('name' => $name));
    }
}
