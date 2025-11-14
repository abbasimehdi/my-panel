<?php
//
//use Illuminate\Foundation\Application;
//use Illuminate\Foundation\Configuration\Exceptions;
//use Illuminate\Foundation\Configuration\Middleware;
//return Application::configure(basePath: dirname(__DIR__))
//    ->withRouting(
//        web: __DIR__.'/../routes/web.php',
//        api: __DIR__.'/../routes/api.php',
//        commands: __DIR__.'/../routes/console.php',
//        health: '/up',
//    )
//    ->withMiddleware(function (Middleware $middleware): void {
//        //
//    })
//    ->withExceptions(function (Exceptions $exceptions): void {
//        //
//    })->create();


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Enable built-in CORS for API routes
        $middleware->api(prepend: [
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);

        // If your modular structure uses web routes for API, add this too
        $middleware->web(prepend: [
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);

        // If you have modular middleware groups, you can also add it there
        $middleware->group('api', [
            \Illuminate\Http\Middleware\HandleCors::class,
            // ... your other API middleware
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
