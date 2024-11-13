<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PagesController;
use Controllers\LoginController;

$router = new Router();

// Login page
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/', [LoginController::class, 'logout']);

// Account Recovery
$router->get('/forgot-password', [LoginController::class, 'forgotPassword']);
$router->post('/forgot-password', [LoginController::class, 'forgotPassword']);
$router->get('/account-recovery', [LoginController::class, 'accountRecovery']);
$router->post('/account-recovery', [LoginController::class, 'accountRecovery']);

// Sign up page
$router->get('/signup', [LoginController::class, 'signup']);
$router->post('/signup', [LoginController::class, 'signup']);

// Confirm account
$router->get('/confirm-account', [LoginController::class, 'confirmAccount']);
$router->get('/message', [LoginController::class, 'message']);

// Main page
$router->get('/', [PagesController::class, 'index']);

// Tags page
$router->get('/tags', [PagesController::class, 'tags']);

// Users page
$router->get('/users', [PagesController::class, 'users']);

// Unanswered page
$router->get('/unanswered', [PagesController::class, 'unanswered']);

// Questions page
$router->get('/questions', [PagesController::class, 'questions']);

// Checks and validates the routes that exist and assigns them the Controller functions
$router->checkRoutes();