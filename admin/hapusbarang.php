<?php

$ambil = $koneksi->query("SELECT*FROM barang WHERE idbarang='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotobarang = $pecah['fotobarang'];
if (file_exists("../foto/$fotobarang")) {
	unlink("../foto/$fotobarang");
}


$koneksi->query("DELETE FROM barang WHERE idbarang='$_GET[id]'");

echo "<script>alert('Produk Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=barang';</script>";
