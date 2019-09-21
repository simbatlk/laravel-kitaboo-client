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
 * Class UserMarshaller
 *
 * @package Thunderlane\Kitaboo\Marshallers\ReaderServices
 */
class AuthenticateUserMarshaller extends MarshallerAbstract implements MarshallerInterface
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
                    ]
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

        return true;
    }
}