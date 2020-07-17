<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="col-md-12">
  <!-- MAP & BOX PANE -->
  <div class="card collapsed-card">
    <div class="card-header">
      <h3 class="card-title btn" data-card-widget="collapse">INFO DATA PELANGGAN</h3>

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
              <?php 
                $cnab = count($data['cnab']);
                $cnanb = count($data['cnanb']);
                $jmlcp = $cnab + $cnanb;
                echo $jmlcp;
               ?>
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
                 <?php 
                  $cab = count($data['cab']);
                  $canb = count($data['canb']);
                  $jmlpa = $cab + $canb;
                  echo $jmlpa;
                 ?>
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
      <h3 class="card-title btn" data-card-widget="collapse">INFO DATA MAINTANCE</h3>

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