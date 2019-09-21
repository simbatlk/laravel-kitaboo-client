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
use Thunderlane\Kitaboo\Clients\External;
use Thunderlane\Kitaboo\Clients\ExternalInterface;
use Thunderlane\Kitaboo\Clients\Reader;
use Thunderlane\Kitaboo\Clients\ReaderInterface;
use Thunderlane\Kitaboo\Marshallers\ExternalServicesMarshallerFactory;
use Thunderlane\Kitaboo\Marshallers\ExternalServicesMarshallerFactoryInterface;
use Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactory;
use Thunderlane\Kitaboo\Marshallers\ReaderServicesMarshallerFactoryInterface;
use Thunderlane\Kitaboo\Models\UserModel;
use Thunderlane\Kitaboo\Models\UserModelInterface;
use Thunderlane\Kitaboo\Services\ExternalServices;
use Thunderlane\Kitaboo\Services\ExternalServicesInterface;
use Thunderlane\Kitaboo\Services\ExternalServices\CollectionService;
use Thunderlane\Kitaboo\Services\ExternalServices\CollectionServiceInterface;
use Thunderlane\Kitaboo\Services\ReaderServices;
use Thunderlane\Kitaboo\Services\ReaderServicesInterface;
use Thunderlane\Kitaboo\Services\ReaderServices\UserServiceInterface;
use Thunderlane\Kitaboo\Services\ReaderServices\UserService;

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

        $this->registerExternalServices();
        $this->registerReaderServices();

        $this->app->singleton(KitabooInterface::class, function () {
            $externalServices = $this->app->make(ExternalServicesInterface::class);
            $readerServices = $this->app->make(ReaderServicesInterface::class);
            return new Kitaboo($externalServices, $readerServices);
        });

    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return ['laravel.kitaboo'];
    }

    private function registerExternalServices(): void
    {
        $this->app->singleton(ExternalInterface::class, function () {
            return new External();
        });

        $this->app->singleton(ExternalServicesMarshallerFactoryInterface::class, function () {
            return new ExternalServicesMarshallerFactory();
        });

        $this->app->singleton(CollectionServiceInterface::class, function () {
            $client = $this->app->make(ExternalInterface::class);
            $marshaller = $this->app->make(ExternalServicesMarshallerFactoryInterface::class);
            return new CollectionService($client, $marshaller);
        });

        $this->app->singleton(ExternalServicesInterface::class, function () {
            $collectionService = $this->app->make(CollectionServiceInterface::class);
            return new ExternalServices($collectionService);
        });
    }

    private function registerReaderServices(): void
    {
        $this->app->bind(UserModelInterface::class, function () {
            return new UserModel();
        });

        $this->app->singleton(ReaderInterface::class, function () {
            return new Reader();
        });

        $this->app->singleton(ReaderServicesMarshallerFactoryInterface::class, function () {
            return new ReaderServicesMarshallerFactory();
        });

        $this->app->singleton(UserServiceInterface::class, function () {
            $client = $this->app->make(ReaderInterface::class);
            $marshaller = $this->app->make(ReaderServicesMarshallerFactoryInterface::class);
            $userModel = $this->app->make(UserModelInterface::class);
            return new UserService($client, $marshaller, $userModel);
        });

        $this->app->singleton(ReaderServicesInterface::class, function () {
            $userService = $this->app->make(UserServiceInterface::class);
            return new ReaderServices($userService);
        });
    }
}