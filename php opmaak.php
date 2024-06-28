<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'email-smtp.us-east-1.amazonaws.com'; // Replace with your SES SMTP endpoint
        $mail->SMTPAuth = true;
        $mail->Username = 'AKIAV4X3LTZTRWDDXEH4'; // Replace with your SES SMTP username
        $mail->Password = 'BOOSucf/vaYw/cfH7m+y3Ws4koGCLxVSvkLWtr2y4upo'; // Replace with your SES SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('terwaljoop@gmail.com', 'Webinar Aanmelding'); // Replace with your verified SES email
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Webinar Aanmelding Bevestiging';
        $mail->Body    = "Bedankt voor je aanmelding, $name! We sturen de webinar details naar dit email adres.";

        if ($mail->send()) {
            // Redirect to a thank you page or back to the form page with a success message
            header("Location: thank_you.html");
            exit;
        } else {
            // Redirect to an error page or back to the form page with an error message
            header("Location: error.html");
            exit;
        }
    } catch (Exception $e) {
        // Redirect to an error page or back to the form page with an error message
        header("Location: error.html");
        exit;
    }
} else {
    echo "Form not submitted";
}
?>
