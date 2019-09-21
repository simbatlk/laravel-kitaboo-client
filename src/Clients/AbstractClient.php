<?php
/**
 * Created by PhpStorm.
 * User: soarin
 * Date: 21.9.2019 г.
 * Time: 14:48
 */

namespace Thunderlane\Kitaboo\Clients;

use GuzzleHttp\ClientInterface;

abstract class AbstractClient
{
    /**
     * @param \stdClass $response
     * @return bool
     */
    public function isResponseOK(\stdClass $response): bool
    {
        return $response->responseCode && $response->responseCode === 200;
    }
}