<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: landingPage.php");
    exit;
}

if ($_SESSION['isAdmin'] != true && strpos($_SERVER['REQUEST_URI'], '/pages/dashboard.php') !== false) {
    header("Location: homeView.php");
    exit;
}
