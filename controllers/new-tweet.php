<?php
include "../helpers/DbConnection.php";
include "../model/Tweet.php";
include "../helpers/AccountRepository.php";
session_start();
$activeUser = $_SESSION["user_id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $dateTime = new DateTime();
         $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
        $tweet = new Tweet((int)$activeUser, $formattedDateTime, $_POST["tweet-new"]);
        var_dump($tweet);
        // insertTweet($_SESSION("user_id"), "2024-01-08 22:44:42", $_POST["tweet-new"])
        $tweet->toEntity();
        header("Location: ../pages/homeView.php");
        
   
}
