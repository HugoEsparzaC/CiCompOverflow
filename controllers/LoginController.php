<?php

namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

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
        $usuario = new Usuario;
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->synchronize($_POST);
            $alerts = $usuario->validarNuevaCuenta();
            if(empty($alerts)) {
                $resultado = $usuario->existeCorreo();
                if($resultado->num_rows) {
                    $alerts = Usuario::getAlerts();
                } else {
                    $resultado = $usuario->existeUsuario();
                    if($resultado->num_rows) {
                        $alerts = Usuario::getAlerts();
                    } else {
                        $usuario->hashPassword();
                        $usuario->crearToken();
                        $email = new Email($usuario->email, $usuario->nickname, $usuario->token);
                        $email->enviarConfirmacion();
                        $resultado = $usuario->save();
                        if($resultado) {
                            header('Location: /message');
                        }
                    }
                }
            }
        }
        $router->render('auth/signup', [
            'usuario' => $usuario,
            'alerts' => $alerts
        ]);
    }

    public static function confirmAccount( Router $router ) {
        $alerts = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)) {
            Usuario::setAlert('error', 'Token no válido');
        } else {
            $usuario->status_user = 'Verificado';
            $usuario->token = null;
            $usuario->save();
            Usuario::setAlert('exito', 'Cuenta verificada correctamente');
        }
        $alerts = Usuario::getAlerts();
        $router->render('auth/confirm-account', [
            'alerts' => $alerts
        ]);
    }

    public static function message( Router $router ) {
        $router->render('auth/message');
    }
}