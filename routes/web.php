<?php

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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'page/'], function ($app) {
    $app->get('/','PagesController@index'); //get all the routes
    $app->post('/','PagesController@store'); //store single route
    $app->get('/{id}/', 'PagesController@show'); //get single route
    $app->put('/{id}/','PagesController@update'); //update single route
    $app->delete('/{id}/','PagesController@destroy'); //delete single route
});