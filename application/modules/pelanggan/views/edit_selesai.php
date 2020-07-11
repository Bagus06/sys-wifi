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
	<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-angle-left"></i>kembali</a>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				Data Pelanggan (<?php echo get_name_pelanggan($this->uri->rsegments[3]) ?>)
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="nik">NIK</label>
					<input type="number" class="form-control" name="nik" placeholder="nik" value="<?php echo @$data['data']['nik'] ?>" required>
				</div>
				<div class="form-group">
					<label for="kordinat">Kordinat</label>
					<input type="text" class="form-control" name="kordinat" placeholder="kordinat" value="<?php echo @$data['data']['kordinat'] ?>" required>
				</div>
				<div class="form-group">
					<label for="kk">No KK</label>
					<input type="number" class="form-control" name="kk" placeholder="kk" value="<?php echo @$data['data']['kk'] ?>" required>
				</div>
				<div class="form-group">
					<label for="pekerjaan">pekerjaan</label>
					<input type="text" class="form-control" name="pekerjaan" placeholder="pekerjaan" value="<?php echo @$data['data']['pekerjaan'] ?>" required>
				</div>
				<?php if (!empty($data['data']['foto_pelanggan']) && $data['data']['foto_pelanggan'] != '-'): ?>
					<a href="<?php echo base_url('assets/images/pelanggan/' . $data['data']['foto_pelanggan']) ?>" data-toggle="lightbox" data-title="<?php echo $data['data']['foto_pelanggan']; ?>" data-gallery="gallery" target="_blank">
						<img style="display: block;max-width: 100%;object-fit: cover;height: 150px;width: 110px" src="<?php echo base_url('assets/images/pelanggan/' . $data['data']['foto_pelanggan']) ?>" class="img-fluid mb-2" alt="white sample"/>
					</a>
					
				<?php endif ?>
				<div class="form-group">
					<label for="foto_pelanggan">foto pelanggan (max file size 3Mb)</label>
					<div class="custom-file">
						<input type="file" name="foto_pelanggan" class="form-control custom-file-label" id="foto_pelanggan">
					</div>
				</div>
				<?php if (!empty($data['data']['foto_rumah']) && $data['data']['foto_rumah'] != '-'): ?>
					<a href="<?php echo base_url('assets/images/rumah/' . $data['data']['foto_rumah']) ?>" data-toggle="lightbox" data-title="<?php echo $data['data']['foto_rumah']; ?>" data-gallery="gallery" target="_blank">
						<img style="display: block;max-width: 100%;object-fit: cover;height: 150px;" src="<?php echo base_url('assets/images/rumah/' . $data['data']['foto_rumah']) ?>" class="img-fluid mb-2" alt="white sample"/>
					</a>

				<?php endif ?>
				<div class="form-group">
					<label for="foto_rumah">foto rumah (max file size 3Mb)</label>
					<div class="custom-file">
						<input type="file" name="foto_rumah" class="form-control custom-file-label" id="foto_rumah">
					</div>
				</div>
				<div class="form-group">
					<label for="no_pelanggan">No PKS</label>
					<input type="text" class="form-control" name="no_pelanggan" placeholder="no_pelanggan" value="<?php echo @$data['data']['no_pelanggan'] ?>" required>
				</div>
				<div class="row">
					<div class="col-6">
						<input name="trx" type="number" class="form-control" placeholder="TRX" min="1" max="100" required>
					</div>
					<div class="col-6">
						<input name="ccq" type="number" class="form-control" placeholder="CCQ" min="1" max="100" required>
					</div>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>