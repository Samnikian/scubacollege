<?php

namespace Users;

class User {

    private $result,$db, $id, $email, $password, $last_login_time, $reset_hash, $reset_time, $reset_email, $last_login_ip, $aantal_pogingen, $lidnr, $activatie_hash, $adres, $opleidingen, $naam, $voornaam, $level, $active, $input_password;

    public function __construct(&$db, $id = '', $mail = '') {
        $this->db = $db;
        if ($mail == '' && $id == '' && isset($_SESSION['ingelogt']) && $_SESSION['ingelogt'] === true) {
            $this->id = $_SESSION['user_id'];
            $this->result = $this->loadDetails();
        } elseif (is_numeric($id) && empty($mail)) {
            $this->id = $id;
            $this->result = $this->loadDetails();
        } elseif (!is_numeric($id) && !empty($mail)) {
            $this->email = $mail;
            $this->result = $this->loadDetailsMail();
        }
    }

    private function hashPassword($pasw) {
        return password_hash($pasw, PASSWORD_DEFAULT);
    }

    public function updateUser() {
//TODO
    }

    public function changePassword($oudww, $nieuwwwa, $nieuwwwb) {
        if ($nieuwwwa === $nieuwwwb) {
            if ($this->checkPassword($oudww)) {
                $this->updatePassword($nieuwwwa);
                return array(true, '<span class="melding">Wachtwoord succesvol gewijzigd.</span>');
            } else {
                return array(false, '<span class="melding">Oud wachtwoord incorrect.</span>');
            }
        } else {
            return array(false, '<span class="melding">Nieuwe wachtwoorden zijn niet gelijk.</span>');
        }
    }

    public function login($password) {
        if ($this->active) {
            if ($this->aantal_pogingen < 4) {
                if ($this->checkPassword($password)) {
                    $_SESSION['ingelogt'] = true;
                    $_SESSION['user_level'] = $this->level;
                    $_SESSION['user_id'] = $this->id;
                    $this->loginSucces();
                    $this->result =  array(true, '<span class="melding">Succesvol ingelogt!</span>');
                } else {
                    $_SESSION['ingelogt'] = false;
                    $this->slechtePoging();
                    $this->result =  array(false, '<span class="melding">Wachtwoord incorrect.</span>');
                }
            } else {
                $this->result =  array(false, '<span class="melding">Teveel login pogingen! <a href="forgot.php">Wachtwoord vergeten?</a></span>');
            }
        } else {
            $this->result =  array(false, '<span class="melding">Account is inactief, neem contact op met de beheerder.</span>');
        }
    }

    public function logout() {
        if (isset($_SESSION['ingelogt']) && $_SESSION['ingelogt'] === true) {
            $_SESSION['ingelogt'] = false;
            $_SESSION['user_level'] = 0;
            $_SESSION['user_id'] = '';
            session_destroy();
        }
    }

    private function loadDetails() {
        $query = "SELECT email,password,lidnr,adres,opleidingen,naam,voornaam,level,active,aantal_pogingen FROM login WHERE id=? LIMIT 1;";
        $stmt = $this->db->prepare($query);
        if ($stmt !== false) {
            $stmt->bind_param("i", $this->id);
            if ($stmt->execute()) {
                $stmt->bind_result($email, $password, $lidnr, $adres, $opleidingen, $naam, $voornaam, $level, $active, $aantal_pogingen);
                $result = $stmt->fetch();
                $this->email = $email;
                $this->password = $password;
                $this->lidnr = $lidnr;
                $this->adres = $adres;
                $this->opleidingen = $opleidingen;
                $this->naam = $naam;
                $this->voornaam = $voornaam;
                $this->level = $level;
                $this->active = $active;
                $this->aantal_pogingen = $aantal_pogingen;
                $this->result = array(true,'');
            } else {
                $this->result = array(false, '<span class="melding">Failed to load data.</span>');
            }
            $stmt->close();
        } else {
            $this->result = array(false, '<span class="melding">Account bestaat niet!</span>');
        }
    }

    private function loadDetailsMail() {
        $query = "SELECT id,password,lidnr,adres,opleidingen,naam,voornaam,level,active,aantal_pogingen FROM login WHERE email=? LIMIT 1;";
        $stmt = $this->db->prepare($query);
        if ($stmt !== false) {
            $stmt->bind_param("s", $this->email);
            if ($stmt->execute()) {
                $stmt->bind_result($id, $password, $lidnr, $adres, $opleidingen, $naam, $voornaam, $level, $active, $aantal_pogingen);
                $stmt->fetch();
                $this->id = $id;
                $this->password = $password;
                $this->lidnr = $lidnr;
                $this->adres = $adres;
                $this->opleidingen = $opleidingen;
                $this->naam = $naam;
                $this->voornaam = $voornaam;
                $this->level = $level;
                $this->active = $active;
                $this->aantal_pogingen = $aantal_pogingen;
                $this->result =  array(true,'');
            } else {
                $this->result =  array(false, '<span class="melding">Failed to load data.</span>');
            }
            $stmt->close();
        } else {
            $this->result =  array(false, '<span class="melding">Account bestaat niet!</span>');
        }
    }

    private function checkPassword($ww) {
        return password_verify($ww, $this->password);
    }

    private function updatePassword($nieuwwwa) {
        $hash = $this->hashPassword($nieuwwwa);
        $this->password = $hash;
        $query = "UPDATE login SET password=? WHERE id=?;";
        $stmt = $this->db->prepare($query);
        if ($stmt !== false) {
            $stmt->bind_param("si", $hash, $this->id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function loginSucces() {
        $query = 'UPDATE login SET last_login_time=?,last_login_ip=?,aantal_pogingen=0 WHERE id=?';
        $tijd = time();
        $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
        $stmt = $this->db->prepare($query);
        if ($stmt !== false) {
            $stmt->bind_param("ssi", $tijd, $ip, $this->id);
            if (!$stmt->execute()) {
                throw \Exception('Unknown error.');
            }
        }
    }

    private function slechtePoging() {
        $query = 'UPDATE login SET aantal_pogingen=? WHERE id=?';
        $pogingen = $this->aantal_pogingen + 1;
        $stmt = $this->db->prepare($query);
        if ($stmt !== false) {
            $stmt->bind_param("ii", $pogingen, $this->id);
            if (!$stmt->execute()) {
                throw \Exception('Unknown error.');
            }
        }
    }

    public function doLogin() {
        $this->getPostData();
        $this->loadDetailsMail();
        if($this->result[0]){
            $this->login($this->input_password);
        }
        if ($this->result[0]) {
            echo $this->result[1];
            redirect('index.php');
        } else {
            echo $this->result[1];
        }
        $this->input_password = '';
    }

    public function doLogout() {
        $this->logout();
        echo '<div id="content">Je werd succesvolg uitgelogt!</div>';
        redirect('index.php');
    }

    private function getPostData() {
        $this->email = filter_input(INPUT_POST, 'email');
        $this->input_password = filter_input(INPUT_POST, 'password');
    }

}
