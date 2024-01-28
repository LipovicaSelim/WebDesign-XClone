<?php

require_once '../vendor/PHPMailer-6.9.1/src/PHPMailer.php';
require_once '../vendor/PHPMailer-6.9.1/src/SMTP.php';
require_once '../vendor/PHPMailer-6.9.1/src/Exception.php';
include '../helpers/DbConnection.php';

use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["code"]) || !isset($_POST["email"])) {
        http_response_code(400);
        exit("Missing parameters");
    }

    $verificationCode = $_POST["code"];
    $email = $_POST["email"];

    $dbConnection = new DbConnection();
    $pdo = $dbConnection->dbConnect();

    $sql = "INSERT INTO verifiko_emailin (email, kodi_verifikues) VALUES (:email, :kodi_verifikues)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'kodi_verifikues' => $verificationCode]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        exit("Invalid email format");
    }



    // Create a new PHPMailer instance
    $mail = new PHPMailer;

    // Set up SMTP for sending emails
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Assuming your local SMTP server is running on localhost
    $mail->SMTPAuth = true;
    $mail->Username = "dren.azemi444@gmail.com";
    $mail->Password = "phbk gmgz wiyq opxb";
    $mail->Port = '465';
    $mail->SMTPSecure = "ssl";
    $mail->isHTML(true);

    // Set email parameters
    $mail->setFrom('selim.lipovica@outlook.com', 'dXsClone Project');
    $mail->addAddress($email);
    $mail->Subject = 'Verification Code';
    $mail->Body = '<html>
    <body>
    <h1>Confirm your email address</h1><br>
    <p>In order to continue on registering in our platform please write this code to get started to dXsClone</p>
    </body>
    </html>' . $verificationCode;

    // Send the email
    if ($mail->send()) {
        http_response_code(200);
        echo "Email sent successfully";
    } else {
        http_response_code(500);
        echo "Failed to send email: " . $mail->ErrorInfo;
    }
} else {
    http_response_code(405);
    exit("Method not allowed");
}
