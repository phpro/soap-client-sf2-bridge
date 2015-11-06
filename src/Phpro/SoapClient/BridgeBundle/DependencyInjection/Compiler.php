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
        // Register subscriber on the default event dispatcher
        $definition = $container->findDefinition('debug.event_dispatcher');
        var_dump($definition);
        $definition->addMethodCall(
            'addSubscriber',
            [new Reference('phpro_soap_client_bridge.collector')]
        );

        // Find tagged event dispatchers
        $taggedServices = $container->findTaggedServiceIds('phpro_soap_client.event_dispatcher');
        foreach ($taggedServices as $id => $taggedService) {
            $taggedDefinition = $container->findDefinition($id);
            $taggedDefinition->addMethodCall(
                'addSubscriber',
                [new Reference('phpro_soap_client_bridge.collector')]
            );
        }
    }
}
