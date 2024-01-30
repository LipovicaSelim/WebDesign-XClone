<?php
declare(strict_types=1);
include "../helpers/TweetRepository.php";
class Tweet{
    private int $userId;

    private string $createdAt;

    private String $content;

    public function __construct(int $userId, string $createdAt, String $content) {
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->content = $content;
    }


    public function getUserId(): int{ 
        return $this->userId;
    }

    public function getCreatedAt(): string{ 
        return $this->createdAt;
    }

    public function getContent(): string{ 
        return $this->content;
    }

    public  function toEntity() {
        $twR = new TweetRepository();
        $twR->insertTweet($this->userId,$this->createdAt,$this->content);
    }

}