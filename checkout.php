<?php

namespace Midtrans;

require_once 'Midtrans.php';

Config::$serverKey = 'SB-Mid-server-5q6LCsTxMzj7ClD9yfyFD_qx';
Config::$clientKey = 'SB-Mid-client-GHAqOJodIWM2OPsP';

printExampleWarningMessage();

Config::$isSanitized = Config::$is3ds = true;

function printExampleWarningMessage()
{
	if (strpos(Config::$serverKey, 'your ') != false) {
		echo "<code>";
		echo "<h4>Please set your server key from sandbox</h4>";
		echo "In file: " . __FILE__;
		echo "<br>";
		echo "<br>";
		echo htmlspecialchars('Config::$serverKey = \"SB-Mid-server-5q6LCsTxMzj7ClD9yfyFD_qx\";');
		die();
	}
}

session_start();
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
	echo "<script> alert('You haven\'t sign-in');</script>";
	echo "<script> location ='login.php';</script>";
}
$idakun = $_SESSION["pengguna"]["id"];
$ambildata = $koneksi->query("SELECT * FROM pengguna WHERE id='$idakun'");
$akun = $ambildata->fetch_assoc();
?>

<?php include 'header.php'; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">Checkout</h6>
            <h1 class="mb-5">Checkout</h1>
        </div>
        <div class="row g-4">
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-white">
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Product Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Price Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        $totalberat = 0;
                        $totalbelanja = 0;

                        if (empty($_SESSION["keranjang"])) {
                            echo "<tr><td colspan='6' class='text-center'>Your cart is empty.</td></tr>";
                            return;
                        }

                        foreach ($_SESSION["keranjang"] as $idbarang => $jumlah) {
                            // Ambil data barang dari database
                            $ambil = $koneksi->query("SELECT * FROM barang WHERE idbarang='$idbarang'");
                            $pecah = $ambil->fetch_assoc();

                            // Cek apakah ada harga dari session keranjang_harga
                            $harga = isset($_SESSION["keranjang_harga"][$idbarang]) 
                                ? $_SESSION["keranjang_harga"][$idbarang] 
                                : $pecah['hargabarang'];

                            // Hitung total harga untuk barang ini
                            $totalharga = $harga * $jumlah;
                            $subberat = $pecah["beratbarang"] * $jumlah;

                            // Tambahkan ke total berat dan total belanja
                            $totalberat += $subberat;
                            $totalbelanja += $totalharga;
                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah['namabarang']; ?></td>
                            <td class="image-prod">
                                <img src="foto/<?php echo $pecah["fotobarang"]; ?>" style="width: 150px; border-radius:10px">
                            </td>
                            <td>IDR <?php echo number_format($harga); ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>IDR <?php echo number_format($totalharga); ?></td>
                        </tr>
                        <?php
                            $nomor++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="d-none d-sm-block mb-5 pb-4">
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form class="form-contact contact_form" method="post">
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Checkout Detail</h2>
                        <label class="signin-form">For International Customer, skip state and city form.</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="mb-3 text-white">Name</label>
                            <input type="text" readonly value="<?php echo $_SESSION["pengguna"]['nama'] ?>" class="form-control valid mb-3" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="mb-3 text-white">Mobile Number</label>
                            <input type="text" readonly value="<?php echo $_SESSION["pengguna"]['telepon'] ?>" class="form-control valid mb-3" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-3 text-white">Full Address</label>
                            <input type="hidden" name="totalberatnya" value="<?php echo $totalberat ?>">
                            <textarea class="form-control valid mb-3" rows="5" name="alamatpengiriman" placeholder="Type your full address here" required></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-3 text-white">State</label>
                            <select class="form-control" name="nama_provinsi"></select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-3 text-white">City</label>
                            <select class="form-control" name="nama_distrik"></select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-3 text-white">Expedition</label>
                            <select class="form-control" name="nama_ekspedisi"></select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-3 text-white">Layanan</label>
                            <select class="form-control" name="nama_paket"></select>
                        </div>
                    </div>
                    <input type="hidden" id="dua" name="dua" value="<?php echo $totalbelanja ?>">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-3 text-white">Product Total Price</label>
                            <input class="form-control mb-3" type="number" readonly required value="<?= $totalbelanja ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-3 text-white">Delivery Fee</label>
                            <input class="form-control mb-3" name="ongkir" type="number" readonly required id="res">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-3 text-white">Grand Total</label>
                            <input class="form-control mb-3" id="grandtotal" name="grandtotal" required readonly type="number" value="<?= $totalbelanja ?>">
                        </div>
                    </div>
                    <input type="hidden" name="totalbelanja" id="totalbelanja" value="<?= $totalbelanja ?>">
                    <input type="hidden" name="total_berat" value="1">
                    <input type="hidden" name="provinsi">
                    <input type="hidden" name="distrik">
                    <input type="hidden" name="tipe">
                    <input type="hidden" name="kodepos">
                    <input type="hidden" name="ekspedisi">
                    <input type="hidden" name="paket">
                    <input type="hidden" name="ongkir">
                    <input type="hidden" name="estimasi">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" name="checkout" class="btn btn-primary">Buy Now</button>
                </div>
                <div class="label">
                    <small class="label mb-3">If you have a problem getting delivery fee please contact us by <a href="https://wa.me/6281282873142"></a>WhatsApp here</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST["checkout"])) {
    $notransaksi = 'TP' . date("Ymdhis");
    $id = $_SESSION["pengguna"]["id"];
    $tanggalbeli = date("Y-m-d");
    $waktu = date("Y-m-d H:i:s");
    $alamatpengiriman = $_POST["alamatpengiriman"];
    $totalbelanja = $_POST["totalbelanja"];
    $ongkir = $_POST["ongkir"];
    $totalbeli = $totalbelanja + $ongkir; // Total harga setelah negosiasi + ongkir
    $totalberatnya = $_POST["totalberatnya"];
    $provinsi = $_POST["nama_provinsi"];
    $kota = $_POST["nama_distrik"];
    $ekspedisi = strtoupper($_POST["nama_ekspedisi"]);
    $layanan = $_POST["nama_paket"];

    // Simpan data pembelian ke database
    $koneksi->query(
        "INSERT INTO pembelian(notransaksi, id, tanggalbeli, totalbeli, alamatpengiriman, totalberat, ongkir, statusbeli, waktu, kota, provinsi, ekspedisi, layanan)
         VALUES('$notransaksi', '$id', '$tanggalbeli', '$totalbeli', '$alamatpengiriman', '$totalberatnya', '$ongkir', '', '$waktu', '$kota', '$provinsi', '$ekspedisi', '$layanan')"
         
    );

    $idbeli_barusan = $koneksi->insert_id;

    $item_details = array();
    foreach ($_SESSION['keranjang'] as $idbarang => $jumlah) {
        $ambil = $koneksi->query("SELECT * FROM barang WHERE idbarang='$idbarang'");
        $perbarang = $ambil->fetch_assoc();

        // Gunakan harga dari $_SESSION["keranjang_harga"] jika ada
        $harga = isset($_SESSION["keranjang_harga"][$idbarang])
            ? $_SESSION["keranjang_harga"][$idbarang]
            : $perbarang['hargabarang'];

        $nama = $perbarang['namabarang'];
        $berat = $perbarang['beratbarang'];

        $subberat = $berat * $jumlah;
        $subharga = $harga * $jumlah;

        $koneksi->query(
            "INSERT INTO pembelianproduk (idbeli, idproduk, nama, harga, berat, subberat, subharga, jumlah)
             VALUES ('$idbeli_barusan', '$idbarang', '$nama', '$harga', '$berat', '$subberat', '$subharga', '$jumlah')"
        );

        // Tambahkan ke item_details untuk Midtrans
        $item_details[] = array(
            'id' => $idbarang,
            'price' => $harga,
            'quantity' => $jumlah,
            'name' => $nama
        );
    }

    // Tambahkan ongkir ke item_details untuk Midtrans
    $item_details[] = array(
        'id' => 'ONGKIR',
        'price' => $ongkir,
        'quantity' => 1,
        'name' => 'Ongkos Kirim'
    );

    // Informasi transaksi untuk Midtrans
    $transaction_details = array(
        'order_id' => $notransaksi,
        'gross_amount' => $totalbeli, // Total harga setelah nego + ongkir
    );

    // Informasi pelanggan
    $billing_address = array(
        'first_name'    => $akun['nama'],
        'last_name'     => "",
        'address'       => $alamatpengiriman,
        'city'          => $kota,
        'postal_code'   => "30118",
        'phone'         => $akun['telepon'],
        'country_code'  => 'IDN'
    );

    $shipping_address = array(
        'first_name'    => $akun['nama'],
        'last_name'     => "",
        'address'       => $alamatpengiriman,
        'city'          => $kota,
        'postal_code'   => "30118",
        'phone'         => $akun['telepon'],
        'country_code'  => 'IDN'
    );

    $customer_details = array(
        'first_name'    => $akun['nama'],
        'last_name'     => "",
        'email'         => $akun['email'],
        'phone'         => $akun['telepon'],
        'billing_address'  => $billing_address,
        'shipping_address' => $shipping_address
    );

    $transaction = array(
        'transaction_details' => $transaction_details,
        'customer_details' => $customer_details,
        'item_details' => $item_details,
    );

    $snap_token = '';
    try {
        $snap_token = Snap::getSnapToken($transaction);
        // Simpan token snap ke database
        $koneksi->query("UPDATE pembelian SET snapkode='$snap_token' WHERE idbeli='$idbeli_barusan'");
        echo "<script>alert('Transaction created successfully!');</script>";
        echo "<script>location='riwayat.php';</script>";
    } catch (\Exception $e) {
        echo "<script>alert('Failed to create transaction: " . addslashes($e->getMessage()) . "');</script>";
        echo "<script>location='checkout.php';</script>";
        exit();
    }
}
?>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
<script>
	$(document).ready(function() {
		// Mengambil data provinsi saat halaman dimuat
		$.ajax({
			type: 'post',
			url: 'dataprovinsi.php',
			success: function(hasil_provinsi) {
				$("select[name=nama_provinsi]").html(hasil_provinsi);
			}
		});

		// Ketika provinsi dipilih, ambil data distrik berdasarkan provinsi
		$("select[name=nama_provinsi]").on("change", function() {
			var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
			$.ajax({
				type: 'post',
				url: 'datadistrik.php',
				data: 'id_provinsi=' + id_provinsi_terpilih,
				success: function(hasil_distrik) {
					$("select[name=nama_distrik]").html(hasil_distrik);
				}
			});
		});

		// Mengambil data ekspedisi
		$.ajax({
			type: 'post',
			url: 'dataekspedisi.php',
			success: function(hasil_ekspedisi) {
				$("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
			}
		});

		// Ketika ekspedisi dipilih, ambil data ongkir dan paket
		$("select[name=nama_ekspedisi]").on("change", function() {
			var ekpedisi_terpilih = $("select[name=nama_ekspedisi]").val();
			var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
			var total_berat = $("input[name=total_berat]").val();
			$.ajax({
				type: 'post',
				url: 'datapaket.php',
				data: 'ekspedisi=' + ekpedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + total_berat,
				success: function(hasil_paket) {
					console.log(hasil_paket);
					$("select[name=nama_paket]").html(hasil_paket);
					$("input[name=ekspedisi]").val(ekpedisi_terpilih);
				}
			});
		});

		// Ketika distrik dipilih, perbarui informasi distrik di input tersembunyi
		$("select[name=nama_distrik]").on("change", function() {
			var prov = $("option:selected", this).attr("nama_provinsi");
			var dist = $("option:selected", this).attr("nama_distrik");
			var tipe = $("option:selected", this).attr("tipe_distrik");
			var kodepos = $("option:selected", this).attr("kodepos");

			$("input[name=provinsi]").val(prov);
			$("input[name=distrik]").val(dist);
			$("input[name=tipe]").val(tipe);
			$("input[name=kodepos]").val(kodepos);
		});

		// Ketika paket dipilih, perbarui informasi ongkir dan total belanja
		$("select[name=nama_paket]").on("change", function() {
			var paket = $("option:selected", this).attr("paket");
			var ongkir = $("option:selected", this).attr("ongkir");
			var etd = $("option:selected", this).attr("etd");

			$("input[name=paket]").val(paket);
			$("input[name=ongkir]").val(ongkir);
			$("input[name=estimasi]").val(etd);

			// Update grand total
			var totalBelanja = parseInt(document.getElementById("totalbelanja").value) || 0;
			var totalGrand = totalBelanja + parseInt(ongkir || 0);
			document.getElementById("grandtotal").value = totalGrand;

            
		});
	});
</script>
<?php
include 'footer.php';
?>
