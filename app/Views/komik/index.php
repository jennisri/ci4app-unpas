<?php echo $this->extend('layout/template'); ?>

<?php echo $this->section('content'); ?>

<div class="container">
	<div class="row">
		<div class="col mt-3">
			<a href="/komik/create" class="btn btn-primary btn-sm mb-3">Tambah Data</a>

			<h3 class="mb-3">Daftar Komik</h3>
			<?php if(session()->getFlashdata('pesan')) :?>
			<div class="alert alert-success" role="alert">
				<?php echo session()->getFlashdata('pesan'); ?>
			</div>
		<?php endif; ?>

		<table class="table">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Sampul</th>
					<th scope="col">Judul</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no= 1 ?>
				<?php foreach ( $komik as $data ) : ?>
					<tr>
						<th scope="row"><?php echo $no++ ?></th>
						<td><img src="/img/<?php echo $data['sampul'] ?>" alt="" class="sampul"></td>
						<td><?php echo $data['judul'] ?></td>
						<td>
							<a href="/komik/<?php echo $data['slug']; ?>" class="btn btn-sm btn-secondary">Detail</a>
						</td>
					</tr>

				<?php endforeach ?>

			</tbody>
		</table>
	</div>
</div>
</div>

<?php echo $this->endSection() ?>