<?php
include 'koneksi.php';
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
  $datakategori[] = $tiap;
}
function rupiah($angka)
{
  $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
  return $hasilrupiah;
}
function tanggal($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = getBulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}
error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>NUSATRADE</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="assets_home/lib/animate/animate.min.css" rel="stylesheet">
  <link href="assets_home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets_home/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="assets_home/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="assets_home/css/style.css" rel="stylesheet">
</head>

<body style="background-color: #373A40;">
  <!-- Spinner Start -->
  <!--<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">-->
  <!--  <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">-->
  <!--    <span class="sr-only">Loading...</span>-->
  <!--  </div>-->
  <!--</div>-->
  <!-- Spinner End -->


  <!-- Topbar Start -->
  <div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
      <div class="col-lg-7 px-5 text-start">
        <div class="h-100 d-inline-flex align-items-center py-3 me-4">
          <small class="fa fa-map-marker-alt text-primary me-2"></small>
          <small>MTH Square Ground Floor (GF) A4 A, Jl. Letjen M.T. Haryono</small>
        </div>
      </div>
      <div class="col-lg-5 px-5 text-end">
        <div class="h-100 d-inline-flex align-items-center py-3 me-4">
          
          <a href="https://wa.me/6281282873142" target="_blank">
  <small class="fa fa-phone-alt text-primary me-2"></small>
  <small>Contact Us</small>
</a>

        </div>
        <div class="h-100 d-inline-flex align-items-center">
          <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.facebook.com/zahirhaidar.nafisii"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-sm-square bg-white text-primary me-0" href="http://instagram.com/diandrafahriza/"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
      <h2 class="m-0 text-primary">NUSATRADE</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto p-4 p-lg-0">
        <a href="index.php" class="nav-item nav-link">Home</a>
        <a href="produk.php" class="nav-item nav-link">Product</a>
        <a href="tentangkami.php" class="nav-item nav-link">About Us</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Category</a>
          <div class="dropdown-menu fade-up m-0">
            <?php foreach ($datakategori as $key => $value) : ?>
              <a href="kategori.php?id=<?php echo $value["id_kategori"] ?>" class="dropdown-item"><?php echo $value["nama_kategori"] ?></a>
            <?php endforeach ?>
          </div>
        </div>
        <?php
        include 'koneksi.php';
        if (isset($_SESSION["pengguna"])) : ?>
          <?php
          $id = $_SESSION["pengguna"]['id'];
          $ambil = $koneksi->query("SELECT *FROM pengguna WHERE id='$id'");
          $pecah = $ambil->fetch_assoc(); ?>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile</a>
            <div class="dropdown-menu fade-up m-0">
                <a href="edit_profile.php" class="dropdown-item">Edit Profile</a>
                <a href="riwayat.php" class="dropdown-item">History</a>
                <a href="keranjang.php" class="dropdown-item">Cart</a>
                <a href="logout.php" onclick="return confirm('Log Off')" class="dropdown-item">Sing-Out</a>
            </div>
          </div>
        <?php else : ?>
          <a href="daftar.php" class="nav-item nav-link">REGISTER</a>
          <a href="login.php" class="nav-item nav-link">Login</a>
          <?php endif ?>
      </div>
    </div>
  </nav>