<?php

namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

Class LoginController {
    public static function login( Router $router ) {
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alerts = $auth->validarLogin();
            if(empty($alerts)) {
                $usuario = Usuario::where('email', $auth->email);
                if($usuario) {
                    if($usuario->comprobarPasswordAndUserStatus($auth->password)) {
                        session_start();
                        $_SESSION['id'] = $usuario->id_user;
                        $_SESSION['nombre'] = $usuario->nickname;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        if($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                        }
                        header('Location: /');
                    }
                } else {
                    Usuario::setAlert('error', 'Usuario no encontrado');
                }
            }
        }
        $alerts = Usuario::getAlerts();
        $router->render('auth/login', [
            'alerts' => $alerts
        ]);
    }

    public static function logout( Router $router ) {
        $router->render('pages/index');
    }

    public static function forgotPassword( Router $router ) {
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alerts = $auth->validarEmail();
            if (empty($alerts)) {
                $usuario = Usuario::where('email', $auth->email);
                if($usuario && $usuario->status_user === 'Verificado') {
                    $usuario->crearToken();
                    $email = new Email($usuario->email, $usuario->nickname, $usuario->token);
                    $email->enviarRecuperacion();
                    $usuario->save();
                    Usuario::setAlert('exito', 'Correo enviado, revisa tu bandeja de entrada');
                } else {
                    Usuario::setAlert('error', 'El correo electrónico no esta registrado o la cuenta no esta verificada');
                }
                $alerts = Usuario::getAlerts();
            }
        }
        $router->render('auth/forgot-password', [
            'alerts' => $alerts
        ]);
    }

    public static function accountRecovery( Router $router ) {
        $alerts = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if (empty($usuario)) {
            Usuario::setAlert('error', 'Token no válido');
            $error = true;
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $password = new Usuario($_POST);
                $alerts = $password->validarPassword();
                if (empty($alerts)) {
                    $usuario->password = $password->password;
                    $usuario->hashPassword();
                    $usuario->token = null;
                    $usuario->save();
                    Usuario::setAlert('exito', 'Contraseña actualizada correctamente');
                }
            }
        }
        $alerts = Usuario::getAlerts();
        $router->render('auth/account-recovery', [
            'alerts' => $alerts,
            'error' => $error
        ]);
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