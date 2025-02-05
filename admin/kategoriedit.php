<?php
$ambil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<center>
	<h1><b>UBAH KATEGORI</b></h1>
</center>
<form method="post">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" class="bentukform" name="kategori" value=" <?php echo $pecah['nama_kategori']; ?>">
	</div>
	<button class="tombolkecil kanan" name="ubah">Simpan</button>
</form>
<?php
if (isset($_POST['ubah'])) {
	$koneksi->query("UPDATE kategori SET nama_kategori='$_POST[kategori]' WHERE id_kategori='$_GET[id]'");
	echo "<script>alert('kKategori Berhasil Di Ubah');</script>";
	echo "<script> location ='index.php?halaman=kategori';</script>";
}
?>