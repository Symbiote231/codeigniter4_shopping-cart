<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/cart', 'CartController::index');
$routes->post('cart/add', 'CartController::add'); // To handle form submission
$routes->post('/cart/update', 'CartController::update');
$routes->get('/cart/remove/(:any)', 'CartController::remove/$1');
$routes->get('/cart/clear', 'CartController::clear');
$routes->get('cart/add', 'CartController::showAddForm'); // To display the add form
