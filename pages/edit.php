<?php
include '../controllers/protected.php';
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");
$acRepo = new AccountRepository();
$twRepo = new TweetRepository();
$id = $_GET['id'];
$account = $acRepo->getAccountById($id)[0];
$tweets = $twRepo->getAllTweetsByUserId($id);

             if (isset($_POST["delete-cmt-btn"])) {
                 $twToDelete = $_POST['tweet_id'];
                 $twRepo->deleteTweetById($twToDelete);
             }
            
    
            
            

?>



<link rel="stylesheet" href="../style/edit.css">
<a href="#" onclick="history.back(); ;">
    <img id="back-arrow" src="images/back-arrow-edit.svg" alt="backarrow">
</a>
<h1>Manage Account</h1>
<div class="anonuncements-ctn">
    <a href='edit.php?id=<?php echo ($account["perdoruesi_id"]) ?>'>
        <div class="user-cnt">

            <div class="user-details">
                <div class="username">
                    <img src='<?php echo $acRepo->getProfilePicture($account['perdoruesi_id'])[0] ?>' alt="profile img"
                        style="width: 60px; border-radius: 50%">

                    <?php echo ($account["perdoruesi_id"] . " @" . $account["pseudonimi"]) ?>
                </div>
                <div class="bottom-details">
                    <div class="tweetCount" style="display: flex; flex-direction: column;">
                        <span>Tweet count</span>
                        <?php echo ($acRepo->getTweetCount($account["perdoruesi_id"])) ?>
                    </div>
                    <div class="createdAt" style="display: flex; flex-direction: column;">
                        <span>Created at</span>
                        <?php echo ($account["krijuar_me"]) ?>
                    </div>
                    <div class="interaksionet" style="display: flex; flex-direction: column;">
                        <span>Engagements</span>
                        <?php echo ($acRepo->getInteractionsCount($account["perdoruesi_id"])) ?>
                    </div>
                    <div class="edit-user-ctn" style="display: flex; flex-direction: column;">
                        <img id="deleteButton" src="images/edit-delete-red.svg" alt="delete button"
                            style="height:20px; width:20px;">
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<h2>Manage Tweets</h2>

<div class="tweets-ctn">
    <?php foreach ($tweets as $tweet) { ?>
        <div class="full-tweet">
            <div class="user-tweet">
                <h1 class="tweet-id">
                    <span>Tweet</span>
                    <?php echo ($tweet["tweet_id"]) ?>
                </h1>
                <div class="tweet-body">
                    <?php echo ($tweet["tweet_body"]) ?>
                </div>
                <div class="tweet-media" <?php $tweetMedias = $twRepo->getImagesForTweet($tweet["tweet_id"]); ?>;
                <?php $tweetImgUrls = $tweetMedias[0]["tweet_img_url"]; $urls = explode(",",$tweetImgUrls); ?>
               <?php if (count($urls) > 0) { ?>
                 <?php foreach ($urls as $tweetMedia) { ?> 
                        <div class="picture-post-ctn">
                            <img class="picture-post" src=<?php echo ($tweetMedia) ?> alt="post pic example">
                        </div>
                    <?php } ?>
             <?php   } ?>
                <div class="created-at">
                    <?php echo ($tweet["krijuar_me"]) ?>
                </div>
            </div>

           
            <div class="delete-tweet">
                <form action="<?php echo $SERVER['PHP_SELF']?>" id="myForm" method="POST">
                    <input type="hidden" name="tweet_id" value=<?php echo($tweet["tweet_id"]) ?>>
                    <input type="submit" name="delete-cmt-btn" >
                         <img id="deleteButton" src="images/edit-delete.svg" alt="delete button">
                 </input>
                </form>
            </div>
        </div>
    <?php } ?>
</div>
</div>
