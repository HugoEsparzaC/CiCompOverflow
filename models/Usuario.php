<?php

namespace Model;

class Usuario extends ActiveRecord {
    // Base de datos
    protected static $table = 'users';
    protected static $dbColumns = ['nickname', 'email', 'password', 'picture', 'major', 'registration_date', 'reputation', 'biography', 'status_user', 'admin', 'token'];

    public $id_user;
    public $nickname;
    public $email;
    public $password;
    public $picture;
    public $major;
    public $registration_date;
    public $reputation;
    public $biography;
    public $status_user;
    public $admin;
    public $token;

    public function __construct($args = []) {
        $this->id_user = $args['id_user'] ?? NULL;
        $this->nickname = $args['nickname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->picture = $args['picture'] ?? NULL;
        $this->major = $args['major'] ?? NULL;
        $this->registration_date = $args['registration_date'] ?? 'CURDATE()';
        $this->reputation = $args['reputation'] ?? 0;
        $this->biography = $args['biography'] ?? '';
        $this->status_user = $args['status_user'] ?? 'Registrado';
        $this->admin = $args['admin'] ?? 1;
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta() {
        if(!$this->nickname) {
            self::$alerts['error'][] = 'El nombre de usuario es obligatorio';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'El correo electrónico es obligatorio';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'El correo electrónico es obligatorio';
        }
        if($this->email and (!filter_var($this->email, FILTER_VALIDATE_EMAIL) or strlen($this->email) != 24 or substr($this->email, 0, 1) != 'a' or substr($this->email, -14) != '@alumnos.uaslp.mx')) {
            self::$alerts['error'][] = 'Correo electrónico no válido, asegurate de que sea tu correo institucional de la UASLP';
        }
        if($this->password and strlen($this->password) < 8) {
            self::$alerts['error'][] = 'La contraseña debe contener al menos 8 caracteres';
        }
        if(!$this->major) {
            self::$alerts['error'][] = 'Elige una carrera';
        }

        return self::$alerts;
    }

    public function existeCorreo() {
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1;";
        $resultado = self::$db->query($query);
        if($resultado->num_rows) {
            self::$alerts['error'][] = 'Este correo electrónico ya esta registrado';
        }
        return $resultado;
    }

    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$table . " WHERE nickname = '" . $this->nickname . "' LIMIT 1;";
        $resultado = self::$db->query($query);
        if($resultado->num_rows) {
            self::$alerts['error'][] = 'Este nombre de usuario ya esta tomado, elige otro';
        }
        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function validarLogin() {
        if(!$this->email) {
            self::$alerts['error'][] = 'El correo electrónico es obligatorio';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }
        return self::$alerts;
    }

    public function comprobarPasswordAndUserStatus($password) {
        $resultado = password_verify($password, $this->password);
        if(!$resultado or $this->status_user != 'Verificado') {
            self::$alerts['error'][] = 'Contraseña incorrecta o cuenta no verificada';
        } else {
            return true;
        }
    }
}