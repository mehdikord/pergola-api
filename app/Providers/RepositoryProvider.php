<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Colors\ColorInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Interfaces\Users\UserInterface;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Colors\ColorRepository;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Users\UserRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(AuthInterface::class,AuthRepository::class);

        $this->app->bind(ProfileInterface::class,ProfileRepository::class);

        $this->app->bind(UserInterface::class,UserRepository::class);

        $this->app->bind(ColorInterface::class,ColorRepository::class);

    }

    public function boot(): void
    {

    }
}



?>
