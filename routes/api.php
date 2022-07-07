<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api'], function () use ($router) {
    Route::group(['prefix' => 'user'], function () use ($router) {
        $router->post('register', ['uses' => 'UserController@register']);

        $router->post('sign-in', ['uses' => 'AuthController@signIn']);
        $router->post('recover-password', ['uses' => 'AuthController@recoverPassword']);
        $router->get('reset-password', ['as' => 'reset-password', 'uses' => 'AuthController@resetPassword']);

        Route::group(['prefix' => 'companies', 'middleware' => 'auth'], function () use ($router) {
            $router->get('/', ['uses' => 'CompanyController@index']);
            $router->post('/', ['uses' => 'CompanyController@store']);
        });
    });
});

