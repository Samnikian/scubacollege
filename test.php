<?php

require_once('header.php');
$db = NULL;
try {
    $obj = new Opleidingen\Opleiding($db, 1, '', '', '', true, '');
} catch (Exception $e) {
    echo $e->getMessage();
}
require_once('footer.php');
