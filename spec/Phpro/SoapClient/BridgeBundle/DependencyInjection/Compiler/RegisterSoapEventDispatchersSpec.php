<?php

namespace spec\Phpro\SoapClient\BridgeBundle\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class RegisterSoapEventDispatchersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\SoapClient\BridgeBundle\DependencyInjection\Compiler\RegisterSoapEventDispatchers');
    }

    function it_should_register_the_compiler_pass(
        ContainerBuilder $container,
        Definition $definition
    ) {
        $definition->addMethodCall(
            Argument::exact('addSubscriber'),
            Argument::type('array')
        )->shouldBeCalled();
        $container->findDefinition(Argument::type('string'))->willReturn($definition);
        $container->findTaggedServiceIds(Argument::type('string'))->willReturn([]);

        $this->process($container);
    }

    function it_should_find_tagged_services(
        ContainerBuilder $container,
        Definition $definition,
        Definition $defaultDefinition
    ) {
        $definition->addMethodCall(
            Argument::exact('addSubscriber'),
            Argument::type('array')
        )->shouldBeCalled();

        $container->findDefinition(Argument::type('string'))->willReturn($defaultDefinition);
        $container->findDefinition(Argument::exact('testservice'))->willReturn($definition);
        $container->findTaggedServiceIds(Argument::exact('phpro_soap_client.event_dispatcher'))->willReturn([
            'testservice' => $definition
        ]);

        $this->process($container);
    }
}
