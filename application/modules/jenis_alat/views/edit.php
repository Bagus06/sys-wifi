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
	<a class="btn btn-sm btn-warning" href="<?php echo base_url('jenis_alat/list/') ?>"><i class="fas fa-caret-left"></i> Kembali</a>
	<form action="" method="post" enctype="multipart/form-data" style="padding-top: 10px">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['data'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> jenis alat
			</div>
			<?php if (!empty($data['data'])): ?>
				<div class="panel-body card-body">
					<?php if (@$data['data']['title'] != 'tiang' && @$data['data']['title'] != 'kabel'): ?>
						<div class="form-group">
							<label for="title">Tipe nama alat</label>
							<input type="text" class="form-control" name="title" placeholder="title" value="<?php echo @$data['data']['title'] ?>" required>
						</div>
						<?php elseif(@$data['data']['title'] == 'tiang' || @$data['data']['title'] == 'kabel'): ?>
							<div class="form-group">
								<label for="title">Tambah alat</label>
								<input type="number" class="form-control" name="tambah" placeholder="title" value="<?php echo @$data['data']['jumlah'] ?>" required>
							</div>
						<?php endif ?>
			<?php elseif(empty($data['data'])): ?>
				<div class="panel-body card-body">
					<div class="form-group">
						<label for="title">Tipe nama alat</label>
						<input type="text" class="form-control" name="title" placeholder="title" value="<?php echo @$data['data']['title'] ?>" required>
					</div>
					<div class="form-group">
						<label for="jumlah">jumlah</label>
						<input type="number" class="form-control" name="jumlah" placeholder="jumlah" value="<?php echo @$data['data']['title'] ?>" required>
					</div>
					<div class="form-group">
						<label>Type</label>
						<?php if (!empty($tipe)) : ?>
							<?php foreach ($tipe as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if ($value['id'] == @$data['data']['tipe']) : ?>
									<?php $selected = 'checked'; ?>
								<?php endif ?>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="tipe<?php echo $value['id'] ?>" name="tipe" value="<?php echo $value['id'] ?>" <?php echo $selected ?> required>
									<label for="tipe<?php echo $value['id'] ?>" class="custom-control-label"><?php echo $value['title'] ?></label>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>	
				</div>
			<?php endif ?>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>