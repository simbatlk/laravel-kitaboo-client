<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Clients\Traits;

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait ShouldRetry
 *
 * @package Thunderlane\Kitaboo\Clients\Traits
 */
trait ShouldRetry
{
    protected function setupRetryStrategyMiddleware(): void
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
}