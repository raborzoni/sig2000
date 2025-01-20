<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
    ];

    protected $middlewareGroups = [
        'web' => [
            // Middleware para o grupo web
        ],
        'api' => [
            // Middleware para o grupo API
        ],
    ];

    protected $routeMiddleware = [
        // Middleware para rotas específicas
    ];
}