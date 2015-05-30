<?php
class event {
    protected $id;
    protected $begin;
    protected $einde;
    protected $omschrijving;
    protected $titel;
    protected $locatie;
    protected $fblink;
    protected $heledag;
    public function __construct($id,$begin,$einde,$omschrijving,$titel,$locatie,$fblink,$heledag) {
        $this->id = $id;
        $this->begin = $begin;
        $this->einde = $einde;
        $this->omschrijving = $omschrijving;
        $this->titel = $titel;
        $this->locatie = $locatie;
        $this->fblink = $fblink;
        $this->heledag = $heledag;
    }
    public function getTrHTML() {
        $output = '<tr>';
        if ($this->begin === $this->einde) {
            $output.= '<td>' . $this->formatTime($this->begin) . '</td>';
        } else {
            $output.= '<td>Van ' . $this->formatTime($this->begin) . ' tot ' . $this->formatTime($this->einde) . '';
        }
        $output.= '<td><p>' . $this->titel . '</p><p>' . $this->omschrijving . '</p></td>';
        $output.= '<td>' . $this->locatie . '</td>';
        $output.= '<td>' . $this->minniveau . '</td>';
        $output.= '<td>' . $this->createAddToCalendarCode() . '</td>';
        $output.= '</tr>';
        return $output;
    }
    protected function createAddToCalendarCode() {
        $output = "<a href=\"http://scubacollege.be/kalender.php#" . $this->id . "\" title=\"Toevoegen aan je agenda\" class=\"addthisevent\">";
        $output.= "Toevoegen aan je agenda!";
        $output.= "<span class=\"_start\">" . $this->formatTimeForEvent($this->begin) . "</span>";
        $output.= "<span class=\"_end\">" . $this->formatTimeForEvent($this->einde) . "</span>";
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
    protected function formatTime($input){
        return date("d-m-Y",$input);
    }
    private function formatTimeForEvent($input){
        //06/18/2015 18:00
        return date("m\/d\/Y",$input);
    }
}
