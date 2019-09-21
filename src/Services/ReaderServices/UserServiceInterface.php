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
     * @param string $userName
     * @param string $password
     * @return bool
     * @throws \Thunderlane\Kitaboo\Exceptions\UnknownEntityException
     */
    public function authenticateUser(string $userName, string $password): bool;

    /**
     * @param string $oldPassword
     * @param string $newPassword
     * @return bool
     */
    public function changePassword(string $oldPassword, string $newPassword): bool;

    /**
     * @return bool
     */
    public function checkClientSession(int $bookId): bool;

    /**
     * @return bool
     */
    public function validateUserToken(): bool;

    /**
     * @param string $userName
     * @return bool
     */
    public function resetPassword(string $userName): bool;

    /**
     * @return null|\stdClass
     */
    public function getLastResponse(): ?\stdClass;

    /**
     * @return null|string
     */
    public function getCurrentUserToken(): ?string;

    /**
     * @param string $token
     */
    public function setCurrentUserToken(string $token): void;

    /**
     * @param \Thunderlane\Kitaboo\Services\UserModelInterface $user
     */
    public function setCurrentUser(UserModelInterface $user): void;

    /**
     * @return null|\Thunderlane\Kitaboo\Models\UserModelInterface
     */
    public function getCurrentUser(): ?UserModelInterface;
}