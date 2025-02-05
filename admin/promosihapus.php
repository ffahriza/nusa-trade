<?php

$ambil = $koneksi->query("SELECT*FROM promosi WHERE idpromosi='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotopromosi = $pecah['gambar'];
if (file_exists("../foto/$fotopromosi")) {
    unlink("../foto/$fotopromosi");
}


$koneksi->query("DELETE FROM promosi WHERE idpromosi='$_GET[id]'");

echo "<script>alert('Produk Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=promosidaftar';</script>";
