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

$app->group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'api',
    'middleware' => 'jsonapi'
], function ($app) {
    $app->get('/company', 'CompanyController@readAll');
    $app->get('/company/{id}', 'CompanyController@read');

    $app->get('/line', 'LineController@readAll');
    $app->get('/line/{id}', 'LineController@read');

    $app->get('/status', 'StatusController@readAll');
    $app->get('/status/{id}', 'StatusController@read');

    $app->get('/occurrence', 'OccurrenceController@readAll');
    $app->get('/occurrence/{id}', 'OccurrenceController@read');
});
