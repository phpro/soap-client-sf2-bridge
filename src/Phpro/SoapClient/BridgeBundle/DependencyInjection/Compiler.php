<?php
/**
 * Created by PhpStorm.
 * User: janvernieuwe
 * Date: 6/11/15
 * Time: 12:47
 */

namespace Phpro\SoapClient\BridgeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class Compiler implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('event_dispatcher');
        $definition->addMethodCall(
            'addSubsriber',
            new Reference('phpro_soap_client_bridge.collector')
        );
    }
}
