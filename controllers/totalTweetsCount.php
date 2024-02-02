<?php

require_once '../helpers/DbConnection.php';

function getTotalTweetsCount()
{
    $dbConnection = new DbConnection();
    $pdo = $dbConnection->dbConnect();

    try {
        $sql = "SELECT COUNT(*) AS total_tweets FROM tweets";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_tweets'];
    } catch (PDOException $e) {
        return false;
    }
}
$TotalTweetsCount = getTotalTweetsCount();

if ($TotalTweetsCount !== false) {
    echo json_encode(["success" => true, "total_tweets" => $TotalTweetsCount]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to get total tweets count"]);
}
?>