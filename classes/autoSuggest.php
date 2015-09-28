<?php
class autoSuggest{

    private $db;
    private $a_json = array();
    private $input;
    private $output;

    public function __construct() {
        $this->db = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
        if ($this->db->connect_errno == 0) {
            $this->db->set_charset('utf8');
            $this->filterGET();
            $this->getData();
            $this->generateOutput();
        }
    }

    public function getOutput() {
        return $this->output;
    }

    private function filterGET() {
        $this->input = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);
    }

    private function getData() {
        $query = 'SELECT naam,voornaam,lidnr FROM login WHERE lidnr LIKE ? OR naam LIKE ? OR voornaam LIKE ?;';
        $stmt = $this->db->prepare($query);
        if ($stmt !== false) {
            $stmt->bind_param("sss", $this->input, $this->input, $this->input);
            if ($stmt->execute()) {
                var_dump($stmt);
                if($stmt->num_rows > 0) {
                    $stmt->bind_result($naam, $voornaam, $lidnr);
                    $a_json_row["id"] = $lidnr;
                    $a_json_row["value"] = $lidnr;
                    $a_json_row["label"] = $lidnr . ' - ' . $voornaam . ' ' . $naam;
                    array_push($this->a_json, $a_json_row);
                }
            }
            $stmt->close();
        }
    }

    private function generateOutput() {
        $this->output = json_encode($this->a_json);
    }

}
