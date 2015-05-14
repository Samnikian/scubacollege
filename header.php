<?php
session_start();
session_regenerate_id();
date_default_timezone_set('Europe/Brussels');
//$_SESSION['ingelogt'] = true;
//$_SESSION['user_level'] = 2;
require_once('includes/config.php');
$db = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
if($db->connect_errno > 0){
	die('Unable to connect to database [' . $db->connect_error . ']');
}
require_once('includes/functions.php');
$ingelogd = isIngelogd();
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Leren duiken - padi duikschool/duikclub/duikcentrum Scuba College mechelen/antwerpen</title>
		<meta name="description" content="leren duiken - padi duikschool/duikclub/duikcentrum scuba college mechelen/antwerpen" />
		<meta name="keywords" content="duiken,leren duiken,padi,padi,duikschool,duikclub,duikcentrum,duikwinkel,duikshop,open water,advanced open water,openwater,ow,aow,rescue diver,efr,divemaster,owsi,mechelen,antwerpen,walem,nitrox,cursus,duikcursus,duikopleiding,nekker,de nekker,dan,dan,bare,green force,mares,ralf tech,seac sub,sealife,suunto,uwkinetics,underwater kinetics,uk" />
		<meta name="verify-v1" content="1tjmsjmixkferm/5wdgpkjrv24bv+4ggch4v6eryymk=" />
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<script type="text/javascript" src="https://addthisevent.com/libs/1.5.8/ate.min.js"></script>
		<link rel="icon" type="image/ico" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="opmaak.php" />
		<?php
			if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] != 'POST'){
				if(strpos($_SERVER['PHP_SELF'],'contact.php') !== false or strpos($_SERVER['PHP_SELF'],'initiatie.php') !== false){
					echo "<script src='https://www.google.com/recaptcha/api.js'></script>";
				}
				
			}
		?>
		<?php
			if(strpos($_SERVER['PHP_SELF'],'links.php') !== false){
				echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"links.css\" />";
			}
		?>
	</head>
	<body>
	<div id="frame">
		<div id="contentheader"></div>
		<div id="contentheadermenu">
			<div class="headermenusub">
				<a class="hoofdlink" href="index.php">Home</a> | 
				<a class="hoofdlink" target="_blank" href="http://www.facebook.com/scubacollege">Facebook forum</a> | 
				<a class="hoofdlink" href="kalender.php">Kalender</a> | 
				<a class="hoofdlink" href="contact.php">Contact</a>
			</div>
		</div>
		<div id="contentleft">
			<!--<div class="boxkopl">Leren duiken</div>-->
			<div class="boxkopl">Duikschool</div>
			<a href="initiatie.php">Gratis duikinitiatie</a><br />
			<a href=""> Leer nu duiken</a><br /><br />
			<a href="">Locatie & planning</a><br />
			<a href="opleidingen.php">Padi duikopleidingen</a><br /><br />
			
			<div class="boxkopl">Club</div>
			<a href="">Informatie</a><br />
			<a href=""> Activiteiten</a><br />
			<a target="_blank" href="http://www.facebook.com/scubacollege#!/scubacollege?sk=photos" > Foto album</a><br /><br />
			
			<div class="boxkopl">Contact</div>
			<a href="">Wie zijn wij ?</a><br />
			
			<div class="boxkopl">Informatief</div>
			<a href="links.php">Interessante links</a>
			
			<?php
			if($ingelogd && $_SESSION['user_level'] >= ADMIN){
				echo "<div class=\"boxkopl\">Admin</div>";
				echo "<a href=\"logout.php\">Uitloggen</a><br />";
				echo "<a href=\"nieuws_toevoegen.php\">Nieuws Item Toevoegen</a><br />";
			}
			if($ingelogd && $_SESSION['user_level'] >= STAFF){
				echo "<div class=\"boxkopl\">Staff</div>";
				echo "<a href=\"logout.php\">Uitloggen</a><br />";
				echo "<a href=\"nieuws_toevoegen.php\">Nieuws Item Toevoegen</a><br />";
			}
			elseif($ingelogd && $_SESSION['user_level'] >= INSTRUCTOR){
				echo "<div class=\"boxkopl\">Instructeur</div>";
				echo "<a href=\"logout.php\">Uitloggen</a><br />";
			}
			elseif($ingelogd && $_SESSION['user_level'] >= USER){
				echo "<div class=\"boxkopl\">Leden</div>";
				echo "<a href=\"logout.php\">Uitloggen</a><br />";
			}
			else{
				require_once('includes/loginform.html');
			}
			?>
			<br clear="all">
		</div>
		<div id="contentcenter">