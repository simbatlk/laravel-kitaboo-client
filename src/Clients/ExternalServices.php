<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ExternalServices implements ExternalServicesInterface
{
    private const CONNECTION_TIMEOUT = 6;
    private const TIMEOUT = 30;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var HandlerStack
     */
    private $stack;

    /**
     * ExternalServices constructor.
     */
    public function __construct()
    {
        if (!$this->client) {
            $this->setupClient();
        }
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    private function setupClient()
    {
        $this->stack = HandlerStack::create();

        $this->stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            return $request->withHeader('Accept', 'application/json');
        }), 'accept');

        $this->setupRetryStrategy();
        $this->setupAuth();

        $this->client = new Client([
            'base_uri'          => config('laravel_kitaboo')['context_url'],
            'handler'           => $this->stack,
            'connect_timeout'   => self::CONNECTION_TIMEOUT,
            'timeout'           => self::TIMEOUT,
            'auth'              => 'oauth'
        ]);
    }

    private function setupRetryStrategy()
    {
        $this->stack->push(Middleware::retry(
            function (
                $retries,
                RequestInterface $request,
                ResponseInterface $response = null,
                RequestException $exception = null
            ) {
                if ($retries >= 5) {
                    return false;
                }
                $shouldRetry = false;

                if ($exception instanceof ConnectException) {
                    $shouldRetry = true;
                }

                if ($response) {
                    if ($response->getStatusCode() >= 500) {
                        $shouldRetry = true;
                    }
                }

                if ($shouldRetry) {
                    Log::error(sprintf(
                        'Retrying %s %s %s/5, %s',
                        $request->getMethod(),
                        $request->getUri(),
                        $retries + 1,
                        $response ? 'status code: ' . $response->getStatusCode() :
                            $exception->getMessage()
                    ));
                }
                return $shouldRetry;
            }
        ), 'retry');
    }

    private function setupAuth()
    {
        $oauth = new Oauth1([
            'consumer_key'    => config('laravel_kitaboo')['consumer_key'],
            'consumer_secret' => config('laravel_kitaboo')['consumer_secret'],
            'token'           => '',
            'token_secret'    => ''
        ]);

        $this->stack->push($oauth, 'auth');
    }
}