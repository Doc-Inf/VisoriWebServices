<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    header("Location: https://www.itisvallauri.net/visori360/index.php");
    die();

?>
    