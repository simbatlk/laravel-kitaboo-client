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

use Thunderlane\Kitaboo\Clients\ReaderInterface;
use Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactory;
use Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactoryInterface;
use Thunderlane\Kitaboo\Models\UserModel;
use Thunderlane\Kitaboo\Models\UserModelInterface;

/**
 * Class UserService
 *
 * @package Thunderlane\Kitaboo\Services\ReaderServices
 */
class UserService implements UserServiceInterface
{
    private const AUTHENTICATE_USER_ENDPOINT = "DistributionServices/services/api/reader/user/SGH116SPZL/WINDOWS/authenticateUser";

    /**
     * @var \Thunderlane\Kitaboo\Clients\ReaderInterface
     */
    private $client;

    /**
     * @var \Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactoryInterface
     */
    private $marshallerFactory;

    /**
     * @var \stdClass|null
     */
    private $lastFailedResponse;

    /**
     * @var \Thunderlane\Kitaboo\Models\UserModel|null
     */
    private $currentUser;

    /**
     * UserService constructor.
     *
     * @param \Thunderlane\Kitaboo\Services\ReaderServices\ReaderInterface $client
     * @param \Thunderlane\Kitaboo\Services\ReaderServices\ReaderServicesMarshallerFactoryInterface $marshallerFactory
     */
    public function __construct(ReaderInterface $client, ReaderServicesMarshallerFactoryInterface $marshallerFactory)
    {
        $this->client = $client;
        $this->marshallerFactory = $marshallerFactory;
    }

    /**
     * @inheritdoc
     */
    public function authenticateUser(string $username, string $password): bool
    {
        $marshaller = $this->marshallerFactory->getMarshaller(ReaderServicesMarshallerFactory::USER);
        $data = $marshaller->encodePostData(['username' => $username, 'password' => $password]);
        $response = $this->client->getClient()->post(self::AUTHENTICATE_USER_ENDPOINT, $data);
        $response = $marshaller->decodeResponseData($response);

        if ($response->responseCode !== 200) {
            $this->setLastFailedResponse($response);
            return false;
        }

        $this->client->setUserToken($response->userToken);
        $this->setCurrentUser(new UserModel($response->user));
        return true;
    }

    /**
     * @return null|\stdClass
     */
    public function getLastFailedResponse(): ?\stdClass
    {
        return $this->lastFailedResponse;
    }

    /**
     * @param \stdClass $lastFailedResponse
     */
    public function setLastFailedResponse(\stdClass $lastFailedResponse): void
    {
        $this->lastFailedResponse = $lastFailedResponse;
    }

    /**
     * @inheritdoc
     */
    public function getCurrentUserToken(): ?string
    {
        return $this->client->getUserToken();
    }

    /**
     * @inheritdoc
     */
    public function setCurrentUserToken(string $token): void
    {
        $this->client->setUserToken($token);
    }

    /**
     * @inheritdoc
     */
    public function setCurrentUser(UserModelInterface $user): void
    {
        $this->currentUser = $user;
    }

    /**
     * @inheritdoc
     */
    public function getCurrentUser(): ?UserModelInterface
    {
        return $this->currentUser;
    }
}