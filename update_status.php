<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE pembelian SET status='$status' WHERE idbeli='$id'";
    if ($koneksi->query($query) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
