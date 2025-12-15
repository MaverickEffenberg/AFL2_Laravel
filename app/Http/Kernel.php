<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Global middleware...
    ];

    /**
     * The application's route middleware groups.
     *
     * These middleware groups may be applied to routes.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Web-specific middleware...
        ],

        'api' => [
            // API-specific middleware...
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware can be assigned to specific routes.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        // Other route middleware...

        // Register your custom admin middleware here
        'admin' => \App\Http\Middleware\CheckIfAdmin::class,  // This is your custom middleware
    ];
}
