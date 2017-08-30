<?php

namespace Phpro\SoapClient\BridgeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RegisterSoapEventDispatchers
 *
 * @package Phpro\SoapClient\BridgeBundle\DependencyInjection\Dispatcher
 */
class RegisterSoapEventDispatchers implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
     */
    public function process(ContainerBuilder $container)
    {
        // Register subscriber on the default event dispatcher
        $definition = $container->findDefinition('event_dispatcher');
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
