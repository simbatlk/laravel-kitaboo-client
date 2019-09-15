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

use Thunderlane\Kitaboo\Services\ExternalServices\CollectionServiceInterface;

/**
 * Class ExternalServices
 *
 * @package Thunderlane\Kitaboo\Services
 */
class ExternalServices implements ExternalServicesInterface
{
    /**
     * @var \Thunderlane\Kitaboo\Services\ExternalServices\CollectionServiceInterface
     */
    private $collectionService;

    /**
     * ExternalServices constructor.
     *
     * @param \Thunderlane\Kitaboo\Services\ExternalServices\CollectionServiceInterface $collectionService
     */
    public function __construct(CollectionServiceInterface $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    /**
     * @inheritdoc
     */
    public function getCollectionService(): CollectionServiceInterface
    {
        return $this->collectionService;
    }
}