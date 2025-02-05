<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');
?>
<?php
session_start();
include 'koneksi.php';
?>
<?php include 'header.php'; ?>

<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Sign-Up</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center text-uppercase">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item text-white active" aria-current="page">Sign-Up</li>
				</ol>
			</nav>
		</div>
	</div>
</div>

<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
		</div>
		<div class="row g-4">
			<div class="col-md-12">
				<div class="wow fadeInUp" data-wow-delay="0.2s">
					<form method="post">
						<div class="row g-3">
							<div class="col-12">
								<h2 class="contact-title">REGISTER</h2>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="mb-3 text-white">Full Name</label>
									<input class="form-control" name="nama" id="nama" type="text" placeholder="Type in your full name here" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="mb-3 text-white">Email</label>
									<input class="form-control" name="email" type="text" placeholder="example@gmail.com" required>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label class="mb-3 text-white">Password</label>
									<input class="form-control" name="password" type="password" placeholder="Type in your password here" required>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label class="mb-3 text-white">Contact</label>
									<input class="form-control" name="telepon" type="number" placeholder="Type in your phone number here" required>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label class="mb-3 text-white">Address</label>
									<textarea class="form-control w-100" name="alamat" cols="30" rows="9" placeholder="Type in your address here" required></textarea>
								</div>
							</div>
							<div class="col-12">
								<button class="btn btn-primary w-100 py-3" name="daftar" type="submit">Sign-Up Now</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST["daftar"])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];

	// Cek apakah email sudah terdaftar
	$ambil = $koneksi->query("SELECT * FROM pengguna WHERE email='$email'");
	$yangcocok = $ambil->num_rows;

	if ($yangcocok == 1) {
		echo "<script>alert('Your email has been registered.')</script>";
		echo "<script>location='daftar.php';</script>";
	} else {
		// Generate OTP dan waktu kedaluwarsa
		$otp = rand(100000, 999999);
		$otp_expiry = date("Y-m-d H:i:s", strtotime('+1 minutes'));

		// Hash the password for security
		$hashed_password = password_hash($password, PASSWORD_BCRYPT);

		// Simpan data ke sesi
		$_SESSION['pendaftaran'] = [
			'nama' => $nama,
			'email' => $email,
			'password' => $hashed_password, // Store hashed password
			'alamat' => $alamat,
			'telepon' => $telepon,
			'otp' => $otp,
			'otp_expiry' => $otp_expiry,
		];

		// Kirim OTP ke email
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = 0;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'srinusantaraabadi@gmail.com'; 
			$mail->Password = 'zptv ljjr othb cugd';
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;

			$mail->setFrom('srinusantaraabadi@gmail.com', 'PT. Sri Nusantara Abadi');
			$mail->addAddress($email);

			// Konten email
			$mail->isHTML(true);
			$mail->Subject = 'Kode OTP Anda';
			$mail->Body = "Halo, $nama.<br><br>Kode OTP Anda adalah: <strong>$otp</strong>.<br>Kode ini akan kedaluwarsa dalam 1 menit.";
			$mail->AltBody = "Halo, $nama. Kode OTP Anda adalah: $otp. Kode ini akan kedaluwarsa dalam 1 menit.";

			$mail->send();

			echo "<script>alert('Pendaftaran berhasil. Silakan cek email Anda untuk kode OTP.')</script>";
			echo "<script>location='otp.php';</script>";
		} catch (Exception $e) {
			echo "Pesan tidak dapat dikirim. Kesalahan: {$mail->ErrorInfo}";
		}
	}
}
?>
<?php
include 'footer.php';
?>
