<?php
declare(strict_types=1);
class TweetMedia{
    private int $id;
    private string $tweetImageUrl;

    private string $tweetVideoUrl;

    public function __construct(int $id, string $tweetImageUrl, string $tweetVideoUrl){
        $this->id = $id;
        $this->tweetImageUrl = $tweetImageUrl;
        $this->tweetVideoUrl = $tweetVideoUrl;
    }
    public function getId(): int{
        return $this->id;
    }

    public function getTweetImageUrl(): string{
        return $this->tweetImageUrl;
    }

    public function getTweetVideoUrl(): string{
        return $this->tweetVideoUrl;
    }
    
}