<main class="app-content">
	<div class="app-title" style="background-color: #d76c82;">
		<div>
			<h1><i class="fa fa-th-list"></i> Daftar Pengguna</h1>

		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Daftar Pengguna</li>
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
								<th>Email</th>
								<th>Telepon</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM pengguna where level='Pelanggan'"); ?>
							<?php while ($pecah = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah['nama'] ?></td>
									<td><?php echo $pecah['email'] ?></td>
									<td><?php echo $pecah['telepon'] ?></td>
									<td class="text-center">
										<a href="index.php?halaman=hapuspengguna&id=<?php echo $pecah['id'] ?>" class="btn btn-danger btn-sm btn-round mt-2" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>

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