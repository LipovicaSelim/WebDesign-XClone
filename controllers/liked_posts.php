<?php

declare(strict_types=1);
include_once('../helpers/DbConnection.php');
session_start();
$perdoruesi_id = $_SESSION['user_id'];

$tempDb = new DbConnection();
$dbConnection = $tempDb->dbConnect();

try {

    $query = "SELECT t.tweet_id FROM pelqimet p JOIN tweets t ON p.tweet_id = t.tweet_id WHERE p.liked_by_id = :perdoruesi_id";

    $statement = $dbConnection->prepare($query);
    $statement->bindParam(":perdoruesi_id", $perdoruesi_id);
    $statement->execute();

    $likedTweets = $statement->fetchAll(PDO::FETCH_ASSOC);

    header("Content-Type: application/json");
    echo json_encode($likedTweets);
    // var_dump($likedTweets);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Failed to retrieve the tweets that the user has liked!"]);
}

error_log("End of liked_posts.php script");
