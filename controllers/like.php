<?php

declare(strict_types=1);

include_once("../helpers/DbConnection.php");

$tempDb = new DbConnection();
$dbConnection = $tempDb->dbConnect();

if(isset($_POST["like"])){
    $tweet_id = $_POST["post_id"];
    $user_id = 3; // session user

     $sql = "INSERT INTO pelqimet (tweet_id, userLikes_id) VALUES (:tdwId, :usrId)";
     $ddlStatement = $dbConnection->prepare($sql);

     $ddlStatement->bindParam(":tdwId", $tweet_id);
     $ddlStatement->bindParam(":usrId", $user_id);

     $ddlStatement->execute();

    echo "Like added successfully!";
}