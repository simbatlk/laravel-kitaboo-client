<?php
/**
 * Created by PhpStorm.
 * User: soarin
 * Date: 21.9.2019 г.
 * Time: 15:32
 */

namespace Thunderlane\Kitaboo\Marshallers;

use Psr\Http\Message\ResponseInterface;

abstract class MarshallerAbstract
{
    /**
     * @param array $data
     * @return array
     */
    abstract public function encodeData(array $data): array;

    /**
     * @param \Thunderlane\Kitaboo\Marshallers\ResponseInterface $response
     * @return \stdClass
     */
    public function decodeResponseData(ResponseInterface $response): \stdClass
    {
        return json_decode($response->getBody()->getContents());
    }
}