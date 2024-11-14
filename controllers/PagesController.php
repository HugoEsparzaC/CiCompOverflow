<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Pregunta;
use Model\Respuesta;

Class PagesController {
    public static function index( Router $router ) {
        session_start();
        $numUsuarios = Usuario::countUsers();
        $numPreguntas = Pregunta::countQuestions();
        $numRespuestas = Respuesta::countAnswers();
        $router->render('pages/index', [
            'numUsuarios' => $numUsuarios,
            'numPreguntas' => $numPreguntas,
            'numRespuestas' => $numRespuestas
        ]);
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

    public static function saves(Router $router) {
        session_start();
        if (!isset($_SESSION['login'])) {
            header('Location: /login');
            exit;
        }
        $router->render('pages/saves');
    }

    public static function profile(Router $router) {
        session_start();
        if (!isset($_SESSION['login'])) {
            header('Location: /login');
            exit;
        }
        $router->render('pages/profile');
    }

    public static function ask(Router $router) {
        session_start();
        if (!isset($_SESSION['login'])) {
            header('Location: /login');
            exit;
        }
        $router->render('pages/ask');
    }
}