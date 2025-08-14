<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
<<<<<<< HEAD
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'editeur' => \App\Http\Middleware\EditeurMiddleware::class,
        ]);
=======
        //
>>>>>>> bf330a648a7b8366453911d006c1fdbba87992c0
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
