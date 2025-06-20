<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'AuthController::login');
$routes->post('/login', 'Auth::login', ['filter' => 'redirect']);

$routes->get('logout', 'AuthController::logout');



$routes->get('/produk', 'ProdukController::index');
$routes->get('/keranjang', 'TransaksiController::index');
$routes->get('/contact', 'ContactController::index');
