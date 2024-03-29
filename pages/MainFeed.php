<?php

declare(strict_types=1);
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");

$tweetRep = new TweetRepository();
$acRepo = new AccountRepository();
$activeUserId = $_SESSION['user_id'];
$tweets = $tweetRep->getAllTweetsOfFollowed($activeUserId);
?>
<div class="main-side-ctn">
    <div class="main-ctn">
        <div class="feed-mode-ctn">
            <div class="stick1">
                <h2 class="feed-mode">Following Feed</h2>
                <div class="feed-mode-underlinde">&nbsp</div>
            </div>
        </div>
        <div class="post-modal-ctn">
            <div class="prof-pic-ctn">
                <a href="./profile.php"><img class="profile-pic" src=<?php echo ($acRepo->getProfilePicture($activeUserId)[0]) ?> alt="default profile pic"
                        style="border-radius:50%"></a>
            </div>
            <div class="post-interact-ctn">
                <div class="input-tweet-ctn">
                    <form action="../controllers/new-tweet.php" method="post" id="tweet-input-form">
                        <input contenteditable type="text-area" name="tweet-new" id="tweet"
                            placeholder="What is happening?! " required>
                        <div class="right-type">
                            <button type="submit" class="post-btn post-btn-feed" id="post-new-tweet">Post</button>
                        </div>
                    </form>
                </div>
                <div class="post-type-ctn">
                    <div class="post-types">
                        <div class="left-types">
                            <div class="insert-type-ctn insert-img-ctn">
                                <img class="insert-type-twt insert-type-img" src="images/img.svg" alt="insert image">
                                <input type="file" name="" id="choose-img" class="insert-type-img">
                            </div>
                            <div class="insert-type-ctn insert-type-gif">
                                <img class="insert-type-twt" src="images/gif.svg" alt="insert gif">
                            </div>
                            <div class="insert-type-ctn">
                                <img class="insert-type-twt" src="images/poll.svg" alt="insert poll">
                            </div>
                            <div class="insert-type-ctn">
                                <img class="insert-type-twt" src="images/emoji.svg" alt="insert emoji">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="feed-ctn">
            <?php foreach ($tweets as $tweet) { ?>
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
                                        <?php echo ($acRepo->getAccountFieldById($tweet["ndjek_id"], "emri")) ?>
                                    </span>
                                    <span class="profile-card-username username-feed">
                                        <?php echo ("@" . $acRepo->getAccountFieldById($tweet["ndjek_id"], "pseudonimi")) ?>
                                    </span>
                                    <span class="profile-card-username">
                                        <?php echo ("~" . $tweet["krijuar_me"]) ?>
                                    </span>
                                </div>
                                <div>
                                    <a href='tweet.php?id=<?php echo($tweet["tweet_id"] . "&activeUserId=" . $activeUserId ) ?>'><img class="three-dots-op" src="images/threedots.svg" alt="options"></a>
                                </div>
                            </div>
                        </div>
                        <div class="post-text-dsc-ctn">
                            <?php echo $tweet["tweet_body"] ?>
                        </div>
                        <?php $tweetMedias = $tweetRep->getImagesForTweet($tweet["tweet_id"]);
                        if (count($tweetMedias) > 0) {
                            foreach ($tweetMedias as $tweetMedia) { ?>
                                <div class="picture-post-ctn">
                                    <img class="picture-post" src=<?php echo ($tweetMedia[0]) ?> alt="post pic example">
                                </div>
                            <?php }
                        } ?>
                        <div class="post-interaction-ctn">
                            <div class="comment-post">
                                <div class="comment-post-ctn">
                                    <a href='tweet.php?id=<?php echo($tweet["tweet_id"] . "&activeUserId=" . $activeUserId ) ?>'><img src="images/comment.svg" alt="comment" width="20px"></a>
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
                                    <?php echo ($tweetRep->getLikesForTweet($tweet["tweet_id"])) ?>
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
            <?php } ?>
        </div>
    </div>
