<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Clients;

interface ReaderInterface extends KitabooClientInterface
{
    /**
     * @return null|string
     */
    public function getUserToken(): ?string;

    /**
     * @param string $userToken
     */
    public function setUserToken(string $userToken): void;
}