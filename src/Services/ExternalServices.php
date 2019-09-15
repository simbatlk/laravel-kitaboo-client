<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Services;

use Illuminate\Support\Collection;
use Thunderlane\Kitaboo\Clients\ExternalInterface;
use Thunderlane\Kitaboo\Exceptions\BadResponseException;
use Thunderlane\Kitaboo\Models\CollectionModel;

/**
 * Class ExternalServices
 *
 * @package Thunderlane\Kitaboo\Services
 */
class ExternalServices implements ExternalServicesInterface
{
    private const LIST_COLLECTION_ENDPOINT = 'DistributionServices/ext/api/ListCollection';

    /**
     * @var \GuzzleHttp\Client|\GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * ExternalServices constructor.
     *
     * @param \Thunderlane\Kitaboo\Clients\ExternalInterface $externalServicesClient
     */
    public function __construct(ExternalInterface $externalServicesClient)
    {
        $this->client = $externalServicesClient->getClient();
    }

    /**
     * @inheritdoc
     */
    public function listCollection(): Collection
    {
        $response = $this->client->get(self::LIST_COLLECTION_ENDPOINT);
        $result = json_decode($response->getBody()->getContents());
        if($result->responseCode !== 200) {
            throw new BadResponseException($result->responseMsg, $result->responseCode);
        }

        array_walk($result->collectionList, function (&$collection) {
            $collectionModel = new CollectionModel($collection);
            $collection = $collectionModel;
        });

        return new Collection($result->collectionList);
    }
}