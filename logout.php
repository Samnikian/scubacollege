<?php
require_once('header.php');
$_SESSION['ingelogt'] = false;
$_SESSION['user_level'] = 0;
unset($_SESSION['ingelogt']);
unset($_SESSION['ingelogt']);
session_destroy();
echo '<div id="content">Je werd succesvolg uitgelogt!</div>';
redirect();
require_once('footer.php');
?>