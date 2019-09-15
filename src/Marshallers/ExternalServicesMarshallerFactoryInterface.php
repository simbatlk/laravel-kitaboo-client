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

/**
 * Interface ReaderServicesMarshallerFactoryInterface
 *
 * @package Thunderlane\Kitaboo\Marshallers
 */
interface ExternalServicesMarshallerFactoryInterface
{
    /**
     * @param string $entity
     * @return \Thunderlane\Kitaboo\Marshallers\MarshallerInterface
     * @throws \Thunderlane\Kitaboo\Exceptions\UnknownEntityException
     */
    public function getMarshaller(string $entity): MarshallerInterface;
}