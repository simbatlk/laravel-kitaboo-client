<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Models;

class CollectionModel
{
    private $clientCollectionId;
    private $title;
    private $coverImageUrl;
    private $id;
    private $collectionType;
    private $referenceNumber;

    public function __construct(\stdClass $collection = null)
    {
        if ($collection) {
            $this->hydrate($collection);
        }
    }

    /**
     * @return string
     */
    public function getClientCollectionId(): string
    {
        return $this->clientCollectionId;
    }

    /**
     * @param string $clientCollectionId
     */
    public function setClientCollectionId($clientCollectionId): void
    {
        $this->clientCollectionId = $clientCollectionId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCoverImageUrl(): string
    {
        return $this->coverImageUrl;
    }

    /**
     * @param string $coverImageUrl
     */
    public function setCoverImageUrl(string $coverImageUrl): void
    {
        $this->coverImageUrl = $coverImageUrl;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCollectionType(): string
    {
        return $this->collectionType;
    }

    /**
     * @param string $collectionType
     */
    public function setCollectionType($collectionType): void
    {
        $this->collectionType = $collectionType;
    }

    /**
     * @return string
     */
    public function getReferenceNumber(): string
    {
        return $this->referenceNumber;
    }

    /**
     * @param string $referenceNumber
     */
    public function setReferenceNumber($referenceNumber): void
    {
        $this->referenceNumber = $referenceNumber;
    }

    public function hydrate(\stdClass $collection)
    {
        $this->setClientCollectionId($collection->clientCollectionId);
        $this->setTitle($collection->title);
        $this->setCoverImageUrl($collection->coverImageUrl);
        $this->setId($collection->id);
        $this->setCollectionType($collection->collectionType);
        $this->setReferenceNumber($collection->referenceNumber);
    }
}