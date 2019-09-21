<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Marshallers\ReaderServices;

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Thunderlane\Kitaboo\Marshallers\MarshallerAbstract;
use Thunderlane\Kitaboo\Marshallers\MarshallerInterface;

/**
 * Class CheckClientSessionMarshaller
 *
 * @package Thunderlane\Kitaboo\Marshallers\ReaderServices
 */
class CheckClientSessionMarshaller extends MarshallerAbstract implements MarshallerInterface
{
    /**
     * @inheritdoc
     */
    public function encodeData(array $data): array
    {
        return ['query' => $data];
    }
}