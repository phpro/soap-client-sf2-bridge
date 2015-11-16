<?php

namespace spec\Phpro\SoapClient\BridgeBundle\Type;

use Phpro\SoapClient\BridgeBundle\Type\SoapCall;
use Phpro\SoapClient\ClientInterface;
use Phpro\SoapClient\Event\RequestEvent;
use Phpro\SoapClient\Type\RequestInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Stopwatch\Stopwatch;

class SoapCallSpec extends ObjectBehavior
{
    function let(Stopwatch $stopwatch)
    {
        $this->beConstructedWith($stopwatch);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SoapCall::class);
    }

    function it_should_start_request(
        Stopwatch $stopwatch,
        RequestEvent $event,
        RequestInterface $request,
        ClientInterface $client
    ) {
        $event->getRequest()->willReturn($request);
        $event->getMethod()->willReturn('soapMethod');
        $event->getClient()->willReturn($client);
        $stopwatch->start(Argument::type('string'))->shouldBeCalled();

        $this->setRequest($event);
        $this->getMethod()->shouldBe('soapMethod');
        $this->getRequest()->shouldBe($request);
        $this->getHash()->shouldStartWith('Double\ClientInterface');
    }
}
