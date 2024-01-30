 <?php
include_once("./helpers/AccountRepository.php");
include_once("./helpers/TweetRepository.php");
// var_dump(__DIR__);
$tweetRep = new TweetRepository();
$tweets = $tweetRep->getAllTweetsOfFollowed(1);
$acRepo = new AccountRepository();

var_dump($d = $acRepo->getProfilePicture(1));