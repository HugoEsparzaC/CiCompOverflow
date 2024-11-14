<?php

namespace Model;

class Pregunta extends ActiveRecord {
    protected static $table = 'questions';
    protected static $dbColumns = ['title', 'content_question'];

    public $id_question;
    public $id_user;
    public $title;
    public $content_question;
    public $creation_date_question;
    public $votes_question;
    public $status_question;

    public function __construct($args = []) {
        $this->id_question = $args['id_question'] ?? NULL;
        $this->id_user = $args['id_user'] ?? NULL;
        $this->title = $args['title'] ?? '';
        $this->content_question = $args['content_question'] ?? '';
        $this->creation_date_question = $args['creation_date_question'] ?? 'CURDATE()';
        $this->votes_question = $args['votes_question'] ?? 0;
        $this->status_question = $args['status_question'] ?? 'Abierta';
    }

    public static function countQuestions() {
        $query = "SELECT COUNT(*) FROM questions";
        $result = self::$db->query($query);
        $row = $result->fetch_array();
        return $row[0];
    }
}