<?php

namespace Opleidingen;

class View {

    private $db;
    private $opleidingen = array();

    public function __construct(&$dbref) {
        $this->db = $dbref;
        $this->loadOpleidingen();
    }

    public function getListView() {
        $output = '<table id="eventTable"><tr><td>&nbsp;</td><td>Naam - Afkorting</td><td>Omschrijving</td><td>Min. Opleiding</td><td>Prijs</td><td>Aantal zwembad </td><td>Aantal buiten</td><td>Aantal theorie</td><td>Flyer</td></tr>';
        foreach ($this->opleidingen as $obj) {
            $output.= $obj->getTrHtml();
        }
        $output.= '</table>';
        return $output;
    }

    private function loadOpleidingen() {
        //$query = 'SELECT * FROM opleidingen;';
        $query = "SELECT op.*, opl.naam AS minniveau_naam FROM opleidingen op INNER JOIN opleidingen opl ON op.minniveau = opl.id;";
        $result = $this->db->query($query);
        if ($result !== false) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmpobj = new Opleiding($row['id'], $row['naam'], $row['afkorting'], $row['omschrijving'], $row['minniveau'], $row['minniveau_naam'],$row['prijs'],$row['sessies_zwembad'],$row['sessies_buiten'],$row['sessies_theorie']);
                    $this->opleidingen[] = $tmpobj;
                }
            }
            $result->close();
        }
    }

}
