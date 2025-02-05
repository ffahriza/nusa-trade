<?php
session_start();
include 'koneksi.php';

if (isset($_POST['idbarang']) && isset($_POST['harga_disetujui'])) {
    $idbarang = $_POST['idbarang'];
    $harga_disetujui = $_POST['harga_disetujui'];

    // Update harga di keranjang sesuai batas yang disetujui
    $_SESSION["keranjang_harga"][$idbarang] = $harga_disetujui;

    echo "<script>alert('Your offer has been accepted!');</script>";
    echo "<script>location='keranjang.php';</script>";
}
?>
