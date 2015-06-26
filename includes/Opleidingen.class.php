<?php

class Opleidingen {

    private $db;

    public function __construct(&$database) {
        $this->db = $database;
    }

    public function getOpleidingSelector() {
        $output = '';
        $query = "SELECT `id`,`naam` FROM `Opleidingen`";
        $output.='<select>';
        $output.='<option name="minniveau" selected value="geen">Geen</option>';

        $result = $this->db->query($query);
        if ($result !== false) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $output.="<option value=\"" . $row['id'] . "\">" . $row['naam'] . "</option>";
                }
            }
        }
        $output.='</select>';
        return $output;
    }

}
