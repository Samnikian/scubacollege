<?php

class DiveEvent extends Event {

    private $minniveau;

    public function __construct($id, $begin, $einde, $omschrijving, $titel, $locatie, $fblink, $minniveau, $heledag = false) {
        $this->minniveau = $minniveau;
        parent::__construct($id, $begin, $einde, $omschrijving, $titel, $locatie, $fblink, $heledag);
    }

    public function getTrHTML($login = false) {
        $output = '<tr>';
        $output.= $this->getAdminButton($login);
        if ($this->begin === $this->einde) {
            $output.= '<td class="eventWanneer">' . $this->formatTime($this->begin) . '</td>';
        } else {
            $output.= '<td class="eventWanneer">Van ' . $this->formatTime($this->begin) . ' tot ' . $this->formatTime($this->einde) . '';
        }
        $output.= '<td class="eventOmschijving"><span class="eventTitel">' . $this->titel . '</span><br />' . $this->omschrijving . '</td>';
        $output.= '<td class="eventLocatie">' . $this->locatie . '</td>';
        $output.= '<td class="eventMinNiveau">' . $this->minniveau . '</td>';
        $output.= '<td class="eventAddToCalendar">' . parent::createAddToCalendarCode() . '</td>';
        $output.= '</tr>';

        return $output;
    }
    private function getAdminButton($login) {
        $html = '<td><a href="event.php?action=edit&id=' . $this->id . '"><img class="adminButton" src="images/bewerken.png" alt="Bewerken" title="Bewerken" />';
        $html.= '</a><a href="event.php?action=delete&id=' . $this->id . '"><img class="adminButton" src="images/verwijderen.png" alt="Verwijderen" title="Verwijderen" /></a></td>';
        if ($login) {
            switch ($_SESSION['user_level']) {
                case ADMIN:
                    return $html;
                case STAFF:
                    return $html;
                default:
                    return '';
            }
        }
    }

}
