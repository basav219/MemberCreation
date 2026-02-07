<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('member/create', 'Member::create');
$routes->post('member/store', 'Member::store');
