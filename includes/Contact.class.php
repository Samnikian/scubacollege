<?php

class Contact {

    protected $naam = '';
    protected $voornaam = '';
    protected $email = '';
    protected $gsm = '';
    protected $onderwerp = '';
    protected $bericht = '';
    protected $ip = '';
    protected $query = '';
    protected $query_result = '';
    protected $error = false;
    protected $errormsg = '';
    protected $output = '';

    public function __construct() {
        $REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if ($REQUEST !== NULL and $REQUEST === 'POST') {
            $this->importPostData();
            $this->checkErrors();
            if ($this->error) {
                $this->exportSessionData();
                header('Location: ' . FILE_CONTACT_FORM);
            } else {
                $this->sendMail();
            }
        } elseif ($REQUEST !== NULL and $REQUEST !== 'POST') {
            if (isset($_SESSION['contact'])) {
                $this->importSessionData();
            }
            $this->getContactForm();
        }
    }

    public function getOutput() {
        return $this->output;
    }

    private function getContactForm() {
        $this->output = '';
        if ($this->error) {
            $this->output.= '<fieldset class="errorr"><legend>Gelieve de volgende fouten te corrigeren</legend>';
            $this->output.= $this->errormsg;
            $this->output.= '</fieldset>';
        }
        $this->output.= '<fieldset>';
        $this->output.='<legend>Stuur ons een bericht</legend>';
        $this->output.='<form action="' . FILE_CONTACT_FORM . '" method="POST">';
        $this->output.='<label for = "naam">Naam</label><input type = "text" name = "naam" id = "naam" value = "' . $this->naam . '" /><br />';
        $this->output.='<label for="voornaam">Voornaam</label><input type="text" name="voornaam" id="voornaam" value="' . $this->voornaam . '" /><br />';
        $this->output.='<label for = "gsm">GSM/Telefoon</label><input type = "text" name = "gsm" id = "gsm" value = "' . $this->gsm . '" /><br />';
        $this->output.='<label for="email">Email adres</label><input type="text" name="email" id="email" value="' . $this->email . '" /><br />';
        $this->output.='<label for = "onderwerp">Onderwerp</label><input type = "text" name = "onderwerp" id = "onderwerp" value = "' . $this->onderwerp . '" /><br />';
        $this->output.='<p class="bericht"><label for = "bericht">Bericht</label><br />';
        $this->output.='<textarea name="bericht" id="bericht" />' . $this->bericht . '</textarea>';
        $this->output.='</p><br />';
        $this->output.='<div id = "recaptcha" class = "g-recaptcha" data-sitekey="' . CAPTCHA_SITEKEY . '"></div><br />';
        $this->output.='<input type="submit" value="Verzenden" />';
        $this->output.='</form></fieldset>';
    }

    private function checkErrors() {
        $this->error = false;
        $this->errormsg = '<ul>';
        if ($this->query_result["success"] === false) {
            $this->error = true;
            $this->errormsg.= '<li>Je moet bewijzen dat je geen robot bent.</li>';
        }
        if ($this->naam !== NULL and strlen($this->naam) < 3) {
            $this->error = true;
            $this->errormsg.= '<li>Je naam moet minstens 3 tekens bevatten.</li>';
        }
        if ($this->voornaam !== NULL and strlen($this->voornaam) < 2) {
            $this->error = true;
            $this->errormsg.= '<li>Je voornaam moet minstens 2 tekens bevatten.</li>';
        }
        if ($this->gsm !== NULL and strlen($this->gsm) < 9) {
            $this->error = true;
            $this->errormsg.= '<li>Je gsm/telefoonnummer is niet geldig.</li>';
        }
        if ($this->email !== NULL and ! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error = true;
            $this->errormsg.= '<li>Gelieve een geldig email adres op te geven.</li>';
        }
        if ($this->onderwerp !== NULL and strlen($this->onderwerp) < 4) {
            $this->error = true;
            $this->errormsg.= '<li>Je onderwerp moet minstens 4 tekens bevatten.</li>';
        }
        if ($this->bericht !== NULL and strlen($this->bericht) < 10) {
            $this->error = true;
            $this->errormsg.= '<li>Je bericht moet minstens 10 tekens bevatten.</li>';
        }
        $this->errormsg.='</ul>';
    }

    private function importPostData() {
        $this->naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
        $this->voornaam = filter_input(INPUT_POST, 'voornaam', FILTER_SANITIZE_STRING);
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $this->gsm = filter_input(INPUT_POST, 'gsm', FILTER_SANITIZE_STRING);
        $this->onderwerp = filter_input(INPUT_POST, 'onderwerp', FILTER_SANITIZE_STRING);
        $this->bericht = filter_input(INPUT_POST, 'bericht', FILTER_SANITIZE_STRING);
        $this->response = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        $this->ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);

        $this->query = 'https://www.google.com/recaptcha/api/siteverify?secret=' . CAPTCHA_SECRET . '&response=' . $this->response . '&remoteip=' . $this->ip;
        $this->query_result = json_decode(file_get_contents($this->query), true);
    }

    private function importSessionData() {
        $data = unserialize(urldecode($_SESSION['contact']));
        $this->naam = $data['naam'];
        $this->voornaam = $data['voornaam'];
        $this->email = $data['email'];
        $this->gsm = $data['gsm'];
        $this->onderwerp = $data['onderwerp'];
        $this->bericht = $data['bericht'];
        $this->error = $data['error'];
        $this->errormsg = $data['errormsg'];
        $this->query_result = $data['query_result'];
    }

    private function exportSessionData() {
        $data['naam'] = $this->naam;
        $data['voornaam'] = $this->voornaam;
        $data['email'] = $this->email;
        $data['gsm'] = $this->gsm;
        $data['onderwerp'] = $this->onderwerp;
        $data['bericht'] = $this->bericht;
        $data['error'] = $this->error;
        $data['errormsg'] = $this->errormsg;
        $data['query_result'] = $this->query_result;
        $_SESSION['contact'] = urlencode(serialize($data));
    }

    private function sendMail() {
        $this->configureMailer();
        $bodytemplate = file_get_contents(FILE_CONTACT_TEMPLATE);
        $placeholders = array('REPLACEACHTERNAAM', 'REPLACEVOORNAAM', 'REPLACEGSM', 'REPLACEEMAIL', 'REPLACEONDERWERP', 'REPLACEBERICHT');
        $replacevalues = array($this->naam, $this->voornaam, $this->gsm, $this->email, $this->onderwerp, nl2br($this->bericht));
        $body = str_replace($placeholders, $replacevalues, $bodytemplate);
        $this->mailer->SetFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        $this->mailer->AddReplyTo($this->email, $this->naam . " " . $this->voornaam);
        $this->mailer->AddAddress(CONTACT_MAIL, MAIL_FROM_NAME);
        $this->mailer->Subject = MAIL_CONTACT_SUBJECT;
        $this->mailer->AltBody = MAIL_ALTBODY;
        $this->mailer->MsgHTML($body);
        $this->mailer->AddEmbeddedImage('images/mailheader.jpg', 'mailheader', 'mailheader.jpg', 'base64', 'image/jpeg');
        if (!$this->mailer->Send()) {
            $this->output = "<p class=\"melding\">Mailer Error: " . $this->mailer->ErrorInfo . "</p>";
        } else {
            $this->output = "<p class=\"melding\">Uw bericht is succesvol verzonden!</p>";
            unset($_SESSION['contact']);
        }
    }

    protected function configureMailer() {
        require_once('includes/PHPMailer.class.php');
        require_once('includes/SMTP.class.php');
        $this->mailer = new PHPMailer();
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

}

?>