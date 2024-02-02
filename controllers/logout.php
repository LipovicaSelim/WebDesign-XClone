<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $_SESSION = array();

    session_destroy();

    header("Location: ../pages/landingPage.php");
    exit();
} else {
    header("Location: ../pages/landingPage.php");
    exit();
}
