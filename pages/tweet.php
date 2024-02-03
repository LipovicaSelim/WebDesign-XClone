<?php
declare(strict_types=1);
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");
session_start();

$tweet_id = $_GET['id'];
$activeUserId = $_GET['activeUserId'];
$_SESSION["commenterId"] = $activeUserId;
$_SESSION["tweet_id"] = $tweet_id;
$acRepo = new AccountRepository();
$twRepo = new TweetRepository();
$tweet = $twRepo->getTweetById((int) $tweet_id)[0];
$tweetComments = $twRepo->getCommentsForPost((int)$tweet_id);
$formAction = $_SERVER['PHP_SELF'] . "?id=" . $_SESSION["tweet_id"] . "&activeUserId=" . $_SESSION["commenterId"];
if (isset($_POST['post-comment'])) {
    $twRepo->insertComment((int)$_SESSION["tweet_id"], (int)$_SESSION["commenterId"], $_POST['tweet-new']);
    header('Location: tweet.php?id=' . $_SESSION["tweet_id"] . "&activeUserId=" . $_SESSION["commenterId"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tweet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XClone</title>
    <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0.16/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0.16/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0.16/favicon-16x16.png" />
    <link rel="manifest" href="favicon_package_v0.16/site.webmanifest" />
    <link rel="mask-icon" href="favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5" />
</head>

<body style="display:flex; justify-content:center; align-items:center;">
    <div class="tweet-container" style="min-width:600px; min-height: 600px; color:white">
    <a href="homeView.php">
    <img id="back-arrow" src="images/back-arrow-edit.svg" alt="backarrow" style="width:30px; height:30px;">
    </a>
        <div class="feed-post" data-tweet_id="<?php echo $tweet['tweet_id'] ?>">
            <div class="feed-profile-ctn">
                <img class="profile-pic" src=<?php echo ($acRepo->getProfilePicture($tweet["perdoruesi_id"])[0]) ?>
                    alt="default profile pic" style='border-radius: 50%'>
            </div>
            <div class="feed-post-content">
                <div class="feed-username-options">
                    <div class="username-name">
                        <div>
                            <span>
                                <?php echo ($acRepo->getAccountFieldById($tweet["perdoruesi_id"], "emri")) ?>
                            </span>
                            <span class="profile-card-username username-feed">
                                <?php echo ("@" . $acRepo->getAccountFieldById($tweet["perdoruesi_id"], "pseudonimi")) ?>
                            </span>
                            <span class="profile-card-username">
                                <?php echo ("~" . $tweet["krijuar_me"]) ?>
                            </span>
                        </div>
                        <div>
                            <a href='edit.php?id=<?php echo ($tweet["perdoruesi_id"]) ?>'><img class="three-dots-op"
                                    src="images/threedots.svg" alt="options"></a>
                        </div>
                    </div>
                </div>
                <div class="post-text-dsc-ctn">
                    <?php echo $tweet["tweet_body"] ?>
                </div>
                <?php $tweetMedias = $twRepo->getImagesForTweet($tweet["tweet_id"]);
                if (isset($tweetMedias[0])) {
                    foreach ($tweetMedias as $tweetMedia) { ?>
                        <div class="picture-post-ctn">
                            <img class="picture-post" src=<?php echo ($tweetMedia[0]) ?> alt="post pic example">
                        </div>
                    <?php }
                } ?>
                <div class="post-interaction-ctn">
                    <div class="comment-post">
                        <div class="comment-post-ctn">
                            <img src="images/comment.svg" alt="comment" width="20px">
                        </div>
                        <span></span>
                    </div>
                    <div class="retweet-post">
                        <div class="retweet-post-ctn">
                            <img src="images/retweet.svg" alt="retweet " width="20px">
                        </div>
                    </div>
                    <div class="like-post">
                        <div class="like-post-ctn">
                            <img id="like-button-<?php echo $tweet["tweet_id"]; ?>" src="images/like.svg" alt="like"
                                width="20px">
                        </div>
                        <span>
                            <?php echo ($twRepo->getLikesForTweet($tweet["tweet_id"])) ?>
                        </span>
                    </div>
                    <div class="views-post">
                        <div class="views-post-ctn">
                            <img src="images/statviews.svg" alt="stats">
                        </div>
                    </div>
                    <div class="bmk-share-ctn">
                        <div class="bookmark-post"><img src="images/bookmark.svg" alt="bookmarks" width="20px">
                        </div>
                        <div class="shr"><img src="images/share.svg" alt="share"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="comments-section" style="width:100%">
            <div class="comment-post" style="width:100%">
                <div class="input-tweet-ctn" style="width:100%">
                    <div class="user-profile-pic">
                        <img class="profile-pic" src=<?php echo ($acRepo->getProfilePicture((int) $activeUserId)[0]) ?>
                            alt="">
                    </div>
                    <form action="<?php echo $formAction; ?>" method="post" id="tweet-input-form">
                        <input contenteditable type="text-area" name="tweet-new" id="tweet"
                            placeholder="Post your reply" required>
                        <input type="hidden" name="hidden_twId" value=<?php echo ($tweet_id) ?>>
                        <input type="hidden" name="hidden_usrId" value=<?php echo ($activeUserId) ?>>
                        <div class="right-type">
                            <button type="submit" name="post-comment" class="post-btn post-btn-feed" id="post-new-tweet"
                                style="width:100px">Comment</button>
                        </div>
                    </form>
                </div>
                <div class="comments-ctn">
                    <?php foreach($tweetComments as $tweetComment){ ?>
                        <div class="comment-ctn">
                            <div class="feed-profile-ctn">
                                <img class="profile-pic" src=<?php echo ($acRepo->getProfilePicture((int) $tweetComment["komentuesi_id"])[0]) ?>
                            </div>
                            <div class="comment-content">
                                <div style="color:white;"><?php echo($tweetComment["teksti_komentit"]) ?></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>