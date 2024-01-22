<?php
declare(strict_types=1);

class DbConnection{

    private $serverHost = "localhost";
    private $username = "root";

    private $password = "";

    private $db = "xclone";

    function dbConnect(){
        try{
            $connection = new PDO("mysql:host=$this->serverHost;dbname=$this->db",$this->username,$this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch(PDOException $e){ 
            echo $e->getMessage();
        }
    }
}