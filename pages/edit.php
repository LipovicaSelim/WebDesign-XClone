<?php 
include '../controllers/protected.php';
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");
$acRepo = new AccountRepository();
$twRepo = new TweetRepository();
$id = $_GET['id'];
$account = $acRepo->getAccountById($id)[0];
$tweets =  $twRepo->getAllTweetsByUserId($id);
var_dump($account);
?>

 <div class="anonuncements-ctn">
                        <a href='edit.php?id=<?php echo($account["perdoruesi_id"]) ?>'>
                        <div class="user-cnt">
                        <div class="username">
                        <?php echo($account["perdoruesi_id"]." ".$account["pseudonimi"]) ?>
                        </div>
                        <div class="tweetCount">
                            <?php echo($acRepo->getTweetCount($account["perdoruesi_id"])) ?>
                        </div>
                        <div class="createdAt">
                            <?php echo($account["krijuar_me"])?>
                        </div>
                        <div class="interaksionet">
                         <?php echo($acRepo->getInteractionsCount($account["perdoruesi_id"])) ?>
                        </div>
                        <div class="edit-user-ctn">
                            <img id="closeButton" src="images/closeButton.svg" alt="edit button">
                        </div>
                    </div>
                    </a>
    </div>

    <div class="tweets-ctn">
        <?php foreach($tweets as $tweet){ ?>
        <div class="user-tweet">
            <div class="tweet-id">
            <?php echo($tweet["tweet_id"]) ?>
            </div>
        <div class="tweet-body">
            <?php echo($tweet["tweet_body"]) ?>
        </div>
        <div class="tweet-media">
            <?php echo($twRepo->getImagesForTweet($tweet["tweet_id"])) ?>
        </div>
        <div class="created-at">
            <?php echo($tweet["krijuar_me"]) ?>
        </div>
        <div class="delete-tweet">
            <!-- me shtu buton qe e bon delete tweet -->
        </div>
     </div>
     <?php } ?>
    </div>