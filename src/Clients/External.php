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
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Thunderlane\Kitaboo\Clients\Traits\AcceptsJson;
use Thunderlane\Kitaboo\Clients\Traits\ShouldRetry;

/**
 * Class ExternalServices
 *
 * @package Thunderlane\Kitaboo\Clients
 */
class External extends AbstractClient implements ExternalInterface
{
    use ShouldRetry, AcceptsJson;

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
        if (! $this->client) {
            $this->setupClient();
        }
    }

    /**
     * @inheritdoc
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    private function setupClient(): void
    {
        $this->stack = HandlerStack::create();

        $this->setupAcceptHeaderMiddleware();
        $this->setupRetryStrategyMiddleware();
        $this->setupAuthorizationMiddleware();

        $this->client = new Client([
            'base_uri' => config('laravel_kitaboo')['context_url'],
            'handler' => $this->stack,
            'connect_timeout' => self::CONNECTION_TIMEOUT,
            'timeout' => self::TIMEOUT,
            'auth' => 'oauth',
        ]);
    }

    private function setupAuthorizationMiddleware(): void
    {
        $oauth = new Oauth1([
            'consumer_key' => config('laravel_kitaboo')['consumer_key'],
            'consumer_secret' => config('laravel_kitaboo')['consumer_secret'],
            'token' => '',
            'token_secret' => '',
        ]);

        $this->stack->push($oauth, 'auth');
    }
}