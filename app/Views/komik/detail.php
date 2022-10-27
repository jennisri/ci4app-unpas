<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>

<div class="container">
	<div class="row">
		<div class="col">
			<h3 class="mt-3">Detail Komik</h3><hr>
			<div class="card mb-3" style="max-width: 540px;">
				<div class="row no-gutters">
					<div class="col-md-4">
						<img src="/img/<?= $komik['sampul'] ?>" alt="..." class="card-img">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title"><?php echo $komik['judul'] ?></h5>
							<p class="card-text"><b>Penulis :</b><?php echo $komik['penulis']; ?></p>
							<p class="card-text"><small class="text-muted"><b>Penerbit :</b><?php echo $komik['penerbit'] ?></small></p>

							<a href="/komik/edit/<?php echo $komik['slug']; ?>" class="btn btn-success btn-sm">Edit</a>


							<form action="/komik/<?php echo $komik['id'];?>" method="post" class="d-inline">
								<?php echo csrf_field(); ?>
								<input type="hidden" name="_method" value="DELETE">
								<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Delete</button>
							</form>

							<!-- <a href="/komik/delete/<?php echo $komik['id']; ?>" class="btn btn-danger btn-sm">Hapus</a> -->
							<a href="/komik" class="btn btn-secondary btn-sm">Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->endSection() ?>