<?php

namespace Opleidingen;

class Opleiding {

    private $id, $naam, $afkorting, $omschrijving, $minniveau, $minniveau_naam;

    public function __construct($id, $naam, $afkorting, $omschrijving, $minniveau, $minniveau_naam) {
        $this->id = $id;
        $this->naam = $naam;
        $this->afkorting = $afkorting;
        $this->omschrijving = $omschrijving;
        $this->minniveau = $minniveau;
        $this->minniveau_naam = $minniveau_naam;
    }

    public function getHtml() {
        $html = '';
        $html.= '<div class="OpleidingeContainer">';
        $html.= '<h1>' . $this->naam . '&nbsp;(' . $this->afkorting . ')</h1>';
        $html.= '<h2>Om deze opleiding te volgen moet je minstens beschikken over een ' . $this->minniveau_naam . ' brevet.</h2>';
        $html.= '<p>' . $this->omschrijving . '</p>';
        $flyer_path = 'flyers/' . $this->afkorting . '.pdf';
        if (file_exists($flyer_path)) {
            $html.= '<p><a href="' . $flyer_path . '" target="_blank">Download hier de Flyer</a></p>';
        }
        $html.= '</div>';
        return $html;
    }

    public function getTrHtml() {
        $html = '<tr>';
        $html.= '<td><a href="opleidingen.php?action=edit&id='.$this->id.'"><img class="adminButton" src="images/bewerken.png" alt="Bewerken" /></a><br />';
        $html.= '<a href="opleidingen.php?action=delete&id='.$this->id.'"><img class="adminButton" src="images/verwijderen.png" alt="Verwijderen" /></a></td>';
        $html.= '<td>' . $this->naam . '&nbsp;(' . $this->afkorting . ')</td>';
        
        $html.= '<td>' . $this->omschrijving . '</td>';
        $flyer_path = 'flyers/' . $this->afkorting . '.pdf';
        if (file_exists($flyer_path)) {
            $html.= '<td><a href="' . $flyer_path . '" target="_blank">Download hier de Flyer</a></td>';
        }
        else{
            $html.= '<td>&nbsp;</td>';
        }
        $html.= '<td>' . $this->minniveau_naam . '</td>';
        $html.= '</tr>';
        return $html;
    }

}
