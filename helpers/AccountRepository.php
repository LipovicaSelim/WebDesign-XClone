<?php
declare(strict_types=1);
include_once "DbConnection.php";
class AccountRepository {
    private $dbConnection;

    public function __construct(){
        $connection = new DbConnection();
        $this->dbConnection = $connection->dbConnect();
    }
    
    public function getAccountById(int $userId): array {
        $connection  = $this->dbConnection;
        $query = "SELECT * FROM perdoruesit WHERE perdoruesi_id = $userId";
        $statement = $connection->query($query);

        $user = $statement->fetchAll();
        return $user;
    }

        public function getAccountFieldById(int $userId, string $field) {
            $userDetailArray = self::getAccountById($userId);
            return $userDetailArray[0][$field];
        }


        
     public function getAccountsUserFollows(int $userId): array {
        $connection  = $this->dbConnection;

        $query = "SELECT ndjeket.ndjek_id
                  FROM perdoruesit
                  JOIN ndjeket ON perdoruesit.perdoruesi_id = ndjeket.ndjek_id
                  WHERE ndjeket.ndjekesi_id = $userId";
        $statement = $connection->query($query);

        $tweets = $statement->fetchAll();
        return $tweets;
    }

    private function getProfileMedia(int $userId): array {
        $connection = $this->dbConnection;
        $query = "select profile_img_url from media where media_id = $userId;";
        $statement = $connection->query($query);
        $imgUrlArray = $statement->fetch();
        return $imgUrlArray;
    }

       public function getProfilePicture(int $userId): string {
        $connection = $this->dbConnection;
        $query = "select profile_img_url from media where media_id = $userId;";
        $statement = $connection->query($query);
        $imgUrlArray = $statement->fetch();
        $url = $imgUrlArray[0];
        if(isset($url)){
            return $url;
        } else {
            return "images/defaultProfile1.svg";
        }
    }

           public function getProfileBanner(int $userId): string {
        $connection = $this->dbConnection;
        $query = "select profile_img_url from media where media_id = $userId;";
        $statement = $connection->query($query);
        $imgUrlArray = $statement->fetch();
        return $imgUrlArray[1];
    }


}