<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array<string, class-string>
     */
    protected $routeMiddleware = [
    // Other middleware...
    'mentor' => \App\Http\Middleware\MentorMiddleware::class,
    'mentee' => \App\Http\Middleware\MenteeMiddleware::class,
    
];
}