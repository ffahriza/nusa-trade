<main class="app-content">
	<div class="app-title" style="background-color: #d76c82;">
		<div>
			<h1><i class="fa fa-edit"></i> Tambah Kategori</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Tambah Kategori</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="row">
					<div class="col-lg-12">
						<form method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Kategori</label>
								<input type="text" class="form-control" name="kategori">
							</div>

							<button class="btn btn-primary float-right btn-round mt-2" name="tambah">Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
if (isset($_POST['tambah'])) {
	$kategori = $_POST["kategori"];
	$koneksi->query("INSERT INTO kategori(nama_kategori)
		VALUES ('$kategori')");
	echo "<script> alert('Kategori Berhasil Di Tambah');</script>";
	echo "<script> location ='index.php?halaman=kategori';</script>";
}
?>