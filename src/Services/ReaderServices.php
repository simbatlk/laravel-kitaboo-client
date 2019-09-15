<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo\Services;

use Thunderlane\Kitaboo\Clients\ReaderInterface;

/**
 * Class ReaderServices
 *
 * @package Thunderlane\Kitaboo\Services
 */
class ReaderServices implements ReaderServicesInterface
{
    /**
     * @var \Thunderlane\Kitaboo\Clients\ReaderInterface
     */
    private $client;

    /**
     * ReaderServices constructor.
     *
     * @param \Thunderlane\Kitaboo\Clients\ReaderInterface $client
     */
    public function __construct(ReaderInterface $client)
    {
        $this->client = $client;
        $this->client->setUserToken("123123");
        $this->client->setUserToken("ASDFSDFG");
    }
}