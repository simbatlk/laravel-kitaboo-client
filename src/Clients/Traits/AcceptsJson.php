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
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait AcceptsJson
 *
 * @package Thunderlane\Kitaboo\Clients\Traits
 */
trait AcceptsJson
{
    protected function setupAcceptHeaderMiddleware(): void
    {
        $this->stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            return $request->withHeader('Accept', 'application/json');
        }), 'accept');
    }
}