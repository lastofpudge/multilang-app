<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        \App\Models\Post::class => \App\Admin\Models\Post::class,
    ];

    /**
     * @param Router $router
     */
    public function registerRoutes(Router $router)
    {
        $router->group([
            'prefix'     => config('sleeping_owl.url_prefix'),
            'middleware' => config('sleeping_owl.middleware')
        ], function ($router) {
        });
    }


    /**
     * Register sections.
     *
     * @param \SleepingOwl\Admin\Admin $admin
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//
        $this->app->call([ $this, 'registerRoutes' ]);
        parent::boot($admin);
    }
}
