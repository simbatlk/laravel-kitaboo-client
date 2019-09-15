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
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Thunderlane\Kitaboo\Clients\Traits\AcceptsJson;
use Thunderlane\Kitaboo\Clients\Traits\ShouldRetry;

/**
 * Class Reader
 *
 * @package Thunderlane\Kitaboo\Clients
 */
class Reader implements ReaderInterface
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
     * @var string|null
     */
    private $userToken;

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

    /**
     * @inheritdoc
     */
    public function getUserToken(): ?string
    {
        return $this->userToken;
    }

    /**
     * @inheritdoc
     */
    public function setUserToken(string $userToken): void
    {
        $this->userToken = $userToken;
        $this->setupAuthorizationMiddleware();
    }

    private function setupClient(): void
    {
        $this->stack = HandlerStack::create();

        $this->setupAcceptHeaderMiddleware();
        $this->setupRetryStrategyMiddleware();

        $this->client = new Client([
            'base_uri' => config('laravel_kitaboo')['context_url'],
            'handler' => $this->stack,
            'connect_timeout' => self::CONNECTION_TIMEOUT,
            'timeout' => self::TIMEOUT,
        ]);
    }

    private function setupAuthorizationMiddleware(): void
    {
        $this->stack->remove('authorization');
        $this->stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            return $request->withHeader('usertoken', $this->getUserToken());
        }), 'authorization');
    }
}