<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// routes for the products endpoint
$router->get('/products', 'ProductController@getAllProducts');
$router->delete('/products/(\d+)', 'ProductController@deleteProduct');
$router->post('/products', 'ProductController@createProduct');
$router->get('/products/(\d+)', 'ProductController@getProductById');
$router->put('/products/(\d+)', 'ProductController@updateProduct');

// routes for the users endpoint
$router->post('/users', 'UserController@createUser');
$router->post('/users/login', 'UserController@loginUser');

// routes for the orders endpoint
$router->post('/orders', 'OrderController@createOrder');

// routes for the orderItems endpoint
$router->post('/orderItems', 'OrderItemController@createOrderItem');

// Run it!
$router->run();