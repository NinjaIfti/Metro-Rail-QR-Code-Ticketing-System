<?php
// api/index.php

// Load Laravel's autoloader
require __DIR__ . '/../vendor/autoload.php';

// Load Laravel kernel
require_once __DIR__ . '/../bootstrap/app.php';

// Create the kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Handle the request
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);