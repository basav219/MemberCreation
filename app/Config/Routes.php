<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('member/create', 'Member::create');
$routes->post('member/store', 'Member::store');
$routes->get('member', 'Member::index');
$routes->get('member/edit/(:num)', 'Member::edit/$1');
$routes->post('member/update/(:num)', 'Member::update/$1');
