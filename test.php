<?php

require_once('header.php'); /*
  $db = NULL;
  try {
  $obj = new Opleidingen\Opleiding($db, 1, '', '', '', true, '');
  } catch (Exception $e) {
  echo $e->getMessage();
  }
 */
//echo password_hash("samnikian", PASSWORD_DEFAULT);
//print_r($_SESSION);
/*$u = new \Users\User($db, 0, 'niels@mortelmans.org');
$res = $u->login('samnikian');
if ($res[0] === false) {
    echo $res[1];
}*/
//$u = new \Users\User($db);
//$u->logout();
echo time()-1447965656;
//$b  =new \Users\User($db,'','niels@mortelmans.org');
var_dump($_SESSION);
require_once('footer.php');
