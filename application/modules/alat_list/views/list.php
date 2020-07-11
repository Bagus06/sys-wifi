<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-12 row">
	<?php $size_card = 'col-md-12'; ?>
	<?php if (!empty($this->input->get('jenis'))): ?>
		<?php $size_card = 'col-md-8'; ?>
		<div class="col-md-4">
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
						<?php if (!empty($this->input->get('jenis'))): ?>
						 	tambah
						 	<?php else: ?>
						 	ubah
						 <?php endif ?> Alat
					</div>
					<div class="panel-body card-body">
						<div class="form-group">
							<label for="jenis_alat">jenis alat</label>
							<h1><b>
								<?php if (!empty($jenis_alat)): ?>
									<?php $selected=''; ?>
									<?php foreach ($jenis_alat as $key => $value): ?>
										<?php if ($value['id'] == $this->input->get('jenis')): ?>
											<input type="hidden" name="alat_jenis_id" value="<?php echo @$this->input->get('jenis') ?>">
											<?php echo $value['title'] ?>
										<?php endif ?>
									<?php endforeach ?>
								<?php endif ?>
							</b></h1>
						</div>
						<div class="form-group">
							<label for="sn">SN</label>
							<input type="text" class="form-control" name="sn" placeholder="sn" required>
						</div>
						<div class="form-group">
							<label>status</label>
							<?php if (!empty($status)) : ?>
								<?php foreach ($status as $key => $value) : ?>
									<?php $checked = ''; ?>
									<?php if (!empty($this->input->get('jenis'))): ?>
										<?php if ($value['id'] == 1): ?>
											<?php $checked = 'checked'; ?>
										<?php endif ?>
									<?php endif ?>
									<div class="custom-control custom-radio">
										<input class="custom-control-input" type="radio" id="status<?php echo $value['id'] ?>" name="status" value="<?php echo $value['id'] ?>" <?php echo $checked ?>>
										<label for="status<?php echo $value['id'] ?>" class="custom-control-label"><?php echo $value['title'] ?></label>
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
	<?php endif ?>
	<div class="card mb-3 <?php echo $size_card; ?>">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Data Alat
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>nama alat</th>
							<th>SN</th>
							<th>status</th>
							<th style="text-align: center">action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>nama alat</th>
							<th>SN</th>
							<th>status</th>
							<th style="text-align: center">action</th>
						</tr>
					</tfoot>
					<tbody>

						<?php
							$ab = '';
							$ad = '';
							$ar = '';
						 ?>
						<?php if (!empty($this->input->get('fa'))): ?>
							<?php
								$ab = 'none';
								$ad = 'none';
								$ar = 'none';
							?>
							<?php if ($this->input->get('fa') == 1): ?>
								<?php $ab = ''; ?>
							<?php elseif ($this->input->get('fa') == 2): ?>
								<?php $ad = ''; ?>
							<?php elseif ($this->input->get('fa') == 3): ?>
								<?php $ar = ''; ?>
							<?php else: ?>
								<?php
									$ab = '';
									$ad = '';
									$ar = '';
								?>
							<?php endif ?>
						<?php endif ?>

						<div class="row" style="margin:5px">
							<p style="padding-right: 8px; display: <?php echo $ab; ?>"><i class="fas fa-square-full" style="color:#2874A6"></i> Alat tidak dipakai/baru (<?php echo @$count['baru']; ?>)</p>
							<p style="padding-right: 8px; display: <?php echo $ad; ?>"><i class="fas fa-square-full" style="color:#D0D3D4"></i> Alat dipakai (<?php echo @$count['dipakai']; ?>)</p>
							<p style="padding-right: 8px; display: <?php echo $ar; ?>"><i class="fas fa-square-full" style="color:#C0392B"></i> Alat rusak (<?php echo @$count['rusak']; ?>)</p>
						</div>
						<?php if (!empty($data['data'])) : ?>
							<?php foreach ($data['data'] as $key => $value) : ?>
								<?php $bg = ''; ?>
								<?php 
									if ($value['status'] == 1) {
										$bg = '#2874A6';
									}elseif ($value['status'] == 2) {
										$bg = '#D0D3D4';
									}elseif ($value['status'] == 3) {
										$bg = '#C0392B';
									}
								 ?>
								<tr style="background-color: <?php echo $bg ?>">
									<td><?php echo ++$data['url']; ?></td>
									<td><?php echo $value['title'] ?></td>
									<td><?php echo $value['sn'] ?></td>
									<td>
										<?php foreach ($status as $key => $vstatus): ?>
											<?php if ($vstatus['id'] == $value['status']): ?>
												<?php echo $vstatus['title'] ?>
												<?php
													if (!empty($value['nama'])) {
														echo " di rumah ";
														echo $value['nama'];
													}
												 ?>
											<?php endif ?>
										<?php endforeach ?>
									</td>
									<td align="center">
										<a href="<?php echo base_url('alat_list/edit/' . $value['alat_id']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
										<?php if ($value['status'] == 1 || $value['status'] == 3): ?>
											|
											<a href="<?php echo base_url('alat_list/delete/' . $value['alat_id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus SN : <?php echo $value['sn'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
										<?php endif ?>
									</td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
		<div class="card-footer small text-muted">by : MANDESA</div>
	</div>
</div>