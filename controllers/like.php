<?php

declare(strict_types=1);
include_once("../helpers/DbConnection.php");
include_once("../helpers/TweetRepository.php");
session_start();

function getLikesForTweet($tweet_id)
{
    $tweetRep = new TweetRepository();
    return $tweetRep->getLikesForTweet($tweet_id);
}


$tempDb = new DbConnection();
$dbConnection = $tempDb->dbConnect();
$perdoruesi_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if (isset($data["like"])) {
        $tweet_id = $data["tweet_id"];
        $like = $data["like"] === true ? 1 : 0;

        try {
            $dbConnection->beginTransaction();

            $sqlCheckLike = "SELECT COUNT(*) FROM pelqimet WHERE interaksioni_id IN (SELECT interaksioni_id FROM interaksionet WHERE tweet_id = :tweet_id AND perdoruesi_id = :perdoruesi_id)";
            $stmtCheckLike = $dbConnection->prepare($sqlCheckLike);
            $stmtCheckLike->bindParam(":tweet_id", $tweet_id);
            $stmtCheckLike->bindParam(":perdoruesi_id", $perdoruesi_id);
            $stmtCheckLike->execute();
            $hasLiked = $stmtCheckLike->fetchColumn();

            if ($hasLiked) {
                $sqlDeleteLike = "DELETE FROM pelqimet WHERE interaksioni_id IN (SELECT interaksioni_id FROM interaksionet WHERE tweet_id = :tweet_id AND perdoruesi_id = :perdoruesi_id)";
                $stmtDeleteLike = $dbConnection->prepare($sqlDeleteLike);
                $stmtDeleteLike->bindParam(":tweet_id", $tweet_id);
                $stmtDeleteLike->bindParam(":perdoruesi_id", $perdoruesi_id);
                $stmtDeleteLike->execute();

                $sqlDeleteInteraksionet = "DELETE FROM interaksionet WHERE tweet_id = :tweet_id AND perdoruesi_id = :perdoruesi_id";
                $stmtDeleteInteraksionet = $dbConnection->prepare($sqlDeleteInteraksionet);
                $stmtDeleteInteraksionet->bindParam(":tweet_id", $tweet_id);
                $stmtDeleteInteraksionet->bindParam(":perdoruesi_id", $perdoruesi_id);
                $stmtDeleteInteraksionet->execute();
                $dbConnection->commit();
                echo json_encode([
                    "success" => true,
                    "message" => "Tweet unliked successfully",
                    "isLiked" => !$hasLiked
                ]);
            } else {
                $sqlLikeTweet = "INSERT INTO interaksionet (tweet_id, perdoruesi_id, krijuar_me, lloji_interaksionit) VALUES (:tweet_id, :perdoruesi_id, NOW(), 1)";
                $stmtLikeTweet = $dbConnection->prepare($sqlLikeTweet);
                $stmtLikeTweet->bindParam(":tweet_id", $tweet_id);
                $stmtLikeTweet->bindParam(":perdoruesi_id", $perdoruesi_id);
                $stmtLikeTweet->execute();

                $interaksioni_id = $dbConnection->lastInsertId();

                $sqlInsertLike = "INSERT INTO pelqimet (interaksioni_id, liked_by_id, tweet_id) VALUES (:intrId, :usrId, :tdwId)";
                $stmtInsertLike = $dbConnection->prepare($sqlInsertLike);
                $stmtInsertLike->bindParam(":intrId", $interaksioni_id);
                $stmtInsertLike->bindParam(":usrId", $perdoruesi_id);
                $stmtInsertLike->bindParam(":tdwId", $tweet_id);
                $stmtInsertLike->execute();
                $dbConnection->commit();
                echo json_encode(["success" => true, "message" => "Tweet liked successfully", "isLiked" => !$hasLiked]);
            }
        } catch (PDOException $e) {
            $dbConnection->rollBack();
            echo json_encode(["success" => false, "message" => "failed to perform a like operation: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "missing like"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
