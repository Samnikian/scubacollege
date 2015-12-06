<?php

namespace Users;

class Manager {

    private $email, $lidnr;
    private $error = false;
    private $errors = array();
    private $activatie_hash;
    private $db;
    private $req, $action, $getaction;

    public function __construct(&$db) {
        $this->db = $db;
        $activatie[] = time();
        $activatie[] = hash('sha256', time());
        $this->activatie_hash = serialize($activatie);
        $this->url = 'http://www.scubacollege.be/usercp.php?action=activate&h=' . urlencode($this->activatie_hash);
        $this->req = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        $this->action = filter_input(INPUT_POST, 'action');
        $this->getaction = filter_input(INPUT_GET, 'a');
    }

    public function newUser() {
        $output = '';
        if ($this->req == 'POST' && $this->action == 'add') {
            $this->validateAddAuthorization();
            $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $this->lidnr = filter_input(INPUT_POST, 'lidnr', FILTER_SANITIZE_NUMBER_INT);
            $this->validateEmail();
            $this->validateLidnr();
            if (!$this->error) {
                $output = $this->RegisterUser();
            } else {
                $output = $this->getErrors();
            }
        } elseif ($this->req == 'GET' && $this->getaction == 'activate') {//?a=activate&h=a%3A2%3A%7Bi%3A0%3Bi%3A1447965052%3Bi%3A1%3Bs%3A64%3A%227f6aaad7448cc002a903a675a1d3738f29a6f654913247c3f888cf8a02e19750%22%3B%7D
            $urlencodedhash = filter_input(INPUT_GET, 'h');
            $hash = urldecode($urlencodedhash);
            $array = unserialize($hash);
            $time = $array[0];
            $hash = $array[1];
            $this->activateUser($time, $hash);
        } else {
            $output = $this->getRegistrationForm();
        }
        return $output;
    }

    public function changePassword() {
        $output = '';
        if ($this->req == 'POST' && $this->action == 'changepassword') {
            $this->validateAuthorization();
            $oudww = filter_input(INPUT_POST, 'oudww', FILTER_SANITIZE_STRING);
            $nieuwwwa = filter_input(INPUT_POST, 'nieuwwwa', FILTER_SANITIZE_STRING);
            $nieuwwwb = filter_input(INPUT_POST, 'nieuwwwb', FILTER_SANITIZE_STRING);
            $usr = new User($this->db, $_SESSION['user_id']);
            $result = $usr->changePassword($oudww, $nieuwwwa, $nieuwwwb);
            if ($result[0]) {
                $output.= $result[1];
            } else {
                $output.= $result[1];
                $output.= $this->getChangePasswordForm();
            }
        } else {
            $output = $this->getChangePasswordForm();
        }
        return $output;
    }

    public function banUser() {
        return $this->getBanForm();
    }

    private function getRegistrationForm() {
        $output = '<fieldset><legend>Een nieuwe gebruiker toevoegen</legend>';
        $output.= '<form action="usercp.php" method="POST">';
        $output.= '<label for="lidnr">Lid Nummer</label><input type="text" id="lidnr" name="lidnr" value="' . $this->lidnr . '" placeholder="2015345678" /><br />';
        $output.= '<label for="email">Email</label><input type="text" name="email" id="email" value="' . $this->email . '" placeholder="lid@scubacollege.be" /><br />';
        $output.= '<input type="submit" value="Toevoegen" /><br />';
        $output.= '<input type="hidden" name="action" value="add">';
        $output.= '</form>';
        $output.= '</fieldset>';
        return $output;
    }

    private function getBanForm() {
        $output = '<fieldset>';
        $output.= '<legend>Gebruiker blokkeren/deblokkeren</legend>';
        $output.= '<form action="usercp.php" method="POST">';
        $output.= '<input type="text" placeholder="Lidnummer" id="lidnr" name="lidnr" />';
        $output.= '<input type="hidden" name="action" value="ban">';
        $output.= '</form>';
        $output.= '</fieldset>';
        return $output;
    }

