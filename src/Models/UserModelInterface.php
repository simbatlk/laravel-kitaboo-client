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
 * Interface UserModelInterface
 *
 * @package Thunderlane\Kitaboo\Models
 */
interface UserModelInterface
{
    /**
     * @return int
     */
    public function getId(): ?int;

    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getFirstName(): ?string;

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void;

    /**
     * @return string
     */
    public function getLastName(): ?string;

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void;

    /**
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * @param string $email
     */
    public function setEmail(string $email): void;

    /**
     * @return array
     */
    public function getRoles(): ?array;

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void;

    /**
     * @return string
     */
    public function getUserName(): ?string;

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void;

    /**
     * @return bool
     */
    public function isUsernameForInstitute(): ?bool;

    /**
     * @param bool $usernameForInstitute
     */
    public function setUsernameForInstitute(bool $usernameForInstitute): void;

    /**
     * @return bool
     */
    public function isTrialUser(): ?bool;

    /**
     * @param bool $trialUser
     */
    public function setTrialUser(bool $trialUser): void;

    /**
     * @return int
     */
    public function getSessionCount(): ?int;

    /**
     * @param int $sessionCount
     */
    public function setSessionCount(int $sessionCount): void;

    /**
     * @return string
     */
    public function getProfilePicURL(): ?string;

    /**
     * @param string $profilePicURL
     */
    public function setProfilePicURL(string $profilePicURL): void;

    /**
     * @return string
     */
    public function getCoverPhotoURL(): ?string;

    /**
     * @param string $coverPhotoURL
     */
    public function setCoverPhotoURL(string $coverPhotoURL): void;

    /**
     * @return string
     */
    public function getClientUserID(): ?string;

    /**
     * @param string $clientUserID
     */
    public function setClientUserID(string $clientUserID): void;

    /**
     * @return int
     */
    public function getUserID(): ?int;

    /**
     * @param int $userID
     */
    public function setUserID(int $userID): void;

    /**
     * @return int
     */
    public function getClientID(): ?int;

    /**
     * @param int $clientID
     */
    public function setClientID(int $clientID): void;

    /**
     * @return int
     */
    public function getLevel(): ?int;

    /**
     * @param int $level
     */
    public function setLevel(int $level): void;

    /**
     * @param \stdClass $collection
     */
    public function hydrate(\stdClass $user): void;
}