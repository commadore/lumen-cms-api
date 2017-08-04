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

$app->group(['prefix' => 'page/{id}'], function ($app) {
    $app->get('/content/','ContentsController@index'); //get all the contents for a page
    $app->post('/content','ContentsController@store'); //store single content
    $app->get('/{contentid}/', 'ContentsController@show'); //get single content
    $app->put('/{contentid}/','ContentsController@update'); //update single content
    $app->delete('/{contentid}/','ContentsController@destroy'); //delete single content

    $app->get('/metadata','MetadatasController@index'); //get all the zones for this layout
    $app->post('/metadata','MetadatasController@store'); //store single zone
    $app->get('/metadata/{metadataid}/', 'MetadatasController@show'); //get single zone
    $app->get('/metadata/name/{name}','MetadatasController@showByName'); //get zone by name
    $app->put('/metadata/{metadataid}','MetadatasController@update'); //update single zone
    $app->delete('/metadata/{metadataid}','MetadatasController@destroy'); //delete single zone
});