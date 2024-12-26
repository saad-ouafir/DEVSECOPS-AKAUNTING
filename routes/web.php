<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/**
 * 'web' middleware applied to all routes
 *
 * @see \App\Providers\Route::mapWebRoutes
 */

Livewire::setScriptRoute(function ($handle) {
    $base = request()->getBasePath();

    return Route::get($base . '/vendor/livewire/livewire/dist/livewire.min.js', $handle);
});

Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('register');
});

// Ensure the route points to the correct controller and method
Route::post('/register', 'Auth\Register@store')->name('register');