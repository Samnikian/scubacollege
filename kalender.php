<?php

require_once('header.php');
require_once "includes/JBBCode/Parser.php";
if (true) {
    $obj = new DiveEvent\Display($db);
    echo $obj->getHTMLTable();
} else {
    echo '<p class="melding">Er staat momenteel niets op de planning!</p>';
}
require_once('footer.php');
?>