</div>
<div class="right-side-ctn">
    <div class="right-side-bar">
        <div class="search-bar">
            <div><img src="images/graySearch.svg" class="search-bar-svg" alt="search img"></div>
            <div><input type="text" name="search" id="search" placeholder="Search"></div>
        </div>
        <div class="sub-premium-popup">
            <div>
                <h2 class="sub-header">Subscribe to Premium</h2>
            </div>
            <div>
                <h5 class="sub-pgf">Subscribe to unlock new features and if eligible, receive a share of ads revenue.
                </h5>
            </div>
            <input type="button" class="post-btn sub-btn" value="Subscribe">
        </div>
        <div class="trends" id="trends-ctn">
            <div>
                <h2 class="sub-header trends-main-title">Trends For you</h2>
            </div>
            <div class="trendings-ctn">
                <div class="trending-row">
                    <div class="trnd-ctg">
                        <div class="categori-trnd">Television · Trending</div>
                        <div class="three-dots-trnd"><img src="images/threedots-gray.svg" alt="options"></div>
                    </div>
                    <div class="trnd-title-ctn">
                        <h4 class="trnd-title">Luffy</h4>
                    </div>
                    <div class="trnd-stat-posts">
                        <div>31.4K posts</div>
                    </div>
                </div>
                <div class="trending-row">
                    <div class="trnd-ctg">
                        <div class="categori-trnd">Television · Trending</div>
                        <div class="three-dots-trnd"><img src="images/threedots-gray.svg" alt="options"></div>
                    </div>
                    <div class="trnd-title-ctn">
                        <h4 class="trnd-title">Zoro</h4>
                    </div>
                    <div class="trnd-stat-posts">
                        <div>31.4K posts</div>
                    </div>
                </div>
                <div class="trending-row">
                    <div class="trnd-ctg">
                        <div class="categori-trnd">Television · Trending</div>
                        <div class="three-dots-trnd"><img src="images/threedots-gray.svg" alt="options"></div>
                    </div>
                    <div class="trnd-title-ctn">
                        <h4 class="trnd-title">Brook</h4>
                    </div>
                    <div class="trnd-stat-posts">
                        <div>31.4K posts</div>
                    </div>
                </div>
                <div class="trending-row">
                    <div class="trnd-ctg">
                        <div class="categori-trnd">Television · Trending</div>
                        <div class="three-dots-trnd"><img src="images/threedots-gray.svg" alt="options"></div>
                    </div>
                    <div class="trnd-title-ctn">
                        <h4 class="trnd-title">Chopper</h4>
                    </div>
                    <div class="trnd-stat-posts">
                        <div>31.4K posts</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="follow-sug" id="follow-sug-ctn">
            <div>
                <h1 id="follow-sug-text">Who to follow</h1>
            </div>
            <div class="all-fll-sg-ctn">
                <div class="fllw-sg-ctn">
                    <div class="user-img-name">
                        <div>
                            <img src="images/defaultProfile1.svg" class="profile-pic" alt="profile pic">
                        </div>
                        <div class="usr-name-ctn">
                            <div>Name</div>
                            <div class="profile-card-username">@Username</div>
                        </div>
                    </div>
                    <div><button type="button" class="post-btn post-btn-feed">Follow</button></div>
                </div>
                <div class="fllw-sg-ctn">
                    <div class="user-img-name">
                        <div>
                            <img src="images/defaultProfile1.svg" class="profile-pic" alt="profile pic">
                        </div>
                        <div class="usr-name-ctn">
                            <div>Name</div>
                            <div class="profile-card-username">@Username</div>
                        </div>
                    </div>
                    <div><button type="button" class="post-btn post-btn-feed">Follow</button></div>
                </div>
                <div class="fllw-sg-ctn">
                    <div class="user-img-name">
                        <div>
                            <img src="images/defaultProfile1.svg" class="profile-pic" alt="profile pic">
                        </div>
                        <div class="usr-name-ctn">
                            <div>Name</div>
                            <div class="profile-card-username">@Username</div>
                        </div>
                    </div>
                    <div><button type="button" class="post-btn post-btn-feed">Follow</button></div>
                </div>
            </div>
        </div>
        <div class="footer" id="footer-id">
            Terms of Service Privacy Policy Cookie Policy Accessibility Ads info More © 2023 dXS.
        </div>
    </div>
</div>
<script type="text/javascript" src="likeATweet.js"></script>
<script type="text/javascript" src="getAllLikedTweets.js"></script>
<script>
    console.log("User ID from MainFeed: ", <?php echo json_encode($_SESSION['user_id']); ?>);
</script>