<?php
/**
 * This file is part of the Laravel Kitaboo package.
 *
 * (c) Ivan Atanasov <thunderlane@thewonderbolts.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Thunderlane\Kitaboo;

use Thunderlane\Kitaboo\Services\ExternalServicesInterface;
use Thunderlane\Kitaboo\Services\ReaderServicesInterface;

/**
 * Class Kitaboo
 *
 * @package Thunderlane\Kitaboo
 */
class Kitaboo implements KitabooInterface
{
    /**
     * @var \Thunderlane\Kitaboo\Services\ExternalServicesInterface
     */
    private $externalServices;

    /**
     * @var \Thunderlane\Kitaboo\Services\ReaderServicesInterface
     */
    private $readerServices;
    /**
     * Kitaboo constructor.
     *
     * @param \Thunderlane\Kitaboo\Services\ExternalServicesInterface $externalServices
     */
    public function __construct(ExternalServicesInterface $externalServices, ReaderServicesInterface $readerServices)
    {
        $this->externalServices = $externalServices;
        $this->readerServices= $readerServices;
    }

    /**
     * @inheritdoc
     */
    public function getExternalServices(): ExternalServicesInterface
    {
        return $this->externalServices;
    }

    /**
     * @inheritdoc
     */
    public function getReaderServices(): ReaderServicesInterface
    {
        return $this->readerServices;
    }
}