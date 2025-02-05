<?php
session_start();
include 'koneksi.php';
?>
<?php include 'header.php';
$kategori = $_GET["id"];
$semuadata = array();
$ambil = $koneksi->query("SELECT*FROM barang WHERE id_kategori LIKE '%$kategori%'");
while ($pecah = $ambil->fetch_assoc()) {
	$semuadata[] = $pecah;
}
?>
<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$datakategori[] = $tiap;
}
?>
<?php $am = $koneksi->query("SELECT * FROM kategori where id_kategori='$kategori'");
$pe = $am->fetch_assoc()
?>
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Product Category</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center text-uppercase">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item text-white active" aria-current="page">Category</li>
				</ol>
			</nav>
		</div>
	</div>
</div>

<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h6 class="text-primary text-uppercase">Our Product</h6>
			<h1 class="mb-5">Category : <?php echo $pe["nama_kategori"] ?></h1>
		</div>
		<div class="row g-4">
			<?php foreach ($semuadata as $key => $perbarang) : ?>

				<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
					<div class="team-item">
						<div class="position-relative overflow-hidden">
							<img class="img-fluid" width="100%" src="foto/<?php echo $perbarang['fotobarang'] ?>" alt="">
						</div>
						<div class="bg-light text-center  p-4">
							<h5 class="fw-bold mb-0 text-dark"><?php echo $perbarang['namabarang'] ?></h5>
							<small>IDR <?php echo number_format($perbarang['hargabarang']) ?></small>
							<br><br>
							<a href="detail.php?id=<?php echo $perbarang['idbarang']; ?>" class="btn btn-primary w-100">Buy</a>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<?php
include 'footer.php';
?>