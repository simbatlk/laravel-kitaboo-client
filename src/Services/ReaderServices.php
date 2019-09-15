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

use Thunderlane\Kitaboo\Services\ReaderServices\UserServiceInterface;

/**
 * Class ReaderServices
 *
 * @package Thunderlane\Kitaboo\Services
 */
class ReaderServices implements ReaderServicesInterface
{
    /**
     * @var \Thunderlane\Kitaboo\Services\ReaderServices\UserServiceInterface
     */
    private $userService;

    /**
     * ReaderServices constructor.
     *
     * @param \Thunderlane\Kitaboo\Services\ReaderServices\UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @inheritdoc
     */
    public function getUserService(): \Thunderlane\Kitaboo\Services\ReaderServices\UserServiceInterface
    {
        return $this->userService;
    }
}