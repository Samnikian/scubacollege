<?php
require_once('header.php');
if(isIngelogd() && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='GET'){
	$continue = true;
	$error = '';
	if(!isset($_GET['i'])){
		$continue = false;
		$error.= '<p class="">Geen ID opgegeven!</p>';
	}
	if(!is_numeric($_GET['i'])){
		$continue = false;
		$error.= '<p class="">Foutief ID opgegeven!</p>';
	}
	if($continue){
		$id = $_GET['i'];
		$nieuws = haalNieuwsArtikel($id,$db);
		if($nieuws !== false){
			$id = $nieuws['id'];
			$titel = $nieuws['titel'];
			$tekst = $nieuws['tekst'];
			$prioriteit = $nieuws['prioriteit'];
			$foto = $nieuws['foto'];
			$postaction = 'nieuws_bewerken.php';
			require_once('includes/nieuwsform.php');
		}
	}
	else{
		echo $error;
	}
	
}
elseif(isIngelogd() && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['titel']) && isset($_POST['tekst']) && isset($_POST['prioriteit']) && isset($_POST['id'])){
		if(!empty($_POST['titel']) && !empty($_POST['tekst']) && !empty($_POST['prioriteit']) && isset($_FILES['foto']) && !empty($_POST['id'])){
			if($_FILES['foto']['size'] > 0){
				$target_dir = 'images/nieuws/';
				//$target_file = $target_dir . basename($_FILES["foto"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_dir . basename($_FILES["foto"]["name"]),PATHINFO_EXTENSION);
				$target_file = $target_dir.clean($_POST['titel']).'.'.$imageFileType;
				$check = getimagesize($_FILES["foto"]["tmp_name"]);
				if($check === false) {
					//File is not an image.";
					$uploadOk = 0;
				}
				if($_FILES["foto"]["size"] > 5000000) {
					echo "<p class=\"melding\">De maximum bestandsgroote is 5Mb.</p>";
					$uploadOk = 0;
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
				    echo "<p class=\"melding\">Alleen JPG, JPEG, PNG & GIF bestanden zijn toegelaten.</p>";
				    $uploadOk = 0;
				}
				if($uploadOk == 0) {
					echo "<p class=\"melding\">Sorry, je bestand werd niet geupload (zie bovenstaande meldingen)!</p>";
				}
				else{
					if(file_exists($target_file)) {
						unlink($target_file);
					}
					if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)){
						$foto = $target_file;
						$error = false;
					}
					else{
						$error = true;
						echo "<p class=\"melding\">Sorry, er was een probleem met het uploaden. Als dit probleem blijft aanhouden gelieve contact op te nemen met de webmaster.</p>";
					}
				}
			}
			else{
				$error = false;
				$foto = 'geen';
			}
			if(!$error){
				if(isset($_POST['delete']) && isset($_POST['path']) && !empty($_POST['path']) && file_exists($_POST['path'])){
					unlink($_POST['path']);
					$foto = 'geen';
				}
				$id = $_POST['id'];
				$titel = $_POST['titel'];
				$tekst = $_POST['tekst'];
				$wie = $_SESSION['user_id'];
				$gewijzigd = time();
				$prioriteit = $_POST['prioriteit'];
				if($foto=='geen'){
					$query = "UPDATE `nieuws` SET `titel`='".htmlspecialchars($titel)."',`tekst`='".$tekst."',`wie`='".$wie."',`gewijzigd`='".$gewijzigd."',`prioriteit`='".$prioriteit."' WHERE `id`='".$id."';";
				}
				else{
					$query = "UPDATE `nieuws` SET `titel`='".htmlspecialchars($titel)."',`tekst`='".$tekst."',`foto`='".$foto."',`wie`='".$wie."',`gewijzigd`='".$gewijzigd."',`prioriteit`='".$prioriteit."' WHERE `id`='".$id."';";
				}
				$db = new mysqli('localhost', 'scubacollege', 'scubacollege', 'scubacollege');
				if($db->connect_errno > 0){
					die('Unable to connect to database [' . $db->connect_error . ']');
				}
				else{
					if($db->query($query)){
						echo '<p class="melding">Je nieuwsbericht werd aangepast!</p>';
						redirect('index.php');
					}
					else{
						if(strpos($db->error,'Duplicate') !== false){
							echo '<p class="melding">Er bestaat al een artikel met die titel!</p>';
						}
						else{
							echo '<p class="melding">Er is een probleem opgetreden: '.$db->error.'</p>';
							if($foto != 'geen'){
								unlink($foto);
							}
						}
					}
				}
			}
		}
		else{
			echo 'Gelieve alle velden in te vullen!';
		}
	}
	else{
		echo 'Error, probeer het opnieuw!';
	}
}
else{
	header('Location: index.php');
}
require_once('footer.php');
?>