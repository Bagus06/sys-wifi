<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-lg-12">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner" align="center">
					<p>Pendapatan bulan <?php echo date('M') ?></p>
					<h3><?php echo money($data['jml_pendapatan']) ?></h3>
				</div>
				<div class="icon">
					
				</div>
				<hr>
				<a href="<?php echo base_url('laporan_keuangan/list?desa=0&pelanggan=0&rentan=1'); ?>" class="small-box-footer">Info lebih lanjut bulanan<i class="fas fa-arrow-circle-right"></i></a>
				<hr>
				<a href="<?php echo base_url('laporan_keuangan/list?desa=0&pelanggan=0&rentan=2'); ?>" class="small-box-footer">Info lebih lanjut tahunan<i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-12">
			<!-- small box -->
			<div class="small-box bg-warning">
				<div class="inner" align="center">
					<p>Terbayar bulan <?php echo date('M') ?></p>
					<h3><?php echo money($data['sudah_terbayar']) ?></h3>
				</div>
				<div class="icon">
					
				</div>
				<a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-12">
			<!-- small box -->
			<div class="small-box bg-danger">
				<div class="inner" align="center">
					<p>Hutang pelanggan bulan <?php echo date('M') ?></p>
					<h3><?php $hutang = $data['jml_pendapatan'] - $data['sudah_terbayar']; echo money($hutang); ?></h3>
				</div>
				<div class="icon">
					
				</div>
				<a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
</div>