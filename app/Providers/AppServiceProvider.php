<?php

namespace App\Providers;

use App\Interfaces\MetaInterface;
use App\Services\MetaClass;
use Eusonlito\LaravelMeta\Meta;
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
        $this->registerRepositories();
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

    private function registerRepositories(): void
    {
        $this->app->bind(MetaInterface::class, MetaClass::class);
        // We are literally binding the interface (UserRepository) to a concrete class
        // So when somewhere in the applicatoin the UserRepository should be injected
        // instance of PostgresUser will be return

        // I prefer to create a map of interfaces that need binding
        // And just itterate through them. I find it more readable
        // $toBind = [
        //     UserRepository::class => PostgresUser::class,
        // ];

        // foreach ($toBind as $interface => $implementation) {
        //     $this->app->bind($interface, $implementation);
        // }
    }
}
