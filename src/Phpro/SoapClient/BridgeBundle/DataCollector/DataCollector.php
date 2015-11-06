<?php
/**
 * Created by PhpStorm.
 * User: janvernieuwe
 * Date: 7/10/15
 * Time: 23:15
 */

namespace Phpro\SoapClient\BridgeBundle\DataCollector;

use Phpro\SoapClient\Event\RequestEvent;
use Phpro\SoapClient\Event\ResponseEvent;
use Phpro\SoapClient\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class DataCollector implements EventSubscriberInterface
{

    protected static $responses = [];

    /**
     * @var Stopwatch
     */
    protected $stopwatch;

    /**
     * @param Stopwatch $stopwatch
     * @return $this
     */
    protected function setStopwatch(Stopwatch $stopwatch)
    {
        $this->stopwatch = $stopwatch;
        return $this;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        dump(__FUNCTION__);
        return [
            Events::RESPONSE => 'onClientResponse',
            Events::REQUEST  => 'onClientRequest'
        ];
    }

    public function onClientRequest(RequestEvent $e)
    {
        dump(__FUNCTION__, $e);
    }

    public function onClientResponse(ResponseEvent $e)
    {
        static::$responses[] = $e->getClient()->debugLastSoapRequest();
        dump($e, $e->getClient()->debugLastSoapRequest());
    }
}
