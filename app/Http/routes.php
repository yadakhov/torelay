<?php

/*
 * Routes
 */
$app->get('/', [
    'uses' => 'MainController@frontpage',
]);

$app->get('/about', [
    'uses' => 'MainController@about',
]);

$app->get('test', function () {

});
