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

use Illuminate\Support\Collection;

/**
 * Interface ExternalServicesInterface
 *
 * @package Thunderlane\Kitaboo\Services
 */
interface ExternalServicesInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function listCollection(): Collection;
}