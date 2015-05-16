<?php

class Event {

    private $id;
    private $begin;
    private $einde;
    private $omschrijving;
    private $titel;
    private $locatie;
    private $fblink;
    private $heledag;

    public function __construct($id,$begin,$einde,$omschrijving,$titel,$locatie,$fblink,$heledag = false) {
        $this->id;
        $this->begin;
        $this->$einde;
        $this->$omschrijving;
        $this->$titel;
        $this->$locatie;
        $this->$fblink;
        $this->$heledag;
    }

    public function getTrHTML($addTableTags = true) {
        if (DEBUG) {
            echo '<span class="debug">Function call: Event::getTrHTML</span>';
        }
        if ($addTableTags) {
            $output = '<table><tr>';
        } else {
            $output = '<tr>';
        }
        if ($this->begin === $this->einde) {
            $output.= '<td>' . $this->begin . '</td>';
        } else {
            $output.= '<td>Van ' . $this->begin . ' tot ' . $this->einde . '';
        }
        $output.= '<td><p>' . $this->titel . '</p>' . $this->omschrijving . '</td>';
        $output.= '<td>' . $this->locatie . '</td>';
        $output.= '<td>' . $this->createAddToCalendarCode() . '</td>';
        if ($addTableTags) {
            $output.= '</tr>';
        } else {
            $output.= '</tr></table>';
        }
        return $output;
    }

    private function createAddToCalendarCode() {
        if (DEBUG) {
            echo '<span class="debug">Function call: Event::createAddToCalendar</span>';
        }
        $output = "<a href=\"".EVENT_CALENDAR_URL.$this->id . "\" title=\"Toevoegen aan je agenda\" class=\"addthisevent\">";
        $output.= "Toevoegen aan je agenda!";
        $output.= "<span class=\"_start\">" . $this->begin . "</span>";
        $output.= "<span class=\"_end\">" . $this->einde . "</span>";
        $output.= "<span class=\"_zonecode\">" . EVENT_TIMEZONE . "</span>";
        $output.= "<span class=\"_summary\">" . $this->omschrijving . "</span>";
        $output.= "<span class=\"_description\">" . $this->titel . "</span>";
        $output.= "<span class=\"_location\">" . $this->locatie . "</span>";
        $output.= "<span class=\"_organizer\">" . EVENT_ORGANISATOR . "</span>";
        $output.= "<span class=\"_organizer_email\">" . EVENT_ORGANISATOR_EMAIL . "</span>";
        $output.= "<span class=\"_facebook_event\">" . $this->fblink . "</span>"; //http://www.facebook.com/events/160427380695693
        $output.= "<span class=\"_all_day_event\">" . $this->heledag . "</span>";
        $output.= "<span class=\"_date_format\">" . EVENT_DATUMFORMAAT . "</span>";
        $output.= "</a>";
        return $output;
    }

}
