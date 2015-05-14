<?php
require_once('header.php');
if(isset($_GET['c']) and !empty($_GET['c'])){
    $c = filter_var($_GET['c'],FILTER_SANITIZE_STRING);
    echo $c;
}
else{
    redirect('opleidingen.php');
}
require_once('footer.php');
?>