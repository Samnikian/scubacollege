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
        $output = '<table id="eventTable"><tr><td>&nbsp;</td><td>Naam - Afkorting</td><td>Omschrijving</td><td>Flyer</td><td>Min. Opleiding</td></tr>';
        foreach ($this->opleidingen as $obj) {
            $output.= $obj->getTrHtml();
        }
        $output.= '</table>';
        return $output;
    }

    private function loadOpleidingen() {
        $query = 'SELECT * FROM opleidingen;';
        $result = $this->db->query($query);
        if ($result !== false) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmpobj = new Opleiding($row['id'], $row['naam'], $row['afkorting'], $row['omschrijving'], $row['minniveau'], $row['minniveau_naam']);
                    $this->opleidingen[] = $tmpobj;
                }
            }
            $result->close();
        }
    }

}
