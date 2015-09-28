<?php

namespace Users;

class Manager {

    private $email, $lidnr;
    private $error = false;
    private $errors = array();
    private $activatie_hash;

    public function __construct() {
        $this->activatie_hash = hash('sha256', time());
    }

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
        $output = '<fieldset><legend>Een nieuwe gebruiker toevoegen</legend>';
        $output.= '<label for="lidnr">Lid Nummer</label><input type="text" name="lidnr" value="'.$this->lidnr.'" placeholder="2015345678" />';
        $output.= '<label for="email"></label><input type="text" name="email" value="'.$this->email.'" placeholder="voorbeeld@voorbeeld.be" />';
        $output.= '<input type="submit" name="" value="Toevoegen" />';
        $output.= '</fieldset>';
        return $output;
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
        $query = "INSERT INTO login (email,lidnr,activatie_hash) VALUES (?,?,?);";
        $stmt = $this->db->prepare($query);
        if ($stmt !== false) {
            $stmt->bind_param("sis", $this->email, $this->lidnr, $this->activatie_hash);
            if ($stmt->execute()) {
                return $this->getSuccessMessage();
            } else {
                return $this->getFailMessage($stmt->error);
            }
            $stmt->close();
        } else {
            return 'Error: ' . $stmt->error;
        }
    }

    public function getErrors() {
        $output = 'Gelieve de volgende fouten te corrigeren.';
        $output.= '<ul>';
        for ($i = 0; $i < count($this->errors); $i++) {
            $output.= $this->errors[$i];
        }
        $output.= '</ul>';
    }

    public function validateAuthorization() {
        if ($_SESSION['user_level'] <= 3 or ! isset($_SESSION['ingelogt']) or $_SESSION['ingelogt'] === false) {
            return '<span class="melding">U heeft niet genoeg rechten om een gebruiker toe te voegen.</span>';
        }
    }

    public function getSuccessMessage() {
        return '<span class="melding"> De gebruiker is succesvol toegevoegd></span>';
    }

    public function getFailMessage($err = 'onbekend') {
        return '<span class="melding"> Er is een fout opgetreden, contacteer de webmaster. (Foutcode: ' . $err . ')</span>';
    }

}
