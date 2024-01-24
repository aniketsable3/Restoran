<?php
session_start();
require 'D:\xampp\htdocs\otp\PHPMailer-master\src/PHPMailer.php';
require 'D:\xampp\htdocs\otp\PHPMailer-master\src/SMTP.php';
require 'D:\xampp\htdocs\otp\PHPMailer-master\src/Exception.php';// Include PHPMailer library

$conn = new mysqli('localhost', 'root', '', 'cafe');
if (isset($_POST['submit'])) {
    $signup_username = $_POST['username'];
    $signup_email = $_POST['email'];
    $signup_password =$_POST['password'];

    $otp = rand(100000, 999999);
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));

    $_SESSION['email'] = $signup_email;
    $_SESSION['signup_otp'] = $otp;

    $stmt = $conn->prepare("INSERT INTO `signup` (`username`, `email`, `password`, `otp`, `otp_expiry`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $signup_username, $signup_email, $signup_password, $otp, $otp_expiry);
    $stmt->execute();
    $stmt->close();




    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'aniketsable0508@gmail.com';  // Replace with your SMTP username
    $mail->Password = 'wqzsthfaaiqeqsph';  // Replace with your SMTP password
    $mail->SMTPSecure = 'tls';  // Use 'tls' or 'ssl'
    $mail->Port = 587;
    $mail->SMTPDebug = 2;   // Use 587 for TLS or 465 for SSL

    $mail->setFrom('aniketsable0508@gmail.com', 'Aniket Sable');  // Replace with your email and name
    $mail->addAddress($signup_email, $signup_username);
    $mail->Subject = 'Your OTP for Signup';
    $mail->Body = "Hello ".$signup_username." Welcome to Restoran . Kindly Submit Your OTP. Your OTP for signup is: $otp";

    if ($mail->send()) {
        echo "OTP sent to $signup_email";
    } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    
    

    // Redirect to OTP verification page
    header("Location: otp_verification.php");
    exit();
}

$conn->close();
?>
