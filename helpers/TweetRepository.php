<?php
declare(strict_types=1);
include_once "DbConnection.php";
class TweetRepository {
    private $dbConnection;

    public function __construct(){
        $connection = new DbConnection();
        $this->dbConnection = $connection->dbConnect();
    }
    
    public function getAllTweetsByUserId(int $userId): array {
        $connection  = $this->dbConnection;

        $query = "SELECT * FROM TWEETS WHERE perdoruesi_id = $userId";
        $statement = $connection->query($query);

        $tweets = $statement->fetchAll();
        return $tweets;
    }

    public function getAllTweetsOfFollowed(int $userId): array { 
        $connection  = $this->dbConnection;
        $query = "SELECT * FROM tweets
        inner join ndjeket
        on 
        ";
    }


    
}