<?php
require_once('header.php');
echo '<div class="boxkoplboven">Leden - Login</div>';
$mgr = new \Users\User($db);
$mgr->doLogin();
require_once('footer.php');