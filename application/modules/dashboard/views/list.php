<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container-fluid">
  <h5 class="mb-2">INFO DATA PELANGGAN</h5>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-12">
      <a href="<?php echo base_url("pelanggan/list/?filter=1") ?>" style="color: black">
        <div class="info-box">
          <span class="info-box-icon bg-success"><i class="fas fa-user-plus"></i></span>

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
          <span class="info-box-icon bg-warning"><i class="fas fa-user-plus"></i></span>

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
    <div class="col-md-6 col-sm-6 col-12">
      <a href="<?php echo base_url("pelanggan/list/?filter=3") ?>" style="color: black">
        <div class="info-box">
          <span class="info-box-icon bg-success"><i class="fas fa-user-check"></i></span>

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
          <span class="info-box-icon bg-warning"><i class="fas fa-user-check"></i></span>

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

<div class="container-fluid">
  <h5 class="mb-2">INFO DATA MAINTANCE</h5>
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