    private function getChangePasswordForm() {
        $output = '<fieldset><legend>Je wachtwoord wijzigen</legend>';
        $output.= '<form action="usercp.php" method="POST">';
        $output.= '<label for="oudww">Oud wachtwoord</label><input type="password" id="oudww" name="oudww" /><br />';
        $output.= '<label for="nieuwwwa">Nieuw wachtwoord</label><input type="password" id="nieuwwwa" name="nieuwwwa" /><br />';
        $output.= '<label for="nieuwwwb">Bevestig nieuw wachtwoord</label><input type="password" id="nieuwwwb" name="nieuwwwb" /><br />';
        $output.= '<input type="submit" value="Wijzig wachtwoord" />';
        $output.= '<input type="hidden" name="action" value="changepassword">';
        $output.= '</form>';
        $output.= '</fieldset>';
        return $output;
    }

    private function getPostData() {
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $this->lidnr = filter_input(INPUT_POST, 'lidnr', FILTER_SANITIZE_NUMBER_INT);
    }

    private function validateEmail() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error = true;
            $this->errors[] = '<li>Geef een geldig email adres op</li>';
        }
    }

    private function validateLidnr() {
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
                $output = $this->sendRegistrationMail();
                $output.= '<span class="melding"> De gebruiker is succesvol toegevoegd</span>';
                return $output;
            } else {
                return '<span class="melding"> Er is een fout opgetreden, contacteer de webmaster. (Foutcode: ' . $stmt->error . ')</span>';
            }
            $stmt->close();
        } else {
            return 'Error: ' . $stmt->error;
        }
    }

    private function sendRegistrationMail() {
        $this->configureMailer();
        $bodytemplate = file_get_contents(FILE_REGISTRATION_TEMPLATE);
        $placeholders = array('LIDNR', 'URL');
        $replacevalues = array($this->lidnr, $this->url);
        $body = str_replace($placeholders, $replacevalues, $bodytemplate);
        $this->mailer->SetFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        $this->mailer->AddReplyTo(WEBMASTER_MAIL, WEBMASTER_NAME);
        $this->mailer->AddAddress($this->email, '');
        $this->mailer->Subject = MAIL_REGISTRATION_SUBJECT;
        $this->mailer->AltBody = MAIL_ALTBODY;
        $this->mailer->MsgHTML($body);
        $this->mailer->AddEmbeddedImage('images/mailheader.jpg', 'mailheader', 'mailheader.jpg', 'base64', 'image/jpeg');
        if (!$this->mailer->Send()) {
            $output = "<p class=\"melding\">Mailer Error: " . $this->mailer->ErrorInfo . "</p>";
        } else {
            $output = "<p class=\"melding\">Registratie Mail succesvol verzonden</p>";
        }
        return $output;
    }

    protected function configureMailer() {
        $this->mailer = new \PHPMailer();
        $this->mailer->IsSMTP();
        if (DEBUG) {
            $this->mailer->SMTPDebug = 2;
        }
        $this->mailer->SMTPAuth = true;
        $this->mailer->Host = SMTP_HOST;
        $this->mailer->Port = SMTP_PORT;
        $this->mailer->Username = SMTP_USER;
        $this->mailer->Password = SMTP_PASSWORD;
        $this->mailer->SMTPSecure = 'ssl';
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
        if (!isset($_SESSION['ingelogt']) or $_SESSION['ingelogt'] === false) {
            $this->error = true;
            $this->errors[] = '<span class="melding">U heeft niet genoeg rechten om uw wachtwoord te wijzigen.</span>';
        }
    }

    public function validateAddAuthorization() {
        if ($_SESSION['user_level'] <= 3 or ! isset($_SESSION['ingelogt']) or $_SESSION['ingelogt'] === false) {
            $this->error = true;
            $this->errors[] = '<span class="melding">U heeft niet genoeg rechten om een gebruiker toe te voegen.</span>';
        }
    }

    public function validateBanAuthorization() {
        if ($_SESSION['user_level'] <= 3 or ! isset($_SESSION['ingelogt']) or $_SESSION['ingelogt'] === false) {
            $this->error = true;
            $this->errors[] = '<span class="melding">U heeft niet genoeg rechten om een gebruiker te (un)bannen.</span>';
        }
    }

    private function activateUser($time, $hash) {
        if (time() - $time < 172800) {
            $bytes = openssl_random_pseudo_bytes(4);
            $password = bin2hex($bytes);
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE login SET password='".$password_hash."', active=1, activatie_hash='' WHERE activatie_hash='".$hash."' LIMIT 1;";
        }
    }

}
