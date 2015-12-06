<?php

class Initiatie extends Contact {

    private $postcode = '';
    private $gemeente = '';
    private $geboortedatum = '';
    private $adres = '';
    private $voorkeur = '';

    public function __construct() {
        $REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if ($REQUEST !== NULL and $REQUEST === 'POST') {
            $this->importPostData();
            $this->checkErrors();
            if ($this->error) {
                $this->exportSessionData();
                header('Location: ' . FILE_INITIATIE_FORM . '#formulier');
            } else {
                $this->sendMail();
            }
        } elseif ($REQUEST !== NULL and $REQUEST !== 'POST') {
            if (isset($_SESSION['initiatie'])) {
                $this->importSessionData();
            }
            $this->getForm();
        }
    }

    private function getForm() {
        $this->output = '';
        $this->AddErrors();
        $this->output.= '<fieldset>';
        $this->output.='<legend><a name="formulier">Stuur ons een bericht</a></legend>';
        $this->output.='<form action="' . FILE_INITIATIE_FORM . '" method="POST">';
        $this->output.='<label for = "naam">Naam</label><input type = "text" name = "naam" id = "naam" value = "' . $this->naam . '" required /><br />';
        $this->output.='<label for="voornaam">Voornaam</label><input type="text" name="voornaam" id="voornaam" value="' . $this->voornaam . '" required /><br />';
        $this->output.='<label for="geboortedatum">Geboortedatum (dd/mm/jjjj)</label><input type="text" name="geboortedatum" id="geboortedatum" pattern="\d{1,2}/\d{1,2}/\d{4}" value="' . $this->geboortedatum . '" required /><br />';
        $this->output.='<label for="adres">Adres</label><input type="text" name="adres" id="adres" value="' . $this->adres . '" required /><br />';
        $this->output.='<label for="postcode">Postcode</label><input type="text" name="postcode" id="postcode" value="' . $this->postcode . '" required /><br />';
        $this->output.='<label for="gemeente">Gemeente</label><input type="text" name="gemeente" id="gemeente" value="' . $this->gemeente . '" required /><br />';
        $this->output.='<label for = "gsm">GSM/Telefoon</label><input type = "text" name = "gsm" id = "gsm" value = "' . $this->gsm . '" required /><br />';
        $this->output.='<label for="email">Email adres</label><input type="email" name="email" id="email" value="' . $this->email . '" required /><br />';
        $this->AddVoorkeurInput();
        $this->output.='</select><p class="bericht"><label for = "bericht">Opmerking (Optioneel)</label><br /><textarea name="bericht" id="bericht" />' . $this->bericht . '</textarea></p><br />';
        $this->output.='<div id = "recaptcha" class = "g-recaptcha" data-sitekey="' . CAPTCHA_SITEKEY . '"></div><br />';
        $this->output.='<input type="submit" value="Verzenden" />';
        $this->output.='</form></fieldset>';
    }

    private function checkErrors() {
        $this->error = false;
        $this->errormsg = '<ul>';
        $this->CheckCaptcha();
        $this->CheckNames();
        $this->CheckAddress();
        $this->CheckGSM();
        $this->CheckDOB();
        $this->CheckEmail();
        $this->errormsg.='</ul>';
    }

    private function importPostData() {
        $this->naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
        $this->voornaam = filter_input(INPUT_POST, 'voornaam', FILTER_SANITIZE_STRING);
        $this->geboortedatum = filter_input(INPUT_POST, 'geboortedatum', FILTER_SANITIZE_STRING);
        $this->adres = filter_input(INPUT_POST, 'adres', FILTER_SANITIZE_STRING);
        $this->postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
        $this->gemeente = filter_input(INPUT_POST, 'gemeente', FILTER_SANITIZE_STRING);
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $this->gsm = filter_input(INPUT_POST, 'gsm', FILTER_SANITIZE_STRING);
        $this->voorkeur = filter_input(INPUT_POST, 'voorkeur', FILTER_SANITIZE_STRING);
        $this->bericht = filter_input(INPUT_POST, 'bericht', FILTER_SANITIZE_STRING);
        $this->response = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
        $this->ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);

