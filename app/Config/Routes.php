<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');

// Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('loginAuth', 'Auth::loginAuth');
$routes->get('register', 'Auth::register');
$routes->post('registerSave', 'Auth::registerSave');
$routes->get('logout', 'Auth::logout');

// Employee Routes 
$routes->get('employee', 'Employee::index', ['filter' => 'auth']);
$routes->get('employee/create', 'Employee::create', ['filter' => 'auth']);
$routes->post('employee/store', 'Employee::store', ['filter' => 'auth']);
$routes->get('employee/edit/(:num)', 'Employee::edit/$1', ['filter' => 'auth']);
$routes->post('employee/update/(:num)', 'Employee::update/$1', ['filter' => 'auth']);
$routes->post('employee/delete/(:num)', 'Employee::delete/$1', ['filter' => 'auth']);
