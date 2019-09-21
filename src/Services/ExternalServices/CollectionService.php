<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Services\ExternalServices;

use Jn\Collection;
use Thunderlane\Kitaboo\Clients\ExternalInterface;
use Thunderlane\Kitaboo\Exceptions\BadResponseException;
use Thunderlane\Kitaboo\Marshallers\ExternalServicesMarshallerFactory;
use Thunderlane\Kitaboo\Marshallers\ExternalServicesMarshallerFactoryInterface;
use Thunderlane\Kitaboo\Marshallers\MarshallerInterface;

/**
 * Class CollectionService
 *
 * @package Thunderlane\Kitaboo\Services\ExternalServices
 */
class CollectionService implements CollectionServiceInterface
{
    private const LIST_COLLECTION_ENDPOINT = 'DistributionServices/ext/api/ListCollection';

    /**
     * @var \Thunderlane\Kitaboo\Clients\ExternalInterface
     */
    private $client;

    /**
     * @var \Thunderlane\Kitaboo\Marshallers\ExternalServicesMarshallerFactoryInterface
     */
    private $marshallerFactory;

    /**
     * CollectionService constructor.
     *
     * @param \Thunderlane\Kitaboo\Clients\ExternalInterface $client
     * @param \Thunderlane\Kitaboo\Marshallers\ExternalServicesMarshallerFactoryInterface $marshallerFactory
     */
    public function __construct(ExternalInterface $client, ExternalServicesMarshallerFactoryInterface $marshallerFactory)
    {
        $this->client = $client;
        $this->marshallerFactory = $marshallerFactory;
    }

    /**
     * @inheritdoc
     */
    public function listCollection(): Collection
    {
        $response = $this->client->getClient()->get(self::LIST_COLLECTION_ENDPOINT);
        $marshaller = $this->marshallerFactory->getMarshaller(ExternalServicesMarshallerFactory::COLLECTION_LIST);
        $result = $marshaller->decodeResponseData($response);

        if ($result->responseCode !== 200) {
            throw new BadResponseException($result->responseMsg, $result->responseCode);
        }

        return new Collection($result->collectionList);
    }
}