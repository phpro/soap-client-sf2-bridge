<?php

namespace spec\Phpro\SoapClient\BridgeBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PhproSoapClientBridgeBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\SoapClient\BridgeBundle\PhproSoapClientBridgeBundle');
    }

    function it_is_a_symfony_bundle()
    {
        $this->shouldImplement('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    function it_should_register_compiler_passes(ContainerBuilder $containerBuilder)
    {
        $containerBuilder->addCompilerPass(
            Argument::type('Phpro\SoapClient\BridgeBundle\DependencyInjection\Compiler\RegisterSoapEventDispatchers')
        )->shouldBeCalled();
        $this->build($containerBuilder);
    }
}
