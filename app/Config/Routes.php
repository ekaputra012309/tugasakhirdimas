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

// route api admin
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('admin', 'AdminController::index');
    $routes->get('admin/(:num)', 'AdminController::show/$1');
    $routes->post('admin', 'AdminController::create');
    $routes->put('admin/(:num)', 'AdminController::update/$1');
    $routes->delete('admin/(:num)', 'AdminController::delete/$1');
});
// route api jabatan
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('jabatan', 'JabatanController::index');
    $routes->get('jabatan/(:num)', 'JabatanController::show/$1');
    $routes->post('jabatan', 'JabatanController::create');
    $routes->put('jabatan/(:num)', 'JabatanController::update/$1');
    $routes->delete('jabatan/(:num)', 'JabatanController::delete/$1');
});

// route web admin page
$routes->group('admin', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AdminPageController::login');
    $routes->get('dashboard', 'AdminPageController::dashboard');
    // admin
    $routes->get('admin', 'AdminPageController::admin');
    $routes->get('admin/add', 'AdminPageController::addadmin');
    $routes->get('admin/edit', 'AdminPageController::editadmin');
    // jabatan
    $routes->get('jabatan', 'AdminPageController::jabatan');
    $routes->get('jabatan/add', 'AdminPageController::addjabatan');
    $routes->get('jabatan/edit', 'AdminPageController::editjabatan');
});
