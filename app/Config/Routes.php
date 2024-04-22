<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// auth admin
$routes->group('authadmin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->post('register', 'AdminController::register');
    $routes->post('login', 'AdminController::login');
    $routes->get('logout', 'AdminController::logout');
    $routes->get('profile', 'AdminController::getProfile');
});

// route web admin page
$routes->group('admin', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AdminPageController::login');
    $routes->get('dashboard', 'AdminPageController::dashboard');
});
