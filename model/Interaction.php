<?php
declare(strict_types=1);
include "../helpers/TweetRepository.php";
class Interaction{
    private int $interactionId;

    private int $tweetId;

    private int $userId;

    private string $createdAt;

    private int $nrInteraksionit;

    public function __construct(int $tweetId ,int $userId, string $createdAt) {
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->createdAt = $createdAt;
    }



    public  function toEntity() {
        $twR = new TweetRepository();
        // $twR->insertTweet($this->userId,$this->createdAt,$this->createdAt);
    }

}