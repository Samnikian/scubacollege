<?php

namespace DiveEvent;

class Event extends \Event {

    private $minniveau, $minniveau_naam;

    public function __construct($id, $begin, $einde, $omschrijving, $titel, $locatie, $fblink, $minniveau, $minniveau_naam, $heledag = false) {
        $this->minniveau = $minniveau;
        $this->minniveau_naam = $minniveau_naam;
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
        $parser = new \JBBCode\Parser();
        $parser->addCodeDefinitionSet(new \JBBCode\DefaultCodeDefinitionSet());
        $parser->parse($this->omschrijving);
        $output.= '<td class="eventOmschijving"><span class="eventTitel">' . $this->titel . '</span><br />' .$parser->getAsHtml(). '</td>';
        $output.= '<td class="eventLocatie">' . $this->locatie . '</td>';
        $output.= '<td class="eventMinNiveau">' . $this->minniveau_naam . '</td>';
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
