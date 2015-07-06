<?php

namespace Opleidingen;

class Admin {

    private $db,$getaction, $postaction;

    public function __construct(&$dbref) {
        $this->db = $dbref;
        $this->getaction = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        $this->postaction = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    }

    public function processAction() {
        $output = $this->checkGet();
        if (empty($output)) {
            $output = $this->checkPost();
        }
        return $output;
    }

    private function checkGet() {
        switch ($this->getaction) {
            case 'add':
                $obj = new AddManager($this->db);
                return $obj->getAddForm();
        }
    }

    private function checkPost() {
        switch ($this->postaction) {
            case 'add':
                $obj = new AddManager($this->db);
                return $obj->getAddForm();

            default:
                return file_get_contents('includes/flowchart.html');
        }
    }

}
