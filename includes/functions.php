<?php

function autoLoader($class) {
    $filename = DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    //echo $filename;
    include $filename;
}

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function isIngelogd() {
    if (isset($_SESSION['ingelogt']) && isset($_SESSION['user_level']) && $_SESSION['ingelogt']) {
        return true;
    } else {
        return false;
    }
}

function haalNieuwsArtikel($id, &$db) {
    $query = "SELECT * FROM `nieuws` WHERE `id`='" . $id . "';";
    if ($result = $db->query($query)) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function redirect($page) {
    header('refresh: 5; url=index.php');
    echo '<p class="melding"><a href="' . $page . '">U word binnen 5 seconden doorverwezen naar de startpagina, klik hier indien dit niet gebeurd.</a></p>';
}

function IsDate($Str) {
    $Stamp = strtotime($Str);
    $Month = date('m', $Stamp);
    $Day = date('d', $Stamp);
    $Year = date('Y', $Stamp);
    if (!empty($Stamp)) {
        return checkdate($Month, $Day, $Year);
    } else {
        return false;
    }
}

function toMoney($val, $symbol = '€', $r = 2) {

    $n = filter_var($val, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $c = is_float($n) ? 1 : number_format($n, $r);
    $d = '.';
    $t = ',';
    $sign = ($n < 0) ? '-' : '';
    $i = $n = number_format(abs($n), $r);
    $j = (($j = strlen($i)) > 3) ? $j % 3 : 0;
    var_dump($i);
    return $symbol . $sign . ($j ? substr($i, 0, $j) + $t : '') . preg_replace('/(\d{3})(?=\d)/', "$1" + $t, substr($i, $j));
}
