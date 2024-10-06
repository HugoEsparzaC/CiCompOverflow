<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PagesController;

$router = new Router();

$router->get('/', [PagesController::class, 'index']);

// Checks and validates the routes that exist and assigns them the Controller functions
$router->checkRoutes();