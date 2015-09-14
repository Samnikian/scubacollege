<?php

namespace Users;

class Manager {

    private $email, $lidnr;
    private $error = false;
    private $errors = array();

    public function newUser() {
        $output = '';
        $req = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if ($req == 'POST') {
            $this->validateAuthorization();
            $this->getPostData();
            $this->validateData();
            if (!$this->error) {
                $output = $this->RegisterUser();
            } else {
                $output = $this->getErrors();
            }
        } else {
            $output = $this->getRegistrationForm();
        }
        return $output;
    }

    private function getRegistrationForm() {
        echo 'A$$';
    }

    private function getPostData() {
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $this->lidnr = filter_input(INPUT_POST, 'lidnr', FILTER_SANITIZE_NUMBER_INT);
    }

    private function validateData() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error = true;
            $this->errors[] = '<li>Geef een geldig email adres op</li>';
        }
        if (!filter_var($this->lidnr, FILTER_VALIDATE_INT)) {
            $this->error = true;
            $this->errors[] = '<li>Geef een geldig lidnr op</li>';
        }
    }

    private function RegisterUser() {
        
    }

    public function getUnauthorizedMessage() {
        return '<span class="melding">U heeft niet genoeg rechten om een gebruiker toe te voegen.</span>';
    }

    public function getErrors() {
        $output = '<ul>';
        for($i=0;$i<count($this->errors);$i++){
            $output.= $this->errors[$i];
        }
        $output.= '</ul>';
    }

    public function validateAuthorization() {
        if ($_SESSION['user_level'] <= 3 or ! isset($_SESSION['ingelogt']) or $_SESSION['ingelogt'] === false) {
            redirect('index.php');
        }
    }

}
