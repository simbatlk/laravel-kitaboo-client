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

/**
 * Class Kitaboo
 *
 * @package Thunderlane\Kitaboo
 */
class Kitaboo implements KitabooInterface
{
    /**
     * @var ExternalServicesInterface
     */
    private $externalServices;

    public function __construct(ExternalServicesInterface $externalServices)
    {
        $this->externalServices = $externalServices;
    }

    /**
     * @return ExternalServicesInterface
     */
    public function getExternalServices(): ExternalServicesInterface
    {
        return $this->externalServices;
    }
}