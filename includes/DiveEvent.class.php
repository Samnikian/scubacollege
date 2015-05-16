<?php

class DiveEvent extends Event {
    private $minniveau;
    
    public function __construct($id,$begin,$einde,$omschrijving,$titel,$locatie,$fblink,$minniveau,$heledag = false) {
        $this->minniveau = $minniveau;
        parent::__construct($id,$begin,$einde,$omschrijving,$titel,$locatie,$fblink,$heledag); 
    }
    public function getTrHTML($addTableTags = true) {
        if (DEBUG) {
            echo '<span class="debug">Function call: DiveEvent::getTrHTML</span>';
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
        $output.= '<td>' . $this->minniveau . '</td>';
        $output.= '<td>' . parent::createAddToCalendarCode() . '</td>';
        if ($addTableTags) {
            $output.= '</tr>';
        } else {
            $output.= '</tr></table>';
        }
        return $output;
    }

}
?>