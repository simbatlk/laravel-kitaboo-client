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

use Illuminate\Support\ServiceProvider;

/**
 * Class KitabooServiceProvider
 *
 * @package Thunderlane\Kitaboo
 */
class KitabooServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/laravel_kitaboo.php' => base_path('config/laravel_kitaboo.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel_kitaboo.php', 'laravel_kitaboo');
    }

    public function provides(): array
    {
        return ['laravel.kitaboo'];
    }
}