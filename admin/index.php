<?php
session_start();
include '../koneksi.php';
function rupiah($angka)
{
    $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasilrupiah;
}
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
        case 2:
            return "Februari";
        case 3:
            return "Maret";
        case 4:
            return "April";
        case 5:
            return "Mei";
        case 6:
            return "Juni";
        case 7:
            return "Juli";
        case 8:
            return "Agustus";
        case 9:
            return "September";
        case 10:
            return "Oktober";
        case 11:
            return "November";
        case 12:
            return "Desember";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>ADMIN</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets_admin/docs/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/ckeditor/ckeditor.js"></script>

</head>

<body class="app sidebar-mini rtl ">

    <header class="app-header"><a class="app-header__logo bg-danger" href="index.php?halaman=beranda"><img width="40px" src="../assets_home/logo.png"></a>
        <a class="app-sidebar__toggle " href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <ul class="app-nav">

            <li class="dropdown"><a class="app-nav__item " href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="index.php?halaman=logout" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <div class="app-sidebar__overlay " data-toggle="sidebar"></div>
    <aside class="app-sidebar bg-danger">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" width="20%" src="assets_admin/docs/adm.png" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">ADMIN</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="index.php?halaman=beranda"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
            <li><a class="app-menu__item" href="index.php?halaman=pembelian"><i class="app-menu__icon fa fa fa-laptop"></i><span class="app-menu__label">Transaction Data</span></a></li>
            <li><a class="app-menu__item" href="index.php?halaman=barang"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Product Detail</span></a></li>
            <li><a class="app-menu__item" href="index.php?halaman=kategori"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Product Category</span></a></li>
            <li><a class="app-menu__item" href="index.php?halaman=promosidaftar"><i class="app-menu__icon fa fa-star"></i><span class="app-menu__label">Make an Offer</span></a></li>
            <li><a class="app-menu__item" href="index.php?halaman=pengguna"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users Data List</span></a></li>
            <li><a class="app-menu__item" href="index.php?halaman=permintaan_nego"><i class="app-menu__icon fa fa-handshake-o"></i><span class="app-menu__label">Offer Request List</span></a></li>
        </ul>
    </aside>
    <div class="w3-row w3-padding-64">
        <div class="w3-container" style="padding-bottom: 500px">
            <?php
            if (isset($_GET['halaman'])) {
                if ($_GET['halaman'] == "barang") {
                    include 'barang.php';
                } elseif ($_GET['halaman'] == "pembelian") {
                    include 'pembelian.php';
                } elseif ($_GET['halaman'] == "pengguna") {
                    include 'pengguna.php';
                } elseif ($_GET['halaman'] == "detail") {
                    include 'detail.php';
                } elseif ($_GET['halaman'] == "tambahbarang") {
                    include 'tambahbarang.php';
                } elseif ($_GET['halaman'] == "hapusbarang") {
                    include 'hapusbarang.php';
                } elseif ($_GET['halaman'] == "ubahbarang") {
                    include 'ubahbarang.php';
                } elseif ($_GET['halaman'] == "logout") {
                    include 'logout.php';
                } elseif ($_GET['halaman'] == "pembayaran") {
                    include 'pembayaran.php';
                } elseif ($_GET['halaman'] == "beranda") {
                    include 'beranda.php';
                } elseif ($_GET['halaman'] == "kategori") {
                    include 'kategori.php';
                } elseif ($_GET['halaman'] == "ubahkategori") {
                    include 'ubahkategori.php';
                } elseif ($_GET['halaman'] == "detailproduk") {
                    include 'detailproduk.php';
                } elseif ($_GET['halaman'] == "hapusfotoproduk") {
                    include 'hapusfotoproduk.php';
                } elseif ($_GET['halaman'] == "tambahkategori") {
                    include 'tambahkategori.php';
                } elseif ($_GET['halaman'] == "hapuskategori") {
                    include 'hapuskategori.php';
                } elseif ($_GET['halaman'] == "hapuspengguna") {
                    include 'hapuspelanggan.php';
                } elseif ($_GET['halaman'] == "pembelianhapus") {
                    include 'pembelianhapus.php';
                } elseif ($_GET['halaman'] == "promosidaftar") {
                    include 'promosidaftar.php';
                } elseif ($_GET['halaman'] == "promositambah") {
                    include 'promositambah.php';
                } elseif ($_GET['halaman'] == "promosiedit") {
                    include 'promosiedit.php';
                } elseif ($_GET['halaman'] == "promosihapus") {
                    include 'promosihapus.php';
                } elseif ($_GET['halaman'] == "permintaan_nego") { // Tambahan fitur nego harga
                    include 'permintaan_nego.php';
                }
            } else {
                include 'beranda.php';
            }
            ?>
        </div>
    </div>
    <script src="assets_admin/docs/js/jquery-3.2.1.min.js"></script>
    <script src="assets_admin/docs/js/popper.min.js"></script>
    <script src="assets_admin/docs/js/bootstrap.min.js"></script>
    <script src="assets_admin/docs/js/main.js"></script>

    <script src="assets_admin/docs/js/plugins/pace.min.js"></script>

    <script type="text/javascript" src="assets_admin/docs/js/plugins/chart.js"></script>
    <script type="text/javascript" src="assets_admin/docs/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets_admin/docs/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
    <script type="text/javascript">
        var data = {
            labels: ["January", "February", "March", "April", "May"],
            datasets: [{
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 86]
                }
            ]
        };
        var pdata = [{
                value: 300,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Complete"
            },
            {
                value: 50,
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "In-Progress"
            }
        ]

        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

        var ctxp = $("#pieChartDemo").get(0).getContext("2d");
        var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
        if (document.location.hostname == 'pratikborsadiya.in') {
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
    </script>
    <script>
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>
    <script>
        var ctx = document.getElementById("grafikharga");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: "Harga",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: [<?= $hargagrafik[0] ?>, <?= $hargagrafik[1] ?>, <?= $hargagrafik[2] ?>, <?= $hargagrafik[3] ?>, <?= $hargagrafik[4] ?>, <?= $hargagrafik[5] ?>, <?= $hargagrafik[6] ?>, <?= $hargagrafik[7] ?>, <?= $hargagrafik[8] ?>, <?= $hargagrafik[9] ?>, <?= $hargagrafik[10] ?>, <?= $hargagrafik[11] ?>],
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 12,
                            callback: function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return 'Rp.' + value;
                                }
                            }
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(t, d) {
                            var xLabel = d.datasets[t.datasetIndex].label;
                            var yLabel = t.yLabel >= 1000 ? 'Rp.' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.yLabel;
                            return xLabel + ': ' + yLabel;
                        }
                    }
                },
            }
        });
    </script>
</body>

</html>
