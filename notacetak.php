<?php
function rupiah($angka) {
    return "Rp " . number_format($angka, 2, ',', '.');
}

include('koneksi.php');

function tanggal($tgl) {
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function getBulan($bln) {
    $bulanArray = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    return $bulanArray[$bln - 1];
}

$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pengguna ON pembelian.id=pengguna.id WHERE pembelian.idbeli='$idpem'");
$pecah = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>PT. Sri Nusantara Abadi - Transaction Contract</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            color: #333;
            margin: 0;
        }
        .container {
            width: 700px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 20pt;
            margin: 0;
        }
        .header p {
            font-size: 10pt;
            margin: 5px 0;
        }
        hr {
            border: 1px solid #333;
            margin: 20px 0;
        }
        .details, .table, .signatures {
            width: 100%;
            margin-bottom: 10px;
        }
        .details td {
            padding: 5px;
            font-size: 10pt;
        }
        .table th, .table td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 10pt;
            text-align: center;
        }
        .table th {
            background-color: #f5f5f5;
        }
        .signatures td {
            padding-top: 50px;
            text-align: center;
        }
        .digital-signature {
            font-size: 10pt;
            color: #333;
            margin-top: 10px;
            display: block;
            text-align: center;
        }
        .signature-image {
            width: 150px;
            height: auto;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <img src="foto/ptsri.png" alt="Logo">
            <h1>PT. Sri Nusantara Abadi</h1>
            <p style='text-align= justify'>MTH Square Ground Floor (GF) A4 A, Jl. Letjen M.T. Haryono, RT.6/RW.12, Bidara Cina, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13330</p>
            <p>Telp : +6287832730722</p>
        </div>
        <hr>
        <!-- Details Section -->
        <table class="details">
            <tr>
                <td><strong>Transaction Id</strong></td>
                <td>: <?= $pecah['notransaksi'] ?></td>
                <td><strong>Date</strong></td>
                <td>: <?= tanggal(date('Y-m-d', strtotime($pecah['tanggalbeli']))) ?></td>
            </tr>
            <tr>
                <td><strong>Name</strong></td>
                <td>: <?= $pecah['nama'] ?></td>
                <td><strong>Address</strong></td>
                <td>: <?= $pecah['alamat'] ?></td>
            </tr>
            <tr>
                <td><strong>Contact</strong></td>
                <td>: <?= $pecah['telepon'] ?></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br>
        <!-- Table Section -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                $ambildetail = $koneksi->query("SELECT * FROM pembelianproduk WHERE idbeli='$idpem'");
                while ($detail = $ambildetail->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= $detail['nama'] ?></td>
                        <td><?= rupiah($detail['harga']) ?></td>
                        <td><?= $detail['jumlah'] ?></td>
                        <td><?= rupiah($detail['subharga']) ?></td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
                <tr>
                    <td colspan="4" style="text-align:right"><strong>Price Total : </strong></td>
                    <td><?= rupiah($pecah['totalbeli']) ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right"><strong>Delivery Fee : </strong></td>
                    <td><?= rupiah($pecah['ongkir']) ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right"><strong>Grand Total : </strong></td>
                    <td><?= rupiah($pecah['totalbeli'] + $pecah['ongkir']) ?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <!-- Signature Section -->
        <table class="signatures">
            <tr>
                <td>Recipient<br><br><br><br><br><br><br><br>(.....................)</td>
                <br>
                <td>
    Best Regards,<br><br>
    <img style="width: 90px; height: 80px;"  src="foto/signature.png" alt="Signature" class="signature-image"><br>
    <span class="digital-signature">Zahir Haidar Nafis<br>Head of PT Sri Nusantara</span>
</td>

            </tr>
        </table>
    </div>
</body>
</html>
