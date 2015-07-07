<?php

namespace Opleidingen;

class Admin {

    private $db, $getaction, $postaction, $login;

    public function __construct(&$dbref) {
        $this->db = $dbref;
        $this->getaction = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        $this->postaction = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $this->login = isIngelogd();
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
            case 'edit':
                $obj = new EditManager($this->db);
                return $obj->getEditForm();
            case 'delete':
                $obj = new DeleteManager($this->db);
                return $obj->getDeleteForm();
            case 'list':
                if ($this->hasEditRights()) {
                    $obj = new View($this->db);
                    return $obj->getListView();
                }
                break;
        }
    }

    private function checkPost() {
        switch ($this->postaction) {
            case 'add':
                $obj = new AddManager($this->db);
                return $obj->getAddForm();
            case 'edit_confirmed':
                $obj = new EditManager($this->db);
                return $obj->getEditForm();
            case 'delete_confirmed':
                $obj = new DeleteManager($this->db);
                return $obj->getDeleteForm();
            default:
                return file_get_contents('includes/flowchart.html');
        }
    }

    private function hasEditRights() {
        if ($this->login) {
            switch ($_SESSION['user_level']) {
                case ADMIN:
                    return true;

                case STAFF:
                    return true;

                default:
                    return false;
            }
        }
    }

}
