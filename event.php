<?php

require_once('header.php');
$obj = new DiveEvent\Admin($db);
echo $obj->processAction();
require_once('footer.php');
