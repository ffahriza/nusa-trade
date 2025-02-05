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
			<h1><i class="fa fa-edit"></i> Tambah Produk</h1>
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Tambah Produk</li>
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
								<input type="text" class="form-control" name="nama">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Keyword</label>
								<input type="text" class="form-control" name="keyword">
							</div>
							<div class="form-group">
								<label for="exampleSelect1">Nama Kategori</label>
								<select name="id_kategori" class="form-control">
									<option value="">Pilih Kategori</option>
									<?php foreach ($datakategori as $key => $value) : ?>
										<option value="<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Harga (Rp)</label>
								<input type="number" class="form-control" name="harga">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Berat (*KG)</label>
								<input type="number" class="form-control" name="berat">
							</div>
							<div class="form-group">
								<label for="exampleTextarea">Deskripsi</label>
								<textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"></textarea>
								<script>
									CKEDITOR.replace('deskripsi');
								</script>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Foto</label>
								<input type="file" class="form-control" name="foto">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Stok Produk</label>
								<input type="number" class="form-control" name="stok">
							</div>
							<button class="btn btn-primary float-right btn-round mt-2" name="save">Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
if (isset($_POST['save'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasifoto, "../foto/" . $namafoto);
	$keyword = strtolower($_POST['keyword']);
	$koneksi->query("INSERT INTO barang
		(namabarang,keyword,id_kategori,hargabarang,beratbarang,fotobarang,deskripsibarang, stokbarang)
		VALUES('$_POST[nama]','$keyword','$_POST[id_kategori]','$_POST[harga]','$_POST[berat]','$namafoto','$_POST[deskripsi]','$_POST[stok]')");
	$idbarang_barusan = $koneksi->insert_id;
	echo "<script>alert('Produk Berhasil Di Simpan');</script>";
	echo "<script> location ='index.php?halaman=barang';</script>";
}
?>