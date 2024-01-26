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
}