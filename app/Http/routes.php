<?php

/*
 * Routes
 */
$app->get('/', [
    'uses' => 'App\Http\Controllers\MainController@frontpage'
]);

$app->get('/about', [
    'uses' => 'App\Http\Controllers\MainController@about'
]);

$app->get('test', function () {

});
