<?php

class DiveEvent extends Event {
    private $minniveau;
    
    public function __construct($id,$begin,$einde,$omschrijving,$titel,$locatie,$fblink,$minniveau,$heledag = false) {
        $this->minniveau = $minniveau;
        parent::__construct($id,$begin,$einde,$omschrijving,$titel,$locatie,$fblink,$heledag); 
    }
    public function getTrHTML() {
        $output = '<tr>';
        if ($this->begin === $this->einde) {
            $output.= '<td>' . $this->formatTime($this->begin) . '</td>';
        } else {
            $output.= '<td>Van ' . $this->formatTime($this->begin) . ' tot ' . $this->formatTime($this->einde) . '';
        }
        $output.= '<td><span class="eventTitel">' . $this->titel . '</span><br />' . $this->omschrijving . '</td>';
        $output.= '<td>' . $this->locatie . '</td>';
        $output.= '<td>' . $this->minniveau . '</td>';
        $output.= '<td>' . parent::createAddToCalendarCode() . '</td>';
        $output.= '</tr>';
        
        return $output;
    }
}