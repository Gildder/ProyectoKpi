<?php

namespace ProyectoKpi\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \ProyectoKpi\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \ProyectoKpi\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \ProyectoKpi\Http\Middleware\Authenticate::class,                         //  utenticacion para outing
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,       // contenido basico de autenticacion
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \ProyectoKpi\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,


        'administrador' => \ProyectoKpi\Http\Middleware\AdministradorMiddleware::class,
        'estandard' => \ProyectoKpi\Http\Middleware\EstandarMiddleware::class,
    ];
}
