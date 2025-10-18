<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    // app/Providers/RouteServiceProvider.php

public function boot(): void
{
    $this->routes(function () {
        // Web routes
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Admin routes
        Route::middleware(['web', 'auth']) // যদি admin middleware থাকে, সেটা দিতে হবে
            ->group(base_path('routes/admin.php'));

        // API routes
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    });
}


}
