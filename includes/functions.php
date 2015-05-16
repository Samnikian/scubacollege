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
function redirect($page){
	header('refresh: 5; url=index.php');
	echo '<p class="melding"><a href="'.$page.'">U word binnen 5 seconden doorverwezen naar de startpagina, klik hier indien dit niet gebeurd.</a></p>';
}
function IsDate( $Str ){
  $Stamp = strtotime( $Str );
  $Month = date( 'm', $Stamp );
  $Day   = date( 'd', $Stamp );
  $Year  = date( 'Y', $Stamp );
  if(!empty($Stamp)){
      return checkdate( $Month, $Day, $Year );
  }
  else{
      return false;
  }   
}
?>