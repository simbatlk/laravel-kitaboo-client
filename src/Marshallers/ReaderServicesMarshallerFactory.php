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

use Thunderlane\Kitaboo\Exceptions\UnknownEntityException;
use Thunderlane\Kitaboo\Marshallers\ReaderServices\AuthenticateUserMarshaller;
use Thunderlane\Kitaboo\Marshallers\ReaderServices\ChangePasswordMarshaller;
use Thunderlane\Kitaboo\Marshallers\ReaderServices\CheckClientSessionMarshaller;
use Thunderlane\Kitaboo\Marshallers\ReaderServices\ResetPasswordMarshaller;
use Thunderlane\Kitaboo\Marshallers\ReaderServices\UserMarshaller;

/**
 * Class ReaderServicesMarshallerFactory
 *
 * @package Thunderlane\Kitaboo\Marshallers
 */
class ReaderServicesMarshallerFactory implements ReaderServicesMarshallerFactoryInterface
{
    public const AUTHENTICATE_USER = 'authenticateUser';
    public const CHANGE_PASSWORD = 'changePassword';
    public const CHECK_CLIENT_SESSION = 'checkClientSession';
    public const VALIDATE_USER_TOKEN = 'validateUserToken';
    public const RESET_PASSWORD = 'resetPassword';

    /**
     * @inheritdoc
     */
    public function getMarshaller(string $entity): MarshallerInterface
    {
        switch ($entity) {
            case self::AUTHENTICATE_USER:
                return new AuthenticateUserMarshaller();
                break;
            case self::CHANGE_PASSWORD:
                return new ChangePasswordMarshaller();
                break;
            case self::CHECK_CLIENT_SESSION:
                return new CheckClientSessionMarshaller();
                break;
            case self::VALIDATE_USER_TOKEN:
                return new CheckClientSessionMarshaller();
                break;
            case self::RESET_PASSWORD:
                return new ResetPasswordMarshaller();
                break;
            default:
                throw new UnknownEntityException();
                break;
        }
    }
}