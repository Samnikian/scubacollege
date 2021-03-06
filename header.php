<?php
ob_start();
session_start();
session_regenerate_id();
date_default_timezone_set('Europe/Brussels');
error_reporting(E_ALL);
//$_SESSION['ingelogt'] = true;
//$_SESSION['user_level'] = 2;
require_once('includes/config.php');
$db = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
if (DEBUG and $db->connect_errno > 0) {
    die('<span class="error">Unable to connect to database [' . $db->connect_error . ']</span>');
}
require_once('includes/functions.php');
spl_autoload_register('autoLoader');
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
        <link rel="icon" type="image/ico" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="CSS/opmaak.php" />
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
        <script src="googleAutoComplete.js"></script>
        <?php
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
            if (strpos(filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_URL), 'contact.php') !== false or strpos($_SERVER['PHP_SELF'], 'initiatie.php') !== false) {
                echo "<script src='https://www.google.com/recaptcha/api.js'></script>";
            }
        }
        ?>
        <?php
        if (strpos(filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_URL), 'links.php') !== false) {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"CSS/links.css\" />";
        }
        ?>
        <link rel="stylesheet" type="text/css" href="CSS/addThisEvent.css" />
        <script type="text/javascript" src="https://addthisevent.com/libs/ate-latest.min.js"></script>
        <!-- AddThisEvent Settings -->
        <script type="text/javascript">
            addthisevent.settings({
                license: "replace-with-your-licensekey",
                css: false,
                outlook: {show: true, text: "Outlook Calendar"},
                google: {show: true, text: "Google Calendar"},
                yahoo: {show: true, text: "Yahoo Calendar"},
                outlookcom: {show: true, text: "Outlook.com"},
                appleical: {show: true, text: "Apple iCalendar"},
                facebook: {show: true, text: "Facebook Event"},
                dropdown: {order: "appleical,google,outlook,outlookcom,facebook,yahoo"}
            });
        </script>
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
                <a href="initiatie.php">Duikinitiatie</a><br />
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
                if ($ingelogd) {
                    switch ($_SESSION['user_level']) {
                        case ADMIN:
                            echo "<div class=\"boxkopl\">Admin</div>";
                            echo "<a href=\"nieuws_toevoegen.php\">Nieuws Item Toevoegen</a><br />";
                            echo "<a href=\"event_toevoegen.php\">Kalender Item Toevoegen</a><br />";
                            echo "<a href=\"opleidingen.php?action=add\">Opleiding Toevoegen</a><br />";
                            break;
                        case STAFF:
                            echo "<div class=\"boxkopl\">Staff</div>";
                            echo "<a href=\"nieuws_toevoegen.php\">Nieuws Item Toevoegen</a><br />";
                            echo "<a href=\"event.php\">Kalender Item Toevoegen</a><br />";
                            echo "<a href=\"opleidingen.php?action=add\">Opleiding Toevoegen</a><br />";
                            break;
                        case INSTRUCTOR:
                            echo "<div class=\"boxkopl\">Instructeur</div>";
                            break;
                        case USER:
                            echo "<div class=\"boxkopl\">Leden</div>";
                            break;
                    }
                    echo "<a href=\"logout.php\">Uitloggen</a><br />";
                } else {
                    require_once('includes/loginform.html');
                }
                ?>
                <br clear="all">
            </div>
            <div id="contentcenter">