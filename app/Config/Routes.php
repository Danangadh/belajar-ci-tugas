<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');


$routes->get('logout', 'AuthController::logout');
$routes->group('produk', ['filters' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filters' => 'auth'], function ($routes) {
    $routes->get('/', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');

});
$routes->get('checkout', 'TransaksiController::checkout', ['filters' => 'auth']);
$routes->get('get-location', 'TransaksiController::getLocation', ['filters' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filters' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filters' => 'auth']);

$routes->get('diskon', 'DiskonController::index');
$routes->get('diskon/create', 'DiskonController::create');
$routes->post('diskon/store', 'DiskonController::store');
$routes->get('diskon/edit/(:num)', 'DiskonController::edit/$1');
$routes->post('diskon/update/(:num)', 'DiskonController::update/$1');
$routes->get('diskon/delete/(:num)', 'DiskonController::delete/$1');




$routes->get('/produk', 'ProdukController::index');
$routes->get('/keranjang', 'TransaksiController::index');
$routes->get('/contact', 'ContactController::index');
