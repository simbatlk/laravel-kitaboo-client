<?php
/**
 * Created by PhpStorm.
 * User: soarin
 * Date: 15.9.2019 г.
 * Time: 13:37
 */

namespace Thunderlane\Kitaboo\Models;

class UserModel implements UserModelInterface
{
    /**
     * @var null|int
     */
    private $id;

    /**
     * @var null|string
     */
    private $firstName;

    /**
     * @var null|string
     */
    private $lastName;

    /**
     * @var null|string
     */
    private $email;

    /**
     * @var null|array
     */
    private $roles;

    /**
     * @var null|string
     */
    private $userName;

    /**
     * @var null|bool
     */
    private $usernameForInstitute;

    /**
     * @var null|bool
     */
    private $trialUser;

    /**
     * @var null|int
     */
    private $sessionCount;

    /**
     * @var null|string
     */
    private $profilePicURL;

    /**
     * @var null|string
     */
    private $coverPhotoURL;

    /**
     * @var null|string
     */
    private $clientUserID;

    /**
     * @var null|int
     */
    private $userID;

    /**
     * @var null|int
     */
    private $clientID;

    /**
     * @var null|int
     */
    private $level;

    /**
     * CollectionModel constructor.
     *
     * @param \stdClass|null $collection
     */
    public function __construct(\stdClass $user = null)
    {
        if ($user) {
            $this->hydrate($user);
        }
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return bool
     */
    public function isUsernameForInstitute(): ?bool
    {
        return $this->usernameForInstitute;
    }

    /**
     * @param bool $usernameForInstitute
     */
    public function setUsernameForInstitute(bool $usernameForInstitute): void
    {
        $this->usernameForInstitute = $usernameForInstitute;
    }

    /**
     * @return bool
     */
    public function isTrialUser(): ?bool
    {
        return $this->trialUser;
    }

    /**
     * @param bool $trialUser
     */
    public function setTrialUser(bool $trialUser): void
    {
        $this->trialUser = $trialUser;
    }

    /**
     * @return int
     */
    public function getSessionCount(): ?int
    {
        return $this->sessionCount;
    }

    /**
     * @param int $sessionCount
     */
    public function setSessionCount(int $sessionCount): void
    {
        $this->sessionCount = $sessionCount;
    }

    /**
     * @return string
     */
    public function getProfilePicURL(): ?string
    {
        return $this->profilePicURL;
    }

    /**
     * @param string $profilePicURL
     */
    public function setProfilePicURL(string $profilePicURL): void
    {
        $this->profilePicURL = $profilePicURL;
    }

    /**
     * @return string
     */
    public function getCoverPhotoURL(): ?string
    {
        return $this->coverPhotoURL;
    }

    /**
     * @param string $coverPhotoURL
     */
    public function setCoverPhotoURL(string $coverPhotoURL): void
    {
        $this->coverPhotoURL = $coverPhotoURL;
    }

    /**
     * @return string
     */
    public function getClientUserID(): ?string
    {
        return $this->clientUserID;
    }

    /**
     * @param string $clientUserID
     */
    public function setClientUserID(string $clientUserID): void
    {
        $this->clientUserID = $clientUserID;
    }

    /**
     * @return int
     */
    public function getUserID(): ?int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     */
    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return int
     */
    public function getClientID(): ?int
    {
        return $this->clientID;
    }

    /**
     * @param int $clientID
     */
    public function setClientID(int $clientID): void
    {
        $this->clientID = $clientID;
    }

    /**
     * @return int
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * @param \stdClass $collection
     */
    public function hydrate(\stdClass $user): void
    {
        $this->setId($user->id ?? 0);
        $this->setFirstName($user->firstName ?? '');
        $this->setLastName($user->lastName ?? '');
        $this->setEmail($user->email ?? '');
        $this->setRoles($user->roles ?? []);
        $this->setUserName($user->userName ?? '');
        $this->setUsernameForInstitute($user->usernameForInstitute ?? false);
        $this->setTrialUser($user->trialUser ?? false);
        $this->setSessionCount($user->sessionCount ?? 0);
        $this->setProfilePicURL($user->profilePicURL ?? '');
        $this->setCoverPhotoURL($user->coverPhotoURL ?? '');
        $this->setClientUserID($user->clientUserID ?? '');
        $this->setUserID($user->userID ?? 0);
        $this->setClientID($user->userID ?? 0);
        $this->setLevel($user->level ?? 0);
    }
}