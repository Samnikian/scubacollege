<?php
require_once('header.php');
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
	$action = 'nieuws_toevoegen.php';
	require_once('includes/nieuwsform.php');
}
else{
	if(isset($_POST['titel']) && isset($_POST['tekst']) && isset($_POST['prioriteit']) && isIngelogd()){
		if(!empty($_POST['titel']) && !empty($_POST['tekst']) && !empty($_POST['prioriteit']) && isset($_FILES['foto'])){
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
				if ($_FILES["foto"]["size"] > 5000000) {
					echo "De maximum bestandsgroote is 5Mb.<br />";
					$uploadOk = 0;
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
				    echo "Alleen JPG, JPEG, PNG & GIF bestanden zijn toegelaten.<br />";
				    $uploadOk = 0;
				}
				if (file_exists($target_file)) {
					echo "Er bestaat al een nieuwsbericht met dezelfde titel!<br />";
					$uploadOk = 0;
				}
				if ($uploadOk == 0) {
					echo "Sorry, je bestand werd niet geupload (zie bovenstaande meldingen)!";
				}
				else{
					if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)){
						$foto = $target_file;
						$error = false;
					}
					else{
						$error = true;
						echo "Sorry, er was een probleem met het uploaden. Als dit probleem blijft aanhouden gelieve contact op te nemen met de webmaster.";
					}
				}
			}
			else{
				$error = false;
				$foto = 'geen';
			}
			if(!$error){
				$titel = $_POST['titel'];
				$tekst = $_POST['tekst'];
				$wie = $_SESSION['user_id'];
				$aangemaakt = time();
				$gewijzigd = time();
				$prioriteit = $_POST['prioriteit'];
				$query = "INSERT INTO `nieuws` (`titel`,`tekst`,`foto`,`wie`,`aangemaakt`,`gewijzigd`,`prioriteit`) VALUES ('".$titel."','".$tekst."','".$foto."','".$wie."','".$aangemaakt."','".$gewijzigd."','".$prioriteit."');";
				$db = new mysqli('localhost', 'scubacollege', 'scubacollege', 'scubacollege');
				if($db->connect_errno > 0){
					die('Unable to connect to database [' . $db->connect_error . ']');
				}
				else{
					if($db->query($query)){
						echo '<p class="melding">Je nieuwsbericht werd toegevoegd!</p>';
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
require_once('footer.php');
?>