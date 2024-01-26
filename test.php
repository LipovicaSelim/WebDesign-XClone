 <?php
declare(strict_types=1);
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");
// var_dump(__DIR__);
$activeSessionUser = 1;
$tweetRep = new TweetRepository();
$tweets = $tweetRep->getAllTweetsByUserId(1);
$accountRepo = new AccountRepository();
$accountUserFollowsTemp = $accountRepo->getAccountsUserFollows($activeSessionUser);
$accountUserFollows = $accountUserFollowsTemp[2];
$feedTweets = [];
// foreach ($accountUserFollows as $followedAccount) {
//     var_dump($accountUserFollows);
//     // $tweetsOfFollowedAccount = $tweetRep->getAllTweetsByUserId($followedAccount);
//     var_dump($followedAccount);
// }

var_dump($accountUserFollows);


$feedTweets = [];

foreach ($tweets as $tweet) {
    
 }