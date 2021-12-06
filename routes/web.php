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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'/partner'], function($router){
    $router->get('/', 'PartnerController@all');
    $router->post('/add', 'PartnerController@add');
    $router->post('/authenticate', 'PartnerController@authenticate');
});
$router->group(['prefix'=>'/product'], function($router){
    $router->get('/', 'ProductController@all');
    $router->post('/add', 'ProductController@add');
    $router->group(['prefix'=>'/{product_id}'], function($router){
        $router->delete('/delete', 'ProductController@delete');
        $router->post('/add-to-cart', 'ProductController@addToCart');
    });
});
$router->group(['prefix'=>'/cart'], function($router){
    $router->get('/', 'CartController@partnerCart');
});
$router->post('/order', "OrderController@order");