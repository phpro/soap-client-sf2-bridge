<?php

namespace spec\Phpro\SoapClient\BridgeBundle;

use Phpro\SoapClient\BridgeBundle\DependencyInjection\Compiler\RegisterSoapEventDispatchers;
use Phpro\SoapClient\BridgeBundle\PhproSoapClientBridgeBundle;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PhproSoapClientBridgeBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PhproSoapClientBridgeBundle::class);
    }

    function it_is_a_symfony_bundle()
    {
        $this->shouldImplement(Bundle::class);
    }

    function it_should_register_compiler_passes(ContainerBuilder $containerBuilder)
    {
        $containerBuilder->addCompilerPass(Argument::type(RegisterSoapEventDispatchers::class))->shouldBeCalled();
        $this->build($containerBuilder);
    }
}
