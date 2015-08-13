<?php
require_once('header.php');
echo '<div class="boxkoplboven">Duikschool - PADI Opleidingen</div>';
$obj = new Opleidingen\Admin($db);
echo $obj->processAction();
require_once('footer.php');
?>