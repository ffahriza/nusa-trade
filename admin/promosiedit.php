<?php
$id = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM promosi WHERE idpromosi='$id'");
$data = $ambil->fetch_assoc();

if (!$data) {
    echo "<script>alert('Data tidak ditemukan');</script>";
    echo "<script>location='index.php?halaman=promosidaftar';</script>";
    exit;
}
?>
<main class="app-content">
    <div class="app-title" style="background-color: #d76c82;">
        <div>
            <h1><i class="fa fa-edit"></i> Edit Promosi</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Edit Promosi</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">

                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" name="judul" value="<?php echo $data['judul']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="pesan">Pesan</label>
                                <textarea class="form-control" name="pesan" id="pesan" rows="5" required><?php echo $data['pesan']; ?></textarea>
                                <script>
                                    CKEDITOR.replace('pesan');
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="tipe">Tipe Promosi</label>
                                <select name="tipe" class="form-control" required>
                                    <option value="Promo" <?php echo ($data['tipe'] == 'Promo') ? 'selected' : ''; ?>>Promo</option>
                                    <option value="Produk Baru" <?php echo ($data['tipe'] == 'Produk Baru') ? 'selected' : ''; ?>>Produk Baru</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                                <small class="form-text text-muted">Jika ingin mengubah gambar, silakan unggah gambar baru.</small>
                            </div>
                            <button class="btn btn-primary float-right btn-round mt-2" name="update">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $pesan = $_POST['pesan'];
    $tipe = $_POST['tipe'];

    $id = $_GET['id'];

    $gambar = '';
    if (!empty($_FILES['gambar']['name'])) {
        $namagambar = $_FILES['gambar']['name'];
        $namagambarfix = date('Ymd') . $namagambar;
        $lokasigambar = $_FILES['gambar']['tmp_name'];
        $gambar = "../foto/" . $namagambarfix;
        move_uploaded_file($lokasigambar, $gambar);

        $koneksi->query("UPDATE promosi SET judul='$judul', pesan='$pesan', tipe='$tipe', gambar='$namagambarfix' WHERE idpromosi='$id'");
    } else {
        $koneksi->query("UPDATE promosi SET judul='$judul', pesan='$pesan', tipe='$tipe' WHERE idpromosi='$id'");
    }

    echo "<script>alert('Promosi Berhasil Diperbarui');</script>";
    echo "<script>location='index.php?halaman=promosidaftar';</script>";
}
?>