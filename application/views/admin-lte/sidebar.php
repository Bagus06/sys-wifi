<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php 

$link1 = $this->uri->rsegments[1];
$link2 = $this->uri->rsegments[2];
$get = @$this->input->get('filter');
$fa = @$this->input->get('fa');
$fm = @$this->input->get('fm');
$fls = @$this->input->get('fls');

if ($link1 == 'dashboard') {
	$mo0 = 'menu-open';
	$ma0 = 'active';
	if ($link2 == 'list') {
		$d = 'active';
	}
}

if ($link1 == 'laporan') {
	$mo5 = 'menu-open';
	$ma5 = 'active';
	if ($link2 == 'list') {
		$l = 'active';
	}elseif ($link2 == 'edit') {
		$le = 'active';
	}
}

if ($link1 == 'agenda') {
	$mo6 = 'menu-open';
	$ma6 = 'active';
	if ($link2 == 'list') {
		if ($fa == 1) {
			$agnd = 'active';
		}elseif ($fa == 2) {
			$agnddp = 'active';
		}elseif ($fa == 3) {
			$agndss = 'active';
		}else{
			$agnd = 'active';
		}
	}elseif ($link2 == 'edit') {
		$tagnd = 'active';
	}
}

if ($link1 == 'laporan_keuangan') {
	$mo7 = 'menu-open';
	$ma7 = 'active';
	if ($link2 == 'list') {
		$lk = 'active';
	}elseif ($link2 == 'edit_config') {
		$tcp = 'active';
	}
}

if ($link1 == 'library_scurity') {
	$mo8 = 'menu-open';
	$ma8 = 'active';
	if ($link2 == 'list') {
		$lls = 'active';
	}elseif ($link2 == 'edit') {
		$tls = 'active';
	}
}

if ($link1 == 'user') {
	$mo1 = 'menu-open';
	$ma1 = 'active';
	if ($link2 == 'list') {
		$tau = 'active';
	}elseif ($link2 == 'edit') {
		$tu = 'active';
	}
}

if ($link1 == 'pelanggan') {
	$mo3 = 'menu-open';
	$ma3 = 'active';
	if ($link1 == 'pelanggan' && $link2 == 'list' && $get == 1) {
		$lpbt = 'active';
	}elseif ($link1 == 'pelanggan' && $link2 == 'list' && $get == 2) {
		$lpk = 'active';
	}elseif ($link1 == 'pelanggan' && $link2 == 'list' && $get == 3) {
		$lptp = 'active';
	}elseif ($link1 == 'pelanggan' && $link2 == 'list' && $get == 4) {
		$lpbl = 'active';
	}elseif ($link1 == 'pelanggan' && $link2 == 'list' && $get == 5) {
		$lpdc = 'active';
	}elseif ($link2 == 'edit') {
		$tp = 'active';
	}
}


if ($link1 == 'jenis_alat' || $link1 == 'alat_list') {
	$mo2 = 'menu-open';
	$ma2 = 'active';
	if ($link1 == 'alat_list' && $link2 == 'list') {
		if ($fa == 1 || $fa == 2 || $fa == 3) {
			$mso = 'menu-open';
			$msa = 'active';
		}
	}
	if ($link1 == 'jenis_alat' && $link2 == 'list') {
		$lta = 'active';
	}elseif ($link1 == 'jenis_alat' && $link2 == 'edit') {
		$tta = 'active';
	}elseif ($link1 == 'jenis_alat' && $link2 == 'alat_history') {
		$htp = 'active';
	}elseif ($link1 == 'alat_list' && $link2 == 'list' && $fa == 1) {
		$abt = 'active';
	}elseif ($link1 == 'alat_list' && $link2 == 'list' && $fa == 2) {
		$ast = 'active';
	}elseif ($link1 == 'alat_list' && $link2 == 'list' && $fa == 3) {
		$asr = 'active';
	}elseif($link1 == 'alat_list' && $link2 == 'list')
	{
		$dsa = 'active';
	}
}

if ($link1 == 'maintance' || $link1 == 'list') {
	$mo4 = 'menu-open';
	$ma4 = 'active';
	if ($link1 == 'maintance' && $link2 == 'list' && $fm == 1) {
		$mab = 'active';
	}elseif ($link1 == 'maintance' && $link2 == 'list' && $fm == 2) {
		$dpm = 'active';
	}elseif ($link1 == 'maintance' && $link2 == 'list' && $fm == 3) {
		$pmbs = 'active';
	}elseif($link1 == 'maintance' && $link2 == 'list' && $fm == 4)
	{
		$pms = 'active';
	}
}
?>

