<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// AUTH
$routes->get('admin/login', 'Admin::login');
$routes->post('admin/authenticate', 'Admin::authenticate');
$routes->get('admin/logout', 'Admin::logout');

// HOME
$routes->get('/', 'Home::index');

// MEMBER (PROTECTED)
$routes->group('member', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Member::index');        
    $routes->get('create', 'Member::create');  
    $routes->post('store', 'Member::store');   
    $routes->get('list', 'Member::list');      
    $routes->get('edit/(:num)', 'Member::edit/$1');
    $routes->post('update/(:num)', 'Member::update/$1');
    $routes->post('edit-by-customer', 'Member::editByCustomerId');
    $routes->get('export-csv', 'Member::exportCSV');
    $routes->get('export-pdf', 'Member::exportPDF');
    $routes->get('sharecreation', 'Member::sharecreation');
  
});

// AJAX / Public endpoints (optional: move inside auth group if needed)
$routes->get('member/searchIntroducer', 'Member::searchIntroducer', ['as'=>'member.searchIntroducer']);
$routes->get('member/fetch-location', 'Member::fetchLocationByPincode', ['as'=>'member.fetchLocation']);
$routes->get('member/fetch-areas', 'Member::fetchAreasByPincode', ['as'=>'member.fetchAreas']);
$routes->get('member/fetch-location-by-area', 'Member::fetchLocationByArea', ['as'=>'member.fetchLocationByArea']);

//Share cCreation
$routes->get('share/sharecreation', 'ShareController::create');
$routes->get('share/create', 'ShareController::create');
$routes->post('share/store', 'ShareController::store');
$routes->get('share/sharecreationlist', 'ShareController::index');
$routes->get('customer/search', 'ShareController::searchCustomer');
$routes->get('customer/details/(:segment)', 'ShareController::getCustomer/$1');
$routes->get('share/sharecreationlist', 'ShareController::sharecreationlist');
$routes->get('share/export-csv', 'ShareController::exportCsv');
$routes->get('share/export-pdf', 'ShareController::exportPdf');
$routes->get('share/share_edit/(:segment)', 'ShareController::edit/$1');
$routes->post('share/update/(:segment)', 'ShareController::update/$1');
$routes->get('share/viewpagesharecreation/(:segment)', 'ShareController::viewPageShareCreation/$1');
$routes->get('share/getNominees/(:segment)', 'ShareController::getNominees/$1');
$routes->get('share/check-exists/(:segment)', 'ShareController::checkShareExists/$1');