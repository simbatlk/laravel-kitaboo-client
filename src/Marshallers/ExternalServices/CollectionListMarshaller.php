<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Marshallers\ExternalServices;

use Psr\Http\Message\ResponseInterface;
use Thunderlane\Kitaboo\Marshallers\MarshallerInterface;
use Thunderlane\Kitaboo\Models\CollectionModel;

/**
 * Class UserMarshaller
 *
 * @package Thunderlane\Kitaboo\Marshallers\ReaderServices
 */
class CollectionListMarshaller implements MarshallerInterface
{
    /**
     * @inheritdoc
     */
    public function encodePostData(array $data): array
    {
        return $data;
    }

    public function decodeResponseData(ResponseInterface $response): \stdClass
    {
        $result = json_decode($response->getBody()->getContents());
        if($result->responseCode === 200) {
            array_walk($result->collectionList, function (&$collection) {
                $collectionModel = new CollectionModel($collection);
                $collection = $collectionModel;
            });
        }
        return $result;
    }
}