<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');
?>
<main class="app-content">
    <div class="app-title" style="background-color: #d76c82;">
        <div>
            <h1><i class="fa fa-th-list"></i> Daftar promosi</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Daftar Promosi</li>
        </ul>
    </div>
    <a href="index.php?halaman=promositambah" class="btn btn-primary btn-sm btn-round mb-4">Tambah Promosi</a>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Pesan</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php $ambil = $koneksi->query("SELECT * FROM promosi"); ?>
                            <?php while ($data = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor ?></td>
                                    <td><?php echo $data["judul"] ?></td>
                                    <td><?php echo $data["pesan"] ?></td>
                                    <td><?php echo $data["tipe"] ?></td>
                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="idpromosi" value="<?php echo $data['idpromosi']; ?>">
                                            <button type="submit" name="kirim_email" class="btn btn-info btn-sm btn-round mt-2" onclick="return confirm('Apakah Anda yakin ingin mengirim promosi ini ke email pelanggan?')">Kirim ke Email Pelanggan</button>
                                        </form>
                                        <a href="index.php?halaman=promosiedit&id=<?php echo $data['idpromosi']; ?>" class="btn btn-warning btn-sm btn-round mt-2">Ubah</a>
                                        <a href="index.php?halaman=promosihapus&id=<?php echo $data['idpromosi']; ?>" class="btn btn-danger btn-sm btn-round mt-2" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
if (isset($_POST['kirim_email'])) {
    $idpromosi = $_POST['idpromosi'];
    $ambil = $koneksi->query("SELECT * FROM promosi WHERE idpromosi = '$idpromosi'");
    $data = $ambil->fetch_assoc();

    // Mengambil informasi dari database
    $judul = $data['judul'];
    $pesan = $data['pesan'];
    $gambar = $data['gambar']; 

    // Inisialisasi PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0; // Hapus atau ganti dengan 2 untuk debug
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'srinusantaraabadi@gmail.com';
        $mail->Password = 'zptv ljjr othb cugd';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('srinusantaraabadi@gmail.com', 'PT. Sri Nusantara Abadi');
        $mail->addReplyTo('no-reply@gmail.com', 'No-reply');

        // Ambil semua email pelanggan
        $ambilPelanggan = $koneksi->query("SELECT email FROM pengguna WHERE level = 'Pelanggan'");

        // Loop melalui setiap pelanggan dan kirim email
        while ($pelanggan = $ambilPelanggan->fetch_assoc()) {
            $emailPelanggan = $pelanggan['email'];
            $mail->addAddress($emailPelanggan);

            // Set email format ke HTML
            $mail->isHTML(true);
            $mail->Subject = $judul;

            // Menyusun isi email dengan gambar
            $isi = "<h1>$judul</h1>";
            $isi .= "<p>$pesan</p>";
          

            $mail->Body = $isi;
            $mail->AltBody = strip_tags($isi);
            $gambarPath = "../foto/" . $gambar; // Path gambar
            $mail->addAttachment($gambarPath, $gambar); // Menambahkan lampiran

            $mail->send();
            $mail->clearAddresses(); 
        }

    } catch (Exception $e) {
        echo "<script>alert('Pesan gagal dikirim. Error: {$mail->ErrorInfo}');</script>";
    }

    echo "<script> alert('Pesan telah dikirim ke semua pelanggan');</script>";
    echo "<script>location='index.php?halaman=promosidaftar';</script>";
}

?>