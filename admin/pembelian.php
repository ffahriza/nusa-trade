<?php


?>
<main class="app-content">
	<div class="app-title" style="background-color: #d76c82;">
		<div>
			<h1><i class="fa fa-th-list"></i> Daftar Pembelian</h1>

		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Daftar Pembelian</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<table class="table table-hover table-bordered" id="sampleTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Tanggal Pembelian</th>
								<th>Total Pembelian</th>
								<th>Status Belanja</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pengguna ON pembelian. id=pengguna.id where statusbeli != '' and statusbeli != 'deny' and statusbeli != 'expire' and statusbeli != 'pending' order by pembelian.tanggalbeli desc, pembelian.idbeli desc"); ?>
							<?php while ($pecah = $ambil->fetch_assoc()) {
								$statusbeli = $pecah['statusbeli'];
							?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['nama'] ?></td>
									<td><?= tanggal(date('Y-m-d', strtotime($pecah['tanggalbeli']))) ?></td>
									<td>Rp. <?php echo number_format($pecah['totalbeli']) ?></td>
									<td>
										<?php
										if ($statusbeli == 'settlement') {
											echo "<label class='text-success'>Lunas, Belum Di Kirim</label>";
											if ($pecah['statusbeli'] == 'Delivered') {
											} else {
												if ($pecah['statusbeli'] != 'settlement') {
													echo '<br>' . $pecah['statusbeli'];
												}
											}
										} else if ($statusbeli == 'Selesai') {
											echo "<label class='text-success'>Selesai</a>";
										} else if ($statusbeli == 'pending') {
											echo "<label class='text-warning'>Pending, Mohon Selesaikan Pembayaran</a>";
										} else if ($statusbeli == 'deny') {
											echo "<label class='text-danger'>Di Tolak</a>";
										} else if ($statusbeli == 'expire') {
											echo "<label class='text-danger'>Gagal, Pembayaran anda telah melewati batas pembayaran</a>";
										} else if ($statusbeli == 'cancel') {
											echo "<label class='text-success'>Gagal</a>";
										} else {
											echo $statusbeli;
										}
										?>
									</td>
									<td>
										<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['idbeli'] ?>" class="btn btn-primary btn-sm btn-round mt-2">Detail</a>
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