<li class="nav-item">
	<a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php echo @$d; ?>">
		<i class="nav-icon fas fa-tachometer-alt"></i>
		<p>
			DASHBOARD
		</p>
	</a>
</li>
<?php if (is_admin() || is_net()): ?>
<?php if (is_admin()): ?>
	<li class="nav-item has-treeview <?php echo @$mo1; ?>">
		<a href="#" class="nav-link <?php echo @$ma1; ?>">
			<i class="nav-icon fas fa-user-cog"></i>
			<p>
				PENGGUNA
				<i class="fas fa-angle-left right"></i>
			</p>
		</a>
		<ul class="nav nav-treeview">
			<li class="nav-item">
				<a href="<?php echo base_url("user") ?>" class="nav-link <?php echo @$tau; ?>">
					<i class="far fa-circle nav-icon"></i>
					<p>Semua Pengguna <?php echo @$tau; ?></p>
				</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url("user/edit") ?>" class="nav-link <?php echo @$tu; ?>">
					<i class="far fa-circle nav-icon"></i>
					<p>Tambah Pengguna</p>
				</a>
			</li>
		</ul>
	</li>
<?php endif ?>
<li class="nav-item has-treeview <?php echo @$mo3; ?>">
	<a href="#" class="nav-link <?php echo @$ma3; ?>">
		<i class="nav-icon fas fa-users"></i>
		<p>
			PELANGGAN
			<i class="fas fa-angle-left right"></i>
		</p>
	</a>
	<ul class="nav nav-treeview">
		<?php if (is_admin() || is_net()): ?>
			<li class="nav-item">
				<a href="<?php echo base_url("pelanggan/edit") ?>" class="nav-link <?php echo @$tp; ?>">
					<i class="far fa-circle nav-icon"></i>
					<p>Tambah Pelanggan</p>
				</a>
			</li>
		<?php endif ?>
		<li class="nav-item">
			<a href="<?php echo base_url("pelanggan/list/?filter=1") ?>" class="nav-link <?php echo @$lpbt; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Calon Pelanggan (<?php echo count_p()['calon']; ?>)</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url("pelanggan/list/?filter=4") ?>" class="nav-link <?php echo @$lpbl; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Pelanggan Diblaclist (<?php echo count_p()['bl']; ?>)</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url("pelanggan/list/?filter=2") ?>" class="nav-link <?php echo @$lpk; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Dalam Proses Pasang (<?php echo count_p()['proses']; ?>)</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url("pelanggan/list/?filter=3") ?>" class="nav-link <?php echo @$lptp; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Data Pelanggan Aktif (<?php echo count_p()['active']; ?>)</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url("pelanggan/list/?filter=5") ?>" class="nav-link <?php echo @$lpdc; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Data Pencabutan (<?php echo count_p()['dc']; ?>)</p>
			</a>
		</li>
	</ul>
</li>
<li class="nav-item has-treeview <?php echo @$mo4; ?>">
	<a href="#" class="nav-link <?php echo @$ma4; ?>">
		<i class="nav-icon fas fa-toolbox"></i>
		<p>
			MAINTANCE
			<i class="fas fa-angle-left right"></i>
		</p>
	</a>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url("maintance/list/?fm=1") ?>" class="nav-link <?php echo @$mab; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Maintance Masuk</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url("maintance/list/?fm=2") ?>" class="nav-link <?php echo @$dpm; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Dalam Proses Maintance</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url("maintance/list/?fm=3") ?>" class="nav-link <?php echo @$pmbs; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Maintance Belum Selesai</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url("maintance/list/?fm=4") ?>" class="nav-link <?php echo @$pms; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Maintance Telah Selesai</p>
			</a>
		</li>
	</ul>
