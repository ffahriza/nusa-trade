<?php
include '../koneksi.php'; // Pastikan koneksi database benar

// Ambil semua permintaan negosiasi dari database
$query = "SELECT permintaan_nego.id, pengguna.nama AS nama_pengguna, barang.namabarang, permintaan_nego.harga_nego, permintaan_nego.status 
          FROM permintaan_nego
          JOIN pengguna ON permintaan_nego.userid = pengguna.id
          JOIN barang ON permintaan_nego.idbarang = barang.idbarang";
$result = $koneksi->query($query);
?>

<main class="app-content">
    <div class="app-title" style="background-color: #d76c82;">
        <div>
            <h1><i class="fa fa-handshake-o"></i> Daftar Permintaan Nego Harga</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Permintaan Nego Harga</li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>Produk</th>
                                <th>Harga yang Diajukan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['nama_pengguna']; ?></td>
                                    <td><?= $row['namabarang']; ?></td>
                                    <td>Rp <?= number_format($row['harga_nego']); ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td>
                                        <?php if ($row['status'] == 'Pending') { ?>
                                            <a href="proses_nego.php?id=<?= $row['id']; ?>&status=Accepted" class="btn btn-success btn-sm">Setujui</a>
                                            <!-- Tombol untuk membuka form batas harga jika ditolak -->
                                            <button onclick="openRejectForm(<?= $row['id']; ?>)" class="btn btn-danger btn-sm">Tolak</button>
                                            
                                            <!-- Form batas harga, tampil hanya saat tombol Tolak diklik -->
                                            <div id="rejectForm<?= $row['id']; ?>" style="display: none; margin-top: 10px;">
                                                <form action="proses_nego.php" method="POST">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <input type="hidden" name="status" value="Rejected">
                                                    <label for="batas_harga">Price offered:</label>
                                                    <input type="number" name="batas_harga" required class="form-control mb-2">
                                                    <button type="submit" class="btn btn-danger btn-sm">Kirim</button>
                                                </form>
                                            </div>
                                        <?php } else { ?>
                                            <?= $row['status']; ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Tambahkan ini untuk mendukung tampilan tabel responsif -->
<script src="assets_admin/docs/js/jquery-3.2.1.min.js"></script>
<script src="assets_admin/docs/js/popper.min.js"></script>
<script src="assets_admin/docs/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="assets_admin/docs/js/plugins/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
    $('#sampleTable').DataTable({
        responsive: true // Tambahkan responsivitas
    });

    // Fungsi untuk menampilkan form batas harga jika ditolak
    function openRejectForm(id) {
        document.getElementById('rejectForm' + id).style.display = 'block';
    }
</script>
