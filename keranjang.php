<?php
session_start();
include 'koneksi.php';
?>
<?php include 'header.php'; ?>
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">CART</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">CART</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">CART</h6>
            <h1 class="mb-5">Cart</h1>
        </div>
        <div class="row g-4">
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-white">
                        <tr>
                            <th>No</th>
                            <th>Image Product</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Option</th>
                            <th>Negotiate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php if (!empty($_SESSION["keranjang"])) { ?>
                            <?php foreach ($_SESSION["keranjang"] as $idbarang => $jumlah) : ?>
                                <?php
                                $ambil = $koneksi->query("SELECT * FROM barang WHERE idbarang='$idbarang'");
                                $pecah = $ambil->fetch_assoc();
                                
                                // Cek apakah ada harga nego yang disetujui atau batas harga jika ditolak
                                $queryNego = "SELECT harga_nego, status, batas_harga FROM permintaan_nego 
                                              WHERE idbarang = '$idbarang' 
                                              AND userid = '{$_SESSION['pengguna']['id']}' 
                                              ORDER BY id DESC LIMIT 1";
                                $resultNego = $koneksi->query($queryNego);
                                $negoData = $resultNego->fetch_assoc();
                                
                                // Gunakan harga yang disetujui jika ada
                                $harga_nego = ($negoData && $negoData['status'] == 'Accepted') ? $negoData['harga_nego'] : (isset($_SESSION["keranjang_harga"][$idbarang]) ? $_SESSION["keranjang_harga"][$idbarang] : $pecah['hargabarang']);
                                $status_nego = $negoData ? $negoData['status'] : 'Pending';
                                $batas_harga = ($negoData && $negoData['status']  == 'Rejected' ) ? $negoData['batas_harga'] : null; 
                                
                                $totalharga = $harga_nego * $jumlah;
                                ?>
                                <tr class="text-tengah">
                                    <td style="color: white;"><?php echo $nomor; ?></td>
                                    <td class="image-prod ">
                                        <img src="foto/<?php echo $pecah["fotobarang"]; ?>" style="width: 100px;border-radius:8px">
                                    </td>
                                    <td style="color: white;"><?php echo $pecah['namabarang']; ?></td>
                                    <td style="color: white;"><?php echo $jumlah; ?></td>
                                    <td style="color: white;">IDR <?php echo number_format($harga_nego); ?></td>
                                    <td style="color: white;">IDR <?php echo number_format($totalharga); ?></td>
                                    <td style="color: white;">
                                        <?php 
                                        echo $status_nego;
                                        if ($status_nego == 'Rejected' && $batas_harga) {
                                            echo "<br>Admin offer: IDR " . number_format($batas_harga);
                                            echo "<form action='update_harga.php' method='POST' style='display:inline; margin-top:10px;'>
                                                    <input type='hidden' name='idbarang' value='$idbarang'>
                                                    <input type='hidden' name='harga_disetujui' value='$batas_harga'>
                                                    <label class='small' type='hidden' name=label>Press Agree Before procceding to Checkout</label>
                                                    <button type='submit' class='btn btn-success btn-sm'>Agree</button>
                                                  </form>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="hapuskeranjang.php?id=<?php echo $idbarang ?>" class="btn btn-primary">Delete</a>
                                    </td>
                                    <td>
                                        <?php if ($status_nego != 'Accepted') : ?>
                                            <button onclick="openNegoForm(<?= $idbarang; ?>)" class="btn btn-warning">Negotiate Price</button>
                                            <div id="negoForm<?= $idbarang; ?>" style="display: none; margin-top: 10px;">
                                                <form action="ajukan_nego.php" method="POST">
                                                    <input type="hidden" name="idbarang" value="<?= $idbarang; ?>">
                                                    <input type="hidden" name="userid" value="<?= $_SESSION['pengguna']['id']; ?>">
                                                    <label for="harga_nego" style="color: white;">Your Offer(/kg):</label>
                                                    <input type="number" name="harga_nego" required class="form-control mb-2">
                                                    <button type="submit" class="btn btn-success">Offer</button>
                                                </form>
                                            </div>
                                        <?php else : ?>
                                            <span>Your offer has been accepted, please procced to payment.</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                            <?php endforeach; ?>
                        <?php } ?>
                    </tbody>
                </table>

                <br>
                <a href="checkout.php" class="btn btn-success">Checkout</a>
            </div>
        </div>
    </div>
</div>

<script>
    function openNegoForm(idbarang) {
        document.getElementById('negoForm' + idbarang).style.display = 'block';
    }
</script>

<?php include 'footer.php'; ?>
