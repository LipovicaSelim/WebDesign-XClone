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


    
    public function getTweetById(int $tweetId): array {
        $connection  = $this->dbConnection;
        $query = "SELECT * FROM tweets WHERE tweet_id = $tweetId";
        $statement = $connection->query($query);

        $tweet = $statement->fetchAll();
        return $tweet;
    }

    public function getTweetFieldById(int $tweetId, string $field) {
            $tweetFields = self::getTweetById($tweetId);
            return $tweetFields[0][$field];
        }


    public function getAllTweetsByUserId(int $userId): array
    {
        $connection  = $this->dbConnection;

        $query = "SELECT * FROM TWEETS WHERE perdoruesi_id = $userId ORDER BY  krijuar_me DESC";
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
                  LIMIT 20
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

    public function getCommentsForPost(int $tweetId) : array {
        $connection  = $this->dbConnection;
        $query = "SELECT k.teksti_komentit, k.komentuesi_id, k.tweet_id FROM `komentet` as k WHERE k.tweet_id = $tweetId;";
        $statement = $connection->query($query);
        $comments = $statement->fetchAll();
        return $comments;
    }

    public function insertComment(int $tweetId,string $content,int $commenterId): void{
         try {
            $query = "INSERT INTO interaksionet (tweet_id, krijuar_me, perdoruesi_id, lloji_interaksionit) VALUES ( :tweet_id, :krijuar_me, :perdoruesi_id, :lloji_interaksionit)";
            $statement = $this->dbConnection->prepare($query);

            // Bind parameters
            $dateTime = new DateTime();
         $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
            $statement->bindParam('::tweet_id', $tweetId, PDO::PARAM_INT);
            $statement->bindParam(':krijuar_me', $formattedDateTime, PDO::PARAM_STR);
            $statement->bindParam(':perdoruesi_id', $commenterId, PDO::PARAM_STR);
            $llojiInterksionit = "2";
            $statement->bindParam(':lloji_interaksionit',$llojiInterksionit , PDO::PARAM_STR);

            // Execute the query
            $statement->execute();

            // Close the statement
            $statement->closeCursor();
        } catch (PDOException $e) {
            // Handle any exceptions here, e.g., log the error or display a user-friendly message
            echo "Error: " . $e->getMessage();
        }
    }

    public function insertCommentHelper(string $commentContent, int $commenterId, int $tweetId): void
    {
        try {
            $query = "INSERT INTO komentet (interaksioni_id, tweet_id, perdoruesi_id, teksti_komentit) VALUES (:interaksioni_id :tweet_id, :perdoruesi_id, :teksti_komentit)";
            $statement = $this->dbConnection->prepare($query);

            $interaksioni_id = $this->dbConnection->lastInsertId();

            $statement->bindParam(":interaksioni_id", $interaksioni_id);
            $statement->bindParam(':tweet_id', $tweetId, PDO::PARAM_INT);
            $statement->bindParam(':perdoruesi_id', $commenterId, PDO::PARAM_STR);
            $statement->bindParam(':teksti_komentit', $commentContent, PDO::PARAM_STR);

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
