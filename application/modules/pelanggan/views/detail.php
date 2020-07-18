<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-12">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<a data-toggle="modal" data-target="#modal-profle" href="#">
									<img class="profile-user-img img-fluid img-circle"
									src="<?php echo base_url('assets/images/pelanggan/' . $data['foto_pelanggan']) ?>"
									alt="User profile picture" style="width: 100px;height: 100px;">
								</a>
								<div class="modal fade" id="modal-profle">
									<div class="modal-dialog modal-sm">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<img style=" max-width: 100%; max-height: 100%;" src='<?php echo base_url('assets/images/pelanggan/' . $data['foto_pelanggan']) ?>'>
											</div>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
								<!-- /.modal -->
							</div>

							<h3 class="profile-username text-center"><?php echo @$data['nama'] ?></h3>

							<p class="text-muted text-center">
								No PKS <?php echo $data['no_pelanggan']; ?>
							</p>
							<div class="card-header">
								<h3 class="card-title">Detail pelanggan</h3>
								<h3 class="card-title" style="padding-left: 2%">
									<a href="<?php echo base_url('pelanggan/edit_pelanggan/' . $data['pelanggan_id']) ?>" class="btn btn-sm btn-info">Edit Profile Pelanggan</a>
									<!-- <a href="" class="btn btn-sm btn-info">Edit Profile Pelanggan</a> -->
								</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="table-responsive">
									<table class="col-md-12" border="0" style="margin: 0px">
										<tr>
											<td>Nama </td>
											<td>:</td>
											<td><?php echo $data['nama']; ?></td>
										</tr>
										<tr>
											<td>KK </td>
											<td>:</td>
											<td><?php echo $data['kk']; ?></td>
										</tr>
										<tr>
											<td>NIK </td>
											<td>:</td>
											<td><?php echo $data['nik']; ?></td>
										</tr>
										<tr>
											<?php 
												$nohp = $data['no_tlp'];
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
													}elseif(substr(trim($nohp), 0, 1)=='0')
													{
														$hp = '+62'.substr(trim($nohp), 1);
													}
												}
											?>
											<td>No Tlp/WA </td>
											<td>:</td>
											<td><?php if ($hp != '-'): ?><a class="btn btn-sm btn-primary" href="https://api.whatsapp.com/send?phone=<?php echo $hp ?>" target="_blank">klik to chat <?php echo $hp ?></a><?php else: ?>-<?php endif ?></td>
										</tr>
										<tr>
											<td>Alamat </td>
											<td>:</td>
											<td><?php echo $data['alamat']; ?> - Ds.<?php echo $data['desa'] ?> / Kec.<?php echo $data['kec']; ?> / Kab.<?php echo $data['kab'] ?></td>
										</tr>
										<tr>
											<td>Pekerjaan </td>
											<td>:</td>
											<td><?php echo $data['pekerjaan'] ?></td>
										</tr>
										<tr>
											<td>Pelanggan Promo </td>
											<td>:</td>
											<td>
												<?php
													if (!empty($data['alat_biaya'])) {
														echo money($data['alat_biaya']);
													}else{
														?><span class="badge badge-warning">Tidak</span><?php
													}
												?>
											</td>
										</tr>
										<tr>
											<td>Tanggal Pendaftaran </td>
											<td>:</td>
											<td><?php echo echo_date($data['pendaftaran']) ?></td>
										</tr>
										<tr>
											<td>Mulai pasang </td>
											<td>:</td>
											<td><?php echo echo_date($data['tgl_pks']) ?></td>
										</tr>
										<tr>
											<td>Kordinat </td>
											<td>:</td>
											<td><?php echo $data['kordinat'] ?></td>
										</tr>
										<tr>
											<td>Foto Rumah </td>
											<td>:</td>
											<td>
												<a href="<?php echo base_url("assets/images/rumah/" . $data['foto_rumah']) ?>" target="_blank">
													<img style="display: block;max-width: 200%;object-fit: cover;height: 100px;" src="<?php echo base_url("assets/images/rumah/" . $data['foto_rumah']) ?>" />
												</a>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<?php 
													$trx = '';
													$ccq = '';
													if ($data['trx'] >= 70) {
														$trx = 'danger';
													}elseif ($data['trx'] >= 50) {
														$trx = 'warning';
													}elseif ($data['trx'] < 50) {
														$trx = 'success';
													}

													if ($data['ccq'] <= 40) {
														$ccq = 'danger';
													}elseif ($data['ccq'] <= 70) {
														$ccq = 'warning';
													}elseif ($data['ccq'] > 70) {
														$ccq = 'success';
													}

												 ?>
												<p style="margin: 5px">TRX : (<?php echo $data['trx'] ?>%)</p>
												<div class="progress mb-1" style="margin: 5px">
													<div class="progress-bar <?php echo 'bg-' . $trx; ?>" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $data['trx'] . '%' ?>">
														<span class="sr-only">20% Complete</span>
													</div>
												</div>
												<p style="margin: 5px">CCQ : (<?php echo $data['ccq'] ?>%)</p>
												<div class="progress mb-1" style="margin: 5px">
													<div class="progress-bar <?php echo 'bg-' . $ccq; ?>" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $data['ccq'] . '%' ?>">
														<span class="sr-only">20% Complete</span>
													</div>
												</div>
											</td>
										</tr>
									</table>
									<table class="col-md-12" border="1" style="margin: 0px; margin-top: 10px">
										<tr>
											<th colspan="3" style="text-align: center">
												<h2><b><i>ALAT DIPAKAI</i></b></h2>
											</th>
										</tr>
										<tr style="text-align: center">
											<th>Tiang</th>
											<th colspan="2">Kabel</th>
										</tr>
										<tr style="text-align: center">
											<td style="padding: 20px"><?php echo $data['tiang'] ?></td>
											<td colspan="2" style="padding: 20px"><?php echo $data['kabel'] ?></td>
										</tr>
									</table>
									<table class="col-md-12" border="1" style="margin: 0px;">
										<tr style="text-align: center">
											<th style="width: 7%;">No.</th>
											<th>Nama Alat</th>
											<th><b><i>SN</i></b></th>
										</tr>
										<?php $i=0; ?>
										<?php foreach ($data['alat'] as $key => $va): ?>
											<tr>
												<td style=" text-align: center"><?php echo ++$i; ?></td>
												<td><?php echo $va['title'] ?></td>
												<td><?php echo $va['sn'] ?></td>
											</tr>
										<?php endforeach ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>