<?php

require_once('header.php');

//unset($_SESSION['addEvent']);
$mgr = new DiveEventManager($db);
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            $_SESSION['action'] = 'action';
            echo $mgr->addEventForm();
        break;
        case 'edit':
            $_SESSION['action'] = 'edit';
            echo $mgr->editEventForm();
        break;
        case 'delete':
            $_SESSION['action'] = 'delete';
            echo $mgr->deleteEventForm();
        break;
        default:
            echo $mgr->addEventForm();
        break;
    }
}
else{
    if(isset($_POST['action'])){
        echo $mgr->deleteEventForm();
    }
    else{
        echo $mgr->addEventForm();
    }
}
require_once('footer.php');
?>