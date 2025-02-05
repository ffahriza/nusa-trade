<?php
$koneksi->query("DELETE FROM pengguna WHERE id='$_GET[id]'");

echo "<script>alert('pengguna terhapus');</script>";
echo "<script>location='index.php?halaman=pengguna';</script>";
