<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo;

/**
 * Interface KitabooInterface
 *
 * @package Thunderlane\Kitaboo
 */
interface KitabooInterface
{
    /**
     * @return \Thunderlane\Kitaboo\Services\ExternalServicesInterface
     */
    public function getExternalServices(): \Thunderlane\Kitaboo\Services\ExternalServicesInterface;

    /**
     * @return \Thunderlane\Kitaboo\Services\ReaderServicesInterface
     */
    public function getReaderServices(): \Thunderlane\Kitaboo\Services\ReaderServicesInterface;
}