<?php

class autoSuggest {

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
        $query = "SELECT naam,voornaam,lidnr FROM login WHERE lidnr LIKE '%".$this->input."%' OR naam LIKE '%".$this->input."%' OR voornaam LIKE '%".$this->input."%';";
        $result = $this->db->query($query);
        var_dump($result);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $a_json_row["id"] = $row['lidnr'];
                $a_json_row["value"] = $row['lidnr'];
                $a_json_row["label"] = $row['lidnr'] . ' - ' . $row['voornaam'] . ' ' . $row['naam'];
                array_push($this->a_json, $a_json_row);
            }
        }
    }

    private function generateOutput() {
        $this->output = json_encode($this->a_json);
    }

}
