<?php
function getDatabaseConnection() {
    $host = "127.0.0.1";
    $dbname = "broodjesbareindoefening";
    $username = "root";
    $password = "";

    $mysqli = new mysqli($host, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        die("Connection error: " . $mysqli->connect_error);
    }

    return $mysqli;
}
?>
