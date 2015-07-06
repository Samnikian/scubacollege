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
            var_dump($this);
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
        $output = '<fieldset id="DiveEventForm"><legend>Opleiding Toevoegen</legend><form action="opleidingen.php" method="POST">';
        $output.= '<input type="hidden" name="action" value="add" />';
        $output.= '<label for="naam">Naam</label><input type="text" id="" value="'.$this->naam.'" name="naam" placeholder="Bijvoorbeeld: Open Water Diver" required /><br />';
        $output.= '<label for="afkorting">Afkorting</label><input type="text" id="afkorting" value="'.$this->afkorting.'" name="afkorting" placeholder="Bijvoorbeeld: OWD" required /><br />';
        $output.= '<textarea id="omschrijving" name="omschrijving" placeholder="Een omschrijving"></textarea><label for="minniveau">Min. Niveau</label>';
        $output.= $this->getOpleidingSelector();
        $output.= '<input type="submit" value="Toevoegen!" />';
        $output.= '</form></fieldset>';
        return $output;
    }

    private function opleidingOpslaan() {
        $query = 'INSERT INTO opleidingen (naam,afkorting,omschrijving,minniveau,minniveau_naam) VALUES (?,?,?,?,?);';
        $stmt = $this->db->prepare($query);
        if($stmt !== false){
            $stmt->bind_param("sssis",$this->naam,$this->afkorting,$this->omschrijving,$this->minniveau,$this->minniveau_naam);
            if($stmt->execute()){
                return $this->getSuccessMessage();
            }
            else{
                return $this->getFailMessage();
            }
            $stmt->close();
        }
        else{
            return 'Error: '.$stmt->error;
        }
    }

}
