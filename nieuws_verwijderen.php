<?php
require_once('header.php');
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='GET'){
	$continue = true;
	$error = '';
	if(!isIngelogd()){
		$continue = false;
		$error.= '<p class="melding">Je bent niet ingelogd!</p>';
	}
	if(!isset($_GET['i'])){
		$continue = false;
		$error.= '<p class="melding">Geen ID opgegeven!</p>';
	}
	if(!is_numeric($_GET['i'])){
		$continue = false;
		$error.= '<p class="melding">Ongeldig ID opgegeven.</p>';
	}
	if($continue){
		$artikel = haalNieuwsArtikel($_GET['i'],$db);
		if($artikel !== false){
			$me = $_SERVER['PHP_SELF'];
			echo '<form method="post" action="'.$me.'" class="standaardform">';
			echo "<p class=\"melding\">U staat op het punt het artikel <b>".$artikel['titel']."</b> te verwijderen, wilt u doorgaan?<br />";
			echo "<input type=\"hidden\" name=\"id\" value=\"".$_GET['i']."\" />";
			echo "<input type=\"hidden\" name=\"titel\" value=\"".$artikel['titel']."\" />";
			echo "<input type=\"hidden\" name=\"foto\" value=\"".$artikel['foto']."\" />";
			echo '<input type="submit" value="Ja, verwijder het artikel!" /></p>';
			echo '</form>';
		}
		else{
			echo '<p class="melding">Het artikel werd niet gevonden.</p>';
		}
	}
	else{
		echo $error;
	}
}
elseif(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST'){
	if(!isIngelogd() or !isset($_POST['id']) or !isset($_POST['titel']) or !isset($_POST['foto'])){
		header('Location: index.php');
	}
	$id = $_POST['id'];
	$titel = htmlspecialchars($_POST['titel']);
	if(is_numeric($id)){
		if($db->query("DELETE FROM `nieuws` WHERE `id`='".$id."';")){
			if(file_exists($_POST['foto'])){
				unlink($_POST['foto']);
			}
			echo '<p class="melding">Het artikel <b>'.$titel.'</b> werd verwijderd!</p>';
			redirect();
		}
		else{
			echo '<p class="melding">Database error!</p>';
		}
	}
}
else{
	header('Location: index.php');
}
require_once('footer.php');
?>