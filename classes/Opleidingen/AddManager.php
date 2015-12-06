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
        $this->prijs = filter_input(INPUT_POST, 'prijs', FILTER_SANITIZE_NUMBER_FLOAT);
        $this->sessies_zwembad = filter_input(INPUT_POST, 'sessies_zwembad', FILTER_SANITIZE_NUMBER_INT);
        $this->sessies_buiten = filter_input(INPUT_POST, 'sessies_buiten', FILTER_SANITIZE_NUMBER_INT);
        $this->sessies_theorie = filter_input(INPUT_POST, 'sessies_theorie', FILTER_SANITIZE_NUMBER_INT);
    }

    private function getHTMLform() {
        $output = '<fieldset id="DiveEventForm"><legend>Opleiding Toevoegen</legend><form action="opleidingen.php" method="POST">';
        $output.= '<input type="hidden" name="action" value="add" />';
        $output.= '<label for="naam">Naam</label><input type="text" id="" value="'.$this->naam.'" name="naam" placeholder="Bijvoorbeeld: Open Water Diver" required /><br />';
        $output.= '<label for="afkorting">Afkorting</label><input type="text" id="afkorting" value="'.$this->afkorting.'" name="afkorting" placeholder="Bijvoorbeeld: OWD" required /><br />';
        $output.= '<textarea id="omschrijving" name="omschrijving" placeholder="Een omschrijving"></textarea><label for="minniveau">Min. Niveau</label>';
        $output.= $this->getOpleidingSelector();
        $output.= '<label for="prijs">Prijs</label><input type="" id="prijs" value="'.$this->prijs.'" name="prijs" placeholder="125€" /><br />';
        $output.= '<label for="sessies_zwembad">Aantal zwembad sessies</label><input type="number" id="sessies_zwembad" value="'.$this->sessies_zwembad.'" name="sessies_zwembad" /><br />';
        $output.= '<label for="sessies_buiten">Aantal buitenwaterduiken</label><input type="number" id="sessies_buiten" value="'.$this->sessies_buiten.'" name="sessies_buiten" /><br />';
        $output.= '<label for="sessies_theorie">Aantal theorie sessies</label><input type="number" id="sessies_theorie" value="'.$this->sessies_theorie.'" name="sessies_theorie" /><br />';
        $output.= '<input type="submit" value="Toevoegen!" />';
        $output.= '</form></fieldset>';
        return $output;
    }

    private function opleidingOpslaan() {
        $query = 'INSERT INTO opleidingen (naam,afkorting,omschrijving,minniveau,prijs,sessies_zwembad,sessies_buiten,sessies_theorie) VALUES (?,?,?,?,?,?,?,?);';
        $stmt = $this->db->prepare($query);
        if($stmt !== false){
            $stmt->bind_param("sssisiii",$this->naam,$this->afkorting,$this->omschrijving,$this->minniveau,$this->prijs,$this->sessies_zwembad,$this->sessies_buiten,$this->sessies_theorie);
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
