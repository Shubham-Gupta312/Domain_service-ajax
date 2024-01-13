<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index', ['filter' => 'isLogin']);
$routes->get('/register', 'HomeController::register');
$routes->post('/register', 'HomeController::register');
$routes->get('/login', 'HomeController::login');
$routes->post('/login', 'HomeController::login');
$routes->get('/logout', 'HomeController::logout');

// form (domain) data
$routes->post('/domain_data', 'HomeController::domain_data');

// retrive data 
$routes->post('/retrive_data', 'HomeController::retrive_data');

// view data of particular id
$routes->post('/view_data', 'HomeController::view_data');

// edit the data
$routes->post('/edit', 'HomeController::edit');
// update the data
$routes->post('/update_data', "HomeController::update_data");