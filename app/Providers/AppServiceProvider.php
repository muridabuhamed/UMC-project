<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Statamic\Widgets\Widget::register(\App\Widgets\SchoolStatsWidget::class);
        \Statamic\Widgets\Widget::register(\App\Widgets\QuickLinksWidget::class);
        \Statamic\Widgets\Widget::register(\App\Widgets\RecentActivityWidget::class);
    }
}
