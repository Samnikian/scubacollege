<?php

namespace Opleidingen;

class Manager {

    protected $db;
    protected $id, $naam, $afkorting, $omschrijving, $minniveau, $minniveau_naam;

    public function __construct(&$database) {
        $this->db = $database;
    }

    public function idNaarNaam($id) {
        if ($id == 0) {
            return 'Nvt';
        } else {
            try {
                $query = 'SELECT naam FROM `Opleidingen` WHERE `id`=' . $id . ';';
                $result = $this->db->query($query);
                $opl = $result->fetch_assoc();
                $output = $opl['naam'];
            } catch (Exception $ex) {
                $output = 'Errors';
            } finally {
                $result->close();
                return $output;
            }
        }
    }

    public function getOpleidingSelector($id = 0) {
        $output = '';
        $query = "SELECT `id`,`naam` FROM `Opleidingen`";
        $output.='<select name="minniveau">';
        if ($id == 0) {
            $output.='<option selected value="0">Nvt</option>';
        } else {
            $output.='<option value="0">Nvt</option>';
        }
        $result = $this->db->query($query);
        if ($result !== false) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($id == $row['id']) {
                        $output.="<option selected value=\"" . $row['id'] . "\">" . $row['naam'] . "</option>";
                    } else {
                        $output.="<option value=\"" . $row['id'] . "\">" . $row['naam'] . "</option>";
                    }
                }
                $result->close();
            }
        }
        $output.='</select>';
        return $output;
    }

    protected function validateInput() {
        $this->errormsg = '<ul>';
        $this->checkId();
        $this->checkMinNiveau();
        $this->checkNaam();
        $this->checkAfkorting();
        $this->checkOmschrijving();
        $this->errormsg = '</ul>';
    }

    private function checkId() {
        if (!is_numeric($this->id)) {
            $this->error = true;
            $this->errormsg = '<li>Id moet numeriek zijn.</li>';
        }
    }

    private function checkMinNiveau() {
        if (!is_numeric($this->minniveau)) {
            $this->error = true;
            $this->errormsg = '<li>Gelieve een minimum niveau te selecteren</li>';
        }
    }

    private function checkNaam() {
        if (strlen($this->naam) > 3) {
            $this->error = true;
            $this->errormsg = '<li>De naam moet minstens 3 tekens bevatten.</li>';
        }
    }

    private function checkAfkorting() {
        if (strlen($this->afkorting) > 1) {
            $this->error = true;
            $this->errormsg = '<li>De afkorting moet minstens 2 tekens bevatten.</li>';
        }
    }

    private function checkOmschrijving() {
        if (strlen($this->omschrijving) > 10) {
            $this->error = true;
            $this->errormsg = '<li>De omschrijving moet minstens 10 tekens bevatten.</li>';
        }
    }

}
