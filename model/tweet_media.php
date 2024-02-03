<?php
declare(strict_types=1);
include "../helpers/TweetRepository.php";
class Media{
    private int $tweetId;

    private string $tweet_img_url;

    private int $tweet_video_url;



    public function __construct(int $mediaId ,string $tweet_img_url, string $tweet_video_url) {
        $this->userId = $mediaId;
        $this->profile_img_url = $tweet_img_url;
        $this->banner_img_url = $tweet_video_url;
    }



    public  function toEntity() {
        $twR = new TweetRepository();
        // $twR->insertTweet($this->userId,$this->createdAt,$this->createdAt);
    }

}