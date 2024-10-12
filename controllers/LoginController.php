<?php

namespace Controllers;
use MVC\Router;

Class LoginController {
    public static function login( Router $router ) {
        $router->render('auth/login');
    }

    public static function logout( Router $router ) {
        $router->render('pages/index');
    }

    public static function forgotPassword( Router $router ) {
        $router->render('auth/forgot-password');
    }

    public static function accountRecovery( Router $router ) {
        $router->render('auth/account-recovery');
    }

    public static function signup( Router $router ) {
        $router->render('auth/signup');
    }
}