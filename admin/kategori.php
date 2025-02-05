<main class="app-content">
	<div class="app-title" style="background-color: #d76c82;">
		<div>
			<h1><i class="fa fa-th-list"></i> Daftar Kategori</h1>

		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Daftar Kategori</li>
		</ul>
	</div>
	<a href="index.php?halaman=tambahkategori" class="btn btn-primary btn-sm btn-round mb-4">Tambah Kategori</a>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<table class="table table-hover table-bordered" id="sampleTable">
						<thead>
							<tr>
								<th>No</th>
								<th>Kategori</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor = 1; ?>
							<?php $ambil = $koneksi->query("SELECT * FROM kategori"); ?>
							<?php while ($data = $ambil->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $nomor ?></td>
									<td><?php echo $data["nama_kategori"] ?></td>
									<td>
										<a href="index.php?halaman=ubahkategori&id=<?php echo $data['id_kategori']; ?>" class="btn btn-warning btn-sm btn-round mt-2">Ubah</a>
										<a href="index.php?halaman=hapuskategori&id=<?php echo $data['id_kategori']; ?>" class="btn btn-danger btn-sm btn-round mt-2" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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