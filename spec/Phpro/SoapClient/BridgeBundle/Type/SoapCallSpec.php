<?php

namespace spec\Phpro\SoapClient\BridgeBundle\Type;

use Phpro\SoapClient\BridgeBundle\Type\SoapCall;
use Phpro\SoapClient\Client;
use Phpro\SoapClient\ClientInterface;
use Phpro\SoapClient\Event\RequestEvent;
use Phpro\SoapClient\Event\ResponseEvent;
use Phpro\SoapClient\Type\RequestInterface;
use Phpro\SoapClient\Type\ResultInterface;
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

    function it_should_stop_request(
        Stopwatch $stopwatch,
        ResponseEvent $responseEvent,
        RequestEvent $requestEvent,
        ResultInterface $result,
        Client $client
    ) {
        $responseEvent->getResponse()->willReturn($result);
        $responseEvent->getClient()->willReturn($client);
        $stopwatch->start(Argument::type('string'))->shouldBeCalled();
        $stopwatch->stop(Argument::type('string'))->shouldBeCalled();

        $this->setRequest($requestEvent);
        $this->setResponse($responseEvent);
    }

    function it_should_parse_the_debug_array(
        ResponseEvent $responseEvent,
        RequestEvent $requestEvent,
        ResultInterface $result,
        Client $client
    ) {
        $debugData = [
            'request'  => ['headers' => 'SoapRequestHeader', 'body' => '<?xml version="1.0" encoding="UTF-8"?><body>SoapRequestBody</body>'],
            'response' => ['headers' => 'SoapResponseHeader', 'body' => '<?xml version="1.0" encoding="UTF-8"?><body>SoapResponseBody</body>'],
        ];
        $client->debugLastSoapRequest()->willReturn($debugData);
        $responseEvent->getResponse()->willReturn($result);
        $responseEvent->getClient()->willReturn($client);

        $this->setRequest($requestEvent);
        $this->setResponse($responseEvent);
        $this->getResponseHeaders()->shouldBe($debugData['response']['headers']);
        $this->getResponseBody()->shouldStartWith('<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<body>SoapResponseBody</body>');
        $this->getRequestHeaders()->shouldBe($debugData['request']['headers']);
        $this->getRequestBody()->shouldStartWith('<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<body>SoapRequestBody</body>');
    }
}
