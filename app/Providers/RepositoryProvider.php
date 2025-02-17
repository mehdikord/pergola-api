<?php

namespace App\Providers;

use App\Interfaces\Answer_Options\AnswerOptionInterface;
use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Colors\ColorInterface;
use App\Interfaces\Options\OptionInterface;
use App\Interfaces\Plans\PlanInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Interfaces\Questions\QuestionInterface;
use App\Interfaces\Users\UserInterface;
use App\Repositories\Answer_Options\AnswerOptionRepository;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Colors\ColorRepository;
use App\Repositories\Options\OptionRepository;
use App\Repositories\Plans\PlanRepository;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Questions\QuestionRepository;
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

        $this->app->bind(OptionInterface::class,OptionRepository::class);

        $this->app->bind(QuestionInterface::class,QuestionRepository::class);

        $this->app->bind(PlanInterface::class,PlanRepository::class);

        $this->app->bind(AnswerOptionInterface::class,AnswerOptionRepository::class);

    }

    public function boot(): void
    {

    }
}



?>
