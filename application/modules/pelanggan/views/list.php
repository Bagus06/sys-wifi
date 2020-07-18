<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Default box -->
<div class="table-responsive">
	<div class="card card-solid">
		<div class="card-header pb-0">
			<form action="" method="post">
				<div class="text-right input-group input-group-sm col-md-4">
					<input type="text" name="search" class="form-control" placeholder="Search by name">
					<span class="input-group-append">
						<button type="submit" class="btn btn-info btn-flat"><i class="fas fa-search"></i></button>
					</span>
				</div>
			</form>
			<div class="text-left row">
				<p style="padding-right: 8px;"><i class="fas fa-square-full" style="color:#EEEEEE"></i> biaya tambahan</p>
				<p style="padding-right: 8px;"><i class="fas fa-square-full" style="color:#2E2E2E"></i> tanpa biaya tambahan</p>
				<p style="padding-right: 8px;">Jumlah (<?php echo $count_all; ?>)</p>
			</div>
		</div>
		<div class="card-body pb-0">
			<div class="row d-flex align-items-stretch">
				<?php foreach ($data['data'] as $key => $value): ?>
					<?php 
					$bg_card = 'light';
					?>
					<?php if ($value['alat_biaya'] == 0): ?>
						<?php 
						$bg_card = 'dark';
						?>
					<?php endif ?>
					<div class="col-12 col-sm-6 col-md-4 align-items-stretch">
						<div class="card bg-<?php echo $bg_card; ?>">
							<?php 
							$size = '250px';
							if ($value['active'] == 2 || $value['active'] == 3) {
								$size = '300px';
							}
							?>
							<div class="card-body pt-10" style="height: $size">
								<div class="row">
									<div class="col-12">
										<?php 
										if ($value['active'] == 1) {
											$color = 'red';
										}elseif ($value['active'] == 2) {
											$color = '#F4D03F';
										}elseif ($value['active'] == 3) {
											$color = 'blue';
										}elseif ($value['active'] == 4) {
											$color = 'silver';
										}elseif ($value['active'] == 5) {
											$color = 'red';
										}
										?>
										<h2 class="lead"><b><i class="fas fa-lg fa-network-wired" style="color:<?php echo $color; ?>"></i> <?php echo $value['nama'] ?></b></h2>
										<ul class="ml-4 mb-0 fa-ul text-muted">
											<li class="small"><span class="fa-li"><i class="fas fa-sm fa-map-marked-alt"></i></span> Alamat : <?php echo $value['alamat']; ?>/<?php echo $value['desa']; ?>/<?php echo $value['kec']; ?>/<?php echo $value['kab']; ?></li>
											<li class="small"><span class="fa-li"><i class="fas fa-sm fa-map-pin"></i></span> kordinat : <?php echo $value['kordinat'] ?></li>

											<?php 
												$nohp = $value['no_tlp'];
												$nohp = str_replace(" ","",$nohp);
												$nohp = str_replace("(","",$nohp);
												$nohp = str_replace(")","",$nohp);
												$nohp = str_replace(".","",$nohp);
												$hp = '-';

												if(!preg_match('/[^+0-9]/',trim($nohp)))
												{
													if(substr(trim($nohp), 0, 3)=='+62')
													{
														$hp = trim($nohp);
													}
													elseif(substr(trim($nohp), 0, 1)=='0')
													{
														$hp = '+62'.substr(trim($nohp), 1);
													}
												}
											?>
											<li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-sm fa-phone"></i></span> Telephone : <?php if ($hp != '-'): ?><a href="https://api.whatsapp.com/send?phone=<?php echo $hp ?>" target="_blank"><?php echo $hp ?></a><?php else: ?>-<?php endif ?></li>

											<?php if ($value['active'] == 3): ?>
												<li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-sm fa-bookmark"></i></span> No PKS : <?php echo $value['no_pelanggan'] ?></li>
											<?php endif ?>
											<?php if ($value['alat_biaya'] != 0): ?>
												<li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-sm fa-dollar-sign"></i></span> Biaya Promo : <?php echo money($value['alat_biaya']); ?></li>
											<?php endif ?>
											<li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-sm fa-clock"></i></span> Tgl Pendaftaran : <?php echo echo_date($value['pendaftaran']); ?></li>
											<li class="small"><span class="fa-li"><i class="fas fa-sm fa-user"></i></span> Penginput : <?php if (!empty(get_name($value['user_id']))): ?><?php echo get_name($value['user_id']); ?><?php endif ?></li>
										</ul>
									</div>
								</div>
								<?php if ($value['active'] == 2 || $value['active'] == 3): ?>
									<?php 
									$trx = '';
									$ccq = '';
									if ($value['trx'] >= 70) {
										$trx = 'danger';
									}elseif ($value['trx'] >= 50) {
										$trx = 'warning';
									}elseif ($value['trx'] < 50) {
										$trx = 'success';
									}

									if ($value['ccq'] <= 40) {
										$ccq = 'danger';
									}elseif ($value['ccq'] <= 70) {
										$ccq = 'warning';
									}elseif ($value['ccq'] > 70) {
										$ccq = 'success';
									}

									?>
									<p style="margin: 5px">TRX : (<?php echo $value['trx'] ?>%)</p>
									<div class="progress mb-1" style="margin: 5px">
										<div class="progress-bar <?php echo 'bg-' . $trx; ?>" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $value['trx'] . '%' ?>">
											<span class="sr-only">20% Complete</span>
										</div>
									</div>
									<p style="margin: 5px">CCQ : (<?php echo $value['ccq'] ?>%)</p>
									<div class="progress mb-1" style="margin: 5px">
										<div class="progress-bar <?php echo 'bg-' . $ccq; ?>" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $value['ccq'] . '%' ?>">
											<span class="sr-only">20% Complete</span>
										</div>
									</div>
								<?php endif ?>
							</div>
							<div class="card-footer">
								<div class="text-right">
									<?php if ($value['active'] == 2): ?>
										<?php if($value['pemasangan'] == 1): ?>
											<a href="<?php echo base_url('pemasangan/edit/' . $value['pelanggan_id']) ?>" class="btn btn-sm bg-warning">
												<i class="fas fa-satellite-dish"></i> Update alat
											</a>
											<a href="<?php echo base_url('pelanggan/edit_selesai/' . $value['pelanggan_id']) ?>" class="btn btn-sm bg-success">
												<i class="fas fa-american-sign-language-interpreting"></i> selesai
											</a>
											<?php elseif($value['pemasangan'] == 2): ?>
												<a href="<?php echo base_url('pemasangan/edit/' . $value['pelanggan_id']) ?>" class="btn btn-sm bg-warning">
													<i class="fas fa-satellite-dish"></i> Update alat
												</a>
											<?php endif ?>
											<?php elseif($value['active'] == 1) : ?>
												<a href="<?php echo base_url('pelanggan/blacklist/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin memblaclist <?php echo $value['nama'] ?>')){}else{return false;};" class="btn btn-sm bg-danger">
													<i class="fas fa-hands-helping"></i> Blacklist
												</a>
												<a href="<?php echo base_url('pemasangan/edit/' . $value['id']) ?>" class="btn btn-sm bg-teal">
													<i class="fas fa-satellite-dish"></i> Pasang
												</a>
												<?php elseif($value['active'] == 4) : ?>
													<a href="<?php echo base_url('pelanggan/blacklist/' . $value['id']) ?>" class="btn btn-sm bg-info disable">
														<i class="fas fa-hands-helping"></i> Buka blacklist
													</a>
												<?php endif ?>

												<?php if($value['active'] == 5) : ?>
													<a href="<?php echo base_url('pelanggan/blacklist/' . $value['id']) ?>" class="btn btn-sm bg-info">
														<i class="fas fa-hands-helping"></i> Pemasangan ulang
													</a>
												<?php endif ?>

												<?php if($value['active'] == 3): ?>
													<?php $status_maintance = ''; ?>
													<?php if (!empty($data['maintance'])): ?>
														<?php foreach ($data['maintance'] as $key => $vm): ?>
															<?php if ($vm['pelanggan_id'] == $value['pelanggan_id']): ?>
																<?php $status_maintance = 1; ?>
																<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-ubah<?php echo $vm['pelanggan_id'] ?>">
																	Ubah Keluhan
																</button>
																<div class="modal fade" id="modal-ubah<?php echo $vm['pelanggan_id'] ?>">
																	<div class="modal-dialog">
																		<form action="<?php echo base_url('maintance/tambah_maintance/?maintance=1&pelanggan=' . $value['pelanggan_id']) ?>" method="post">
																			<div class="modal-content">
																				<div class="modal-header">
																					<h4 style="color:black" class="modal-title">Ubah keluhan pelanggan <?php echo $value['nama'] ?></h4>
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true">&times;</span>
																					</button>
																				</div>
																				<div class="modal-body">
																					<div class="form-group">
																						<div class="form-group">
																							<textarea type="text" class="form-control" name="keluhan" placeholder="keluhan" value="<?php echo $vm['keluhan'] ?>" required><?php echo $vm['keluhan'] ?></textarea>
																						</div>
																					</div>
																				</div>
																				<div class="modal-footer justify-content-between">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary">Simpan</button>
																				</div>
																			</div>
																		</form>
																	</div>
																	<!-- /.modal-dialog -->
																</div>
															<?php endif ?>
														<?php endforeach ?>
													<?php endif ?>
													<?php if (empty($status_maintance)): ?>
														<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-ubah<?php echo $value['pelanggan_id'] ?>">
															Maintance
														</button>
														<div class="modal fade" id="modal-ubah<?php echo $value['pelanggan_id'] ?>">
															<div class="modal-dialog">
																<form action="<?php echo base_url('maintance/tambah_maintance/?maintance=1&pelanggan=' . $value['pelanggan_id']) ?>" method="post">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h4 style="color:black" class="modal-title">Keluhan pelanggan <?php echo $value['nama'] ?></h4>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																		</div>
																		<div class="modal-body">
																			<div class="form-group">
																				<div class="form-group">
																					<textarea type="text" class="form-control" name="keluhan" placeholder="keluhan" required></textarea>
																				</div>
																			</div>
																		</div>
																		<div class="modal-footer justify-content-between">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																			<button type="submit" class="btn btn-primary">Simpan</button>
																		</div>
																	</div>
																</form>
																<!-- /.modal-content -->
															</div>
															<!-- /.modal-dialog -->
														</div>
													<?php endif ?>
													<a href="<?php echo base_url('pelanggan/pencabutan/' . $value['pelanggan_id']) ?>" onclick="if(confirm('apakah anda yakin ingin mencabut jaringan <?php echo $value['nama'] ?>')){}else{return false;};" class="btn btn-sm btn-danger">
														<i class="fas fa-satellite-dish"></i> Pencabutan  
													</a>
													<a href="<?php echo base_url('pelanggan/detail/' . $value['pelanggan_id']) ?>" class="btn btn-sm btn-primary">
														<i class="fas fa-info"></i> Detail
													</a>
												<?php endif ?>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<nav aria-label="Contacts Page Navigation">
							<?php echo $this->pagination->create_links(); ?>
						</nav>
					</div>
					<!-- /.card-footer -->
				</div>
			</div>
      <!-- /.card -->