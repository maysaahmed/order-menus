<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/menuitems', function () use ($router) {
    return $router->app->version() . ' Module:MenuItems';
});

$router->group(['prefix' => 'api/v1'], function() use ($router) {
    $router->group(['prefix' => 'menuItems'], function() use ($router) {
        $router->post('/', 'MenuItemsController@store');
        $router->get('/', 'MenuItemsController@index');
        $router->get('/{id}', 'MenuItemsController@show');
        $router->delete('/{id}', 'MenuItemsController@destroy');
    });
});
