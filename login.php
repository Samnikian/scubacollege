<?php
require_once('header.php');
echo '<div class="boxkoplboven">Leden - Login</div>';
$mgr = new \Users\User($db);
if (is_array($mgr) and $mgr[0] === false) {
    echo $mgr[1];
} else {
    $mgr->doLogin();
}
require_once('footer.php');
