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
				<?php if (empty($data['data'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> pemasangan (<?php echo get_name_pelanggan($this->uri->rsegments[3]); ?>)
			<div class="card-tools row">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
			</div>
			<div class="panel-body card-body">
				<input type="hidden" name="pelanggan_id" value="<?php echo @$this->uri->rsegments[3] ?>">
				<div class="form-group">
					<label for="tiang">tiang (jumlah)</label>
					<input type="number" class="form-control" name="tiang" placeholder="tiang" value="<?php echo @$data['data']['tiang'] ?>" required>
				</div>
				<div class="row">
					<div class="col-12">
						<label for="kabel">kabel (Meter)</label>
						<input name="kabel" type="number" class="form-control" placeholder="Panjang kabel" value="<?php echo @$data['data']['kabel'] ?>" min="1" max="1000" required>
					</div>
					<div class="col-4">
						<input name="trx" type="hidden" class="form-control" placeholder="TRX" value="0" min="0" max="100" required>
					</div>
					<div class="col-4">
						<input name="ccq" type="hidden" class="form-control" placeholder="CCQ" value="0" min="0" max="100" required>
					</div>
				</div>
				<div class="form-group">
                  <label>Alat</label>
                  <select class="select2" name="alat[]" multiple="multiple" data-placeholder="pilih alat" style="width: 100%;" required>
                  	<?php if (!empty($alat)): ?>
                  		<?php foreach ($alat as $key => $value): ?>
                  			<?php $selected = ''; ?>
                  			<?php $disabled = ''; ?>
                  			<?php if (in_array($value['alat_id'], $data['alat'])): ?>
                  				<?php $selected = 'selected'; ?>
                  			<?php endif ?>
                  			<?php if ($value['status'] == 2 && !in_array($value['alat_id'], $data['alat'])): ?>
                  				<?php $disabled = 'disabled'; ?>
                  			<?php endif ?>
                  			<option value="<?php echo $value['alat_id'] ?>" <?php echo $selected ?><?php echo $disabled ?> required><?php echo $value['title'] ?> (<?php echo $value['sn'] ?>)</option>
                  		<?php endforeach ?>
                  	<?php endif ?>
                  </select>
                </div>
				<div class="form-group">
					<?php $id_iactive = @$data['data']['metode']; ?>
					<?php if (!empty($metode)) : ?>
						<?php foreach ($metode as $key => $value) : ?>
							<?php $selected = ''; ?>
							<?php if ($value['id'] == $id_iactive) : ?>
								<?php $selected = 'checked'; ?>
							<?php endif ?>
							<div class="custom-control custom-radio">
								<input class="custom-control-input" type="radio" id="iactive<?php echo $value['id'] ?>" name="metode" value="<?php echo $value['id'] ?>" <?php echo $selected ?> required>
								<label for="iactive<?php echo $value['id'] ?>" class="custom-control-label"><?php echo $value['title'] ?></label>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>