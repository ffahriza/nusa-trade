<main class="app-content">
	<div class="app-title" style="background-color: #d76c82;">
		<div>
			<h1><i class="fa fa-th-list"></i> Daftar Produk</h1>

		</div>

		<ul class="app-breadcrumb breadcrumb side">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Daftar Produk</li>
		</ul>

	</div>
	<a href="index.php?halaman=tambahbarang" class="btn btn-primary btn-sm btn-round mb-4">Tambah Produk</a>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered" id="sampleTable">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Kategori</th>
									<th>Harga</th>
									<th>Berat (*KG)</th>
									<th>Foto</th>
									<th>Stok</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomor = 1; ?>
								<?php $ambil = $koneksi->query("SELECT*FROM barang LEFT JOIN kategori ON barang.id_kategori=kategori.id_kategori"); ?>
								<?php while ($pecah = $ambil->fetch_assoc()) { ?>
									<tr>
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['namabarang'] ?></td>
										<td><?php echo $pecah['nama_kategori'] ?></td>
										<td><?php echo rupiah($pecah['hargabarang']) ?></td>
										<td><?php echo $pecah['beratbarang'] ?> KG</td>
										<td>
											<img src="../foto/<?php echo $pecah['fotobarang'] ?>" width="100px">
										</td>
										<td><?php echo $pecah['stokbarang'] ?></td>
										<td>
											<a href="index.php?halaman=ubahbarang&id=<?php echo $pecah['idbarang']; ?>" class="btn btn-warning btn-sm btn-round mt-2">Ubah</a>
											<a href="index.php?halaman=hapusbarang&id=<?php echo $pecah['idbarang']; ?>" class="btn btn-danger btn-sm btn-round mt-2" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
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
	</div>
</main>