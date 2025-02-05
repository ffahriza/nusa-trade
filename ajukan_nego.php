<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idbarang = $_POST['idbarang'];
    $userid = $_POST['userid'];
    $harga_nego = $_POST['harga_nego'];

    $query = "INSERT INTO permintaan_nego (idbarang, userid, harga_nego) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("iid", $idbarang, $userid, $harga_nego);

    if ($stmt->execute()) {
        echo "<script>alert('Your offer has been submitted, wait until our response.');</script>";
        echo "<script>location='keranjang.php';</script>";
    } else {
        echo "<script>alert('Failed to send your offer.');</script>";
    }
}
?>
