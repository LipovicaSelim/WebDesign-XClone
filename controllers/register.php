<?php

include '../helpers/DbConnection.php';

$dbConnection = new DbConnection();
$pdo = $dbConnection->dbConnect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST['emri'];
    $email = $_POST['email'];
    $fjalekalimi = $_POST['password'];
    $krijuar_me = date("Y-m-d H:i:s");
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $datelindja = "$year-$month-$day";

    $hashedPassword = password_hash($fjalekalimi, PASSWORD_DEFAULT);

    // Check if the email domain is "@xclone.com"
    $isXcloneEmail = strpos($email, '@xclone.com') !== false;

    /*----- Check if email that the user has written in input, already exists in DB. No account can be registered by the same email! ---*/
    $sql_check_email = "SELECT COUNT(*) AS count FROM perdoruesit WHERE email = ?";
    $stmt_check_email = $pdo->prepare($sql_check_email);
    $stmt_check_email->execute([$email]);
    $result = $stmt_check_email->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $response = ['status' => 'error', 'message' => 'An account with this email already exists.'];
    } else {
        $sql = "INSERT INTO perdoruesit (emri, email, fjalekalimi, datelindja, krijuar_me, eshte_admin) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $eshteAdmin = $isXcloneEmail ? true : false;

        $stmt->execute([$emri, $email, $hashedPassword, $datelindja, $krijuar_me, $eshteAdmin]);

        if ($stmt->rowCount() > 0) {
            $response = ['status' => 'success', 'message' => 'User registered in db successfully'];
            header('Location: ../pages/homeView.php');
            exit();
        } else {
            $response = ['status' => 'error', 'message' => 'Failure in registering a new user'];
        }
    }

    echo json_encode($response);
} else {
    $response = ['status' => 'error', 'message' => 'Form submission not allowed!'];
    echo json_encode($response);
}
