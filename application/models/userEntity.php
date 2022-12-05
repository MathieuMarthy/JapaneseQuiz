<?php

class userEntity {
    public $id;
    public $login;
    public $password;
    public $token;
    public $try;
    public $succesful;

    public function __construct(string $login, string $password, string $token, int $try, int $succesful) {
        $this->login = $login;
        $this->password = $password;
        $this->token = $token;
        $this->try = $try;
        $this->succesful = $succesful;
    }

    public function getId() {
      return $this->id;
    }
    public function setId($value) {
      $this->id = $value;
    }

    public function getLogin() {
      return $this->login;
    }
    public function setLogin($value) {
      $this->login = $value;
    }

    public function getPassword() {
      return $this->password;
    }
    public function setPassword($value) {
      $this->password = $value;
    }

    public function getToken() {
      return $this->token;
    }
    public function setToken($value) {
      $this->token = $value;
    }

    public function getTry() {
      return $this->try;
    }
    public function setTry($value) {
      $this->try = $value;
    }

    public function getSuccesful() {
      return $this->succesful;
    }
    public function setSuccesful($value) {
      $this->succesful = $value;
    }
}
