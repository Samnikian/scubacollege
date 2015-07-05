<?php
namespace DiveEvent;
class Manager {

    protected $id, $begin, $einde, $omschrijving, $titel, $locatie, $fblink, $minniveau, $heledag, $errormsg;
    protected $error = false;
    protected $login;
    protected $db;
    protected $objOpleidingen;

    public function __construct(&$dbref) {
        $this->db = $dbref;
        $this->login = isIngelogd();
        $this->objOpleidingen = new Opleidingen\Manager($dbref);
    }

    protected function getFailMessage() {
        header('refresh: 5; url=event.php');
        echo '<p class="melding"><a href="event.php">U word binnen 5 seconden terug doorverwezen naar het formulier, klik hier indien dit niet gebeurd.</a></p>';
    }

    protected function getSuccessMessage() {
        header('refresh: 5; url=kalender.php');
        echo '<p class="melding"><a href="kalender.php">De informatie werd met succes aangepast! <br />U word binnen 5 seconden doorverwezen naar de kalender, klik hier indien dit niet gebeurd.</a></p>';
        unset($_SESSION['action']);
    }

    protected function clearVars() {
        $this->id = '';
        $this->begin = '';
        $this->einde = '';
        $this->titel = '';
        $this->omschrijving = '';
        $this->locatie = '';
        $this->fblink = '';
        $this->minniveau = '';
    }

    protected function validateInput() {
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

    protected function datumNaarTimeStamp($datum) {
        $arr_datum = explode('-', $datum);
        if (count($arr_datum) == 3) {
            $timestamp = mktime(0, 0, 0, $arr_datum[1], $arr_datum[0], $arr_datum[2]);
            return $timestamp;
        } else {
            return false;
        }
    }
    protected function timestampNaarDatum($timestamp){
        $mask = 'd-m-Y';
        $output = date($mask,$timestamp);
        return $output;
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
