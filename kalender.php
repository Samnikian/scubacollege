<?php
require_once('header.php');
echo '<div class="boxkoplboven">Duikschool - Club - Kalender</div>';
$obj = new DiveEvent\Display($db);
echo $obj->getHTMLTable();
require_once('footer.php');