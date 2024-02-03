<?php
declare(strict_types=1);
include "../helpers/TweetRepository.php";
class Media{
    private int $mediaId;

    private string $profile_img_url;

    private string $banner_img_url;



    public function __construct(int $mediaId ,string $profile_img_url, string $banner_img_url) {
        $this->userId = $mediaId;
        $this->profile_img_url = $profile_img_url;
        $this->banner_img_url = $banner_img_url;
    }



    public  function toEntity() {
        $twR = new TweetRepository();
        // $twR->insertTweet($this->userId,$this->createdAt,$this->createdAt);
    }

}