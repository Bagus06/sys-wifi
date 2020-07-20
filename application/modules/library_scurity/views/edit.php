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
	<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> kembali</a>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['data'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> Agenda
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label>Pelanggan</label>
					<select name="pelanggan_id" class="form-control select2" style="width: 100%;" required>
		              <option value="">none</option>
		              <?php foreach ($data['pelanggan'] as $key => $vp): ?>
		                <?php $selected = ''; ?>
		                <?php if ($vp['id'] == $data['data']['pelanggan_id']): ?>
		                  <?php $selected='selected' ?>
		                <?php endif ?>
		                <option value="<?php echo $vp['id'] ?>" <?php echo $selected; ?>><?php echo $vp['nama'] ?></option>
		              <?php endforeach ?>
		            </select>
		        </div>
				<div class="form-group">
					<label>IP Mask:</label>
					<div class="input-group">
						<input type="text" name="ip" class="form-control" value="<?php echo @$data['data']['ip'] ?>" data-inputmask="'alias': 'ip'" data-mask required>
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-laptop"></i></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="mac">Mac Address</label>
					<input type="text" class="form-control" name="mac" placeholder="mac" value="<?php echo @$data['data']['mac'] ?>" required>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<?php 
						$username = random_string('alnum', 5);
						if (!empty($data['data']['username'])) {
							$username = $data['data']['username'];
						}
					 ?>
					<input type="text" class="form-control" name="username" placeholder="username" value="<?php echo $username ?>" required readonly>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<?php 
						$password = random_string('alnum', 30);
						if (!empty($data['data']['password'])) {
							$password = $data['data']['password'];
						}
					 ?>
					<input type="text" class="form-control" name="password" placeholder="password" value="<?php echo $password; ?>" required readonly>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>