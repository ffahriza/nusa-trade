<?php
$ambil = $koneksi->query("SELECT*FROM pembelian JOIN pengguna
	ON pembelian.id=pengguna.id
	WHERE pembelian.idbeli='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<main class="app-content">
	<div class="app-title" style="background-color: #d76c82;">
		<div>
			<h1><i class="fa fa-th-list"></i> Daftar Pembayaran</h1>

		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Daftar Pembayaran</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<table class="table table-hover">
						<tr>
							<td>Nama</td>
							<td><?php echo $detail['nama']; ?></td>
						</tr>
						<tr>
							<td>Telepon</td>
							<td><?php echo $detail['telepon']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $detail['email']; ?></td>
						</tr>
						<tr>
							<td>Kota</td>
							<td><?php echo $detail['kota']; ?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><?php echo $detail['alamatpengiriman']; ?></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td><?php echo tanggal($detail['tanggalbeli']); ?></td>
						</tr>
						<tr>
							<td>Status</td>
							<td><?php echo $detail['statusbeli']; ?></td>
						</tr>
						<tr>
							<td>Total</td>
							<td><?php echo rupiah($detail['totalbeli']); ?></td>
						</tr>
						<tr>
							<td>Ongkir</td>
							<td><?php echo rupiah($detail['ongkir']); ?></td>
						</tr>
						<tr>
							<td>Grandtotal</td>
							<td><?php echo rupiah($detail['ongkir'] + $detail['totalbeli']); ?></td>
						</tr>
					</table>
					<a class="btn btn-warning btn-block" target="_blank" href="../notacetak.php?id=<?= $_GET['id'] ?>">Nota</a>
				</div>

			</div>
			<div class="card-block table-border-style">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="bg-primary text-white">
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Total Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM pembelianproduk WHERE idbeli='$_GET[id]'"); ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['nama']; ?></td>
									<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
									<td><?php echo $pecah['jumlah']; ?></td>
									<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
								</tr>
								<?php $nomor++; ?>
							<?php } ?>
						</tbody>
					</table>
					<br>
				</div>
				<?php
				$idbeli = $_GET['id'];
				
				?>
				<?php $am = $koneksi->query("SELECT*FROM pembelian WHERE idbeli='$idbeli'");
				$det = $am->fetch_assoc(); ?>
				<br>
				<br>
				<br>
				<?php if ($det['statusbeli'] != '') { ?>
					<div class="card-block">
						<form method="post">
							<div class="form-group row">
								<label>Catatan</label>
								<textarea rows="5" class="form-control" name="catatan"></textarea><?php echo $det['catatan'] ?></textarea>
							</div>
							<div class="form-group row">
								<label>Status</label>
								<select class="form-control" name="statusbeli">
									<?php if ($det['statusbeli'] != 'Selesai') { ?>
										<option value="">Belum di Konfirmasi</option>
										<option <?php if ($det['statusbeli'] == 'Rejected') echo 'selected'; ?> value="Rejected">Rejected</option>
										<option <?php if ($det['statusbeli'] == 'At Origin') echo 'selected'; ?> value="At Origin">At Origin</option>
										<option <?php if ($det['statusbeli'] == 'On Its Way') echo 'selected'; ?> value="On Its Way">On Its Way</option>
										<option <?php if ($det['statusbeli'] == 'Delivered') echo 'selected'; ?> value="Delivered">Delivered</option>
									<?php } else { ?>
										<option <?php if ($det['statusbeli'] == 'Selesai') echo 'selected'; ?> value="Selesai">Selesai</option>
									<?php } ?>
								</select>
							</div>
							<br>
							<button class="btn btn-primary float-right btn-round mt-2" name="proses">Simpan</button>
							<br>
						</form>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</main>
<?php
if (isset($_POST["proses"])) {
	$catatan = $_POST["catatan"];
	$statusbeli = $_POST["statusbeli"];
	$koneksi->query("UPDATE pembelian SET catatan='$catatan', statusbeli='$statusbeli'
		WHERE idbeli='$idbeli'") or die(mysqli_error($koneksi));
	echo "<script>alert('Pembayaran Berhasil Diupdate')</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";
} ?>