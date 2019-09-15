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

use Thunderlane\Kitaboo\Exceptions\UnknownEntityException;
use Thunderlane\Kitaboo\Marshallers\ExternalServices\CollectionListMarshaller;
use Thunderlane\Kitaboo\Marshallers\ReaderServices\UserMarshaller;

/**
 * Class ReaderServicesMarshallerFactory
 *
 * @package Thunderlane\Kitaboo\Marshallers
 */
class ExternalServicesMarshallerFactory implements ExternalServicesMarshallerFactoryInterface
{
    public const COLLECTION_LIST = 'collectionList';

    /**
     * @inheritdoc
     */
    public function getMarshaller(string $entity): MarshallerInterface
    {
        switch ($entity) {
            case self::COLLECTION_LIST:
                return new CollectionListMarshaller();
                break;
            default:
                throw new UnknownEntityException();
                break;
        }
    }
}