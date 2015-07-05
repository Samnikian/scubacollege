<?php

class DiveEventDeleteManager Extends DiveEventManager {

    public function __construct(&$dbref) {
        parent::__construct($dbref);
    }

    public function deleteEventForm() {
        if (filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) === 'delete_confirmed') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            return $this->deleteEvent($id);
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            return $this->getDeleteForm($id);
        }
    }

    private function getDeleteForm($id) {
        $output = '<fieldset id="DiveEventForm"><legend>Kalender item verwijderen</legend><form action="event.php" method="POST">';
        $output.= '<input type="hidden" name="id" value="' . $id . '" />';
        $output.= '<input type="hidden" name="action" value="delete_confirmed" />';
        $output.= '<p>Bent u zeker dat u het evenement wil verwijderen?</p>';
        $output.= '<p><a href="kalender.php">Annuleren &nbsp;</a><input type="submit" value="Bevestigen!" /></p>';
        $output.= '</form></fieldset>';
        return $output;
    }

    private function deleteEvent($id) {
        try {
            $output = '';
            $query = 'DELETE FROM kalender WHERE id=' . $id . ';';
            $result = $this->db->query($query);
            if ($result) {
                $output.= $this->getSuccessMessage();
            } else {
                $output.= 'Er is een fout opgetreden, gelieve contact op te nemen met de webmaster. Hou volgende melding bij de hand: ';
                $output.= $this->db->error;
            }
        } catch (Exception $ex) {
            $output.= 'Er is een fout opgetreden, gelieve contact op te nemen met de webmaster. Hou volgende melding bij de hand: ';
            $output.= $ex->getMessage();
        } finally {
            return $output;
        }
    }

}
