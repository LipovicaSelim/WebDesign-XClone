<?php
declare(strict_types=1);
include_once "DbConnection.php";
class AccountRepository {
    private $dbConnection;

    public function __construct(){
        $connection = new DbConnection();
        $this->dbConnection = $connection->dbConnect();
    }
    
    public function getAllAccounts(): array {
        $connection  = $this->dbConnection;
        $query = "SELECT * FROM perdoruesit";
        $statement = $connection->query($query);

        $user = $statement->fetchAll();
        return $user;
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
           public function getProfilePicture(int $userId): mixed {
        $connection = $this->dbConnection;
        $query = "select profile_img_url from media where media_id = $userId;";
        $statement = $connection->query($query);
        $imgUrlArray = $statement->fetch();
        if(isset($imgUrlArray["profile_img_url"])){
            return $imgUrlArray;
        } else {
            return "images/defaultProfile1.svg";
        }
    }

        public function getProfileBanner(int $userId): mixed {
            $connection = $this->dbConnection;
             $query = "select banner_img_url from media where media_id = $userId;";
             $statement = $connection->query($query);
             $imgUrlArray = $statement->fetch();
             if(isset($imgUrlArray["banner_img_url"])){
                  return $imgUrlArray;
             } else {
               return "images/defaultProfile1.svg";
             }
        }

        public function getFollowingCount(int $userId) {
            $connection = $this->dbConnection;
             $query = "SELECT count(ndjek_id) FROM `ndjeket`where ndjekesi_id = $userId;";
             $statement = $connection->query($query);
             $followingCount = $statement->fetch();
             if(!isset($followingCount)){
                return 0;
            }
               return $followingCount[0];
        }

            public function getFollowersCount(int $userId) {
            $connection = $this->dbConnection;
             $query = "SELECT count(ndjekesi_id) FROM `ndjeket`where ndjek_id = $userId;";
             $statement = $connection->query($query);
             $followersCount = $statement->fetch();
             if(!isset($followersCount)){
                return 0;
            }
               return $followersCount[0];
        }

           public function getTweetCount(int $userId) {
            $connection = $this->dbConnection;
             $query = "SELECT count(*) FROM `tweets` where perdoruesi_id = $userId";
             $statement = $connection->query($query);
             $tweetCount = $statement->fetch();
             if(!isset($tweetCount)){
                return 0;
            }
               return $tweetCount[0];
           }

                  public function getInteractionsCount(int $userId) {
            $connection = $this->dbConnection;
             $query = "SELECT count(*) FROM `interaksionet` where perdoruesi_id = $userId";
             $statement = $connection->query($query);
             $interksionet = $statement->fetch();
             if(!isset($interksionet)){
                return 0;
            }
               return $interksionet[0];
           }

             public function deleteAccountById(int $accountId): void {
             $query = "DELETE FROM perdoruesit where perdoruesi_id = $accountId";
            $statement = $this->dbConnection->prepare($query);
            $success = $statement->execute();
            $statement->closeCursor();
    }

}