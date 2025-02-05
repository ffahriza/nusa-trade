<?php
session_start();
include '../koneksi.php';

// Check if the request is for "Setujui" via GET or "Tolak" via POST
if (isset($_GET['id']) && isset($_GET['status'])) {
    // Handling for "Setujui" with GET request
    $id = $_GET['id'];
    $status = $_GET['status'];

    if ($status === 'Accepted') {
        // Update status for "Disetujui" without batas_harga
        $query = "UPDATE permintaan_nego SET status = ? WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Status negosiasi berhasil diubah.');</script>";
            echo "<script>location='index.php?halaman=permintaan_nego';</script>";
        } else {
            echo "<script>alert('Gagal mengubah status negosiasi.');</script>";
            echo "<script>location='index.php?halaman=permintaan_nego';</script>";
        }
    } else {
        echo "<script>alert('Data tidak valid.');</script>";
        echo "<script>location='index.php?halaman=permintaan_nego';</script>";
    }

} elseif (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['batas_harga'])) {
    // Handling for "Tolak" with POST request
    $id = $_POST['id'];
    $status = $_POST['status'];
    $batas_harga = $_POST['batas_harga'];

    if ($status === 'Rejected' && $batas_harga !== null) {
        // Update status and batas_harga for "Ditolak"
        $query = "UPDATE permintaan_nego SET status = ?, batas_harga = ? WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("sii", $status, $batas_harga, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Status negosiasi berhasil diubah.');</script>";
            echo "<script>location='index.php?halaman=permintaan_nego';</script>";
        } else {
            echo "<script>alert('Gagal mengubah status negosiasi.');</script>";
            echo "<script>location='index.php?halaman=permintaan_nego';</script>";
        }
    } else {
        echo "<script>alert('Data tidak valid.');</script>";
        echo "<script>location='index.php?halaman=permintaan_nego';</script>";
    }

} else {
    echo "<script>alert('Data tidak valid.');</script>";
    echo "<script>location='index.php?halaman=permintaan_nego';</script>";
}
?>