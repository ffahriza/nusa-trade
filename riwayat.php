<?php

namespace Midtrans;

require_once 'Midtrans.php';

// Midtrans configuration
Config::$serverKey = 'SB-Mid-server-5q6LCsTxMzj7ClD9yfyFD_qx';
Config::$clientKey = 'SB-Mid-client-GHAqOJodIWM2OPsP';
// Config::$serverKey = 'Mid-server-si9uFFJs6EBooj7fQxR3sxcQ';
// Config::$clientKey = 'Mid-client-SOgPsHAdgABBnpiO';
Config::$isSanitized = Config::$is3ds = true;

session_start();
include 'koneksi.php';

if (!isset($_SESSION["pengguna"])) {
    echo "<script> alert('Anda belum login');</script>";
    echo "<script> location ='login.php';</script>";
    exit;
}

include 'header.php';

$id = $_SESSION["pengguna"]['id'];
?>

<!-- CSS for centered text and other styles -->
<style>
    .centered-text {
        text-align: center;
    }
</style>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>


<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">History</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">History</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">Buy History</h6>
            <h1 class="mb-5">Buy History</h1>
        </div>
        <div class="row g-4">
            <div class="table-responsive">
                <table class="table text-white">
                    <thead class="bg-white text-dark">
                        <tr class="centered-text">
                            <th>+</th>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Option</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $nomor = 1;
                        $ambil = $koneksi->query("SELECT *, pembelian.idbeli as idbelireal FROM pembelian WHERE pembelian.id='$id' ORDER BY pembelian.tanggalbeli DESC, pembelian.idbeli DESC");
                        while ($pecah = $ambil->fetch_assoc()) {
                            if ($pecah['statusbeli'] != '') {
                                $notransaksi = $pecah['notransaksi'];
                                $status = \Midtrans\Transaction::status($notransaksi);
                                $transaction = $status->transaction_status;
                                if ($pecah['statusbeli'] == 'pending') {
                                    $koneksi->query("POST pembelian SET statusbeli='$transaction' WHERE idbeli='$pecah[idbelireal]'") or die(mysqli_error($koneksi));
                                }
                            }
                            ?>
                            <tr class="centered-text">
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo tanggal($pecah['tanggalbeli']) . '<br>Time (GMT+7) ' . date('H:i', strtotime($pecah['waktu'])); ?></td>
                                <td>
                                    <ul style="padding: 0;list-style-type: none;">
                                        <?php
                                        $ambildetail = $koneksi->query("SELECT * FROM pembelianproduk WHERE idbeli='$pecah[idbelireal]'");
                                        while ($detail = $ambildetail->fetch_assoc()) {
                                            echo '<li><b>- ' . $detail['nama'] . '</b></li>';
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>IDR. <?php echo number_format($pecah["totalbeli"]); ?></td>
                                <td>
                                    <b>
                                        <?php
                                        if ($pecah['statusbeli'] != '') {
                                            if ($transaction == 'settlement') {
                                                echo "<label class='text-success'>Paid</label><br>";
                                                if ($pecah['statusbeli'] == 'On Its Way') {
                                                    echo "<button class='btn btn-primary' onclick='showConfirmModal(" . $pecah['idbelireal'] . ")'>Complete Delivery</button>";
                                                } else {
                                                    echo $pecah['statusbeli'];
                                                }
                                            } else if ($transaction == 'pending') {
                                                echo "<label class='text-warning'>Pending, Complete transaction first</label>";
                                            } else if ($transaction == 'deny') {
                                                echo "<label class='text-danger'>Rejected</label>";                            
                                            } else if ($transaction == 'expire') {
                                                echo "<label class='text-danger'>Failed, your payment has exceeded the payment limit</label>";
                                            } else if ($transaction == 'cancel') {
                                                echo "<label class='text-danger'>Canceled</label>";
                                            } else {
                                                echo "<label class='text-danger'>Canceled</label>";
                                            }
                                        } else {
                                            echo 'Please complete your transaction first';
                                        }
                                        ?>
                                    </b>
                                </td>
                                <td>
                                    <button class="pay-button btn-btn-info" data-snapkode="<?php echo $pecah['snapkode']; ?>">Pay Now</button>
                                    <script type="text/javascript">
                                        console.log('Midtrans snap.js is loaded');
                                        document.addEventListener("DOMContentLoaded", function() {
                                        var payButtons = document.querySelectorAll('.pay-button');
                                        payButtons.forEach(function(button) {
                                        button.addEventListener('click', function () {
                                            var snapkode = button.getAttribute('data-snapkode'); // Ambil data snapkode dari atribut data-* HTML
                                            console.log("Token Snap: " + snapkode); // Debug: lihat apakah token sudah benar
                                
                                            // Cek apakah snapkode tidak kosong
                                            if (snapkode) {
                                            snap.pay(snapkode);  // Panggil snap.pay jika snapkode ada
                                            } else {
                                            console.log('Token Snap tidak ditemukan');
                                            }
                                        });
                                        });
                                    });
                                    </script>
                                </td>
                                <td>
                                    <a class="btn btn-primary" target="_blank" href="notacetak.php?id=<?php echo $pecah['idbeli']; ?>">Receipt</a>
                                </td>

                            </tr>
                        <?php $nomor++; } ?>
                    </tbody>
                </table>
                <div class="label">
				<small class="label mb-3" >If you have a problem please contact us by whatsapp <a href="https://wa.me/6281282873142">here</a></small>			
				</div>	
            </div>
        </div>
    </div>
</div>
<!-- Modal for Notes -->
<div class="modal fade" id="notesModal" tabindex="-1" aria-labelledby="notesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notesModalLabel"><strong>Note</strong></h5>
            </div>
            <div class="modal-body">
                <p id="noteContent" class="btn btn-warning" onclick="showNotes('<?php echo ($pecah['catatan']); ?> ')">INFO</p>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Confirm Order -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Delivery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Please make sure your product has been delivered, confirm delivery?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="confirmOrder()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
    // function bayar(id) {
    //     snap.pay(id);

    // }
    
    function showNotes(noteContent) {
        document.getElementById('noteContent').innerText = noteContent;
        $('#notesModal').modal('show'); // Use jQuery to show modal
    }

    let orderId; // Global variable to hold the order ID for confirmation

    function showConfirmModal(id) {
        orderId = id; // Set the global order ID
        $('#confirmModal').modal('show');
    }
    
    
    function updateTransactionStatus(transactionId, status) {
    $.ajax({
        url : 'ubahstatusmidtransinternal.php',
        method: 'POST',
        data: {
            transaction_id: transactionId,
            status: status
        },
        success: function(response) {
            alert(response); // Menampilkan respons dari server
            location.reload(); // Reload halaman untuk melihat perubahan status
        },
        error: function() {
            alert('UPDATED.');
        }
     });
    }



    function confirmOrder() {
        // Send an AJAX request to update the status in the database
        $.ajax({
            url: 'update_status.php',
            method: 'POST',
            data: { id: orderId, status: ' Delivered' },
            success: function(response) {
                if (response === 'success') {
                    location.reload(); // Reload the page to show the updated status
                } else {
                    alert('Gagal mengkonfirmasi pesanan. Silahkan coba lagi.');
                }
            }
        });
    }
</script>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
