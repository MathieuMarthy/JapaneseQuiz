<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'system'.DIRECTORY_SEPARATOR.'core'
.DIRECTORY_SEPARATOR."Model.php";

require APPPATH.DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."userEntity.php";

class DAO extends CI_Model {

    /**
     * ajoute un utilisateur dans la base de données
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function addUser(string $login, string $password) {
        if (strlen($login) > 32) {
            return false;
        }

        $data = array (
            "login" => $login,
            "password" => $password,
            "token" => $this->generateToken(),
            "try" => 0,
            "succesful" => 0,
        );

        $this->db->insert("users", $data);
        return true;
    }

    public function finishGame(string $login, string $token, bool $succes) {
        echo "salut";
    }

    public function connectWithLoginPassword(string $login, string $password): userEntity {
        $query = $this->db->get_where("users", array("login" => $login));
        $result = $query->result();
        if (count($result) == 0) {
            return null;
        }
        $user = $result[0];
        if ($user->password != $password) {
            return null;
        }
        return new userEntity($user->login, $user->password, $user->token, $user->try, $user->succesful);
    }

    public function connectWithToken(string $login, string $token): userEntity {
        $query = $this->db->get_where("users", array("login" => $login, "token" => $token));
        $result = $query->result();

        if (count($result) == 0) {
            return null;
        }
        $user = $result[0];
        return new userEntity($user->login, $user->password, $user->token, $user->try, $user->succesful);
    }

    /**
     * hash the password with sha256
     * @param string $password
     * @return string
     */
    public function cryptPassword(string $password) {
        return hash("sha256", $password);
    }	

    /**
     * genere un token unique
     * 
     * @return string
     */
    private function generateToken() {
        $token = random_bytes(32);
        while ($this->checkIfTokenExist($token)) {
            $token = random_bytes(32);
        }
        return $token;
    }

    /**
     * verifie si le token existe deja
     * 
     * @param string $token
     * @return bool
     */
    private function checkIfTokenExist(string $token) {
        $this->db->select("token");
        $this->db->from("users");
        $this->db->where("token", $token);

        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

    public function getTrySucessful(string $id) {
        
    }
}