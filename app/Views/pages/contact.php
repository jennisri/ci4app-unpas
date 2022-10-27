<?php echo $this->extend('layout/template'); ?>

<?php echo $this->section('content'); ?>

<div class="container">
	<div class="row">
		<div class="col mt-3">
			<h2>Contact Us</h2>
			<?php foreach ( $alamat as $a ) : ?>
				<ul>
					<li><?php echo $a['tipe']; ?></li>
					<li><?php echo $a['jalan']; ?></li>
					<li><?php echo $a['kota']; ?></li>
				</ul>
				
			<?php endforeach ?>
		</div>
	</div>
</div>

<?php echo $this->endSection() ?>