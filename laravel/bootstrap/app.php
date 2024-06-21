<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// use \App\Http\Middleware\AssignSessionID;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\URL;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->redirectGuestsTo(function () {
            //return URL::to('/');
            //return route('login');
            return env('APP_URL');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
