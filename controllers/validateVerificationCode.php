<?php

include_once '../helpers/DbConnection.php';

$dbConnection = new DbConnection();
$pdo = $dbConnection->dbConnect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $verificationCode = $_POST["verificationCode"];
    $email = $_POST["email"];

    $sql = "SELECT kodi_verifikues FROM verifiko_emailin WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['kodi_verifikues'] == $verificationCode) {
        echo json_encode(["match" => true]);
    } else {
        echo json_encode(["match" => false]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
}
