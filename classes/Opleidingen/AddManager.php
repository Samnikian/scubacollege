<?php

namespace Opleidingen;

class AddManager Extends Manager {

    public function __construct(&$database) {
        parent::__construct($database);
    }

    public function getAddForm() {
        $req = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if ($req == 'POST') {
            $this->getDataFromPost();
            $this->validateInput();
            if ($this->error === true) {
                $output = '';
                $output.= $this->errormsg;
                $output.=$this->getHTMLform();
                return $output;
            } else {
                return $this->opleidingOpslaan();
            }
        } else {
            return $this->getHTMLform();
        }
    }

    private function getDataFromPost() {
        $this->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $this->naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
        $this->afkorting = filter_input(INPUT_POST, 'afkorting', FILTER_SANITIZE_EMAIL);
        $this->omschrijving = filter_input(INPUT_POST, 'omschrijving', FILTER_SANITIZE_STRING);
        $this->minniveau = filter_input(INPUT_POST, 'minniveau', FILTER_SANITIZE_STRING);
        $this->minniveau_naam = $this->idNaarNaam($this->id);
    }

    private function getHTMLform() {
        return 'TODO: Html FOrm';
    }

    private function opleidingOpslaan() {
        return 'TODO: Opslaan';
    }

}
