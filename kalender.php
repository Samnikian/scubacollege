`  <?php
require_once('header.php');
require_once "includes/JBBCode/Parser.php";
if(true){
    require_once('includes/Event.class.php');
    require_once('includes/DiveEvent.class.php');
    require_once('includes/DiveEventManager.class.php');
    $obj = new DiveEventManager($db);
    //$obj->printEvents();
    echo $obj->getHTMLTable();
}
else{
	echo '<p class="melding">Er staat momenteel niets op de planning!</p>';
}
require_once('footer.php');
?>