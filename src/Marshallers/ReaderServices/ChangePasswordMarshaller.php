<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Marshallers\ReaderServices;

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Thunderlane\Kitaboo\Marshallers\MarshallerAbstract;
use Thunderlane\Kitaboo\Marshallers\MarshallerInterface;

/**
 * Class ChangePasswordMarshaller
 *
 * @package Thunderlane\Kitaboo\Marshallers\ReaderServices
 */
class ChangePasswordMarshaller extends MarshallerAbstract implements MarshallerInterface
{
    /**
     * @inheritdoc
     */
    public function encodeData(array $data): array
    {
        if($this->isInputValid($data)) {
            return [
                RequestOptions::JSON => [
                    'user' => [
                        'userName' => $data['userName'],
                        'password' => $data['password']
                    ],
                    'newPassword' => $data['newPassword']
                ]
            ];
        }
    }

    private function isInputValid(array $data): bool
    {
        if (!isset($data['userName'])) {
            throw new \InvalidArgumentException('Username is required');
        }

        if (!isset($data['password'])) {
            throw new \InvalidArgumentException('Password is required');
        }

        if (!isset($data['newPassword'])) {
            throw new \InvalidArgumentException('New password is required');
        }

        return true;
    }
}