<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12 row">

	<div class="card mb-3 col-md-12">
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
		<div class="card-header">
			<i class="fas fa-table"></i>
			Data Jenis alat
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>nama alat</th>
							<th>jumlah</th>
							<th>terpakai</th>
							<th>sisa</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>nama alat</th>
							<th>jumlah</th>
							<th>terpakai</th>
							<th>sisa</th>
						</tr>
					</tfoot>
					<tbody>
						<?php if (!empty($data['data'])) : ?>
							<?php foreach ($data['data'] as $key => $value) : ?>
								<tr>
									<td><?php echo ++$data['url']; ?></td>
									<td><?php echo $value['title'] ?></td>
									<td>
										<?php if ($value['tipe'] == 2): ?>
											<?php echo $value['jumlah'] ?>
										<?php elseif($value['tipe'] == 1): ?>
											<?php if (!empty($count_alat)): ?>
												<?php echo $count_alat[$value['id']]; ?>
											<?php endif ?>
										<?php endif ?>
									</td>
									<td>
										<?php if ($value['tipe'] == 2): ?>

											<?php if ($value['title'] == 'tiang'): ?>
												<?php echo $count_alat['tiang']['tiang']; ?>
											<?php elseif($value['title'] == 'kabel'): ?>
												<?php echo $count_alat['kabel']['kabel']; ?>
											<?php else: ?>
												<?php echo "no data"; ?>
											<?php endif ?>

										<?php elseif($value['tipe'] == 1): ?>
											<?php if (!empty($count_alat)): ?>
												<?php echo $count_alat['terpakai'][$value['id']]; ?>
											<?php endif ?>
										<?php endif ?>
									</td>
									<td align="center">
										<?php if ($value['tipe'] == 2): ?>
											<?php if ($value['title'] == 'tiang'): ?>
												<?php
													$sisa_tiang = $value['jumlah'] - $count_alat['tiang']['tiang'];
													echo $sisa_tiang;
												?>
											<?php elseif($value['title'] == 'kabel'): ?>
												<?php
													$sisa_kabel = $value['jumlah'] - $count_alat['kabel']['kabel'];
													echo $sisa_kabel;
												?>
											<?php else: ?>
												<?php echo "no data"; ?>
											<?php endif ?>
										<?php elseif($value['tipe'] == 1): ?>
											<?php if (!empty($count_alat)): ?>
												<?php $sisa  = $count_alat[$value['id']] - $count_alat['terpakai'][$value['id']]; ?>
												<?php echo $sisa ?>
											<?php endif ?>
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td colspan="5" align="center">
										<?php if ($value['title'] == 'tiang' || $value['title'] == 'kabel'): ?>
											<a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#tambah<?php echo $value['id'] ?>"><i class="fa fa-plus"></i> tambah</a>
											<div class="modal fade" id="tambah<?php echo $value['id'] ?>">
												<div class="modal-dialog modal-sm">
													<form action="" method="post">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Tambah <?php echo $value['title'] ?></h4>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<input type="hidden" class="form-control" name="alat_id" placeholder="tambah" value="<?php echo $value['id'] ?>" required>
																<input type="number" class="form-control" name="tambah" placeholder="tambah" required>
															</div>
															<div class="modal-footer justify-content-between">
																<button type="button" class="btn btn-default" data-dismiss="modal">batal</button>
																<button type="submit" class="btn btn-primary">tambahkan</button>
															</div>
														</div>
													</form>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
										<?php else: ?>
											<a href="<?php echo base_url('jenis_alat/edit/' . $value['id']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> edit</a>
										<?php endif ?>
										|
										<?php if ($value['tipe'] == 1): ?>
											<a href="<?php echo base_url('alat_list/list/' . '?jenis=' . $value['id']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-id-badge"></i> list alat</a>
											|
										<?php endif ?>
										<a href="<?php echo base_url('jenis_alat/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus <?php echo $value['title'] ?>')){}else{return false;};" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> delete</a>
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