<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="col-md-12">
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['data'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> pelanggan
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="nama">nama</label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['data']['nama'] ?>" required>
				</div>
				<div class="row">
					<div class="col-3">
						<input name="kab" type="text" class="form-control" placeholder="Kabupaten/Kota" value="<?php echo @$data['data']['kab'] ?>" required>
					</div>
					<div class="col-4">
						<input name="kec" type="text" class="form-control" placeholder="Kecamatan" value="<?php echo @$data['data']['kec'] ?>" required>
					</div>
					<div class="col-5">
						<input name="alamat" type="text" class="form-control" placeholder="Alamat" value="<?php echo @$data['data']['alamat'] ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="no_tlp">no tlp/wa</label>
					<input type="number" class="form-control" name="no_tlp" placeholder="no_tlp" value="<?php echo @$data['data']['no_tlp'] ?>" required>
				</div>
				<div class="form-group">
					<label for="alat_biaya">Biaya promo <small style="color: red">*isi dengan 0 jika tidak ada penambahan biaya alat dari pelanggan</small></label>
					<input type="number" class="form-control" name="alat_biaya" placeholder="alat_biaya" value="<?php echo @$data['data']['alat_biaya'] ?>" required>
				</div>
				<div class="form-group">
					<label for="kordinat">kordinat lokasi</label>
					<input type="text" class="form-control" name="kordinat" placeholder="kordinat" value="<?php echo @$data['data']['kordinat'] ?>">
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>