<?php
session_start();
include 'koneksi.php';

?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="login/css/style.css">
</head>

<body class="img" style="background-image: url(login/images/bg_login.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Nusatrade</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Please Login</h3>
                        <form method="post" class="signin-form">
                            <div class="form-group">
                                <input class="form-control" name="email" id="name" type="email" placeholder="Insert Email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="password" type="password" placeholder="Insert Password">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="simpan" class="form-control btn btn-primary submit px-3">LOGIN</button>
                            </div>
                            <div class="form-group text-center">
                                <a href="forgot_password.php" class="text-decoration-none" style="color: #fff;">Forget Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST["simpan"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        // Ambil data pengguna berdasarkan email
        $ambil = $koneksi->query("SELECT * FROM pengguna WHERE email='$email' LIMIT 1");
        $akun = $ambil->fetch_assoc();

        // Cek apakah akun ditemukan
        if ($akun) {
            // Cek apakah password di database sudah di-hash atau belum
            if (password_verify($password, $akun['password'])) {
                // Password cocok dengan hash, lanjutkan login
                if ($akun['level'] == "Pelanggan") {
                    $_SESSION["pengguna"] = $akun;
                    echo "<script> alert('Welcome to Nusatrade');</script>";
                    echo "<script> location ='index.php';</script>";
                } elseif ($akun['level'] == "Admin") {
                    $_SESSION['admin'] = $akun;
                    echo "<script> alert('Welcome ');</script>";
                    echo "<script> location ='admin/index.php';</script>";
                }
            } else {
                // Jika password tidak cocok dengan hash, cek apakah password belum di-hash
                if ($akun['password'] === $password) {
                    // Password belum di-hash, hash-kan sekarang
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $koneksi->query("UPDATE pengguna SET password='$hashedPassword' WHERE email='$email'");

                    // Login pengguna setelah update hash
                    if ($akun['level'] == "Pelanggan") {
                        $_SESSION["pengguna"] = $akun;
                        echo "<script> alert('Welcome!');</script>";
                        echo "<script> location ='index.php';</script>";
                    } elseif ($akun['level'] == "Admin") {
                        $_SESSION['admin'] = $akun;
                        echo "<script> alert('Welcome!');</script>";
                        echo "<script> location ='admin/index.php';</script>";
                    }
                } else {
                    echo "<script> alert('Failed to login, please check your account');</script>";
                    echo "<script> location ='login.php';</script>";
                }
            }
        } else {
            echo "<script> alert('Failed to login, please check your account');</script>";
            echo "<script> location ='login.php';</script>";
        }
    }
    ?>
    <script src="login/js/jquery.min.js"></script>
    <script src="login/js/popper.js"></script>
    <script src="login/js/bootstrap.min.js"></script>
    <script src="login/js/main.js"></script>
</body>

</html>
