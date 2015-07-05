<?php

namespace DiveEvent;

class Admin {

    private $db, $postaction, $getaction;

    public function __construct(&$dbref) {
        $this->db = $dbref;
    }

    public function processAction() {
        $this->loadActions();
        if ($this->getaction === NULL and $this->postaction === NULL) {
            $mgr = new AddManager($this->db);
            return $mgr->addEventForm();
        } else {
            $output = $this->checkGet();
            $output.= $this->checkPost();
            return $output;
        }
    }

    private function loadActions() {
        $this->getaction = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        $this->postaction = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    }

    private function checkGet() {
        switch ($this->getaction) {
            case 'add':
                $mgr = new AddManager($this->db);
                return $mgr->addEventForm();
            case 'edit':
                $mgr = new EditManager($this->db);
                return $mgr->editEventForm();
            case 'delete':
                $mgr = new DeleteManager($this->db);
                return $mgr->deleteEventForm();
        }
    }

    private function checkPost() {
        switch ($this->postaction) {
            case 'edit':
                $mgr = new EditManager($this->db);
                return $mgr->editEventForm();
            case 'delete':
                $mgr = new DeleteManager($this->db);
                return $mgr->deleteEventForm();
            case 'delete_confirmed':
                $mgr = new DeleteManager($this->db);
                return $mgr->deleteEventForm();
        }
    }

}
