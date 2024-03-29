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

use Thunderlane\Kitaboo\Models\UserModelInterface;

/**
 * Interface ReaderServicesInterface
 *
 * @package Thunderlane\Kitaboo\Services
 */
interface ReaderServicesInterface
{
    /**
     * @return \Thunderlane\Kitaboo\Services\ReaderServices\UserServiceInterface
     */
    public function getUserService(): \Thunderlane\Kitaboo\Services\ReaderServices\UserServiceInterface;
}