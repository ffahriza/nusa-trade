
<main class="app-content">
    <div class="app-title" style="background-color: #d76c82;">
        <div>
            <h1><i class="fa fa-edit"></i> Tambah Promosi</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tambah Promosi</li>
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
                                <input type="text" class="form-control" name="judul" required>
                            </div>
                            <div class="form-group">
                                <label for="pesan">Pesan</label>
                                <textarea class="form-control" name="pesan" id="pesan" rows="5" required></textarea>
                                <script>
                                    CKEDITOR.replace('pesan');
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="tipe">Tipe Promosi</label>
                                <select name="tipe" class="form-control" required>
                                    <option value="">Pilih Tipe Promosi</option>
                                    <option value="Promo">Promo</option>
                                    <option value="Produk Baru">Produk Baru</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <button class="btn btn-primary float-right btn-round mt-2" name="save">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
if (isset($_POST['save'])) {
    $judul = $_POST['judul'];
    $pesan = $_POST['pesan'];
    $tipe = $_POST['tipe'];
    $status = $_POST['status'];

    $gambar = '';
    if (!empty($_FILES['gambar']['name'])) {
        $namagambar = $_FILES['gambar']['name'];
        $namagambarfix = date('Ymd') . $namagambar;
        $lokasigambar = $_FILES['gambar']['tmp_name'];
        $gambar = "../foto/" . $namagambarfix;
        move_uploaded_file($lokasigambar, $gambar);
    }

    $koneksi->query("INSERT INTO promosi (judul, pesan, tipe, gambar)
					VALUES('$judul', '$pesan', '$tipe', '$namagambarfix')");

    echo "<script>alert('Promosi Berhasil Disimpan');</script>";
    echo "<script>location='index.php?halaman=promosidaftar';</script>";
}
?>