<?php echo $this->extend('layout/template'); ?>

<?php echo $this->section('content'); ?>

<div class="container">
	<div class="row">
		<div class="col">
			<h3 class="mt-3">Daftar Orang</h3>
			<form action="" method="post">

				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Masukkan Keyword Pencarian" name="keyword" aria-label="Recipient's username" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button type="submit" class="btn btn-outline-secondary" name="submit">Cari</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col mt-3">
			

			<table class="table">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama</th>
						<th scope="col">Alamat</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no= 1 + (6 * ($currentPage - 1)) ;?>
					<?php foreach ( $orang as $data ) : ?>
						<tr>
							<th scope="row"><?php echo $no++ ?></th>
							<td><?php echo $data['nama'] ?></td>
							<td><?php echo $data['alamat'] ?></td>
							<td>
								<a href="#" class="btn btn-sm btn-secondary">Detail</a>
							</td>
						</tr>

					<?php endforeach ?>

				</tbody>
			</table>

			<?= $pager->links('orang', 'orang_pagination') ?>
		</div>
	</div>
</div>

<?php echo $this->endSection() ?>