<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         //'App\Models\User' => 'App\Policies\MenuPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        //Menu Policy
        Gate::define('viewGestionActeur', [\App\Policies\MenuPolicy::class, 'viewGestionActeur']);
        Gate::define('viewCreateContent', [\App\Policies\MenuPolicy::class, 'viewCreateContent']);
        Gate::define('viewEditeContent', [\App\Policies\MenuPolicy::class, 'viewEditeContent']);
        Gate::define('viewDeleteContent', [\App\Policies\MenuPolicy::class, 'viewDeleteContent']);
        Gate::define('viewReport', [\App\Policies\MenuPolicy::class, 'viewReport']);
        Gate::define('viewMangeTicket', [\App\Policies\MenuPolicy::class, 'viewMangeTicket']);
        Gate::define('viewManageEmail', [\App\Policies\MenuPolicy::class, 'viewManageEmail']);
    }
}
