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

/**
 * Interface KitabooClientInterface
 *
 * @package Thunderlane\Kitaboo\Clients
 */
interface KitabooClientInterface
{
    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient(): \GuzzleHttp\ClientInterface;

    /**
     * @param \stdClass $response
     * @return bool
     */
    public function isResponseOK(\stdClass $response): bool;
}