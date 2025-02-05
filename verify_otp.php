<?php
session_start();
include('koneksi.php'); 

if (!isset($_SESSION['email'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_otp = $_POST['otp'];
    $email = $_SESSION['email'];

    $query = "SELECT otp, otp_expiry FROM pengguna WHERE email = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $user['otp'] == $input_otp && strtotime($user['otp_expiry']) > time()) {
        $clearOtpQuery = "UPDATE pengguna SET otp = NULL, otp_expiry = NULL WHERE email = ?";
        $clearOtpStmt = $koneksi->prepare($clearOtpQuery);
        $clearOtpStmt->bind_param("s", $email);
        $clearOtpStmt->execute();

        header("Location: reset_password.php");
        exit();
    } else {
        echo "OTP salah atau sudah kedaluwarsa. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>OTP Verification</title>
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
                    <h2 class="heading-section">Check your email for OTP code.</h2>
               
                <form class="singin-form" action="verify_otp.php" method="POST">
                   <div class="form-gorup"> 
                    <label class="" color=" #fff" for="otp">Insert OTP:</label>
                   </div> 
                   <div class="form-group"> 
                    <input class="form-control" type="text" id="otp" name="otp" required>
                   </div>
                   <div class="form-group"> 
                    <button class="btn btn-primary" type="submit">Verify</button>
                   </div>
                </div>
            </div>       
        </form> 
    </div>                     
</section>    
   
<script src="login/js/jquery.min.js"></script>
<script src="login/js/popper.js"></script>
<script src="login/js/bootstrap.min.js"></script>
<script src="login/js/main.js"></script>
</body>
</html>
