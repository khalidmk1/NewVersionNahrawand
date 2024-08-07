<?php

namespace App\Providers;



use App\Interfaces\FAQInterface;
use App\Services\FAQ\FAQService;
use App\Interfaces\EmailIterface;
use App\Interfaces\MapsInterface;
use App\Interfaces\QuizIntreface;
use App\Interfaces\EventInterface;
use App\Interfaces\VideoInterface;
use App\Services\Maps\MapsService;
use App\Services\Quiz\QuizService;
use App\Interfaces\ReportInterface;
use App\Interfaces\TicketInterface;
use App\Interfaces\ContentInterface;
use App\Interfaces\ProfileInterface;
use App\Interfaces\ProgramInterface;
use App\Services\Email\EmailService;
use App\Services\Event\EventService;
use App\Services\Video\VideoService;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ObjectiveInterface;
use App\Services\Report\ReportService;
use App\Services\Tickets\TicketService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\SubCategoryInterface;
use App\Services\Content\ContentService;
use App\Services\Profile\ProfileService;
use App\Services\Program\ProgramService;
use App\Interfaces\NotificationInterface;
use App\Services\Category\CategoryService;
use App\Interfaces\RolePermissionInterface;
use App\Services\Objective\ObjectiveService;
use App\Services\Role\RolePermissionService;
use App\Services\SubCategory\SubCategoryService;
use App\Services\Notification\NotificationService;


class ServiceInterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProfileInterface::class, ProfileService::class);
        $this->app->bind(RolePermissionInterface::class, RolePermissionService::class);
        $this->app->bind(CategoryInterface::class, CategoryService::class);
        $this->app->bind(SubCategoryInterface::class, SubCategoryService::class);
        $this->app->bind(ProgramInterface::class, ProgramService::class);
        $this->app->bind(ObjectiveInterface::class, ObjectiveService::class);
        $this->app->bind(ContentInterface::class, ContentService::class);
        $this->app->bind(VideoInterface::class, VideoService::class);
        $this->app->bind(EventInterface::class, EventService::class);
        $this->app->bind(FAQInterface::class, FAQService::class);
        $this->app->bind(EmailIterface::class, EmailService::class);
        $this->app->bind(TicketInterface::class, TicketService::class);
        $this->app->bind(QuizIntreface::class, QuizService::class);
        $this->app->bind(NotificationInterface::class, NotificationService::class);
        $this->app->bind(ReportInterface::class, ReportService::class);
        $this->app->bind(MapsInterface::class, MapsService::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
