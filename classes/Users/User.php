<?php

namespace Users;

class User {

    private $email,$id,$hashed_password,$password, $register_ip,$register_timestamp,$register_validation;
    private $ip_last_login,$reset_code,$reset_timestamp,$reset_ip,$ban,$loginfails;

    public function __construct($id) {
        
    } 
    private function hashPassword(){
        $this->hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->password = NULL;
    }
    public function addUser($email,$password) {
        $this->hashPassword();
        $query = "INSERT INTO login (email,password,ip_register,register_timestamp,register_validation) VALUES ('" . $this->email . "','" . $this->hashed_password . "','" . $this->ip . "');";
        $result = $this->db->query($query);
        return $result;
    }

    public function updateUser() {
        
    }

    public function login() {
                $_SESSION['ingelogt'] = true;
		$_SESSION['user_level'] = $this->userlevel;
		$_SESSION['user_id'] = 0;
		echo '<p class="melding">Je werd succesvol ingelogt!</p>';
    }

    public function logout() {
        
    }

}

//email password ip_register ip_last_login reset_code reset_timestamp ban loginfails