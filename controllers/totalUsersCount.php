<?php

require_once '../helpers/DbConnection.php';

function getTotalUsersCount()
{
    $dbConnection = new DbConnection();
    $pdo = $dbConnection->dbConnect();

    try {
        $sql = "SELECT COUNT(*) AS total_users FROM perdoruesit";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_users'];
    } catch (PDOException $e) {
        return false;
    }
}
$totalUsersCount = getTotalUsersCount();

if ($totalUsersCount !== false) {
    echo json_encode(["success" => true, "total_users" => $totalUsersCount]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to get total users count"]);
}
?>