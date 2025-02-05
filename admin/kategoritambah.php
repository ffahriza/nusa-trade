<center>
	<h1><b>DATA KATEGORI</b></h1>
</center>
<form method="post">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" class="bentukform" name="kategori">
	</div>
	<button class="tombolkecil kanan" name="tambah">Simpan</button>
</form>
<?php
if (isset($_POST['tambah'])) {
	$kategori = $_POST["kategori"];
	$koneksi->query("INSERT INTO kategori(nama_kategori)
		VALUES ('$kategori')");
	echo "<script> alert('Kategori Berhasil Di Tambah');</script>";
	echo "<script> location ='index.php?halaman=kategori';</script>";
}
?>