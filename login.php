<?php
require_once('header.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['username'],$_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
		//
		//TODO: Login logic
		//
		$_SESSION['ingelogt'] = true;
		$_SESSION['user_level'] = STAFF;
		$_SESSION['user_id'] = 0;
		echo '<p class="melding">Je werd succesvol ingelogt!</p>';
		redirect();
	}
	else{
		header('Location: index.php');
	}
}
else{
	header('Location: index.php');
}
require_once('footer.php');
?>