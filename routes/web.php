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
    $app->get('/','PagesController@index'); //get all the pages
    $app->post('/','PagesController@store'); //store single pages
    $app->get('/{id}/', 'PagesController@show'); //get single pages
    $app->get('/name/{name}','PagesController@showByName'); //get all the pages
    $app->put('/{id}/','PagesController@update'); //update single pages
    $app->delete('/{id}/','PagesController@destroy'); //delete single pages
});

$app->group(['prefix' => 'layout/'], function ($app) {
    $app->get('/','LayoutsController@index'); //get all the layouts
    $app->post('/','LayoutsController@store'); //store single layout
    $app->get('/{id}/', 'LayoutsController@show'); //get single layout
    $app->get('/name/{name}','LayoutsController@showByName'); //get layout by name
    $app->put('/{id}/','LayoutsController@update'); //update single layout
    $app->delete('/{id}/','LayoutsController@destroy'); //delete single layout

    $app->get('/{id}/zone','ZonesController@index'); //get all the zones for this layout
    $app->post('/{id}/zone','ZonesController@store'); //store single zone
    $app->get('/{id}/zone/{zoneid}/', 'ZonesController@show'); //get single zone
    $app->get('/{id}/zone/name/{name}','ZonesController@showByName'); //get zone by name
    $app->put('/{id}/zone/{zoneid}','ZonesController@update'); //update single zone
    $app->delete('/{id}/zone/{zoneid}','ZonesController@destroy'); //delete single zone
});