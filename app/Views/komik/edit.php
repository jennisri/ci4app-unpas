<?php echo $this->extend('layout/template'); ?>
<?php echo $this->section('content'); ?>

<div class="container">
	<div class="row">
		<div class="col-8">
			<!-- my itu atas bawah yang diatur. margin atas bawah -->
			<h3 class="my-3">Form Ubah Data Komik</h3>

			

			<form action="/komik/update/<?php echo $komik['id']; ?>" method="post" enctype="multipart/form-data">
				<!-- digunakan untuk menjaga agar form nya bisa diinput dihalaman ini saja -->
				<?php echo csrf_field(); ?>
				<input type="hidden" name="slug" value="<?php echo $komik['slug'] ?>">
				<input type="hidden" name="sampulLama" value="<?php echo $komik['sampul']; ?>">
				
				<div class="form-group row">
					<label for="judul" class="col-sm-2 col-form-label">Judul</label>
					<div class="col-sm-10">
						<input type="text" class="form-control <?php echo ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?php echo (old('judul')) ? old('judul') : $komik['judul']; ?>">
						<div id="validationServer03Feedback" class="invalid-feedback">
							<?php echo $validation->getError('judul') ?>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
					<div class="col-sm-10">
						<input type="text" name="penulis" class="form-control" id="penulis" value="<?php echo (old('penulis')) ? old('penulis') : $komik['penulis']; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
					<div class="col-sm-10">
						<input type="text" name="penerbit" class="form-control" id="penerbit" value="<?php echo (old('penerbit')) ? old('penerbit') : $komik['penerbit']; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
					<div class="col-sm-10">
						<div class="custom-file">
							<input type="file" class="custom-file-input <?php echo ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="previewImg()" >
							<div id="validationServer03Feedback" class="invalid-feedback">
								<?php echo $validation->getError('sampul') ?>
							</div>
							<label class="custom-file-label" for="sampul" name="sampul"><?php echo $komik['sampul'] ?></label>

							<div class="col-sm-3">
								<img src="/img/<?php echo $komik['sampul'] ?>" class="img-thumbnail img-preview mt-2" alt="">
							</div>
						</div>
					</div>
				</div>



				<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Ubah Data</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php echo $this->endSection(); ?>