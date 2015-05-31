<?php

class DiveEventManager {

    private $DiveEvents = array();
    private $db;
    private $maanden = ['jan' => array(), 'feb' => array(), 'maa' => array(), 'apr' => array(), 'jun' => array(), 'jul' => array(), 'aug' => array(), 'sep' => array(), 'okt' => array(), 'nov' => array(), 'dec' => array()];

    public function __construct(&$dbref) {
        $this->db = $dbref;
        $this->loadEvents();
    }

    private function loadEvents() {
        $query = 'SELECT * FROM `kalender` ORDER BY `begin`;';
        try {
            $result = $this->db->query($query);
            while ($row = $result->fetch_assoc()) {
                $tmpobj = new DiveEvent($row['id'], $row['begin'], $row['einde'], $row['omschrijving'], $row['titel'], $row['locatie'], $row['fblink'], $row['minniveau'], $row['heledag']);
                $this->DiveEvents[] = $tmpobj;
            }
            $result->close();
        } catch (Exception $error) {
            echo 'Er heeft zich een probleem voorgedaan, gelieve de webmaster te contacteren. Details: ' . $error->getMessage();
        }
    }

    public function getSimpleHTMLTable() {
        $output = '<table id="eventTable">';
        $output.= '<tr id="eventHeader"><td>Wanneer</td><td>Omschrijving - Informatie</td><td>Locatie</td><td>Min Niveau</td></tr>';
        foreach ($this->DiveEvents as $evnt) {
            $output.= $evnt->getTrHTML(false);
        }
        $output.='</table>';
        return $output;
    }

    public function getHTMLTable() {
        $output = '';
        $this->sorteerOpMaand();
        foreach ($this->maanden as $key => $arrMaand) {
            if (count($arrMaand) > 0) {
                $output.= '<table id="eventTable">';
                $output.= "<tr><td colspan=\"5\" class=\"maandHeader\"><h1>".$this->getMonthName($key)."</h1></td></tr>";
                $output.= '<tr id="eventHeader"><td>Wanneer</td><td>Omschrijving - Informatie</td><td>Locatie</td><td colspan="2">Min Niveau</td></tr>';
                $output.= $this->getHTMLMaand($arrMaand);
                $output.='</table>';
            }
        }
        return $output;
    }

    public function printEvents() {
        echo '<pre>';
        print_r($this->DiveEvents);
        echo '</pre>';
    }

    private function sorteerOpMaand() {
        foreach ($this->DiveEvents as $DiveEvnt) {
            $m = date('m', $DiveEvnt->getBegin());
            switch ($m) {
                case '01':
                    $this->maanden['jan'][] = $DiveEvnt;
                break;
                case '02':
                    $this->maanden['feb'][] = $DiveEvnt;
                break;
                case '03':
                    $this->maanden['maa'][] = $DiveEvnt;
                break;
                case '04':
                    $this->maanden['apr'][] = $DiveEvnt;
                break;
                case '05':
                    $this->maanden['mei'][] = $DiveEvnt;
                break;
                case '06':
                    $this->maanden['jun'][] = $DiveEvnt;
                break;
                case '07':
                    $this->maanden['jul'][] = $DiveEvnt;
                break;
                case '08':
                    $this->maanden['aug'][] = $DiveEvnt;
                break;
                case '09':
                    $this->maanden['sep'][] = $DiveEvnt;
                break;
                case '10':
                    $this->maanden['okt'][] = $DiveEvnt;
                break;
                case '11':
                    $this->maanden['nov'][] = $DiveEvnt;
                break;
                case '12':
                    $this->maanden['dec'][] = $DiveEvnt;
                break;
            }
        }
    }

    private function getHTMLMaand($arrMaand) {
        $output = '';
        foreach ($arrMaand as $evnt) {
            $output.= $evnt->getTrHTML();
        }
        return $output;
    }

    private function getMonthName($key) {
            switch ($key) {
                case 'jan':
                    return 'Januari';
                case 'feb':
                    return 'Februari';
                case 'maa':
                    return 'Maart';
                case 'apr':
                    return 'April';
                case 'mei':
                    return 'Mei';
                case 'jun':
                    return 'Juni';
                case 'jul':
                    return 'Juli';
                case 'aug':
                    return 'Augustus';
                case 'sep':
                    return 'September';
                case 'okt':
                    return 'Oktober';
                case 'nov':
                    return 'November';
                case 'dec':
                    return 'December';
            }
    }

}
