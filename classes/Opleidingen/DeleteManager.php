<?php

namespace Opleidingen;

class DeleteManager Extends Manager {

    public function __construct(&$database) {
        parent::__construct($database);
    }

    public function getDeleteForm() {
        if (filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) === 'delete_confirmed') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            return $this->deleteEvent($id);
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            return $this->getDeleteFormHtml($id);
        }
    }

    private function getDeleteFormHtml($id) {
        $output = '<fieldset id="DiveEventForm"><legend>Opleiding verwijderen</legend><form action="opleidingen.php" method="POST">';
        $output.= '<input type="hidden" name="id" value="' . $id . '" />';
        $output.= '<input type="hidden" name="action" value="delete_confirmed" />';
        $output.= '<p>Bent u zeker dat u de opleiding wil verwijderen? Dit zal alle afhankelijke evenementen en opleidingen aanpassen!</p>';
        $output.= '<p><a href="opleidingen.php?action=list">Annuleren &nbsp;</a><input type="submit" value="Bevestigen!" /></p>';
        $output.= '</form></fieldset>';
        return $output;
    }

    private function deleteEvent($id) {
        try {
            $output = '';
            $query_kalender = 'UPDATE kalender SET `minniveau`=0,`minniveau_naam`=\'Nvt\' WHERE minniveau='.$id.';';
            $query_opleidingen = 'UPDATE opleidingen SET `minniveau`=0,`minniveau_naam`=\'Nvt\' WHERE minniveau='.$id.';';
            $query_opleiding = 'DELETE FROM opleidingen WHERE id=' . $id . ';';
            $result = $this->db->query($query_kalender);
            $result1 = $this->db->query($query_opleidingen);
            $result2 = $this->db->query($query_opleiding);
            if ($result2) {
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
