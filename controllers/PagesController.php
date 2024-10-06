<?php

namespace Controllers;
use MVC\Router;

Class PagesController {
    public static function index( Router $router ) {
        $router->render('pages/index');
    }
}