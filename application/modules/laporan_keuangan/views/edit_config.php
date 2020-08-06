<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="col-md-12">
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
	<?php if (empty($this->input->get('tempo'))): ?>
		<form action="" method="get" enctype="multipart/form-data">
			<div class="panel panel-default card card-default">
				<div class="panel-heading card-header">
					<?php if (empty($data['data'])): ?>
						tambah
					<?php else: ?>
						ubah
					<?php endif ?> Rentan Waktu
				</div>
				<div class="panel-body card-body">
					<div class="form-group">
						<label>Tempo</label>
						<select name="tempo" class="custom-select" required="">
							<option value="">none</option>
							<?php foreach ($tempo as $key => $vte): ?>
								<?php $selected = ''; ?>
								<?php if ($vte['id'] == @$data['data']['rentan']): ?>
									<?php $selected='selected' ?>
								<?php endif ?>
								<option value="<?php echo $vte['id'] ?>" <?php echo $selected; ?>><?php echo $vte['title'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="panel-footer card-footer">
					<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
				</div>
			</div>
		</form>
	<?php endif ?>
	<?php if (!empty($this->input->get('tempo'))): ?>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="panel panel-default card card-default">
				<div class="panel-heading card-header">
					<?php if (empty($data['data'])): ?>
						tambah
					<?php else: ?>
						ubah
					<?php endif ?> <?php echo $this->uri->rsegments[2]; ?>
				</div>
				<div class="panel-body card-body">
					<input type="hidden" name="rentan" value="<?php echo @$this->input->get('tempo') ?>">
					<div class="form-group">
						<label>Pelanggan</label>
						<select name="pelanggan_id" class="form-control select2" style="width: 100%;" required="">
							<option value="">none</option>
							<?php foreach ($pelanggan as $key => $vp): ?>
								<?php $selected = ''; ?>
								<?php if ($vp['id'] == @$data['data']['pelanggan_id']): ?>
									<?php $selected='selected' ?>
								<?php endif ?>
								<option value="<?php echo $vp['id'] ?>" <?php echo $selected; ?>><?php echo $vp['nama'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Rp.</span>
						</div>
						<input type="text" class="form-control" value="<?php echo @$data['data']['nominal'] ?>" name="nominal">
					</div>
					<?php if ($this->input->get('tempo') == 1): ?>
						<div class="form-group">
							<label>Tanggal</label>
							<select name="tanggal" class="custom-select" required="">
								<option value="">none</option>
								<?php foreach ($date['tanggal'] as $key => $vt): ?>
									<?php $selected = ''; ?>
									<?php if ($vt['id'] == @$data['data']['jatuh_tempo']): ?>
										<?php $selected='selected' ?>
									<?php endif ?>
									<option value="<?php echo $vt['id'] ?>" <?php echo $selected; ?>><?php echo $vt['id'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					<?php endif ?>
                    <?php if ($this->input->get('tempo') == 2): ?>
						<div class="form-group">
							<label>Bulan</label>
							<select name="bulan" class="custom-select" required="">
								<option value="">none</option>
								<?php foreach ($date['bulan'] as $key => $vb): ?>
									<?php $selected = ''; ?>
									<?php if ($vb['id'] == @$data['data']['jatuh_tempo']): ?>
										<?php $selected='selected' ?>
									<?php endif ?>
									<option value="<?php echo $vb['id'] ?>" <?php echo $selected; ?>><?php echo $vb['title'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					<?php endif ?>
				</div>
				<div class="panel-footer card-footer">
					<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
				</div>
			</div>
		</form>
	<?php endif ?>
</div>