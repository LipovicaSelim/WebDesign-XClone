<?php

include '../helpers/DbConnection.php';

$dbConnection = new DbConnection();
$pdo = $dbConnection->dbConnect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql_check_email = "SELECT COUNT(*) AS count FROM perdoruesit WHERE email = ?";
    $stmt_check_email = $pdo->prepare($sql_check_email);
    $stmt_check_email->execute([$email]);
    $result = $stmt_check_email->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $response = ['status' => 'error', 'message' => 'An account with this email already exists.'];
    } else {
        $response = ['status' => 'success', 'message' => 'There is no account with this email.'];
    }

    echo json_encode($response);
} else {
    $response = ['status' => 'error', 'message' => 'Form submission not allowed!'];
    echo json_encode($response);
}
