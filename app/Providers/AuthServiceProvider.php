<?php

namespace App\Providers;

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
        'App\Models\BlogPosts' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {   //dd(454);
        //$this->registerPolicies();


        //$policies = app('Illuminate\Contracts\Auth\Access\Gate')->policies();

    // Output the list of policies
    //dump($policies);

        //Gate::policy(BlogPosts::class, BlogPostPolicy::class);
    }
}
