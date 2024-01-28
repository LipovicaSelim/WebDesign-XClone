<?php

class EmailHelper
{
    public function sendVerificationEmail($whereToEmail, $verificationCode)
    {
        $subject = "XClone Account Verification Code";
        $message = "This is the code which you need to provide to the website in order to verify your email for your account: " . $verificationCode;
        $headers = "From: lipovicaselim@gmail.com" . "\r\n" . "Reply-To: lipovicaselim@gmail.com" . "\r\n" . "X-Mailer: PHP/" . phpversion();

        if (mail($whereToEmail, $subject, $message, $headers)) {
            return true;
        } else {
            echo "Mail couldn't be sent";
            return false;
        }
    }
}
