<?php
require_once('header.php');
$obj = new DiveEvent\Display($db);
echo $obj->getHTMLTable();
require_once('footer.php');