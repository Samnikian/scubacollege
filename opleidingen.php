<?php
require_once('header.php');
$obj = new Opleidingen\Admin($db);
echo $obj->processAction();
require_once('footer.php');
?>