<?php


// Basic counts
$jumlahkategori = $koneksi->query("SELECT COUNT(*) AS count FROM kategori")->fetch_assoc()['count'];
$jumlahbarang = $koneksi->query("SELECT COUNT(*) AS count FROM barang")->fetch_assoc()['count'];
$jumlahmember = $koneksi->query("SELECT COUNT(*) AS count FROM pengguna WHERE level = 'Pelanggan'")->fetch_assoc()['count'];
$jumlahpembelian = $koneksi->query("SELECT COUNT(*) AS count FROM pembelian")->fetch_assoc()['count'];

// Total income
$totalIncome = $koneksi->query("SELECT SUM(totalbeli) AS total FROM pembelian")->fetch_assoc()['total'];
$totalIncome = $totalIncome ? $totalIncome : 0;

// Average order value
$averageOrderValue = $jumlahpembelian > 0 ? $totalIncome / $jumlahpembelian : 0;

// Top-selling products
$topProducts = $koneksi->query("
    SELECT barang.namabarang, SUM(pembelianproduk.jumlah) AS total_sold 
    FROM pembelianproduk 
    JOIN barang ON pembelianproduk.idproduk = barang.idbarang 
    GROUP BY pembelianproduk.idproduk 
    ORDER BY total_sold DESC 
    LIMIT 5
");

// Monthly sales breakdown for current year
$currentYear = date('Y');
$monthlySales = [];
for ($i = 1; $i <= 12; $i++) {
    $month = str_pad($i, 2, "0", STR_PAD_LEFT);
    $query = $koneksi->query("SELECT SUM(totalbeli) AS total FROM pembelian WHERE DATE_FORMAT(tanggalbeli, '%Y-%m') = '$currentYear-$month'");
    $monthlySales[$i] = $query->fetch_assoc()['total'] ?: 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .app-title { background-color: #d76c82; padding: 15px; border-radius: 8px; color: white; }
        .card { transition: all 0.3s; }
        .card:hover { transform: translateY(-5px); }
        .top-product-list li { display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>PT. Sri Nusantara Abadi</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded border-0">
                <i class="fa fa-users fa-3x text-primary mb-2"></i>
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?php echo $jumlahmember; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded border-0">
                <i class="fa fa-cube fa-3x text-warning mb-2"></i>
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text"><?php echo $jumlahbarang; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded border-0">
                <i class="fa fa-tags fa-3x text-info mb-2"></i>
                <div class="card-body">
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text"><?php echo $jumlahkategori; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded border-0">
                <i class="fa fa-money fa-3x text-success mb-2"></i>
                <div class="card-body">
                    <h5 class="card-title">Total Income</h5>
                    <p class="card-text">Rp <?php echo number_format($totalIncome); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded border-0">
                <i class="fa fa-shopping-cart fa-3x text-danger mb-2"></i>
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text"><?php echo $jumlahpembelian; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded border-0">
                <i class="fa fa-line-chart fa-3x text-warning mb-2"></i>
                <div class="card-body">
                    <h5 class="card-title">Average Order Value</h5>
                    <p class="card-text">Rp <?php echo number_format($averageOrderValue); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Selling Products and Monthly Sales Chart -->
    <div class="row">
        <div class="col-md-6">
            <div class="card p-4 mb-5 shadow-sm">
                <h4>Top Selling Products</h4>
                <ul class="list-group top-product-list">
                    <?php while ($product = $topProducts->fetch_assoc()) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fa fa-cube"></i> <?php echo $product['namabarang']; ?></span>
                            <span class="badge badge-primary badge-pill"><?php echo $product['total_sold']; ?> sold</span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 mb-5 shadow-sm">
                <h4>Monthly Sales (<?php echo $currentYear; ?>)</h4>
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>
    </div>
</main>

<!-- Chart.js Script -->
<script>
    var ctx = document.getElementById('monthlySalesChart').getContext('2d');
    var monthlySalesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Sales (Rp)',
                data: <?php echo json_encode(array_values($monthlySales)); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

</body>
</html>
