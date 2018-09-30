<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeExtensions();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @return string
     */
    private function registerBladeExtensions()
    {
        Blade::directive('permission', function ($permission) {
            return '<?php if (auth()->check() && auth()->user()->hasPermission("' . constant($permission) . '")): ?>';
        });

        Blade::directive('elsePermission', function () {
            return '<?php else: ?>';
        });

        Blade::directive('endPermission', function () {
            return '<?php endif; ?>';
        });
    }
}
