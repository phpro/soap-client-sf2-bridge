<?php

namespace spec\Phpro\SoapClient\BridgeBundle\DependencyInjection;

use Phpro\SoapClient\BridgeBundle\DependencyInjection\PhproSoapClientBridgeExtension;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PhproSoapClientBridgeExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PhproSoapClientBridgeExtension::class);
    }
}
