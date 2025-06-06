<?php

namespace App\Providers;

use App\Interfaces\Admins\AdminInterface;
use App\Interfaces\Answer_Options\AnswerOptionInterface;
use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Color_Groups\ColorGroupInterface;
use App\Interfaces\Colors\ColorInterface;
use App\Interfaces\Dashboard\DashboardInterface;
use App\Interfaces\Invoices\InvoiceInterface;
use App\Interfaces\Options\OptionInterface;
use App\Interfaces\Pages\PageInterface;
use App\Interfaces\Plans\PlanInterface;
use App\Interfaces\Posts\PostInterface;
use App\Interfaces\Profile\ProfileInterface;
use App\Interfaces\Questions\QuestionInterface;
use App\Interfaces\Services\ServiceInterface;
use App\Interfaces\Users\UserInterface;
use App\Repositories\Admins\AdminRepository;
use App\Repositories\Answer_Options\AnswerOptionRepository;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Color_Groups\ColorGroupRepository;
use App\Repositories\Colors\ColorRepository;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\Invoices\invoiceRepository;
use App\Repositories\Options\OptionRepository;
use App\Repositories\Pages\PageRepository;
use App\Repositories\Plans\PlanRepository;
use App\Repositories\Posts\PostRepository;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Questions\QuestionRepository;
use App\Repositories\Services\ServiceRepository;
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

        $this->app->bind(ServiceInterface::class,ServiceRepository::class);

        $this->app->bind(ColorGroupInterface::class,ColorGroupRepository::class);

        $this->app->bind(AdminInterface::class,AdminRepository::class);

        $this->app->bind(InvoiceInterface::class,invoiceRepository::class);

        $this->app->bind(DashboardInterface::class,DashboardRepository::class);

        $this->app->bind(PostInterface::class,PostRepository::class);

        $this->app->bind(PageInterface::class,PageRepository::class);


    }

    public function boot(): void
    {

    }
}



?>
