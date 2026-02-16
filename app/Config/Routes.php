<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// AUTH
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/authenticate', 'Admin::authenticate');
$routes->get('admin/logout', 'Admin::logout');

// HOME
$routes->get('/', 'Home::index');

// MEMBER (PROTECTED)
$routes->group('member', ['filter' => 'auth'], function($routes) {

    $routes->get('create', 'Member::create');
    $routes->post('store', 'Member::store');

    $routes->get('list', 'Member::list');
    $routes->get('/', 'Member::index');
    
  
     $routes->get('member', 'Member::index');
    
    $routes->get('edit/(:num)', 'Member::edit/$1');
    $routes->post('update/(:num)', 'Member::update/$1');

    $routes->post('edit-by-customer', 'Member::editByCustomerId');
    //Export the member list into pdf or csv file
   $routes->get('export-csv', 'Member::exportCSV');
   $routes->get('export-pdf', 'Member::exportPDF');
});

$routes->get('member/searchIntroducer', 'Member::searchIntroducer');

$routes->get('member/fetch-location', 'Member::fetchLocationByPincode');

$routes->get('member/fetch-areas', 'Member::fetchAreasByPincode');
$routes->get('member/fetch-location-by-area', 'Member::fetchLocationByArea');