        $this->query = 'https://www.google.com/recaptcha/api/siteverify?secret=' . CAPTCHA_SECRET . '&response=' . $this->response . '&remoteip=' . $this->ip;
        $this->query_result = json_decode(file_get_contents($this->query), true);
    }

    private function importSessionData() {
        $data = unserialize(urldecode($_SESSION['initiatie']));
        $this->naam = $data['naam'];
        $this->voornaam = $data['voornaam'];
        $this->geboortedatum = $data['geboortedatum'];
        $this->adres = $data['adres'];
        $this->postcode = $data['postcode'];
        $this->gemeente = $data['gemeente'];
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
        $data['geboortedatum'] = $this->geboortedatum;
        $data['adres'] = $this->adres;
        $data['postcode'] = $this->postcode;
        $data['gemeente'] = $this->gemeente;
        $data['email'] = $this->email;
        $data['gsm'] = $this->gsm;
        $data['onderwerp'] = $this->onderwerp;
        $data['bericht'] = $this->bericht;
        $data['error'] = $this->error;
        $data['errormsg'] = $this->errormsg;
        $data['query_result'] = $this->query_result;
        $_SESSION['initiatie'] = urlencode(serialize($data));
    }

    private function sendMail() {
        $this->configureMailer();
        $bodytemplate = file_get_contents(FILE_INITIATIE_TEMPLATE);
        $placeholders = array('REPLACEACHTERNAAM', 'REPLACEVOORNAAM', 'REPLACEGEBOORTEDATUM', 'REPLACEADRES', 'REPLACEPOSTCODE', 'REPLACEGEMEENTE', 'REPLACEGSM', 'REPLACEEMAIL', 'REPLACEONDERWERP', 'REPLACEBERICHT', 'REPLACEVOORKEUR');
        $replacevalues = array($this->naam, $this->voornaam, $this->geboortedatum, $this->adres, $this->postcode, $this->gemeente, $this->gsm, $this->email, $this->onderwerp, nl2br($this->bericht), $this->voorkeurNaarText());
        $body = str_replace($placeholders, $replacevalues, $bodytemplate);
        $this->mailer->SetFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        $this->mailer->AddReplyTo($this->email, $this->naam . " " . $this->voornaam);
        $this->mailer->AddAddress(INITIATIE_MAIL, MAIL_FROM_NAME);
        $this->mailer->Subject = MAIL_INITIATIE_SUBJECT;
        $this->mailer->AltBody = MAIL_ALTBODY;
        $this->mailer->MsgHTML($body);
        $this->mailer->AddEmbeddedImage('images/mailheader.jpg', 'mailheader', 'mailheader.jpg', 'base64', 'image/jpeg');
        if (!$this->mailer->Send()) {
            $this->output = "<p class=\"melding\">Mailer Error: " . $this->mailer->ErrorInfo . "</p>";
        } else {
            $this->output = "<p class=\"melding\">Uw bericht is succesvol verzonden!</p>";
            $this->output.= '<script type="text/javascript">window.scrollBy(0,100);</script>';
            unset($_SESSION['initiatie']);
        }
    }

    private function voorkeurNaarText() {
        switch ($this->voorkeur) {
            case 'zat1':
                return 'Zaterdag van 13u45 tot 15u30';
            case 'zat2':
                return 'Zaterdag van 15u15 tot 17u00';
            case 'vrij1':
                return 'Vrijdag van 20u30 tot 22u00';
            default:
                return 'Zaterdag van 13u45 tot 15u30';
        }
    }

    private function AddVoorkeurInput() {
        $this->output.='<label for="voorkeur">Voorkeur tijdsstip</label><select name="voorkeur" id="voorkeur">';
        switch ($this->voorkeur) {
            case 'zat1':
                $this->output.='<option value="zat1" selected>Zaterdag van 13u45 tot 15u30</option><option value="zat2">Zaterdag van 15u15 tot 17u00</option><option value="vrij1">Vrijdag van 20u30 tot 22u00</option></select><br />';
                break;
            case 'zat2':
                $this->output.='<option value="zat1">Zaterdag van 13u45 tot 15u30</option><option value="zat2" selected>Zaterdag van 15u15 tot 17u00</option><option value="vrij1">Vrijdag van 20u30 tot 22u00</option></select><br />';
                break;
            case 'vrij1':
                $this->output.='<option value="zat1">Zaterdag van 13u45 tot 15u30</option><option value="zat2">Zaterdag van 15u15 tot 17u00</option><option value="vrij1" selected>Vrijdag van 20u30 tot 22u00</option></select><br />';
                break;
            default:
                $this->output.='<option value="zat1" selected>Zaterdag van 13u45 tot 15u30</option><option value="zat2">Zaterdag van 15u15 tot 17u00</option><option value="vrij1">Vrijdag van 20u30 tot 22u00</option></select><br />';
                break;
        }
    }

    private function CheckAddress() {
        if ($this->adres !== NULL and strlen($this->adres) < 3) {
            $this->error = true;
            $this->errormsg.= '<li>Je adres moet minstens 3 tekens bevatten.</li>';
        }
        if ($this->postcode !== NULL and strlen($this->postcode) < 3) {
            $this->error = true;
            $this->errormsg.= '<li>Je postcode moet minstens 3 tekens bevatten.</li>';
        }
        if ($this->gemeente !== NULL and strlen($this->gemeente) < 3) {
            $this->error = true;
            $this->errormsg.= '<li>Je gemeente moet minstens 3 tekens bevatten.</li>';
        }
    }

    private function CheckDOB() {
        if ($this->geboortedatum !== NULL and strlen($this->geboortedatum) < 3) {
            $this->error = true;
            $this->errormsg.= '<li>Je geboortedatum moet geldig zijn.</li>';
        }
    }

}
