<?php
class DiveEventManager{
    private $DiveEvents = array();
    private $db;
    public function __construct(&$dbref){
        $this->db = $dbref;
        $this->loadEvents();
    }
    private function loadEvents(){
        $query = 'SELECT * FROM `kalender` ORDER BY `begin`;';
        try{
            $result = $this->db->query($query);
            while($row = $result->fetch_assoc()){
                $this->DiveEvents[] = $row;
            }
            $result->close();
        }
        catch(Exception $error){
            echo 'Er heeft zich een probleem voorgedaan, gelieve de webmaster te contacteren. Details: '.$error->getMessage();
        }
    }
    public function getHTMLTable(){
        
    }
    public function printEvents(){
        echo '<pre>';
        print_r($this->DiveEvents);
        echo '</pre>';
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

