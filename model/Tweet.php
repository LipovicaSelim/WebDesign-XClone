<?php
declare(strict_types=1);
class Tweet{
    private int $id;
    private string $userId;

    private DateTime $createdAt;

    private String $content;

    public function __construct(int $id, string $userId, DateTime $createdAt, String $content) {
        $this->id = $id;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->content = $content;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getUserId(): string{ 
        return $this->userId;
    }

    public function getCreatedAt(): DateTime{ 
        return $this->createdAt;
    }

    public function getContent(): string{ 
        return $this->content;
    }
}