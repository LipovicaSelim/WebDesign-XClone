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


    /*----- Check if email that the user has written in input, already exists in DB. No account can be registered by same email! ---*/
    $sql_check_email = "SELECT COUNT(*) AS count FROM perdoruesit WHERE email = ?";
    $stmt_check_email = $pdo->prepare($sql_check_email);
    $stmt_check_email->execute([$email]);
    $result = $stmt_check_email->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $response = ['status' => 'error', 'message' => 'An account with this email already exists.'];
        echo json_encode($response);
    } else {




        $sql = "INSERT INTO perdoruesit (emri, email, fjalekalimi, datelindja, krijuar_me) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$emri, $email, $hashedPassword, $datelindja, $krijuar_me]);
        if ($stmt->rowCount() > 0) {
            $response = ['status' => 'success', 'message' => 'User registered in db successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Failure in registering a new user'];
        }

        echo json_encode($response);
    }
} else {
    $response = ['status' => 'error', 'message' => 'Form submission not allowed!'];
    echo json_encode($response);
}
