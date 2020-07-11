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
				 <?php endif ?> Alat
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="jenis_alat">jenis alat</label>
					<select class="custom-select" name="alat_jenis_id">
						<?php if (!empty($jenis_alat)): ?>
							<?php foreach ($jenis_alat as $key => $value): ?>
								<?php $selected = ''; ?>
								<?php if ($value['id'] == $data['data']['alat_jenis_id']): ?>
									<?php $selected = 'selected'; ?>
								<?php endif ?>
								<option value="<?php echo $value['id'] ?>" <?php echo $selected ?>><?php echo $value['title'] ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="sn">SN</label>
					<input type="text" class="form-control" name="sn" placeholder="sn" value="<?php echo @$data['data']['sn'] ?>" required>
				</div>
				<?php if (@$data['data']['status'] != 2): ?>
					<div class="form-group">
						<label>status</label>
						<?php $id_status[] = @$data['data']['status']; ?>
						<?php if (!empty($status)) : ?>
							<?php foreach ($status as $key => $value) : ?>
								<?php $selected = ''; ?>
								<?php if (in_array($value['id'], $id_status)) : ?>
									<?php $selected = 'checked'; ?>
								<?php endif ?>
								<div class="custom-control custom-radio">
									<input class="custom-control-input" type="radio" id="status<?php echo $value['id'] ?>" name="status" value="<?php echo $value['id'] ?>" <?php echo $selected ?>>
									<label for="status<?php echo $value['id'] ?>" class="custom-control-label"><?php echo $value['title'] ?></label>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
				<?php endif ?>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>