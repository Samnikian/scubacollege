<?php
require_once('header.php');
$req = filter_input(INPUT_SERVER,'REQUEST_METHOD');
$action = filter_input(INPUT_POST,'action');

if($req==='POST' && $action==='changepassword'){
    
}
elseif($req==='POST' && $action==='changeinfo'){
    //changeinfo
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
}
else{
    //SHOWFORMS
?>
<fieldset>
    <form>
        <label for="oudww"></label><input type="password" id="OudWW" name="" />
        <label for="nieuwwwa"></label><input type="password" id="NieuwWWA" name="NieuwWWA" />
        <label for="nieuwwwb"></label><input type="password" id="NieuwWWB" name="NieuwWWB" />
    </form>
</fieldset>
<?php
}
require_once('footer.php');
?>