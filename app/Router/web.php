<?php

use App\Router\Router;

Router::group(['App\Middleware\AuthMiddleware'],function () {
    Router::addRoute('GET', '/dashboard', 'App\Controllers\DefaultController@index');
    Router::addRoute('GET', '/polls', 'App\Controllers\Polls\PollViewsController@indexView');
    Router::addRoute('GET', '/polls/create', 'App\Controllers\Polls\PollViewsController@createView');
    Router::addRoute('GET', '/polls/:id', 'App\Controllers\Polls\PollViewsController@editView');

    Router::addRoute('POST', '/polls', 'App\Controllers\Polls\PollController@allByUser');
    Router::addRoute('POST', '/polls/create', 'App\Controllers\Polls\PollController@create');
    Router::addRoute('POST', '/polls/:id/update', 'App\Controllers\Polls\PollController@update');
    Router::addRoute('POST', '/polls/:id/delete', 'App\Controllers\Polls\PollController@delete');
    Router::addRoute('POST', '/logout', 'App\Controllers\Auth\AuthController@logout');
});

Router::group(['App\Middleware\GuestMiddleware'], function () {
    Router::addRoute('GET', '/login', 'App\Controllers\Auth\AuthController@index');
    Router::addRoute('POST', '/login', 'App\Controllers\Auth\AuthController@login');
    Router::addRoute('GET', '/registration', 'App\Controllers\Auth\RegistrationController@index');
    Router::addRoute('POST', '/registration', 'App\Controllers\Auth\RegistrationController@processRegistration');
});

Router::addRoute('GET', '/', 'App\Controllers\DefaultController@home');
Router::addRoute('GET', '/documentation', 'App\Controllers\DefaultController@documentation');
Router::addRoute('GET', '/api/:apikey/random-poll', 'App\Controllers\Api\Polls\PollController@getRandomPoll');


$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
Router::handle($uri, $method);
