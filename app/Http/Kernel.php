<?php
protected $routeMiddleware = [
    // Otros middlewares...
    'verify.jwt' => \App\Http\Middleware\VerifyJwt::class,
];