<?php 
include '../controllers/protected.php';
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");
$acRepo = new AccountRepository();
$twRepo = new TweetRepository();
$id = $_GET['id'];
$account = $acRepo->getAccountById($id)[0];
$tweets =  $twRepo->getAllTweetsByUserId($id);
?>

<h1>Manage Account</h1>
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
                            <img id="deleteButton" src="images/delete.svg" alt="delete button" style="heigt:20px; width:20px;">
                        </div>
                    </div>
                    </a>
    </div>

    <h2>Manage Tweets</h2>

    <div class="tweets-ctn">
        <?php foreach($tweets as $tweet){ ?>
        <div class="user-tweet">
            <div class="tweet-id">
            <?php echo($tweet["tweet_id"]) ?>
            </div>
        <div class="tweet-body">
            <?php echo($tweet["tweet_body"]) ?>
        </div>
        <div class="tweet-media"
           <?php $tweetMedias = $twRepo->getImagesForTweet($tweet["tweet_id"]);
                        if (count($tweetMedias) > 0) {
                            foreach ($tweetMedias as $tweetMedia) { ?>
                                <div class="picture-post-ctn">
                                    <img class="picture-post" src=<?php echo ($tweetMedia[0]) ?> alt="post pic example">
                                </div>
                            <?php }
                        } ?>
        </div>
        <div class="created-at">
            <?php echo($tweet["krijuar_me"]) ?>
        </div>
        <div class="delete-tweet">
            <img id="deleteButton" src="images/delete.svg" alt="delete button" style="heigt:20px; width:20px;">
        </div>
     </div>
     <?php } ?>
    </div>