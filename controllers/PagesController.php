<?php

namespace Controllers;
use MVC\Router;

Class PagesController {
    public static function index( Router $router ) {
        session_start();
        $router->render('pages/index');
    }

    public static function questions( Router $router ) {
        $router->render('pages/questions');
    }

    public static function tags( Router $router ) {
        $router->render('pages/tags');
    }

    public static function users( Router $router ) {
        $router->render('pages/users');
    }

    public static function unanswered( Router $router ) {
        $router->render('pages/unanswered');
    }
}