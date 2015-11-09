<?php

namespace Phpro\SoapClient\BridgeBundle\SoapCallCollector;

use Phpro\SoapClient\BridgeBundle\Type\SoapCall;
use Phpro\SoapClient\Event\RequestEvent;
use Phpro\SoapClient\Event\ResponseEvent;
use Phpro\SoapClient\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * Class SoapCallCollector
 * @package Phpro\SoapClient\BridgeBundle\SoapCallCollector
 */
class SoapCallCollector implements EventSubscriberInterface, DataCollectorInterface
{

    /**
     * Used for timing the requests
     * @var Stopwatch
     */
    protected $stopwatch;

    /**
     * Collection of requests
     * @var array
     */
    protected $data = [
        'calls'  => []
    ];

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            Events::RESPONSE => 'onClientResponse',
            Events::REQUEST  => 'onClientRequest'
        ];
    }

    /**
     * Process client request event
     * @param RequestEvent $e
     */
    public function onClientRequest(RequestEvent $e)
    {
        $call = new SoapCall($this->stopwatch);
        $call->setRequest($e);
        $this->data['calls'][] = $call;
    }

    /**
     * Process client response event
     * @param ResponseEvent $e
     */
    public function onClientResponse(ResponseEvent $e)
    {
        /** @var SoapCall $call */
        $call = array_pop($this->data['calls']);
        $call->setResponse($e);
        $this->data['calls'][] = $call;
    }

    /**
     * Collects data for the given Request and Response.
     *
     * @param Request $request A Request instance
     * @param Response $response A Response instance
     * @param \Exception $exception An Exception instance
     *
     * @api
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        // Nothing to do here, we implemented our own methods by hooking into the events
    }

    /**
     * Returns the name of the collector.
     * @return string The collector name
     * @api
     */
    public function getName()
    {
        return 'phpro.soap_client';
    }

    /**
     * Get all soap calls
     * @return SoapCall[]
     */
    public function getCalls()
    {
        return $this->data['calls'];
    }

    /**
     * Setter method for Stopwatch
     * @param Stopwatch $stopwatch
     * @return $this
     */
    public function setStopwatch(Stopwatch $stopwatch = null)
    {
        $this->stopwatch = $stopwatch;
        return $this;
    }

    /**
     * Get the total timing of all soap calls
     * @return int
     */
    public function getTotalTiming()
    {
        $timing = 0;
        /** @var SoapCall $call */
        foreach ($this->data['calls'] as $call) {
            $timing += $call->getTiming();
        }
        return $timing;
    }
}
