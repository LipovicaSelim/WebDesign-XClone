<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../helpers/DbConnection.php";
include "../pages/homeView.php";
session_start();

//me bo redirect back ne homeView nese useri nuk bon log out amo munohet me qas landingPage

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usernameOrEmail = $_POST['usernameOrEmail'];
    $password = $_POST['password'];

    $dbConnection = new DbConnection();
    $pdo = $dbConnection->dbConnect();

    $sql = "SELECT * FROM perdoruesit WHERE email = :usernameOrEmail OR emri = :usernameOrEmail";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usernameOrEmail' => $usernameOrEmail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);



    if ($user && password_verify($password, $user['fjalekalimi'])) {
        $_SESSION['user_id'] = $user['perdoruesi_id'];
        $_SESSION['username'] = $user['emri'];
        $_SESSION['email'] = $user['email'];

        $response = [
            'status' => 'success',
            'redirect' => '../pages/homeView.php'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Invalid username/email or password'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
