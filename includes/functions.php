<?php
function clean($string) {
        if(DEBUG){
            echo '<span class="debug">Function call: clean</span>';
        }
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function isIngelogd(){
        if(DEBUG){
            echo '<span class="debug">Function call: isIngelogd</span>';
        }
	if(isset($_SESSION['ingelogt']) && isset($_SESSION['user_level']) && $_SESSION['ingelogt']){
		return true;
	}
	else{
		return false;
	}
}
function haalNieuwsArtikel($id,&$db){
        if(DEBUG){
            echo '<span class="debug">Function call: haalNieuwsArtikel (id: '.$id.')</span>';
        }
	$query = "SELECT * FROM `nieuws` WHERE `id`='".$id."';";
	if($result = $db->query($query)){
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			return $row;
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
}
function redirect(){
	header('refresh: 5; url=index.php');
	echo '<p class="melding"><a href="index.php">U word binnen 5 seconden doorverwezen naar de startpagina, klik hier indien dit niet gebeurd.</a></p>';
}
function createAddToCalendar($event){
        if(DEBUG){
            echo '<span class="debug">Function call: createAddToCalendar</span>';
        }
	$output = "<a href=\"http://scubacollege.be/kalender.php#".$event['id']."\" title=\"Toevoegen aan je agenda\" class=\"addthisevent\">";
	$output.= "Toevoegen aan je agenda!";
	$output.= "<span class=\"_start\">".$event['begin']."</span>";
	$output.= "<span class=\"_end\">".$event['einde']."</span>";
	$output.= "<span class=\"_zonecode\">".EVENT_TIMEZONE."</span>";
	$output.= "<span class=\"_summary\">".$event['omschrijving']."</span>";
	$output.= "<span class=\"_description\">".$event['titel']."</span>";
	$output.= "<span class=\"_location\">".$event['locatie']."</span>";
	$output.= "<span class=\"_organizer\">".EVENT_ORGANISATOR."</span>";
	$output.= "<span class=\"_organizer_email\">".EVENT_ORGANISATOR_EMAIL."</span>";
	$output.= "<span class=\"_facebook_event\">".$event['fblink']."</span>";	//http://www.facebook.com/events/160427380695693
	$output.= "<span class=\"_all_day_event\">".$event['heledag']."</span>";
	$output.= "<span class=\"_date_format\">".EVENT_DATUMFORMAAT."</span>";
	$output.= "</a>";
}
?>