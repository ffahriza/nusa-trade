<?php
session_start();
include 'koneksi.php';
?>
<?php
$idbarang = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM barang WHERE idbarang='$idbarang'");
$detail = $ambil->fetch_assoc();
$kategori = $detail["id_kategori"];
?>
<?php include 'header.php'; ?>
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Product Detail</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center text-uppercase">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item text-white active" aria-current="page">Product Detail</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<div style="padding-top: 100px;"></div>

<div class="container-xxl py-5">
	<div class="container">
		<div class="row g-5">
			<div class="col-lg-6 pt-4" style="min-height: 400px;">
				<div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
					<img class="position-absolute img-fluid w-100 h-100" src="foto/<?php echo $detail["fotobarang"]; ?>" style="object-fit: cover;" alt="">
				</div>
			</div>
			<div class="col-lg-6">
				<h1 class="mb-4"><?php echo $detail["namabarang"] ?></h1>
				<ul class="blog-info-link mt-3 mb-4 text-white">
					<li>IDR. <?php echo number_format($detail["hargabarang"]); ?> / Kg</li>
					<li>Available  Stock : <?php echo $detail["stokbarang"]; ?></li>
				</ul>

				<h4 class="widget_title">Description</h4>
				<p class="text-white" style="text-align:justify">
					<?php echo $detail["deskripsibarang"]; ?>
				</p>
				<h4 class="widget_title">Buy Product</h4>
				<form method="post">
					<div class="form-group">
						<div class="mb-3">
							<label for="qty" class="text-white mb-3">Quantity (Kg) :</label>
							<input type="number" min="1" name="jumlah" max="<?php echo number_format($detail["stokbarang"]); ?>" required value="1" required class="form-control">
						</div>
						<div class="card_area">
							<button class="btn btn-primary" name="beli"><i class="fa fa-shopping-cart"></i> Buy Now</button>
						</div>
					</div>
				</form>
				<?php
				if (isset($_POST["beli"])) {
					$jumlah = $_POST["jumlah"];
					$_SESSION["keranjang"][$idbarang] = $jumlah;
					echo "<script> alert('Added to Your Cart');</script>";
					echo "<script> location ='keranjang.php';</script>";
				}
				?>
				</aside>
			</div>
		</div>
	</div>
</div>
<div style="padding-top: 100px;"></div>

<?php
include 'footer.php';
?>