<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Marshallers;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface MarshallerInterface
 *
 * @package Thunderlane\Kitaboo\Marshallers
 */
interface MarshallerInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function encodeData(array $data): array;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \stdClass
     */
    public function decodeResponseData(ResponseInterface $response): \stdClass;
}