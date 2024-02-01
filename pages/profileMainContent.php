<?php
declare(strict_types=1);
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");
$activeSessionUser = 7;
$acRepo = new AccountRepository();
$twRepo = new TweetRepository();
var_dump($acRepo->getProfilePicture($activeSessionUser));
$tweets = $twRepo->getAllTweetsByUserId($activeSessionUser);
?>


  <div class="main-side-ctn">
            <div class="main-ctn">
                <div class="feed-mode-ctn">
                        <h2 class="feed-mode"><?php echo($acRepo->getAccountFieldById($activeSessionUser,"pseudonimi")) ?></h2>
                </div>
                <div class="profile-details-ctn">
                    <div class="profile-details-flex-ctnm">
                        <div class="cover-pic-ctn">
                            <img src="images/profile-pics/cover-pic.jpg" alt="cover-pic" id="cover-pic">
                        </div>
                        <div class="profile-pic-ctn">
                            <img class="profile-pic" id="profile-pg-pic" src="images/defaultProfilePic.jpg" alt="profile-pic">
                        </div>
                        <div class="edit-profile-btn-ctn">
                            <button class="edit-profile-btn">Edit profile</button>
                        </div>
                        <div class="profile-personal-details-ctn">
                            <div class="prsn-details-flex-ctn">
                                <div class="name-username-ctn">
                                    <div class="name-ctn"><?php echo($acRepo->getAccountFieldById($activeSessionUser,"emri")) ?></div>
                                    <div class="username profile-card-username"><?php echo("@".$acRepo->getAccountFieldById($activeSessionUser,"pseudonimi")) ?></div>
                                </div>
                                <div class="profile-description">
                                    <span class="description-txt">Still using PHP huh ?</span>
                                </div>
                                <div class="birthdate-join-date-ctn">
                                    <div class="bdate-img-ctn">
                                        <img src="images/profile-pics/birthdate-icon.svg" alt="birthdate-icon">
                                    </div>
                                    <div class="birthdate-ctn">
                                        <span class="bday-txt username profile-card-username">On November 6, 1999</span>
                                    </div>
                                    <div class="join-dt-ctn">
                                        <div class="clnd-img-ctn">
                                            <img src="images/profile-pics/calendar.svg" alt="calendar icon">
                                        </div>
                                        <div class="join-dt-txt username profile-card-username">
                                            Joined February 2017
                                        </div>
                                    </div>

                                </div>
                                <div class="followers-following-ctn">
                                        <div class="following-ctn follow-ctn">
                                            <span class="follow-number following">999</span>
                                            <span class="fllw-txt">Following</span>
                                        </div>
                                        <div class="followers-ctn follow-ctn">
                                            <span class="follow-number following">999</span>
                                            <span class="fllw-txt">Followers</span>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <div class="feed-ctn">
                    <?php foreach ($tweets as $tweet) { ?>
                    <div class="feed-post">
                        <div class="feed-profile-ctn">
                            <img class="profile-pic" src="images/defaultProfile1.svg" alt="default profile pic">
                        </div>
                        <div class="feed-post-content">
                            <div class="feed-username-options">
                                <div class="username-name">
                                    <div>
                                        <span><?php echo ($acRepo->getAccountFieldById($tweet["perdoruesi_id"], "emri")) ?></span>
                                        <span class="profile-card-username username-feed"><?php echo ("@" . $acRepo->getAccountFieldById($tweet["perdoruesi_id"], "pseudonimi")) ?></span>
                                        <span class="profile-card-username"> <?php  echo("~" . $tweet["krijuar_me"]) ?></span>
                                    </div>
                                    <div>
                                        <img class="three-dots-op" src="images/threedots.svg" alt="options">
                                    </div>
                                </div>
                            </div>
                            <div class="post-text-dsc-ctn"><?php echo $tweet["tweet_body"] ?></div>
                            <?php $tweetMedias = $twRepo->getImagesForTweet($tweet["tweet_id"]);
                            if(count($tweetMedias) > 0) {
                            foreach ($tweetMedias as $tweetMedia) { ?>
                            <div class="picture-post-ctn">
                                <img class="picture-post" src=<?php echo($tweetMedia[0]) ?> alt="post pic example">
                            </div>
                            <?php } } ?>
                            <div class="post-interaction-ctn">
                                <div class="comment-post"> <span></span> <img src="images/comment.svg" alt="comment"></div>
                                <div class="retweet-post"><img src="images/retweet.svg" alt="retweet"></div>
                                <div class="like-post">  <span><?php echo($tweetRep->getLikesForTweet($tweet["tweet_id"])) ?></span>   <img src="images/like.svg" alt="like"></div>
                                <div class="views-post"><img src="images/statviews.svg" alt="stats"></div>
                                <div class="bmk-share-ctn">
                                    <div class="bookmark-post"><img src="images/bookmark.svg" alt="bookmarks"></div>
                                    <div class="shr"><img src="images/share.svg" alt="share"></div>
                                </div>
                            </div>
                        </div>
                     </div>
                    <?php }?>
                </div>
            </div>
        </div>