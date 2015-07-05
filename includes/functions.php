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
