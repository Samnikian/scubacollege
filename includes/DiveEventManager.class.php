<?php
class DiveEventManager{
    private $DiveEvents = array();
    private $db;
    //private $maanden = array($jan,$feb,$maa,$apr,$jun,$jul,$aug,$sep,$okt,$nov,$dec);
    public function __construct(&$dbref){
        $this->db = $dbref;
        $this->loadEvents();
    }
    private function loadEvents(){
        $query = 'SELECT * FROM `kalender` ORDER BY `begin`;';
        try{
            $result = $this->db->query($query);
            while($row = $result->fetch_assoc()){
                $tmpobj = new DiveEvent($row['id'],$row['begin'],$row['einde'], $row['omschrijving'], $row['titel'],$row['locatie'],$row['fblink'],$row['minniveau'],$row['heledag']);
                $this->DiveEvents[] = $tmpobj;
            }
            $result->close();
        }
        catch(Exception $error){
            echo 'Er heeft zich een probleem voorgedaan, gelieve de webmaster te contacteren. Details: '.$error->getMessage();
        }
    }
    public function getHTMLTable(){
        $output = '<table id="eventTable">';
        $output.= '<tr id="eventHeader"><td>Wanneer</td><td>Omschrijving - Informatie</td><td>Locatie</td><td>Min Niveau</td></tr>';
        foreach($this->DiveEvents as $evnt){
            $output.= $evnt->getTrHTML(false);
        }
        $output.='</table>';
        return $output;
    }
    public function printEvents(){
        echo '<pre>';
        print_r($this->DiveEvents);
        echo '</pre>';
    }
    private function sorteerOpMaand(){
        foreach($this->DiveEvents as $DiveEvnt){
            switch(date('m',$DiveEvnt)){
                case 1:
                    
                case 2:
                    
                case 3:
            
            }
        }
    }
}

