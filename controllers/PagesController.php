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
}