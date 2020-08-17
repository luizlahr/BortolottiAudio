<?php

namespace App\Providers;

use Borto\Domain\Authentication\Repositories\UserRepository;
use Borto\Domain\Equipment\Repositories\BrandRepository;
use Borto\Domain\Equipment\Repositories\CategoryRepository;
use Borto\Domain\Equipment\Repositories\ModelRepository;
use Borto\Domain\Shared\Services\AuthInfo;
use Borto\Domain\Shared\Services\HashChecker;
use Borto\Domain\Shared\Services\HashMaker;
use Borto\Infrastructure\DB\Repositories\EloquentBrandRepository;
use Borto\Infrastructure\DB\Repositories\EloquentCategoryRepository;
use Borto\Infrastructure\DB\Repositories\EloquentModelRepository;
use Borto\Infrastructure\DB\Repositories\EloquentUserRepository;
use Borto\Infrastructure\Services\IlluminateAuthInfo;
use Borto\Infrastructure\Services\IlluminateHashChecker;
use Borto\Infrastructure\Services\IlluminateHashMaker;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // SERVICES
        $this->app->bind(HashChecker::class, IlluminateHashChecker::class);
        $this->app->bind(HashMaker::class, IlluminateHashMaker::class);
        $this->app->bind(AuthInfo::class, IlluminateAuthInfo::class);

        // REPOSITORIES
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(BrandRepository::class, EloquentBrandRepository::class);
        $this->app->bind(ModelRepository::class, EloquentModelRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
