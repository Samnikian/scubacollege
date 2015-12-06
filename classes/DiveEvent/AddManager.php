<?php
namespace DiveEvent;
class AddManager Extends Manager {

    public function __construct(&$dbref) {
        parent::__construct($dbref);
    }

    public function addEventForm() {
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
                return $this->nieuwEventOpslaan();
            }
        } else {
            return $this->getHTMLform();
        }
    }

    private function nieuwEventOpslaan() {
        $query = "INSERT INTO `kalender` (`begin`,`einde`,`omschrijving`,`titel`,`locatie`,`fblink`,`heledag`,`minniveau`)";
        $query.= "VALUES ('" . $this->datumNaarTimeStamp($this->begin) . "','" . $this->datumNaarTimeStamp($this->einde) . "','" . $this->omschrijving . "','" . $this->titel . "','" . $this->locatie . "','" . $this->fblink . "','" . $this->heledag . "','" . $this->minniveau . "');";
        $result = $this->db->query($query);
        if (!$result) {
            return $this->db->error;
            //return $this->getFailMessage();
        } else {
            return $this->getSuccessMessage();
        }
    }

    private function getDataFromPost() {
        $this->id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $this->begin = filter_input(INPUT_POST, 'begin', FILTER_SANITIZE_STRING);
        $this->einde = filter_input(INPUT_POST, 'einde', FILTER_SANITIZE_EMAIL);
        $this->titel = filter_input(INPUT_POST, 'titel', FILTER_SANITIZE_STRING);
        $this->omschrijving = filter_input(INPUT_POST, 'omschrijving', FILTER_SANITIZE_STRING);
        $this->locatie = filter_input(INPUT_POST, 'locatie', FILTER_SANITIZE_STRING);
        $this->fblink = filter_input(INPUT_POST, 'fblink', FILTER_SANITIZE_STRING);
        $this->minniveau = filter_input(INPUT_POST, 'minniveau', FILTER_SANITIZE_STRING);
    }

    public function getHTMLform() {
        $output = '<fieldset id="DiveEventForm"><legend>Kalender item toevoegen</legend><form action="event.php" method="POST">';
        $output.= '<input type="hidden" value="add" name="action" />';
        $output.='<label for="begin">Begin</label><input type="text" id="begin" name="begin" value="' . $this->begin . '" required placeholder="16-07-2015" /><br />';
        $output.='<label for="einde">Einde</label><input type="text" id="einde" name="einde" value="' . $this->einde . '" required placeholder="17-07-2015" /><br />';
        $output.='<label for="titel">Titel</label><input type="text" id="titel" name="titel" value="' . $this->titel . '" required placeholder="Hier komt de Titel" /><br />';
        $output.='<textarea id="omschrijving" name="omschrijving">' . $this->omschrijving . '</textarea><br />';
        $output.='<label for="locatie">Locatie</label><input type="text" id="locatie" name="locatie" value="' . $this->locatie . '" required/><br />';
        $output.='<label for="fblink">Facebook link</label><input type="text" id="fblink" name="fblink" value="' . $this->fblink . '" placeholder="https://www.facebook.com/events/1448283488824627/" /><br />';
        $output.='<label for="minniveau">Minimum Niveau</label>';
        $output.= $this->objOpleidingen->getOpleidingSelector();
        $output.='<input type="submit" id="submit" value="Opslaan!" />';
        $output.= '</form></fieldset>';
        return $output;
    }

}
