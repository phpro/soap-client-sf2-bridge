<?php
/**
 * Created by PhpStorm.
 * User: janvernieuwe
 * Date: 6/11/15
 * Time: 20:56
 */

namespace Phpro\SoapClient\BridgeBundle\Type;

use Phpro\SoapClient\Event\RequestEvent;
use Phpro\SoapClient\Event\ResponseEvent;
use Phpro\SoapClient\Type\RequestInterface;
use Phpro\SoapClient\Type\ResultInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchEvent;

/**
 * Class SoapCall
 * @package Phpro\SoapClient\BridgeBundle\Type
 */
class SoapCall
{
    /**
     * @var Stopwatch
     */
    protected $stopwatch;

    /**
     * @var StopwatchEvent
     */
    protected $timing;

    /**
     * @var string
     */
    protected $requestBody = '';

    /**
     * @var string
     */
    protected $requestHeaders = '';

    /**
     * @var string
     */
    protected $responseBody = '';

    /**
     * @var string
     */
    protected $responseHeaders = '';

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResultInterface
     */
    protected $response;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var string
     */
    protected $clientName;
    /**
     * @var string
     */
    protected $method;

    /**
     * SoapCall constructor.
     * @param Stopwatch $stopwatch
     */
    public function __construct(Stopwatch $stopwatch = null)
    {
        $this->stopwatch = $stopwatch;
    }

    /**
     * Get the called method name
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get the unique hash of the soap call
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Get the duration of the soap call
     * @return int ms
     */
    public function getTiming()
    {
        return $this->timing->getDuration();
    }

    /**
     * Get the formatted request body
     * @return string
     */
    public function getRequestBody()
    {
        $request = new \DOMDocument();
        $request->preserveWhiteSpace = false;
        $request->formatOutput = true;
        $request->loadXML($this->requestBody);
        return $request->saveXML();
    }

    /**
     * Get the request headers
     * @return string
     */
    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    /**
     * Get the formatted response body
     * @return string
     */
    public function getResponseBody()
    {
        $response = new \DOMDocument();
        $response->preserveWhiteSpace = false;
        $response->formatOutput = true;
        $response->loadXML($this->responseBody);
        return $response->saveXML();
    }

    /**
     * Get the response headers
     * @return string
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    /**
     * Get the request object used in the call
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Process soap request
     * @param RequestEvent $e
     */
    public function setRequest(RequestEvent $e)
    {
        $this->request = $e->getRequest();
        $this->method = $e->getMethod();
        $this->clientName = get_class($e->getClient());
        $this->hash = uniqid(sprintf('%s::%s ', $this->clientName, $this->method), true);
        $this->startTimer();
    }

    /**
     * Start the timer for the call
     * @return $this
     */
    protected function startTimer()
    {
        if (!$this->stopwatch instanceof Stopwatch) {
            return $this;
        }
        $this->stopwatch->start($this->hash);
        return $this;
    }

    /**
     * Get the response object constructed for this call
     * @return ResultInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Process a soap response
     * @param ResponseEvent $e
     * @return $this
     */
    public function setResponse(ResponseEvent $e)
    {
        $this->stopTimer();
        $client = $e->getClient();
        $this->response = $e->getResponse();
        $debug = $client->debugLastSoapRequest();
        $this->requestBody = $debug['request']['body'];
        $this->requestHeaders = $debug['request']['headers'];
        $this->responseBody = $debug['response']['body'];
        $this->responseHeaders = $debug['response']['headers'];
        return $this;
    }

    /**
     * Stop the timer for the call
     * @return $this
     */
    protected function stopTimer()
    {
        if (!$this->stopwatch instanceof Stopwatch) {
            return $this;
        }
        $this->timing = $this->stopwatch->stop($this->hash);
        return $this;
    }

    /**
     * Get the name of the soap client
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }
}
