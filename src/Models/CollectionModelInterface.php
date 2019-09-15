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

/**
 * Class CollectionModel
 *
 * @package Thunderlane\Kitaboo\Models
 */
interface CollectionModelInterface
{
    /**
     * @return string
     */
    public function getClientCollectionId(): string;

    /**
     * @param string $clientCollectionId
     */
    public function setClientCollectionId($clientCollectionId): void;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     */
    public function setTitle($title): void;

    /**
     * @return string
     */
    public function getCoverImageUrl(): string;

    /**
     * @param string $coverImageUrl
     */
    public function setCoverImageUrl(string $coverImageUrl): void;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getCollectionType(): string;

    /**
     * @param string $collectionType
     */
    public function setCollectionType($collectionType): void;

    /**
     * @return string
     */
    public function getReferenceNumber(): string;

    /**
     * @param string $referenceNumber
     */
    public function setReferenceNumber($referenceNumber): void;

    /**
     * @param \stdClass $collection
     */
    public function hydrate(\stdClass $collection): void;
}