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
        
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
        
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
        <script type="text/javascript" src="includes/addthisevent.js"></script>
    </head>
    <body>
        <?php require_once('includes/fbsnippet.html'); ?>
        <div id="frame">
            <div id="contentheader"></div>
            <div id="contentcenter">