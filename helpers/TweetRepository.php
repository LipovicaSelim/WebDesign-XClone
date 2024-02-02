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



    public function getTweetById(int $tweetId): array
    {
        $connection = $this->dbConnection;
        $query = "SELECT * FROM tweets WHERE tweet_id = $tweetId";
        $statement = $connection->query($query);

        $tweet = $statement->fetchAll();
        return $tweet;
    }

    public function getTweetFieldById(int $tweetId, string $field)
    {
        $tweetFields = self::getTweetById($tweetId);
        return $tweetFields[0][$field];
    }


    public function getAllTweetsByUserId(int $userId): array
    {
        $connection = $this->dbConnection;

        $query = "SELECT * FROM TWEETS WHERE perdoruesi_id = $userId ORDER BY  krijuar_me DESC";
        $statement = $connection->query($query);

        $tweets = $statement->fetchAll();
        return $tweets;
    }

    public function getAllTweetsOfFollowed(int $userId): array
    {
        $connection = $this->dbConnection;
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
        $connection = $this->dbConnection;
        $query = "SELECT tweet_media.tweet_img_url FROM `tweet_media` WHERE tweet_id = $tweetId;";
        $statement = $connection->query($query);
        $tweets = $statement->fetchAll();
        return $tweets;
    }

    public function getLikesForTweet(int $tweetId): int
    {
        $connection = $this->dbConnection;
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
        return (int) $result['like_count'];
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
            $success = $statement->closeCursor();
            if ($success) {
                echo "insert interaction executed";
            } else {
                echo "insert interactioin didn't execute";
            }
            ;
        } catch (PDOException $e) {
            // Handle any exceptions here, e.g., log the error or display a user-friendly message
            error_log("PDOException: " . $e->getMessage());
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
            $success = $statement->execute();

            // Close the statement
            $statement->closeCursor();

            if ($success) {
                echo "insert tweet executed";
            } else {
                echo "insert tweet didn't execute";
            }
            ;
        } catch (PDOException $e) {
            // Handle any exceptions here, e.g., log the error or display a user-friendly message
            echo "Error: " . $e->getMessage();
        }
    }

    public function getCommentsForPost(int $tweetId): array
    {
        $connection = $this->dbConnection;
        $query = "SELECT k.teksti_komentit, k.komentuesi_id, k.tweet_id FROM `komentet` as k WHERE k.tweet_id = $tweetId;";
        $statement = $connection->query($query);
        $comments = $statement->fetchAll();
        return $comments;
    }

    public function insertComment(int $tweetId, int $commenterId): void
    {
        try {
            $query = "INSERT INTO interaksionet (tweet_id, perdoruesi_id, krijuar_me, lloji_interaksionit) VALUES (:tweet_id, :perdoruesi_id, CURRENT_TIMESTAMP(), :lloji_interaksionit)";
            $statement = $this->dbConnection->prepare($query);

            $statement->bindParam(':tweet_id', $tweetId, PDO::PARAM_INT);
            $statement->bindParam(':perdoruesi_id', $commenterId, PDO::PARAM_INT);
            $llojiInteraksionit = "2";
            $statement->bindParam(':lloji_interaksionit', $llojiInteraksionit, PDO::PARAM_STR);
            $statement->execute();
            $statement->closeCursor();


        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            echo "Error from INSERT COMMENT";
        }
    }

    public function insertCommentHelper(string $commentContent, int $commenterId, int $tweetId): void
    {
        try {
            $query = "INSERT INTO komentet (interaksioni_id, teksti_komentit, komentuesi_id, tweet_id ) VALUES ((SELECT LAST_INSERT_ID()), :teksti_komentit, :perdoruesi_id, :tweet_id)";
            $statement = $this->dbConnection->prepare($query);

            $statement->bindParam(':tweet_id', $tweetId, PDO::PARAM_INT);
            $statement->bindParam(':perdoruesi_id', $commenterId, PDO::PARAM_INT);
            $statement->bindParam(':teksti_komentit', $commentContent, PDO::PARAM_STR);
            $statement->execute();

            $statement->closeCursor();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            echo "Error from INSERT HELPER*****";
        }
    }


    public function getTopUsersWithMostTweets(int $limit): array
    {
        $connection = $this->dbConnection;

        $query = "SELECT p.perdoruesi_id, p.pseudonimi, COUNT(t.perdoruesi_id) AS tweet_count
        FROM perdoruesit p
        LEFT JOIN tweets t ON p.perdoruesi_id = t.perdoruesi_id
        GROUP BY p.perdoruesi_id, p.pseudonimi
        ORDER BY tweet_count DESC
        LIMIT :limit";

        $statement = $connection->prepare($query);
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}
