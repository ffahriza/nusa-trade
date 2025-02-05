
<?php
$koneksi->query("DELETE FROM pembelian WHERE idbeli='$_GET[id]'");

echo "<script>alert('Pembelian Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=pembelian';</script>";

?>