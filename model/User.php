<?php

declare(strict_types=1);

class User{
    private int $userId;
    private string $username;
    private string $lastname;
    private string $firstname;
    private DateTime $birthday;
    private string $description;
    private DateTime $createdAt;
    private string $role;

    public function __construct(int $userId, string $username, string $lastname, string $firstname, DateTime $birthday, string $description, DateTime $createdAt, string $role){
        $this->userId = $userId;
        $this->username = $username;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->birthday = $birthday;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->role = $role;
    }
    public function getUserId(): int {
        return $this->userId;
    }
    public function getUsername(): string{  
        return $this->username;
    }

    public function getLastname(): string{ 
        return $this->lastname;
    }

    public function getFirstname(): string{ 
        return $this->firstname;
    }

    public function getBirthday(): DateTime{ 
        return $this->birthday;
    }

    public function getDescription(): string{   
        return $this->description;
    }

    public function getCreatedAt(): DateTime{ 
        return $this->createdAt;
    }

    public function getRole(): string{ 
        return $this->role;
    }
}
