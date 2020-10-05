<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers',
], function () { // custom admin routes

    if (config('backpack.base.setup_dashboard_routes')==false) {
        Route::get('dashboard', 'AdminController@index')->name('backpack.dashboard');
        Route::get('/', 'AdminController@redirect')->name('backpack');
//        Route::get('/dashboard', 'AdminController@redirect')->name('backpack');
    }

    Route::get('/language/{language}', '\App\Aid\Languages@setUserLanguage');

    Route::crud('/code', 'CodeCrudController');
    Route::crud('/code/{code}/item', 'CodeitemCrudController');

}); // this should be the absolute last line of this file
