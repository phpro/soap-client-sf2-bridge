<?php

namespace Phpro\SoapClient\BridgeBundle;

use Phpro\SoapClient\BridgeBundle\DependencyInjection\Compiler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class PhproSoapClientBridgeBundle
 *
 * @package Phpro\SoapClient\BridgeBundle
 */
class PhproSoapClientBridgeBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new Compiler\RegisterSoapEventDispatchers());
    }
}
