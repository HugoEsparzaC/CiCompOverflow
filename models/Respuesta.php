<?php

namespace Model;

class Respuesta extends ActiveRecord {
    protected static $table = 'answers';
    protected static $dbColumns = ['content_answer'];

    public $id_answer;
    public $id_question;
    public $id_user;
    public $content_answer;
    public $creation_date_answer;
    public $votes_answer;

    public function __construct($args = []) {
        $this->id_answer = $args['id_answer'] ?? NULL;
        $this->id_question = $args['id_question'] ?? NULL;
        $this->id_user = $args['id_user'] ?? NULL;
        $this->content_answer = $args['content_answer'] ?? '';
        $this->creation_date_answer = $args['creation_date_answer'] ?? 'CURDATE()';
        $this->votes_answer = $args['votes_answer'] ?? 0;
    }

    public static function countAnswers() {
        $query = "SELECT COUNT(*) FROM answers";
        $result = self::$db->query($query);
        $row = $result->fetch_array();
        return $row[0];
    }
}