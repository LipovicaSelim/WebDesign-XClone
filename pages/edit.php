<?php
include '../controllers/protected.php';
include_once("../helpers/AccountRepository.php");
include_once("../helpers/TweetRepository.php");

$acRepo = new AccountRepository();
$twRepo = new TweetRepository();
$pstId;
if(isset($_GET["postId"])){
$pstId = $_GET["postId"];
}
if(isset($_GET["deleteAccount"])){
$deleteAccount = $_GET["deleteAccount"];
}


$id = $_GET['id'];
$account = $acRepo->getAccountById($id)[0];
$tweets = $twRepo->getAllTweetsByUserId($id);

if(isset($deleteAccount)) {
    $acRepo->deleteAccountById($id);
}

if(isset($pstId)) {
    $twRepo->deleteTweetById($pstId);
}
?>

<link rel="stylesheet" href="../style/edit.css">
<a href="dashboard.php">
    <img id="back-arrow" src="images/back-arrow-edit.svg" alt="backarrow">
</a>
<h1>Manage Account</h1>

<div class="anonuncements-ctn">
    <a href='edit.php?id=<?php echo ($account["perdoruesi_id"]) ?>'>
        <div class="user-cnt">
            <div class="user-details">
                <div class="username">
                    <img src='<?php echo $acRepo->getProfilePicture($account['perdoruesi_id'])[0] ?>' alt="profile img"
                        style="width: 60px; border-radius: 50%;">
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
                        <a href=<?php echo("edit.php?id=$id&deleteAccount=true")?>> <img id="deleteButton" src="images/edit-delete-red.svg" alt="delete button"
                            style="height:20px; width:20px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<h2>Manage Tweets</h2>

<div class="tweets-ctn">
    <?php foreach ($tweets as $tweet) { ?>
        <?php $postId = $tweet["tweet_id"] ?>
        <div class="full-tweet">
            <div class="user-tweet">
                <h1 class="tweet-id">
                    <span>Tweet</span>
                    <?php echo ($tweet["tweet_id"]) ?>
                </h1>
                <div class="tweet-body">
                    <?php echo ($tweet["tweet_body"]) ?>
                </div>
                <div class="tweet-media">
                    <div class="slider">
                        <div class="slides">
                            <?php
                            $tweetMedias = $twRepo->getImagesForTweet($tweet["tweet_id"]);
                            $tweetImgUrls = $tweetMedias[0]["tweet_img_url"];
                            $urls = explode(",", $tweetImgUrls);
                            if (count($urls) > 0) {
                                foreach ($urls as $tweetMedia) {
                                    ?>
                                    <div class="picture-post-ctn">
                                        <img class="picture-post" src="<?php echo ($tweetMedia) ?>" alt="post pic example">
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <div class="next-prev-button">
                                <div>
                                    <button class="prev" onclick="prevSlide()">Previous</button>
                                </div>
                                <div>
                                    <button class="next" onclick="nextSlide()">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="created-at">
                    <?php echo ($tweet["krijuar_me"]) ?>
                </div>
            </div>
            <div class="delete-tweet">
                 <form action="<?php echo $SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="tweet_id" value="<?php $string = $tweet["tweet_id"]; var_dump($tweet["tweet_id"]) ?>">
                    <a href=<?php echo("edit.php?id=$id&postId=$postId") ?>><img id="deleteButton" src="images/edit-delete.svg" alt="delete button"></a>
                </form>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    let fullTweets = document.querySelectorAll('.tweets-ctn .full-tweet');

    function showSlide(slideIndex, slides) {
        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }
        if (slideIndex < 0) {
            slideIndex = slides.length - 1;
        }
        slides.forEach((slide) => {
            slide.style.display = "none";
        });
        slides[slideIndex].style.display = "block";
        console.log("Slides length: ", slides.length);
    }

    function nextSlide(parentFullTweet) {
        let slides = parentFullTweet.querySelectorAll('.slider .picture-post-ctn');
        if (slides.length === 0) return;
        let slideIndex = Array.from(slides).findIndex((slide) => slide.style.display === "block");
        slideIndex++;
        showSlide(slideIndex, slides);
    }

    function prevSlide(parentFullTweet) {
        let slides = parentFullTweet.querySelectorAll('.slider .picture-post-ctn');
        if (slides.length === 0) return;
        let slideIndex = Array.from(slides).findIndex((slide) => slide.style.display === "block");
        slideIndex--;
        showSlide(slideIndex, slides);
    }

    fullTweets.forEach((fullTweet) => {
        let slides = fullTweet.querySelectorAll('.slider .picture-post-ctn');

        fullTweet.querySelector('.next').addEventListener('click', () => nextSlide(fullTweet));
        fullTweet.querySelector('.prev').addEventListener('click', () => prevSlide(fullTweet));

        showSlide(0, slides);
    });
</script>