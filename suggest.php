<?php
require_once('includes/config.php');
require_once('classes/autoSuggest.php');
$suggest = new autoSuggest();
echo $suggest->getOutput();