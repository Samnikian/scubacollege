<?php

require_once('header.php');
$usr = new Users\Manager($db);
echo $usr->newUser();
echo $usr->changePassword();
echo $usr->banUser();

require_once('footer.php');
?>