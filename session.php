<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();

    if(!array_key_exists("uuid", $_SESSION)) {
        $_SESSION["uuid"] = NULL;
    }
}

if($_SESSION["uuid"]) {
    $session_uuid = $_SESSION["uuid"];
}

?>