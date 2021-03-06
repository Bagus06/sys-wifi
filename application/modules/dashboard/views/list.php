<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <div class="card collapsed-card">
    <div class="card-header">
      <?php
        $cab = count($data['cab']);
        $canb = count($data['canb']);
        $cnab = count($data['cnab']);
        $cnanb = count($data['cnanb']);
        $jmlpa = $cab + $canb;
        $jmlcp = $cnab + $cnanb;
      ?>
      <h3 class="card-title btn" data-card-widget="collapse">INFO DATA PELANGGAN (<?php echo $jmlcp; ?>) (<?php echo $jmlpa; ?>)</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="col-md-12">
        <div class="info-box mb-3 bg-danger">

          <div class="info-box-content text-center">
            <span class="info-box-text"><i class="fas fa-lg fa-users"></i> CALON PELANGGAN</span>
            <span class="info-box-number">
              <?php echo $jmlcp; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("pelanggan/list/?filter=1") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-user-plus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CALON PELANGGAN PROMO</span>
                <span class="info-box-number"><?php echo count($data['cnab']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("pelanggan/list/?filter=1") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-user-plus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CALON PELANGGAN NON PROMO</span>
                <span class="info-box-number"><?php echo count($data['cnanb']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-12">
          <div class="info-box mb-3 bg-info">

            <div class="info-box-content text-center">
              <span class="info-box-text"><i class="fas fa-lg fa-users"></i> PELANGGAN AKTIF</span>
              <span class="info-box-number">
                 <?php echo $jmlpa; ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("pelanggan/list/?filter=3") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-user-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DATA PELANGGAN PROMO</span>
                <span class="info-box-number"><?php echo count($data['cab']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("pelanggan/list/?filter=3") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-user-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DATA PELANGGAN NON PROMO</span>
                <span class="info-box-number"><?php echo count($data['canb']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <div class="card collapsed-card">
    <div class="card-header">
      <h3 class="card-title btn" data-card-widget="collapse">INFO DATA MAINTANCE (<?php echo count($data['mm']); ?>)</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("maintance/list/?fm=1") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-toolbox"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">MAINTANCE MASUK</span>
                <span class="info-box-number"><?php echo count($data['mm']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("maintance/list/?fm=3") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-toolbox"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">MAINTANCE BELUM SELESAI</span>
                <span class="info-box-number"><?php echo count($data['mbs']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <div class="card collapsed-card">
    <div class="card-header">
      <h3 class="card-title btn" data-card-widget="collapse">INFO DATA AGENDA (<?php echo count($data['agndm']); ?>)</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("agenda/list") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="nav-icon fas fa-clipboard-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">AGENDA MASUK</span>
                <span class="info-box-number"><?php echo count($data['agndm']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("agenda/list/?fa=2") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="nav-icon fas fa-clipboard-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">AGENDA BELUM SELESAI</span>
                <span class="info-box-number"><?php echo count($data['agndbs']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <div class="card collapsed-card">
    <div class="card-header">
      <h3 class="card-title btn" data-card-widget="collapse">INFO DATA LAPORAN (<?php echo count($data['lhi']); ?>)</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("laporan/list") ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="nav-icon fas fa-atlas"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">LAPORAN HARI INI</span>
                <span class="info-box-number"><?php echo count($data['lhi']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-12">
          <a href="<?php echo base_url("laporan/list/?bi=" . date('Y-m')) ?>" style="color: black">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="nav-icon fas fa-atlas"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">LAPORAN BULAN INI</span>
                <span class="info-box-number"><?php echo count($data['lbi']); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title btn" data-card-widget="collapse">PETA PENYEBARAN PELANGGAN</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <div style="margin: 2%">
        <h5>Pelanggan Aktif</h5>
        <div class="col-md-12 row">
          <?php foreach ($data['jml_desa_pa'] as $key => $jml): ?>
            <?php if (($key != '-') && !empty($key)): ?>
              <div style="margin: 3px">
                <span class="badge badge-success">
                  <div style="margin: 5px">
                    <i class="fas fa-lg fa-arrow-alt-circle-up"></i> <?php echo $key ?>(<?php echo $jml ?>)
                  </div>
                </span>
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </div>
      </div>
      <div style="margin: 2%">
        <h5>Dalam Proses Pemasangan</h5>
        <div class="col-md-12 row">
          <?php foreach ($data['jml_desa_dp'] as $key => $jml): ?>
            <?php
              $color = '';
              foreach ($data['jml_desa_pa'] as $keypa => $jdpa) {
                if ($keypa == $key) {
                   $color = '#14D700';
                }
              }
             ?>
            <?php if (($key != '-') && !empty($key)): ?>
              <div style="margin: 3px">
                <span class="badge badge-warning">
                  <div style="margin: 5px">
                    <i class="fas fa-lg fa-arrow-alt-circle-right" style="color: <?php echo $color; ?>"></i> <?php echo $key ?>(<?php echo $jml ?>)
                  </div>
                </span>
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </div>
      </div>
      <div style="margin: 2%">
        <h5>Calon Pelanggan</h5>
        <div class="col-md-12 row">
          <?php foreach ($data['jml_desa_cp'] as $key => $jml): ?>
            <?php
              $color = '';
              foreach ($data['jml_desa_pa'] as $keypa => $jdpa) {
                if ($keypa == $key) {
                   $color = '#14D700';
                }
              }
             ?>
            <?php if (($key != '-') && !empty($key)): ?>
              <div style="margin: 3px">
                <span class="badge badge-danger">
                  <div style="margin: 5px">
                    <i class="fas fa-lg fa-arrow-alt-circle-down" style="color: <?php echo $color; ?>"></i> <?php echo $key ?>(<?php echo $jml ?>)
                  </div>
                </span>
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>