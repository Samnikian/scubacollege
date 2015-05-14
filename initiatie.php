<?php
require_once('header.php');
?>
<div id="initiatie">
    <?php
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
        if (isset($_SESSION['initiatie'])) {
            $data = unserialize(urldecode($_SESSION['initiatie']));
            $naam = $data['naam'];
            $voornaam = $data['voornaam'];
            $email = $data['email'];
            $telefoon = $data['telefoon'];
            $mededeling = $data['mededeling'];
            $geboortedatum = $data['geboortedatum'];
            $adres = $data['adres'];
            $postcode = $data['postcode'];
            $gemeente = $data['gemeente'];
            $voorkeur = $data['voorkeur'];
            unset($_SESSION['initiatie']);
        } else {
            $naam = '';
            $voornaam = '';
            $email = '';
            $telefoon = '';
            $mededeling = '';
            $geboortedatum = '';
            $adres = '';
            $postcode = '';
            $gemeente = '';
            $voorkeur = '';
        }
        ?>
        <h1>Duikschool - Gratis Duikinitiatie</h1>
        <p>
            <strong>Wat gaan we allemaal doen tijdens zo'n initiatie?</strong><br />
            Eerst geven we je een korte briefing over de gebruikte apparatuur en de basisprincipes van het 
            persluchtduiken. Daarna ga je al snel onder professionele begeleiding 
            het zwembad in en neem je al snel je eerste ademteugen onder water !
        </p>
        <p>
            <strong>Waar en wanneer gaan deze initiaties door?</strong><br />
            De initiaties gaan door in het Maanhoevebad, in Sint-Katelijne-Waver bij Mechelen op zaterdagmiddag 
            of op vrijdagavond in zwembad De Nekkerpool in Mechelen. Onderaan kan u een voorkeurstijdstip selecteren. 
            U krijgt van ons nog een bevestiging per e-mail.<!--Kontich wegdoen?????-->
        </p>
        <p>
            <strong>Zijn er vereisten?</strong><br />
            De minimumleeftijd is 10 jaar. U dient zich fijn en comfortabel te voelen in het water.
        </p>
        <p>
            <strong>Wat moet ik meebrengen?</strong>
            Zwemgerief en een handdoek!
        </p>
        <p>
            <strong>Hoe kan ik me inschrijven?</strong><br />
            Vul het onderstaande inschrijvingsformulier in en druk op verzend. Wij contacteren U voor een afspraak !<!--telefoon????-->
        </p>
        <p>
            <strong>Wat kan ik doen na deze duikinitiatie?</strong><br />
            Wanneer je het programma hebt afgerond, heb je reeds de 1ste stap gezet in de richting van een 
            internationaal erkend duikbrevet : het <a href="">PADI Open Water Diver</a><!--link invullen!!!!-->
            brevet. Vraag je instructeur om meer informatie.
        </p>
        <fieldset>
            <legend><strong>Schrijf je hier in voor een <u>GRATIS</u> duikinitiatie :</strong></legend>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="naam">Naam</label><input type="text" name="naam" id="naam" value="<?php echo $naam; ?>" /><br />
                <label for="voornaam">Voornaam</label><input type="text" name="voornaam" id="voornaam" value="<?php echo $voornaam; ?>" /><br />
                <label for="geboortedatum">Geboortedatum (dd/mm/jjjj)</label><input type="text" name="geboortedatum" id="geboortedatum" value="<?php echo $geboortedatum; ?>" /><br />
                <label for="adres">Adres</label><input type="text" name="adres" id="adres" value="<?php echo $adres; ?>" /><br />
                <label for="postcode">Postcode</label><input type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>" /><br />
                <label for="gemeente">Gemeente</label><input type="text" name="gemeente" id="gemeente" value="<?php echo $gemeente; ?>" /><br />
                <label for="email">Email</label><input type="text" name="email" id="email" value="<?php echo $email; ?>" /><br />
                <label for="telefoon">Telefoon of GSM</label><input type="text" name="telefoon" id="telefoon" value="<?php echo $telefoon; ?>" /><br />
                <label for="voorkeur">Voorkeur tijdsstip</label>
                <select name="voorkeur" id="voorkeur">
                    <?php
                    switch ($voorkeur) {
                        case 'zat1':
                            ?>
                            <option value="zat1" selected>Zaterdag van 13u45 tot 15u30</option>
                            <option value="zat2">Zaterdag van 15u15 tot 17u00</option>
                            <option value="vrij1">Vrijdag van 20u30 tot 22u00</option>
                            <?php
                            break;
                        case 'zat2':
                            ?>
                            <option value="zat1">Zaterdag van 13u45 tot 15u30</option>
                            <option value="zat2" selected>Zaterdag van 15u15 tot 17u00</option>
                            <option value="vrij1">Vrijdag van 20u30 tot 22u00</option>
                            <?php
                            break;
                        case 'vrij1':
                            ?>
                            <option value="zat1">Zaterdag van 13u45 tot 15u30</option>
                            <option value="zat2">Zaterdag van 15u15 tot 17u00</option>
                            <option value="vrij1" selected>Vrijdag van 20u30 tot 22u00</option>
                            <?php
                            break;
                        default:
                            ?>
                            <option value="zat1" selected>Zaterdag van 13u45 tot 15u30</option>
                            <option value="zat2">Zaterdag van 15u15 tot 17u00</option>
                            <option value="vrij1">Vrijdag van 20u30 tot 22u00</option>
                            <?php
                            break;
                    }
                    ?>
                </select>
                <p class="mededeling">Extra mededeling (niet verplicht)
                    <textarea class="mededeling" name="mededeling"><?php echo $mededeling; ?></textarea></p><br /><br />
                <div id="recaptcha" class="g-recaptcha" data-sitekey="6LeuJgETAAAAABbDWzNMWgjZNvrFxzVdjg_bUNOz"></div><br />
                <input type="submit" value="Verzenden!" />
            </form>
        </fieldset>
        <?php
    } else {
        if (isset($_POST['naam'], $_POST['voornaam'], $_POST['geboortedatum'], $_POST['adres'], $_POST['postcode'], $_POST['gemeente'], $_POST['email'], $_POST['telefoon'], $_POST['mededeling'], $_POST['voorkeur'], $_POST['g-recaptcha-response'])) {
            $response = $_POST['g-recaptcha-response'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $naam = htmlspecialchars($_POST['naam']);
            $voornaam = htmlspecialchars($_POST['voornaam']);
            $geboortedatum = htmlspecialchars($_POST['geboortedatum']);
            $adres = htmlspecialchars($_POST['adres']);
            $postcode = htmlspecialchars($_POST['postcode']);
            $gemeente = htmlspecialchars($_POST['gemeente']);
            $email = $_POST['email'];
            $telefoon = htmlspecialchars($_POST['telefoon']);
            $mededeling = htmlspecialchars($_POST['mededeling']);
            $query = 'https://www.google.com/recaptcha/api/siteverify?secret=' . CAPTCHA_SECRET . '&response=' . $response . '&remoteip=' . $ip;
            $query_result = json_decode(file_get_contents($query), true);
            $error = false;
            $errormsg = '<ul>';
            if ($query_result["success"] === false) {
                $error = true;
                $errormsg.= '<li>Je moet bewijzen dat je geen robot bent.</li>';
            }
            if (strlen($naam) < 3) {
                $error = true;
                $errormsg.= '<li>Je naam moet minstens 3 tekens bevatten.</li>';
            }
            if (strlen($voornaam) < 2) {
                $error = true;
                $errormsg.= '<li>Je voornaam moet minstens 2 tekens bevatten.</li>';
            }
            if (strlen($telefoon) < 9) {
                $error = true;
                $errormsg.= '<li>Je gsm/telefoonnummer is niet geldig.</li>';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = true;
                $errormsg.= '<li>Gelieve een geldig email adres op te geven.</li>';
            }
            if (strlen($adres) < 3) {
                $error = true;
                $errormsg.= '<li>Je adres moet minstens 3 tekens bevatten.</li>';
            }
            if (strlen($postcode) < 3) {
                $error = true;
                $errormsg.= '<li>Je postcode moet minstens 3 tekens bevatten.</li>';
            }
            if (strlen($gemeente) < 3) {
                $error = true;
                $errormsg.= '<li>Je gemeente moet minstens 3 tekens bevatten.</li>';
            }
            if (strlen($geboortedatum) < 3) {
                $error = true;
                $errormsg.= '<li>Je geboortedatum moet geldig zijn.</li>';
            }
            if (!$error) {
                switch ($_POST['voorkeur']) {
                    case 'zat1':
                        $voorkeur = 'Zaterdag van 13u45 tot 15u30';
                        break;
                    case 'zat2':
                        $voorkeur = 'Zaterdag van 15u15 tot 17u00';
                        break;
                    case 'vrij1':
                        $voorkeur = 'Vrijdag van 20u30 tot 22u00';
                        break;
                    default:
                        $voorkeur = 'Vrijdag van 20u30 tot 22u00';
                        break;
                }
                $to = 'info@mortelmans.org';
                require_once('includes/PHPMailerAutoload.php');
                $mail = new PHPMailer(); // defaults to using php "mail()"
                $mail->IsSMTP();
                if (DEBUG) {
                    $mail->SMTPDebug = 2;
                }
                $mail->SMTPAuth = true;
                $mail->Host = SMTP_HOST;
                $mail->Port = SMTP_PORT;
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = 'ssl';
                $body = file_get_contents('includes/initiatietemplate.html');
                $body = str_replace('REPLACEACHTERNAAM', $naam, $body);
                $body = str_replace('REPLACEVOORNAAM', $voornaam, $body);
                $body = str_replace('REPLACEGSM', $telefoon, $body);
                $body = str_replace('REPLACEGEBOORTEDATUM', $geboortedatum, $body);
                $body = str_replace('REPLACEADRES', $adres, $body);
                $body = str_replace('REPLACEPOSTCODE', $postcode, $body);
                $body = str_replace('REPLACEGEMEENTE', $gemeente, $body);
                $body = str_replace('REPLACEEMAIL', $email, $body);
                $body = str_replace('REPLACEVOORKEUR', $voorkeur, $body);
                $body = str_replace('REPLACEBERICHT', nl2br($mededeling), $body);
                $mail->SetFrom(MAIL_FROM, 'Scubacollege');
                $mail->AddReplyTo($email, $naam . " " . $voornaam);
                $mail->AddAddress(INITIATIE_MAIL, "Scubacollege");
                $mail->Subject = "Initiatieaanvraag via scubacollege.be";
                $mail->AltBody = "Om dit bericht te kunnen lezen heb je een email client nodig die HTML ondersteund!";
                $mail->MsgHTML($body);
                $mail->AddEmbeddedImage('images/mailheader.jpg', 'mailheader', 'mailheader.jpg', 'base64', 'image/jpeg');
                if (!$mail->Send()) {
                    echo "<p class=\"melding\">Mailer Error: " . $mail->ErrorInfo . "</p>";
                } else {
                    echo "<p class=\"melding\">Uw aanvraag is succesvol verzonden!</p>";
                }
            } else {
                $data['naam'] = $naam;
                $data['voornaam'] = $voornaam;
                $data['email'] = $email;
                $data['telefoon'] = $telefoon;
                $data['mededeling'] = $mededeling;
                $data['geboortedatum'] = $geboortedatum;
                $data['adres'] = $adres;
                $data['postcode'] = $postcode;
                $data['gemeente'] = $gemeente;
                $data['voorkeur'] = $_POST['voorkeur'];
                $_SESSION['initiatie'] = urlencode(serialize($data));
                echo '<div class="errorr">Gelieve de volgende fouten te corrigeren:<br />';
                echo $errormsg;
                echo '<a href="initiatie.php">Klik hier om terug te gaan.</a></div>';
            }
        } else {
            echo 'Er is een fout opgetreden.';
        }
    }
    ?>
</div>
    <?php
    require_once('footer.php');
    ?>