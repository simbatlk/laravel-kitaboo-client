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
use Thunderlane\Kitaboo\Services\ExternalServices;
use Thunderlane\Kitaboo\Services\ExternalServicesInterface;
use Thunderlane\Kitaboo\Clients\ExternalServicesInterface as ExtertnalServiceClientInterface;
use Thunderlane\Kitaboo\Clients\ExternalServices as ExtertnalServiceClient;

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

        $this->app->singleton(ExtertnalServiceClientInterface::class, function () {
            return new ExtertnalServiceClient();
        });

        $this->app->singleton(ExternalServicesInterface::class, function () {
            return new ExternalServices($this->app->make(ExtertnalServiceClientInterface::class));
        });

        $this->app->singleton(KitabooInterface::class, function () {
            $externalServices = $this->app->make(ExternalServicesInterface::class);
            return new Kitaboo($externalServices);
        });
    }

    public function provides(): array
    {
        return ['laravel.kitaboo'];
    }
}