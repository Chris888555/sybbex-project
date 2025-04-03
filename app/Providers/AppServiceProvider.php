<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\SidebarComposer;
use App\Http\View\Composers\AdminHeaderComposer;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register SidebarComposer for 'includes.sidebar' view
        View::composer('includes.sidebar', SidebarComposer::class);

        // Register AdminHeaderComposer for 'includes.admin-header' view
        View::composer('includes.admin-header', AdminHeaderComposer::class);

        // Apply SidebarComposer to all views EXCEPT 'sales_funnel'
        View::composer('*', function ($view) {
            if ($view->getName() !== 'sales_funnel') {
                (new SidebarComposer())->compose($view);
            }
        });
    }

    public function register()
    {
        //
    }
}
