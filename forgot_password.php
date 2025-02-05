<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');
session_start();
include 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Cek apakah email ada di database
    $query = "SELECT * FROM pengguna WHERE email = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika email ditemukan, buat OTP
        $otp = rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime('+10 minutes'));

        // Simpan OTP dan waktu kedaluwarsa ke database
        $updateQuery = "UPDATE pengguna SET otp = ?, otp_expiry = ? WHERE email = ?";
        $updateStmt = $koneksi->prepare($updateQuery);
        $updateStmt->bind_param("sss", $otp, $otp_expiry, $email);
        $updateStmt->execute();

        // Kirim OTP ke email menggunakan PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'srinusantaraabadi@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'zptv ljjr othb cugd'; // Ganti dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('srinusantaraabadi@gmail.com', 'PT. Sri Nusantara Abadi');
            $mail->addAddress($email);

            // Konten email
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password OTP';
            $mail->Body = "Forget your password?, <br><br>If you didn't ask to change, please leave this massage<br></br>, Your OTP: <strong>$otp</strong>.";
            $mail->AltBody = "Reset Password OTP: $otp. This code will expire in 10 minutes.";

            $mail->send();

            $_SESSION['email'] = $email;
            header("Location: verify_otp.php");
            exit();
        } catch (Exception $e) {
            echo "Pesan tidak dapat dikirim. Kesalahan: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email tidak ditemukan di sistem kami.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="login/css/style.css">
</head>

<body class="img js-fullheight" style="background-image: url(login/images/bg_login.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Reset Password</h2>                           
                <form class="signin-form" action="forgot_password.php" method="POST">
                    <div class="form-group"> 
                     <label for="email">Insert your email here:</label>
                    </div>
                    <div class="form-group">
                     <input class="form-control" type="email" id="email" name="email" placeholder="name@example.com" required>
                    </div>
                    <div class="form-group">
                     <button class="btn btn-primary" type="submit">Send OTP</button>
                    </div>               
                </form>
                </div>
            </div>
        </div>    
    </section>        
    
    <script src="login/js/jquery.min.js"></script>
    <script src="login/js/popper.js"></script>
    <script src="login/js/bootstrap.min.js"></script>
    <script src="login/js/main.js"></script>    
</body>
</html>
