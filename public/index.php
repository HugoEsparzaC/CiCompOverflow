<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

$router = new Router();

// Checks and validates the routes that exist and assigns them the Controller functions
$router->checkRoutes();