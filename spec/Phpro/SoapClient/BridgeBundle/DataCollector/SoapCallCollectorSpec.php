<?php

namespace spec\Phpro\SoapClient\BridgeBundle\DataCollector;

use Phpro\SoapClient\BridgeBundle\DataCollector\SoapCallCollector;
use Phpro\SoapClient\Client;
use Phpro\SoapClient\Event\RequestEvent;
use Phpro\SoapClient\Event\ResponseEvent;
use Phpro\SoapClient\Events;
use Phpro\SoapClient\Type\ResultInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class SoapCallCollectorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SoapCallCollector::class);
    }

    function it_should_be_a_collector()
    {
        $this->shouldImplement(DataCollectorInterface::class);
    }

    function it_should_subscribe_to_events() {
        $this->getSubscribedEvents()->shouldHaveKeyWithValue(Events::RESPONSE, 'onClientResponse');
        $this->getSubscribedEvents()->shouldHaveKeyWithValue(Events::REQUEST, 'onClientRequest');
    }

    function it_should_be_able_to_register_a_request(
        RequestEvent $requestEvent
    ) {
        $this->onClientRequest($requestEvent);
        $this->getCalls()->shouldHaveCount(1);
    }

    function it_should_be_able_to_register_a_response(
        Client $client,
        RequestEvent $requestEvent,
        ResultInterface $result,
        ResponseEvent $responseEvent
    ) {
        $debugData = [
            'request'  => ['headers' => 'SoapRequestHeader', 'body' => '<?xml version="1.0" encoding="UTF-8"?><body>SoapRequestBody</body>'],
            'response' => ['headers' => 'SoapResponseHeader', 'body' => '<?xml version="1.0" encoding="UTF-8"?><body>SoapResponseBody</body>'],
        ];
        $client->debugLastSoapRequest()->willReturn($debugData);
        $responseEvent->getResponse()->willReturn($result);
        $responseEvent->getClient()->willReturn($client);

        $this->onClientRequest($requestEvent);
        $this->onClientResponse($responseEvent);
        $this->getCalls()->shouldHaveCount(1);
    }

    function it_should_register_the_correct_name() {
        $this->getName()->shouldBe('phpro.soap_client');
    }

    function it_should_return_a_total_timing() {
        $this->getTotalTiming()->shouldBe(0);
    }
}
