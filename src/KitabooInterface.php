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
 * Interface KitabooInterface
 *
 * @package Thunderlane\Kitaboo
 */
interface KitabooInterface
{
    public function getExternalServices(): ExternalServicesInterface;
}