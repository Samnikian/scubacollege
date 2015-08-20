<?php
require_once('header.php');
echo '<div class="boxkoplboven">Leden - Logout</div>';
$mgr = new \Users\User($db);
$mgr->doLogout();
require_once('footer.php');
?>