</li>
<?php if (is_admin()): ?>
	<li class="nav-item has-treeview <?php echo @$mo2; ?>">
		<a href="#" class="nav-link <?php echo @$ma2; ?>">
			<i class="nav-icon fas fa-tools"></i>
			<p>
				ALAT
				<i class="fas fa-angle-left right"></i>
			</p>
		</a>
		<ul class="nav nav-treeview">
			<li class="nav-item">
				<a href="<?php echo base_url("jenis_alat") ?>" class="nav-link <?php echo @$lta; ?>">
					<i class="far fa-circle nav-icon"></i>
					<p>Data Tipe Alat</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url("jenis_alat/alat_history/") ?>" class="nav-link <?php echo @$htp; ?>">
					<i class="far fa-circle nav-icon"></i>
					<p>History Penambahan Alat</p>
				</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url("jenis_alat/edit") ?>" class="nav-link <?php echo @$tta; ?>">
					<i class="far fa-circle nav-icon"></i>
					<p>Tambah Tipe Alat</p>
				</a>
			</li>
			<li class="nav-item has-treeview <?php echo @$mso; ?>">
				<a href="#" class="nav-link <?php echo @$msa; ?>">
					<i class="far fa-circle nav-icon"></i>
					<p>
						Detail Alat SN
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul style="padding-left: 12px" class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?php echo base_url("alat_list/list/") ?>" class="nav-link <?php echo @$dsa; ?>">
							<i class="far fa-dot-circle nav-icon"></i>
							<p>Stok Semua Alat</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url("alat_list/list/?fa=1") ?>" class="nav-link <?php echo @$abt; ?>">
							<i class="far fa-dot-circle nav-icon"></i>
							<p>Stok Alat Baru</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url("alat_list/list/?fa=2") ?>" class="nav-link <?php echo @$ast; ?>">
							<i class="far fa-dot-circle nav-icon"></i>
							<p>Stok Alat Terpakai</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url("alat_list/list/?fa=3") ?>" class="nav-link <?php echo @$asr; ?>">
							<i class="far fa-dot-circle nav-icon"></i>
							<p>Stok Alat Rusak</p>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</li>
<?php endif ?>
<li class="nav-item has-treeview <?php echo @$mo8; ?>">
	<a href="#" class="nav-link <?php echo @$ma8; ?>">
		<i class="nav-icon fas fa-laptop"></i>
		<p>
			LIBRARY SCURITY
			<i class="fas fa-angle-left right"></i>
		</p>
	</a>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url("library_scurity/edit") ?>" class="nav-link <?php echo @$tls; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Tambah Scurity</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url("library_scurity/list") ?>" class="nav-link <?php echo @$lls; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>List Scurity</p>
			</a>
		</li>
	</ul>
</li>
<li class="nav-item has-treeview <?php echo @$mo5; ?>">
	<a href="#" class="nav-link <?php echo @$ma5; ?>">
		<i class="nav-icon fas fa-atlas"></i>
		<p>
			LAPORAN
			<i class="fas fa-angle-left right"></i>
		</p>
	</a>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url('laporan/edit'); ?>" class="nav-link <?php echo @$le; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Tambah Laporan</p>
			</a>
		</li>
	</ul>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url('laporan/list'); ?>" class="nav-link <?php echo @$l; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Laporan</p>
			</a>
		</li>
	</ul>
</li>
<li class="nav-item has-treeview <?php echo @$mo6; ?>">
	<a href="#" class="nav-link <?php echo @$ma6; ?>">
		<i class="nav-icon fas fa-clipboard-list"></i>
		<p>
			AGENDA NON TEKNIS
			<i class="fas fa-angle-left right"></i>
		</p>
	</a>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url('agenda/edit'); ?>" class="nav-link <?php echo @$tagnd; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Tambah Agenda</p>
			</a>
		</li>
	</ul>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url('agenda/list'); ?>" class="nav-link <?php echo @$agnd; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Agenda</p>
			</a>
		</li>
	</ul>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url('agenda/list/?fa=2'); ?>" class="nav-link <?php echo @$agnddp; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Agenda Proses Dikerjakan</p>
			</a>
		</li>
	</ul>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url('agenda/list/?fa=3'); ?>" class="nav-link <?php echo @$agndss; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Agenda Selesai Dikerjakan</p>
			</a>
		</li>
	</ul>
</li>
<?php if (is_admin()): ?>
<li class="nav-item has-treeview <?php echo @$mo7; ?>">
	<a href="#" class="nav-link <?php echo @$ma7; ?>">
		<i class="nav-icon fas fa-funnel-dollar"></i>
		<p>
			LAPORAN KEUANGAN
			<i class="fas fa-angle-left right"></i>
		</p>
	</a>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url('laporan_keuangan/edit_config'); ?>" class="nav-link <?php echo @$tcp; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Tambah Config Pembayaran</p>
			</a>
		</li>
	</ul>
	<ul class="nav nav-treeview">
		<li class="nav-item">
			<a href="<?php echo base_url('laporan_keuangan/list'); ?>" class="nav-link <?php echo @$lk; ?>">
				<i class="far fa-circle nav-icon"></i>
				<p>Rekap</p>
			</a>
		</li>
	</ul>
</li>
<?php endif ?>
<?php endif; ?>