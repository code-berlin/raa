<?php
require_once(APPPATH . 'models/dao/db_dao.php');

class Facebook_User_m extends DB_dao {
    private $user;

    public function __construct() {
        parent::__construct('facebook_user');
    }

    public function create() {
        R::setStrictTyping(false);
        $this->user = R::dispense($this->table);
    }

    public function set($data) {
        foreach ($data as $field => $value) {
            $this->user->$field = $value;
        }
    }

    public function save() {
        R::setStrictTyping(false);
        return R::store($this->user);
    }
}