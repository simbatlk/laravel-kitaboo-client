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
use Thunderlane\Kitaboo\Marshallers\ReaderServices\UserMarshaller;

/**
 * Class ReaderServicesMarshallerFactory
 *
 * @package Thunderlane\Kitaboo\Marshallers
 */
class ReaderServicesMarshallerFactory implements ReaderServicesMarshallerFactoryInterface
{
    public const USER = 'user';

    /**
     * @inheritdoc
     */
    public function getMarshaller(string $entity): MarshallerInterface
    {
        switch ($entity) {
            case self::USER:
                return new UserMarshaller();
                break;
            default:
                throw new UnknownEntityException();
                break;
        }
    }
}