<?php

class DiveEventManager {

    private $id, $begin, $einde, $omschrijving, $titel, $locatie, $fblink, $minniveau, $heledag, $errormsg;
    private $error = false;
    private $login;
    private $db;
    private $objOpleidingen;

    public function __construct(&$dbref) {
        $this->db = $dbref;
        $this->login = isIngelogd();
        $this->objOpleidingen = new Opleidingen($dbref);
    }

    public function deleteEventForm() {
        if(filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING)==='delete_confirmed'){
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            return $this->deleteEvent($id);
        }
        else{
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            return $this->getDeleteForm($id);
        }
    }
    private function getDeleteForm($id){
        $output = '<fieldset id="DiveEventForm"><legend>Kalender item verwijderen</legend><form action="event.php" method="POST">';
        $output.= '<input type="hidden" name="id" value="'.$id.'" />';
        $output.= '<input type="hidden" name="action" value="delete_confirmed" />';
        $output.= '<p>Bent u zeker dat u het evenement wil verwijderen?</p>';
        $output.= '<input type="submit" value="Bevestigen!" />';
        $output.= '</form></fieldset>';
        return $output;
    }
    private function deleteEvent($id) {
        try {
            $output = '';
            $query = 'DELETE FROM kalender WHERE id=' . $id . ';';
            $result = $this->db->query($query);
            if ($result) {
                $output.= $this->getSuccessMessage();
            } else {
                $output.= 'Er is een fout opgetreden, gelieve contact op te nemen met de webmaster. Hou volgende melding bij de hand: ';
                $output.= $this->db->error;
            }
        } catch (Exception $ex) {
            $output.= 'Er is een fout opgetreden, gelieve contact op te nemen met de webmaster. Hou volgende melding bij de hand: ';
            $output.= $ex->getMessage();
        } finally {
            return $output;
        }
    }

    public function addEventForm() {
        $req = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if ($req == 'POST') {
            $this->getAddDataFromPost();
            $this->validateInput();
            if ($this->error === true) {
                $output = '';
                $output.= $this->errormsg;
                $output.=$this->getHTMLform();
                return $output;
            } else {
                return $this->nieuwEventOpslaan();
            }
        } else {
            $this->getAddDataFromSession();
            $this->validateInput();
            return $this->getHTMLform();
        }
    }

    private function nieuwEventOpslaan() {
        $query = "INSERT INTO `kalender` (`begin`,`einde`,`omschrijving`,`titel`,`locatie`,`fblink`,`heledag`,`minniveau`,`minniveau_naam`)";
        $query.= "VALUES ('" . $this->datumNaarTimeStamp($this->begin) . "','" . $this->datumNaarTimeStamp($this->einde) . "','" . $this->omschrijving . "','" . $this->titel . "','" . $this->locatie . "','" . $this->fblink . "','" . $this->heledag . "','" . $this->minniveau . "','".$this->objOpleidingen->idNaarNaam($this->minniveau)."');";
        $result = $this->db->query($query);
        if (!$result) {
            return $this->getFailMessage();
        } else {
            return $this->getSuccessMessage();
        }
    }

    private function getFailMessage() {
        header('refresh: 5; url=event.php');
        echo '<p class="melding"><a href="event.php">U word binnen 5 seconden terug doorverwezen naar het formulier, klik hier indien dit niet gebeurd.</a></p>';
    }

    private function getSuccessMessage() {
        header('refresh: 5; url=kalender.php');
        echo '<p class="melding"><a href="kalender.php">De informatie werd met succes aangepast! <br />U word binnen 5 seconden doorverwezen naar de kalender, klik hier indien dit niet gebeurd.</a></p>';
        unset($_SESSION['action']);
    }

    private function getAddDataFromPost() {
        $this->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $this->begin = filter_input(INPUT_POST, 'begin', FILTER_SANITIZE_STRING);
        $this->einde = filter_input(INPUT_POST, 'einde', FILTER_SANITIZE_EMAIL);
        $this->titel = filter_input(INPUT_POST, 'titel', FILTER_SANITIZE_STRING);
        $this->omschrijving = filter_input(INPUT_POST, 'omschrijving', FILTER_SANITIZE_STRING);
        $this->locatie = filter_input(INPUT_POST, 'locatie', FILTER_SANITIZE_STRING);
        $this->fblink = filter_input(INPUT_POST, 'fblink', FILTER_SANITIZE_STRING);
        $this->minniveau = filter_input(INPUT_POST, 'minniveau', FILTER_SANITIZE_STRING);
        $this->response = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
    }

    private function getAddDataFromSession() {
        if (isset($_SESSION['addEvent'])) {
            $des = unserialize($_SESSION['addEvent']);
            $this->id = $des['id'];
            $this->begin = $des['begin'];
            $this->einde = $des['einde'];
            $this->titel = $des['titel'];
            $this->omschrijving = $des['omschrijving'];
            $this->locatie = $des['locatie'];
            $this->fblink = $des['fblink'];
            $this->minniveau = $des['minniveau'];
            unset($_SESSION['addEvent']);
        } else {
            $this->clearVars();
        }
    }

    public function getHTMLform() {
        $output = '<fieldset id="DiveEventForm"><legend>Kalender item toevoegen</legend><form action="event.php" method="POST">';
        $output.= '<input type="hidden" value="' . $this->id . '" name="id" />';
        $output.='<label for="begin">Begin</label><input type="text" id="begin" name="begin" value="' . $this->begin . '" required placeholder="16-07-2015" /><br />';
        $output.='<label for="einde">Einde</label><input type="text" id="einde" name="einde" value="' . $this->einde . '" required placeholder="17-07-2015" /><br />';
        $output.='<label for="titel">Titel</label><input type="text" id="titel" name="titel" value="' . $this->titel . '" required placeholder="Hier komt de Titel" /><br />';
        $output.='<textarea id="omschrijving" name="omschrijving">' . $this->omschrijving . '</textarea><br />';
        $output.='<label for="locatie">Locatie</label><input type="text" id="locatie" name="locatie" value="' . $this->locatie . '" required/><br />';
        $output.='<label for="fblink">Facebook link</label><input type="text" id="fblink" name="fblink" value="' . $this->fblink . '" placeholder="https://www.facebook.com/events/1448283488824627/" /><br />';
        $output.='<label for="minniveau">Minimum Niveau</label>';
        $output.= $this->objOpleidingen->getOpleidingSelector();
        $output.= '<div id = "recaptcha" class = "g-recaptcha" data-sitekey="' . CAPTCHA_SITEKEY . '"></div>';
        $output.='<input type="submit" id="submit" value="Opslaan!" />';
        $output.= '</form></fieldset>';
        return $output;
    }

    private function clearVars() {
        $this->id = '';
        $this->begin = '';
        $this->einde = '';
        $this->titel = '';
        $this->omschrijving = '';
        $this->locatie = '';
        $this->fblink = '';
        $this->minniveau = '';
    }

    private function validateInput() {
        $this->error = false;
        $this->errormsg = '<ul>';
        $this->checkDatums();
        $this->CheckBegin();
        $this->CheckEinde();
        $this->CheckTitle();
        $this->CheckDescription();
        $this->CheckLocation();
        $this->CheckFblink();
        $this->CheckMinNiv();
        $this->errormsg.= '</ul>';
    }

    private function CheckMinNiv() {
        if ($this->minniveau != '0') {
            if (!is_numeric($this->minniveau)) {
                $this->error = true;
                $this->errormsg.= '<li>Je moet een minimum niveau selecteren.</li>';
            }
        }
    }

    private function datumNaarTimeStamp($datum) {
        $arr_datum = explode('-', $datum);
        if (count($arr_datum) == 3) {
            $timestamp = mktime(0, 0, 0, $arr_datum[1], $arr_datum[0], $arr_datum[2]);
            return $timestamp;
        } else {
            return false;
        }
    }

    private function checkDatums() {
        $begin = $this->datumNaarTimeStamp($this->begin);
        $einde = $this->datumNaarTimeStamp($this->einde);
        //var_dump($begin,$einde);
        if (is_numeric($begin) and is_numeric($einde)) {
            $verschil = $einde - $begin;
            if ($verschil < 0) {
                $this->error = true;
                $this->errormsg.= '<li>Je einddatum moet later dan of gelijk aan je begindatum zijn.</li>';
            }
        } else {
            $this->error = true;
            $this->errormsg.= '<li>Je moet een geldige datum ingeven.</li>';
        }
    }

    private function CheckBegin() {
        $arr = explode('-', $this->begin);
        if (count($arr) == 3) {
            if (!checkdate($arr[1], $arr[0], $arr[2])) {
                $this->error = true;
                $this->errormsg.= '<li>Je moet een geldige datum ingeven.</li>';
            }
        } else {
            $this->error = true;
            $this->errormsg.= '<li>Je moet een geldige datum ingeven.</li>';
        }
    }

    private function CheckEinde() {
        $arr = explode('-', $this->einde);
        if (count($arr) == 3) {
            if (!checkdate($arr[1], $arr[0], $arr[2])) {
                $this->error = true;
                $this->errormsg.= '<li>Je moet een geldige datum ingeven.</li>';
            }
        } else {
            $this->error = true;
            $this->errormsg.= '<li>Je moet een geldige datum ingeven.</li>';
        }
    }

    private function CheckTitle() {
        if ($this->titel !== NULL and strlen($this->titel) < 4) {
            $this->error = true;
            $this->errormsg.= '<li>Je titel moet minstens 4 tekens bevatten.</li>';
        }
    }

    private function CheckFblink() {
        if ($this->fblink != '') {
            $valid = filter_var($this->fblink, FILTER_VALIDATE_URL);
            if (!$valid) {
                $this->error = true;
                $this->errormsg.= '<li>Je moet een geldige facebook link ingeven of het veld openlaten.</li>';
            }
        }
    }

    private function CheckLocation() {
        if ($this->locatie !== NULL and strlen($this->locatie) < 4) {
            $this->error = true;
            $this->errormsg.= '<li>Je locatie moet minstens 4 tekens bevatten.</li>';
        }
    }

    private function CheckDescription() {
        if ($this->omschrijving !== NULL and strlen($this->omschrijving) < 10) {
            $this->error = true;
            $this->errormsg.= '<li>Je omschrijving moet minstens 10 tekens bevatten.</li>';
        }
    }

}
