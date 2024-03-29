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
use Thunderlane\Kitaboo\Services\ExternalServices\CollectionServiceInterface;

/**
 * Interface ExternalServicesInterface
 *
 * @package Thunderlane\Kitaboo\Services
 */
interface ExternalServicesInterface
{
    /**
     * @return \Thunderlane\Kitaboo\Services\CollectionServiceInterface
     */
    public function getCollectionService(): CollectionServiceInterface;
}