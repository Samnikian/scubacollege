<?php

class Opleidingen {

    private $db;

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
        }else{
            $output.='<option value="0">Nvt</option>';
        }
        $result = $this->db->query($query);
        if ($result !== false) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if($id == $row['id']){
                        $output.="<option selected value=\"" . $row['id'] . "\">" . $row['naam'] . "</option>";
                    }
                    else{
                        $output.="<option value=\"" . $row['id'] . "\">" . $row['naam'] . "</option>";
                    }
                }
            }
        }
        $output.='</select>';
        return $output;
    }

}
