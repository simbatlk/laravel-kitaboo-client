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
use GuzzleHttp\HandlerStack;

interface ExternalServicesInterface
{
    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient(): Client;
}