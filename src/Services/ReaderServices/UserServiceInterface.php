<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Services\ReaderServices;

use Thunderlane\Kitaboo\Models\UserModelInterface;

/**
 * Interface ReaderServicesInterface
 *
 * @package Thunderlane\Kitaboo\Services
 */
interface UserServiceInterface
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws \Thunderlane\Kitaboo\Exceptions\UnknownEntityException
     */
    public function authenticateUser(string $username, string $password): bool;

    /**
     * @return null|\stdClass
     */
    public function getLastFailedResponse(): ?\stdClass;

    /**
     * @param \stdClass $lastFailedResponse
     */
    public function setLastFailedResponse(\stdClass $lastFailedResponse): void;

    /**
     * @return null|string
     */
    public function getCurrentUserToken(): ?string;

    /**
     * @param \Thunderlane\Kitaboo\Services\UserModelInterface $user
     */
    public function setCurrentUser(UserModelInterface $user): void;

    /**
     * @return null|\Thunderlane\Kitaboo\Models\UserModelInterface
     */
    public function getCurrentUser(): ?UserModelInterface;
}