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
use Thunderlane\Kitaboo\Services\DevicesMap;

/**
 * Class UserService
 *
 * @package Thunderlane\Kitaboo\Services\ReaderServices
 */
class UserService implements UserServiceInterface
{
    private const AUTHENTICATE_USER_ENDPOINT = "DistributionServices/services/api/reader/user/%s/%s/authenticateUser";
    private const CHANGE_PASSWORD_ENDPOINT = "DistributionServices/services/api/reader/user/%s/%s/changePassword";
    private const CHECK_CLIENT_SESSION_ENDPOINT = "DistributionServices/services/api/reader/user/%s/%s/%s/checkClientSession";
    private const VALIDATE_USER_TOKEN_ENDPOINT = "DistributionServices/services/api/reader/user/%s/%s/validateUserToken";
    private const RESET_PASSWORD_ENDPOINT = "DistributionServices/services/api/reader/user/%s/%s/resetPassword";

    /**
     * @var \Thunderlane\Kitaboo\Clients\ReaderInterface
     */
    private $client;

    /**
     * @var \Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactoryInterface
     */
    private $marshallerFactory;

    /**
     * @var string
     */
    private $deviceId;

    /**
     * @var string
     */
    private $deviceType;

    /**
     * @var \stdClass|null
     */
    private $lastResponse;

    /**
     * @var \Thunderlane\Kitaboo\Models\UserModel
     */
    private $currentUser;

    /**
     * UserService constructor.
     *
     * @param \Thunderlane\Kitaboo\Clients\ReaderInterface $client
     * @param \Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactoryInterface $marshallerFactory
     * @param \Thunderlane\Kitaboo\Models\UserModelInterface $userModel
     * @param string $deviceId
     * @param string|null $deviceType
     */
    public function __construct(
        ReaderInterface $client,
        ReaderServicesMarshallerFactoryInterface $marshallerFactory,
        UserModelInterface $userModel,
        string $deviceId = '0',
        string $deviceType = null
    ) {
        $this->client = $client;
        $this->marshallerFactory = $marshallerFactory;
        $this->deviceId = $deviceId;
        $this->deviceType = $deviceType ?? DevicesMap::DEVICE_WINDOWS;
        $this->currentUser = $userModel;
    }

    /**
     * @inheritdoc
     */
    public function authenticateUser(string $userName, string $password): bool
    {
        $marshaller = $this->marshallerFactory->getMarshaller(ReaderServicesMarshallerFactory::AUTHENTICATE_USER);
        $data = $marshaller->encodeData(['userName' => $userName, 'password' => $password]);
        $response = $marshaller->decodeResponseData(
            $this->client->getClient()->post(
                $this->getEndpoint(self::AUTHENTICATE_USER_ENDPOINT),
                $data
            )
        );

        $this->setLastResponse($response);
        $isResponseOK = $this->client->isResponseOK($response);
        if ($isResponseOK) {
            $this->client->setUserToken($response->userToken);
            $this->setCurrentUser(new UserModel($response->user));
        }

        return $isResponseOK;
    }

    /**
     * @inheritdoc
     */
    public function changePassword(string $oldPassword, string $newPassword): bool
    {
        $marshaller = $this->marshallerFactory->getMarshaller(ReaderServicesMarshallerFactory::CHANGE_PASSWORD);

        $data = $marshaller->encodeData([
            'userName' => $this->currentUser->getUserName(),
            'password' => $oldPassword,
            'newPassword' => $newPassword,
        ]);

        $response = $marshaller->decodeResponseData(
            $this->client->getClient()->post(
                $this->getEndpoint(self::CHANGE_PASSWORD_ENDPOINT),
                $data
            )
        );
        $this->setLastResponse($response);

        return $this->client->isResponseOK($response);
    }

    /**
     * @inheritdoc
     */
    public function checkClientSession(int $bookId = 0): bool
    {
        $marshaller = $this->marshallerFactory->getMarshaller(ReaderServicesMarshallerFactory::CHECK_CLIENT_SESSION);

        $response = $marshaller->decodeResponseData(
            $this->client->getClient()->get(
                $this->getEndpoint(self::CHECK_CLIENT_SESSION_ENDPOINT, $bookId)
            )
        );
        $this->setLastResponse($response);

        return $this->client->isResponseOK($response);
    }

    /**
     * @inheritdoc
     */
    public function validateUserToken(): bool
    {
        $marshaller = $this->marshallerFactory->getMarshaller(ReaderServicesMarshallerFactory::CHECK_CLIENT_SESSION);
        $data = $marshaller->encodeData([
            'usertoken' => $this->client->getUserToken(),
        ]);

        $response = $marshaller->decodeResponseData(
            $this->client->getClient()->get(
                $this->getEndpoint(self::VALIDATE_USER_TOKEN_ENDPOINT),
                $data
            )
        );
        $this->setLastResponse($response);
        $isResponseOK = $this->client->isResponseOK($response);
        if ($isResponseOK) {
            $this->client->setUserToken($response->userToken);
            $this->setCurrentUser(new UserModel($response->user));
        }

        return $isResponseOK;
    }

    /**
     * @inheritdoc
     */
    public function resetPassword(string $userName): bool
    {
        $marshaller = $this->marshallerFactory->getMarshaller(ReaderServicesMarshallerFactory::RESET_PASSWORD);
        $data = $marshaller->encodeData([
            'userName' => $userName,
        ]);

        $response = $marshaller->decodeResponseData(
            $this->client->getClient()->post(
                $this->getEndpoint(self::RESET_PASSWORD_ENDPOINT),
                $data
            )
        );
        $this->setLastResponse($response);

        return $this->client->isResponseOK($response);
    }

    /**
     * @inheritdoc
     */
    public function getLastResponse(): ?\stdClass
    {
        return $this->lastResponse;
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

    /**
     * @param \stdClass $lastResponse
     */
    private function setLastResponse(\stdClass $lastResponse): void
    {
        $this->lastResponse = $lastResponse;
    }

    /**
     * @param string $endpointTemplate
     * @return string
     */
    private function getEndpoint(string $endpointTemplate, $parameter = null)
    {
        return sprintf($endpointTemplate, $this->deviceId, $this->deviceType, $parameter);
    }
}