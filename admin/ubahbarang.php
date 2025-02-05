<?php
$ambil = $koneksi->query("SELECT * FROM barang WHERE idbarang='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$datakategori[] = $tiap;
}
?>
<main class="app-content">
	<div class="app-title" style="background-color: #d76c82;">
		<div>
			<h1><i class="fa fa-edit"></i> Ubah Produk</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Ubah Produk</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="row">
					<div class="col-lg-12">
						<form method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama</label>
								<input type="text" class="form-control" name="nama" value="<?php echo $pecah['namabarang']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Keyword</label>
								<input type="text" class="form-control" name="keyword" value="<?php echo $pecah['keyword']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleSelect1">Nama Kategori</label>
								<select name="id_kategori" class="form-control">
									<option value="">Pilih Kategori</option>
									<?php foreach ($datakategori as $key => $value) : ?>
										<option value="<?php echo $value["id_kategori"] ?>" <?php if ($pecah["id_kategori"] == $value["id_kategori"]) {
																								echo "selected";
																							} ?>><?php echo $value["nama_kategori"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Harga (Rp)</label>
								<input type="number" class="form-control" name="harga" value="<?php echo $pecah['hargabarang']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Berat (*KG)</label>
								<input type="number" class="form-control" name="berat" value="<?php echo $pecah['beratbarang']; ?>">
							</div>
							<div class="form-group">
								<img src="../foto/<?php echo $pecah['fotobarang']; ?>" width="200">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Ganti Foto</label>
								<input type="file" class="form-control" name="foto">
							</div>
							<div class="form-group">
								<label for="exampleTextarea">Deskripsi</label>
								<textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"></textarea>
								<script>
									CKEDITOR.replace('deskripsi');
								</script>
							</div>

							<div class="form-group">
								<label for="exampleInputPassword1">Stok Produk</label>
								<input type="number" class="form-control" name="stok" value="<?php echo $pecah['stokbarang']; ?>">
							</div>
							<button class="btn btn-primary float-right btn-round mt-2" name="ubah">Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
if (isset($_POST['ubah'])) {
	$keyword = strtolower($_POST['keyword']);
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	if (!empty($lokasifoto)) {
		move_uploaded_file($lokasifoto, "../foto/$namafoto");
		$koneksi->query("UPDATE barang SET namabarang='$_POST[nama]',keyword='$keyword',id_kategori='$_POST[id_kategori]',hargabarang='$_POST[harga]',beratbarang='$_POST[berat]',fotobarang='$namafoto', deskripsibarang='$_POST[deskripsi]', stokbarang='$_POST[stok]' WHERE idbarang='$_GET[id]'");
	} else {
		$koneksi->query("UPDATE barang SET namabarang='$_POST[nama]',keyword='$keyword',id_kategori='$_POST[id_kategori]',hargabarang='$_POST[harga]',beratbarang='$_POST[berat]', deskripsibarang='$_POST[deskripsi]', stokbarang='$_POST[stok]' WHERE idbarang='$_GET[id]'");
	}
	echo "<script>alert('Data Produk Berhasil Diubah');</script>";
	echo "<script>location='index.php?halaman=barang';</script>";
}
?>