<?php
declare(strict_types=1);
include "./helpers/DbConnection.php";
include_once "./helpers/TweetRepository.php";

$tweetRep = new TweetRepository();
$tweets = $tweetRep->getAllTweetsByUserId(3);

    // var_dump($tweets);
$tw1 = $tweetRep->getAllTweetsByUserFollows(1);
foreach($tw1 as $tweetRep){
    var_dump($tweetRep["ndjek_id"]);
}

 