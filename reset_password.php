<?php
session_start();
include('koneksi.php'); 

if (!isset($_SESSION['email'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        $updateQuery = "UPDATE pengguna SET password = ? WHERE email = ?";
        $stmt = $koneksi->prepare($updateQuery);
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            unset($_SESSION['email']);
            echo "<script> alert('Your password have been changed);</script>";
            echo "<script> location ='login.php';</script>";
        }   else {
            echo "<div class='alert alert-success'> Failed </div>";
        }
            
        
    } else {
        echo "<div class='alert alert-success'> Password didn't match, please try again.</div>";
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
                    <h2 class="heading-section">Create a new Password</h2>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center"></h3>
                    <form class="sigining-form" action="reset_password.php" method="POST">
                        <div class="form-group">
                         <label class="label" for="new_password">Create a New Password:</label>
                        </div>
                        <div class="form-group">
                         <input class="form-control" type="password" id="new_password" name="new_password" required>
                        </div>
                        <div class="form-group">
                         <label class="label" for="confirm_password">Confirm Password:</label>
                        </div>
                        <div class="form-group"> 
                         <input class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="form-group">
                         <button class="btn btn-primary" type="submit">Change Password</button>
                        </div>`
                    </form>
                </div>
            </div>
        </div>
    </section>                               
</body>
</html>
