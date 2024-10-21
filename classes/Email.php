<?php
    namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

    class Email {
        public $email;
        public $nombre;
        public $token;
        public function __construct($email, $nombre, $token) {
            $this->email = $email;
            $this->nombre = $nombre;
            $this->token = $token;
        }

        public function enviarConfirmacion() {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['MAIL_PORT'];
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->setFrom('cuentas@cicompoverflow.com');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Confirma tu cuenta';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = '<html>';
            $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong> Has creado tu cuenta en CiCompOverflow, solo debes confirmarla presionando el siguiente enlace</p>';
            $contenido .= '<p>Presiona aquí: <a href="' . $_ENV['APP_URL'] . '/confirm-account?token=' . $this->token . '">Confirmar cuenta</a></p>';
            $contenido .= '<p>Si no has creado una cuenta en CiCompOverflow, ignora este mensaje</p>';
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->send();
        }
    }
?>