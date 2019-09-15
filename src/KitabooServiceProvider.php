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

use function foo\func;
use Illuminate\Support\ServiceProvider;
use Thunderlane\Kitaboo\Clients\External;
use Thunderlane\Kitaboo\Clients\ExternalInterface;
use Thunderlane\Kitaboo\Clients\Reader;
use Thunderlane\Kitaboo\Clients\ReaderInterface;
use Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactory;
use Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactoryInterface;
use Thunderlane\Kitaboo\Services\ExternalServices;
use Thunderlane\Kitaboo\Services\ExternalServicesInterface;
use Thunderlane\Kitaboo\Services\ReaderServices;
use Thunderlane\Kitaboo\Services\ReaderServicesInterface;

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

        $this->app->singleton(ExternalInterface::class, function () {
            return new External();
        });

        $this->app->singleton(ReaderInterface::class, function () {
            return new Reader();
        });

        $this->app->singleton(ReaderServicesMarshallerFactoryInterface::class, function () {
            return new ReaderServicesMarshallerFactory();
        });

        $this->app->singleton(ExternalServicesInterface::class, function () {
            return new ExternalServices($this->app->make(ExternalInterface::class));
        });

        $this->app->singleton(ReaderServicesInterface::class, function () {
            $client = $this->app->make(ReaderInterface::class);
            $marshaller = $this->app->make(ReaderServicesMarshallerFactoryInterface::class);
            return new ReaderServices($client, $marshaller);
        });

        $this->app->singleton(KitabooInterface::class, function () {
            $externalServices = $this->app->make(ExternalServicesInterface::class);
            $readerServices = $this->app->make(ReaderServicesInterface::class);
            return new Kitaboo($externalServices, $readerServices);
        });
    }

    public function provides(): array
    {
        return ['laravel.kitaboo'];
    }
}