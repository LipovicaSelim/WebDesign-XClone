<?php

declare(strict_types=1);
include_once "DbConnection.php";
class TweetRepository
{
    private $dbConnection;

    public function __construct()
    {
        $connection = new DbConnection();
        $this->dbConnection = $connection->dbConnect();
    }

    public function getAllTweetsByUserId(int $userId): array
    {
        $connection  = $this->dbConnection;

        $query = "SELECT * FROM TWEETS WHERE perdoruesi_id = $userId";
        $statement = $connection->query($query);

        $tweets = $statement->fetchAll();
        return $tweets;
    }

    public function getAllTweetsOfFollowed(int $userId): array
    {
        $connection  = $this->dbConnection;
        $query = "SELECT ndjeket.ndjek_id, tweets.tweet_id, tweets.perdoruesi_id, tweets.krijuar_me, tweets.tweet_body
                  FROM ndjeket
                  inner JOIN tweets ON ndjeket.ndjek_id = tweets.perdoruesi_id
                  where ndjeket.ndjekesi_id = $userId  
                  ORDER BY `tweets`.`krijuar_me` DESC
                  LIMIT 10
                  ";

        $statement = $connection->query($query);
        $tweets = $statement->fetchAll();
        return $tweets;
    }

    public function getImagesForTweet(int $tweetId): array
    {
        $connection  = $this->dbConnection;
        $query = "SELECT tweet_media.tweet_img_url FROM `tweet_media` WHERE tweet_id = $tweetId;";
        $statement = $connection->query($query);
        $tweets = $statement->fetchAll();
        return $tweets;
    }

    public function getLikesForTweet(int $tweetId): int
    {
        $connection  = $this->dbConnection;
        $query = "SELECT COUNT(*) as like_count FROM interaksionet WHERE tweet_id = :tweetId AND lloji_interaksionit = 1";
        $statement = $this->dbConnection->prepare($query);

        // Bind parameters
        $statement->bindParam(':tweetId', $tweetId, PDO::PARAM_INT);

        // Execute the query
        $statement->execute();

        // Fetch the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Close the statement
        $statement->closeCursor();

        // Return the like count
        return (int)$result['like_count'];
    }


    public function likeTweet(int $tweetId, int $perdoruesiId): void
    {
        try {
            $connection = $this->dbConnection;

            // Prepare the SQL query
            $query = "INSERT INTO interaksionet (tweet_id, perdoruesi_id, lloji_interaksionit) VALUES (:tweetId, :perdoruesiId, 1)";
            $statement = $this->dbConnection->prepare($query);

            // Bind parameters
            $statement->bindParam(':tweetId', $tweetId, PDO::PARAM_INT);
            $statement->bindParam(':perdoruesiId', $perdoruesiId, PDO::PARAM_INT);

            // Execute the query
            $statement->execute();

            // Close the statement
            $statement->closeCursor();
        } catch (PDOException $e) {
            // Handle any exceptions here, e.g., log the error or display a user-friendly message
            echo "Error: " . $e->getMessage();
        }
    }
    public function insertTweet(int $perdoruesiId, string $createdAt, string $content): void
    {
        try {
            // Assuming $this->dbConnection is your PDO database connection

            // Prepare the SQL query
            $query = "INSERT INTO tweets (perdoruesi_id, krijuar_me, tweet_body) VALUES ( :perdoruesiId, :krijuar_me, :tweet_body)";
            $statement = $this->dbConnection->prepare($query);

            // Bind parameters
            $statement->bindParam(':perdoruesiId', $perdoruesiId, PDO::PARAM_INT);
            $statement->bindParam(':krijuar_me', $createdAt, PDO::PARAM_STR);
            $statement->bindParam(':tweet_body', $content, PDO::PARAM_STR);

            // Execute the query
            $statement->execute();

            // Close the statement
            $statement->closeCursor();
        } catch (PDOException $e) {
            // Handle any exceptions here, e.g., log the error or display a user-friendly message
            echo "Error: " . $e->getMessage();
        }
    }
}
