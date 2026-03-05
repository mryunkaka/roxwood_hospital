<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// --------------------------------------------------------------------
// Admin Panel (PHASE 4 - layout shell)
// --------------------------------------------------------------------
$routes->group('admin', static function (RouteCollection $routes) {
    $routes->get('login', 'Admin\\Auth::login');
    $routes->post('login', 'Admin\\Auth::attempt');
    $routes->get('logout', 'Admin\\Auth::logout');
    $routes->get('diagnostics/db', 'Admin\\Diagnostics::db');

    $routes->group('', ['filter' => 'adminauth'], static function (RouteCollection $routes) {
        $routes->get('/', 'Admin\\Dashboard::index');
        $routes->get('account', 'Admin\\Dashboard::index'); // stub for navbar link
    });
});
