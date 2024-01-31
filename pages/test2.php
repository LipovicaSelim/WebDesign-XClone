 <?php
    include_once("../helpers/AccountRepository.php");
    include_once("../helpers/TweetRepository.php");
    // var_dump(__DIR__);
    $tweetRep = new TweetRepository();
    $acRepo = new AccountRepository();
    $tweets = $tweetRep->getAllTweetsOfFollowed(2);
    $activeUserId = 1;
    ?>
 <html lang="en">

 <head>
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

 <body>
     <?php foreach ($tweets as $tweet) { ?>
         <div class="feed-post" style="color:white; height:500px; width: 500px; margin-bottom:3rem;">
             <div class="feed-profile-ctn">
                 <img class="profile-pic" src="images/defaultProfile1.svg" alt="default profile pic">
             </div>
             <div class="feed-post-content">
                 <div class="feed-username-options">
                     <div class="username-name">
                         <div>
                             <span><?php echo ($acRepo->getAccountFieldById($tweet["ndjek_id"], "emri")) ?></span>
                             <span class="profile-card-username username-feed"><?php echo ("@" . $acRepo->getAccountFieldById($tweet["ndjek_id"], "pseudonimi")) ?></span>
                             <span class="profile-card-username"> <?php echo ("~" . $tweet["krijuar_me"]) ?></span>
                         </div>
                         <div>
                             <img class="three-dots-op" src="images/threedots.svg" alt="options">
                         </div>
                     </div>
                 </div>
                 <div class="post-text-dsc-ctn"><?php echo $tweet["tweet_body"] ?></div>
                 <?php $tweetMedias = $tweetRep->getImagesForTweet($tweet["tweet_id"]);
                    if (count($tweetMedias) > 0) {
                        foreach ($tweetMedias as $tweetMedia) { ?>
                         <div class="picture-post-ctn">
                             <img class="picture-post" src=<?php echo ($tweetMedia[0]) ?> alt="post pic example">
                         </div>
                 <?php }
                    } ?>
                 <div class="post-interaction-ctn">
                     <div class="comment-post"> <span></span> <img src="images/comment.svg" alt="comment"></div>
                     <div class="retweet-post"><img src="images/retweet.svg" alt="retweet"></div>
                     <div class="like-post"> <span><?php echo ($tweetRep->getLikesForTweet($tweet["tweet_id"])) ?></span> <img src="images/like.svg" alt="like"></div>
                     <div class="views-post"><img src="images/statviews.svg" alt="stats"></div>
                     <div class="bmk-share-ctn">
                         <div class="bookmark-post"><img src="images/bookmark.svg" alt="bookmarks"></div>
                         <div class="shr"><img src="images/share.svg" alt="share"></div>
                     </div>
                 </div>
             </div>
         </div>
     <?php } ?>

 </body>
 <script src="./home.js"></script>

 </html>