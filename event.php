<?php

require_once('header.php');

$mgr = NULL;
$getaction = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$postaction = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

switch ($getaction) {
    case 'add':
        $mgr = new DiveEventAddManager($db);
        echo $mgr->addEventForm();
        break;
    case 'edit':
        $mgr = new DiveEventEditManager($db);
        echo $mgr->editEventForm();
        break;
    case 'delete':
        $mgr = new DiveEventDeleteManager($db);
        echo $mgr->deleteEventForm();
        break;
}
switch ($postaction) {
    case 'edit':
        $mgr = new DiveEventEditManager($db);
        echo $mgr->editEventForm();
        break;
    case 'delete':
        $mgr = new DiveEventDeleteManager($db);
        echo $mgr->deleteEventForm();
        break;
    default:
        $mgr = new DiveEventAddManager($db);
        echo $mgr->addEventForm();
        break;
}
require_once('footer.php');
