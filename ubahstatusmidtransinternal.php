<?php
include 'koneksi.php';

file_put_contents('debug_log.txt', "Accessed at: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

$id = $_GET['order_id'];
$status = $_GET['transaction_status'];

$koneksi->query("UPDATE pembelian SET statusbeli='$status' WHERE notransaksi='$id'") or die(mysqli_error($koneksi));
file_put_contents('debug_log.txt', "Updated order_id $id to status $status\n", FILE_APPEND);

header("Location: https://dcb0-180-252-83-124.ngrok-free.app/ptsri/riwayat.php");
exit();