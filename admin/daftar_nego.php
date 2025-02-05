<?php
session_start();
include 'koneksi.php';

// Ambil semua permintaan negosiasi
$query = "SELECT permintaan_nego.id, pengguna.nama, barang.namabarang, permintaan_nego.harga_nego, permintaan_nego.status 
          FROM permintaan_nego
          JOIN pengguna ON permintaan_nego.userid = pengguna.id
          JOIN barang ON permintaan_nego.idbarang = barang.idbarang";
$result = $koneksi->query($query);
?>

<h2>Daftar Permintaan Nego Harga</h2>
<table border="1">
    <tr>
        <th>Nama Pengguna</th>
        <th>Produk</th>
        <th>Harga yang Diajukan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['namabarang']; ?></td>
            <td><?= $row['harga_nego']; ?></td>
            <td><?= $row['status']; ?></td>
            <td>
                <?php if ($row['status'] == 'Pending') { ?>
                    <a href="proses_nego.php?id=<?= $row['id']; ?>&status=Accepted">Setujui</a> |
                    <a href="proses_nego.php?id=<?= $row['id']; ?>&status=Rejected">Tolak</a>
                <?php } ?>
            </td>s
        </tr>
    <?php } ?>
</table>
