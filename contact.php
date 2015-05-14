<?php
require_once('header.php');
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] != 'POST'){
	if(isset($_SESSION['contact'])){
		$data = unserialize(urldecode($_SESSION['contact']));
		$naam = $data['naam'];
		$voornaam = $data['voornaam'];
		$email = $data['email'];
		$gsm = $data['gsm'];
		$onderwerp = $data['onderwerp'];
		$bericht = $data['bericht'];
		unset($_SESSION['contact']);
	}
	else{
		$naam = '';
		$voornaam = '';
		$email = '';
		$gsm = '';
		$onderwerp = '';
		$bericht = '';
	}
?>
<div id="contact">
	<p>
		U kan ons contacteren via info@scubacollege.be of op 049999895. U kan ook gebruik maken van onderstaand formulier om ons een bericht te sturen.
	</p>
	<fieldset>
		<legend>Stuur ons een bericht</legend>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label for="naam">Naam</label><input type="text" name="naam" id="naam" value="<?php echo $naam; ?>" /><br />
			<label for="voornaam">Voornaam</label><input type="text" name="voornaam" id="voornaam" value="<?php echo $voornaam; ?>" /><br />
			<label for="gsm">GSM/Telefoon</label><input type="text" name="gsm" id="gsm" value="<?php echo $gsm; ?>" /><br />
			<label for="email">Email adres</label><input type="text" name="email" id="email" value="<?php echo $email; ?>" /><br />
			<label for="onderwerp">Onderwerp</label><input type="text" name="onderwerp" id="onderwerp" value="<?php echo $onderwerp; ?>" /><br />
			<p class="bericht">
				<label for="bericht">Bericht</label><br />
				<textarea name="bericht" id="bericht" /><?php echo $bericht; ?></textarea>
			</p>
			<br />
			<div id="recaptcha" class="g-recaptcha" data-sitekey="6LeuJgETAAAAABbDWzNMWgjZNvrFxzVdjg_bUNOz"></div><br />
			<input type="submit" value="Verzenden" />
		</form>
	</fieldset>
</div>
<?php
}
elseif(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['naam'],$_POST['voornaam'],$_POST['gsm'],$_POST['email'],$_POST['onderwerp'],$_POST['bericht'],$_POST['g-recaptcha-response'])){
		$naam = filter_var($_POST['naam'],FILTER_SANITIZE_STRING);
		$voornaam = filter_var($_POST['voornaam'],FILTER_SANITIZE_STRING); 
		$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
		$gsm = filter_var($_POST['gsm'],FILTER_SANITIZE_STRING);
		$onderwerp = filter_var($_POST['onderwerp'],FILTER_SANITIZE_STRING);
		$bericht = filter_var($_POST['bericht'],FILTER_SANITIZE_STRING);
		$response = $_POST['g-recaptcha-response'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$query = 'https://www.google.com/recaptcha/api/siteverify?secret='.CAPTCHA_SECRET.'&response='.$response.'&remoteip='.$ip;
		$query_result = json_decode(file_get_contents($query),true);
		$error = false;
		$errormsg = '<ul>';
		if($query_result["success"]===false){
			$error = true;
			$errormsg.= '<li>Je moet bewijzen dat je geen robot bent.</li>';
		}
		if(strlen($naam) < 3){
			$error = true;
			$errormsg.= '<li>Je naam moet minstens 3 tekens bevatten.</li>';
		}
		if(strlen($voornaam) < 2){
			$error = true;
			$errormsg.= '<li>Je voornaam moet minstens 2 tekens bevatten.</li>';
		}
		if(strlen($gsm) < 9){
			$error = true;
			$errormsg.= '<li>Je gsm/telefoonnummer is niet geldig.</li>';
		}
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$error = true;
			$errormsg.= '<li>Gelieve een geldig email adres op te geven.</li>';
		}
		if(strlen($onderwerp) < 4){
			$error = true;
			$errormsg.= '<li>Je onderwerp moet minstens 4 tekens bevatten.</li>';
		}
		if(strlen($bericht) < 10){
			$error = true;
			$errormsg.= '<li>Je bericht moet minstens 10 tekens bevatten.</li>';
		}
		$errormsg.='</ul>';
		if(!$error){
			require_once('includes/PHPMailerAutoload.php');
			$mail             = new PHPMailer(); // defaults to using php "mail()"
                        $mail->IsSMTP();
                        if(DEBUG){
                                $mail->SMTPDebug  = 2;
                        }
                        $mail->SMTPAuth   = true;
                        $mail->Host       = SMTP_HOST;
                        $mail->Port       = SMTP_PORT;
                        $mail->Username   = SMTP_USER;
                        $mail->Password   = SMTP_PASSWORD;
                        $mail->SMTPSecure = 'ssl';
			$body = file_get_contents('includes/contacttemplate.html');
			$body = str_replace('REPLACEACHTERNAAM',$naam,$body);
			$body = str_replace('REPLACEVOORNAAM',$voornaam,$body);
			$body = str_replace('REPLACEGSM',$gsm,$body);
			$body = str_replace('REPLACEEMAIL',$email,$body);
			$body = str_replace('REPLACEONDERWERP',$onderwerp,$body);
			$body = str_replace('REPLACEBERICHT',nl2br($bericht),$body);
			$mail->SetFrom(MAIL_FROM, 'Scubacollege');
			$mail->AddReplyTo($email,$naam." ".$voornaam);
			$mail->AddAddress(CONTACT_MAIL, "Scubacollege");
			$mail->Subject    = "Bericht via scubacollege.be contactformulier.";
			$mail->AltBody    = "Om dit bericht te kunnen lezen heb je een email client nodig die HTML ondersteund!";
			$mail->MsgHTML($body);
			$mail->AddEmbeddedImage('images/mailheader.jpg','mailheader','mailheader.jpg','base64','image/jpeg');
			if(!$mail->Send()) {
			  echo "<p class=\"melding\">Mailer Error: ".$mail->ErrorInfo."</p>";
			}
			else{
			  echo "<p class=\"melding\">Uw bericht is succesvol verzonden!</p>";
			}
		}
		else{
			$data['naam'] = $naam;
			$data['voornaam'] = $voornaam; 
			$data['email'] = $email;
			$data['gsm'] = $gsm;
			$data['onderwerp'] = $onderwerp;
			$data['bericht'] = $bericht;
			$_SESSION['contact'] = urlencode(serialize($data));
			echo '<div class="errorr">Gelieve de volgende fouten te corrigeren:<br />';
			echo $errormsg;
			echo '<a href="contact.php">Klik hier om terug te gaan.</a></div>';
		}
	}
	else{
		header('Location: contact.php');
	}
}
require_once('footer.php');
?>