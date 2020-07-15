<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="card card-solid collapsed-card">
  <div class="card-header pb-0">
    <div class="text-center">
      <b>CALON PELANGGAN PROMO (<?php echo $data['cnab']; ?>)</b>
    </div>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      </div>
  </div>
  <div class="card-body pb-0" style="display: none">
    <div class="row d-flex align-items-stretch">
      <?php foreach ($data['not_active_biaya'] as $key => $value): ?>
        <div class="col-12 col-sm-6 col-md-4 align-items-stretch">
          <div class="card bg-light">
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-12">
                  <?php
                    if ($value['active'] == 1) {
                      $color = 'red';
                    }elseif ($value['active'] == 2) {
                      $color = '#F4D03F';
                    }elseif ($value['active'] == 3) {
                      $color = 'blue';
                    }else{
                      $color = 'black';
                    }
                   ?>
                  <h2 class="lead"><b><i class="fas fa-lg fa-network-wired" style="color:<?php echo $color; ?>"></i> <?php echo $value['nama'] ?></b></h2>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-marked-alt"></i></span> Alamat : <?php echo $value['alamat']; ?>-Ds.<?php echo $value['desa']; ?>-Kec.<?php echo $value['kec']; ?>-Kab.<?php echo $value['kab']; ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-pin"></i></span> kordinat : <?php echo $value['kordinat'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telephone : <?php echo $value['no_tlp'] ?> </li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-bookmark"></i></span> no pelanggan : <?php echo $value['no_pelanggan'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> Tgl Pendaftaran : <?php echo echo_date($value['pendaftaran']); ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Penginput : <?php if (!empty(get_name($value['user_id']))): ?><?php echo get_name($value['user_id']); ?><?php endif ?></li>
                  </ul>
                </div>
              </div>
              <?php if ($value['active'] == 2 || $value['active'] == 3): ?>
                <?php 
                  $trx = '';
                  $ccq = '';
                  if ($value['trx'] >= 70) {
                    $trx = 'danger';
                  }elseif ($value['trx'] > 70) {
                    $trx = 'info';
                  }

                  if ($value['ccq'] <= 40) {
                    $ccq = 'danger';
                  }elseif ($value['ccq'] > 40) {
                    $ccq = 'info';
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
                    <b>Dalam pemasangan</b>
                  <?php elseif($value['pemasangan'] == 2): ?>
                    <b>Pemasangan Selesai</b>
                  <?php endif ?>
                <?php elseif($value['active'] == 1) : ?>
                  <b>Belum Pasang</b>
                <?php endif ?>

                <?php if($value['active'] == 3): ?>
                  <b>Pemasangan Selesai</b>
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
    </nav>
  </div>
  <!-- /.card-footer -->
</div>
<div class="card card-solid collapsed-card">
  <div class="card-header pb-0">
    <div class="text-center">
      <b>CALON PELANGGAN NON PROMO (<?php echo $data['cnanb']; ?>)</b>
    </div>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      </div>
  </div>
  <div class="card-body pb-0" style="display: none">
    <div class="row d-flex align-items-stretch">
      <?php foreach ($data['not_active_no_biaya'] as $key => $value): ?>
        <div class="col-12 col-sm-6 col-md-4 align-items-stretch">
          <div class="card bg-light">
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-12">
                  <?php 
                    if ($value['active'] == 1) {
                      $color = 'red';
                    }elseif ($value['active'] == 2) {
                      $color = '#F4D03F';
                    }elseif ($value['active'] == 3) {
                      $color = 'blue';
                    }else{
                      $color = black;
                    }
                   ?>
                  <h2 class="lead"><b><i class="fas fa-lg fa-network-wired" style="color:<?php echo $color; ?>"></i> <?php echo $value['nama'] ?></b></h2>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-marked-alt"></i></span> Alamat : <?php echo $value['alamat']; ?>-Ds.<?php echo $value['desa']; ?>-Kec.<?php echo $value['kec']; ?>-Kab.<?php echo $value['kab']; ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-pin"></i></span> kordinat : <?php echo $value['kordinat'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telephone : <?php echo $value['no_tlp'] ?> </li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-bookmark"></i></span> no pelanggan : <?php echo $value['no_pelanggan'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> Tgl Pendaftaran : <?php echo echo_date($value['pendaftaran']); ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Penginput : <?php if (!empty(get_name($value['user_id']))): ?><?php echo get_name($value['user_id']); ?><?php endif ?></li>
                  </ul>
                </div>
              </div>
              <?php if ($value['active'] == 2 || $value['active'] == 3): ?>
                <?php 
                  $trx = '';
                  $ccq = '';
                  if ($value['trx'] >= 70) {
                    $trx = 'danger';
                  }elseif ($value['trx'] > 70) {
                    $trx = 'info';
                  }

                  if ($value['ccq'] <= 40) {
                    $ccq = 'danger';
                  }elseif ($value['ccq'] > 40) {
                    $ccq = 'info';
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
                    <b>Dalam pemasangan</b>
                  <?php elseif($value['pemasangan'] == 2): ?>
                    <b>Pemasangan Selesai</b>
                  <?php endif ?>
                <?php elseif($value['active'] == 1) : ?>
                  <b>Belum Pasang</b>
                <?php endif ?>

                <?php if($value['active'] == 3): ?>
                  <b>Pemasangan Selesai</b>
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
    </nav>
  </div>
  <!-- /.card-footer -->
</div>
<!-- Default box -->
<div class="card card-solid collapsed-card">
  <div class="card-header pb-0">
    <div class="text-center">
      <b>DATA PELANGGAN PROMO (<?php echo $data['cab']; ?>)</b>
    </div>
     <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      </div>
  </div>
  <div class="card-body pb-0" style="display: none">
    <div class="row d-flex align-items-stretch">
      <?php foreach ($data['active_biaya'] as $key => $value): ?>
        <div class="col-12 col-sm-6 col-md-4 align-items-stretch">
          <div class="card bg-light">
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-12">
                  <?php 
                    if ($value['active'] == 1) {
                      $color = 'red';
                    }elseif ($value['active'] == 2) {
                      $color = '#F4D03F';
                    }elseif ($value['active'] == 3) {
                      $color = 'blue';
                    }else{
                      $color = black;
                    }
                   ?>
                  <h2 class="lead"><b><i class="fas fa-lg fa-network-wired" style="color:<?php echo $color; ?>"></i> <?php echo $value['nama'] ?></b></h2>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-marked-alt"></i></span> Alamat : <?php echo $value['alamat']; ?>-Ds.<?php echo $value['desa']; ?>-Kec.<?php echo $value['kec']; ?>-Kab.<?php echo $value['kab']; ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-pin"></i></span> kordinat : <?php echo $value['kordinat'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telephone : <?php echo $value['no_tlp'] ?> </li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-bookmark"></i></span> no pelanggan : <?php echo $value['no_pelanggan'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> Tgl Pendaftaran : <?php echo echo_date($value['pendaftaran']); ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Penginput : <?php if (!empty(get_name($value['user_id']))): ?><?php echo get_name($value['user_id']); ?><?php endif ?></li>
                  </ul>
                </div>
              </div>
              <?php if ($value['active'] == 2 || $value['active'] == 3): ?>
                <?php 
                  $trx = '';
                  $ccq = '';
                  if ($value['trx'] >= 70) {
                    $trx = 'danger';
                  }elseif ($value['trx'] > 70) {
                    $trx = 'info';
                  }

                  if ($value['ccq'] <= 40) {
                    $ccq = 'danger';
                  }elseif ($value['ccq'] > 40) {
                    $ccq = 'info';
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
                    <b>Dalam pemasangan</b>
                  <?php elseif($value['pemasangan'] == 2): ?>
                    <b>Pemasangan Selesai</b>
                  <?php endif ?>
                <?php elseif($value['active'] == 1) : ?>
                  <b>Belum Pasang</b>
                <?php endif ?>

                <?php if($value['active'] == 3): ?>
                  <b>Pemasangan Selesai</b>
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
    </nav>
  </div>
  <!-- /.card-footer -->
</div>
      <!-- /.card -->
<div class="card card-solid collapsed-card">
  <div class="card-header pb-0">
    <div class="text-center">
      <b>DATA PELANGGAN NON PROMO (<?php echo $data['canb']; ?>)</b>
    </div>
     <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      </div>
  </div>
  <div class="card-body pb-0" style="display: none">
    <div class="row d-flex align-items-stretch">
      <?php foreach ($data['active_no_biaya'] as $key => $value): ?>
        <div class="col-12 col-sm-6 col-md-4 align-items-stretch">
          <div class="card bg-light">
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-12">
                  <?php 
                    if ($value['active'] == 1) {
                      $color = 'red';
                    }elseif ($value['active'] == 2) {
                      $color = '#F4D03F';
                    }elseif ($value['active'] == 3) {
                      $color = 'blue';
                    }else{
                      $color = black;
                    }
                   ?>
                  <h2 class="lead"><b><i class="fas fa-lg fa-network-wired" style="color:<?php echo $color; ?>"></i> <?php echo $value['nama'] ?></b></h2>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-marked-alt"></i></span> Alamat : <?php echo $value['alamat']; ?>-Ds.<?php echo $value['desa']; ?>-Kec.<?php echo $value['kec']; ?>-Kab.<?php echo $value['kab']; ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-map-pin"></i></span> kordinat : <?php echo $value['kordinat'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telephone : <?php echo $value['no_tlp'] ?> </li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-bookmark"></i></span> no pelanggan : <?php echo $value['no_pelanggan'] ?></li>
                    <li class="small" style="padding-top: 5px"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> Tgl Pendaftaran : <?php echo echo_date($value['pendaftaran']); ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Penginput : <?php if (!empty(get_name($value['user_id']))): ?><?php echo get_name($value['user_id']); ?><?php endif ?></li>
                  </ul>
                </div>
              </div>
              <?php if ($value['active'] == 2 || $value['active'] == 3): ?>
                <?php 
                  $trx = '';
                  $ccq = '';
                  if ($value['trx'] >= 70) {
                    $trx = 'danger';
                  }elseif ($value['trx'] > 70) {
                    $trx = 'info';
                  }

                  if ($value['ccq'] <= 40) {
                    $ccq = 'danger';
                  }elseif ($value['ccq'] > 40) {
                    $ccq = 'info';
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
                    <b>Dalam pemasangan</b>
                  <?php elseif($value['pemasangan'] == 2): ?>
                    <b>Pemasangan Selesai</b>
                  <?php endif ?>
                <?php elseif($value['active'] == 1) : ?>
                  <b>Belum Pasang</b>
                <?php endif ?>

                <?php if($value['active'] == 3): ?>
                  <b>Pemasangan Selesai</b>
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
    </nav>
  </div>
  <!-- /.card-footer -->
</div>

<div class="col-md-12">
 <!-- Main content -->
 <section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header pb-0">
      <div class="text-center">
        <b>MAINTANCE MASUK</b>
      </div>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0" style="display: none">
      <div class="table-responsive">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th>
                No.
              </th>
              <th>
                Nama pelanggan
              </th>
              <th>
                Keluhan
              </th>
              <th class="text-center">
                Status
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0; ?>
            <?php foreach ($data['maintance'] as $key => $value): ?>
              <tr>
                <td>
                  <?php echo ++$i; ?> 
                </td>
                <td>
                  <a>
                    <?php echo $value['nama'] ?>
                  </a>
                  <br/>
                  <small>
                    <?php echo echo_date($value['komplain_c']); ?> | <?php echo echo_time($value['komplain_c']); ?>
                  </small>
                </td>
                <td>
                  <?php echo $value['keluhan'] ?>
                </td>
                <td class="project-state">
                  <?php
                  $status = '';
                  $text = '';
                  if ($value['status'] == 1) {
                    $status = 'danger';
                    $text = 'belum';
                  }elseif($value['status'] == 2){
                    $status = 'warning';
                    $text = 'proses perbaikan';
                  }elseif($value['status'] == 3){
                    $status = 'info';
                    $text = 'perbaikan belum selesai';
                  }elseif($value['status'] == 4){
                    $status = 'success';
                    $text = 'perbaikan selesai';
                  }
                  ?>
                  <span class="badge badge-<?php echo $status; ?>"><?php echo $text; ?></span>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
</div>
<div class="col-md-12">
 <!-- Main content -->
 <section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header pb-0">
      <div class="text-center">
        <b>MAINTANCE DALAM PROSES</b>
      </div>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0" style="display: none">
      <div class="table-responsive">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th>
                No.
              </th>
              <th>
                Nama pelanggan
              </th>
              <th>
                Keluhan
              </th>
              <th class="text-center">
                Status
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $i=0; ?>
            <?php foreach ($data['maintance'] as $key => $value): ?>
              <tr>
                <td>
                  <?php echo ++$i; ?> 
                </td>
                <td>
                  <a>
                    <?php echo $value['nama'] ?>
                  </a>
                  <br/>
                  <small>
                    <?php echo echo_date($value['komplain_c']); ?> | <?php echo echo_time($value['komplain_c']); ?>
                  </small>
                </td>
                <td>
                  <?php echo $value['keluhan'] ?>
                </td>
                <td class="project-state">
                  <?php
                  $status = '';
                  $text = '';
                  if ($value['status'] == 1) {
                    $status = 'danger';
                    $text = 'belum';
                  }elseif($value['status'] == 2){
                    $status = 'warning';
                    $text = 'proses perbaikan';
                  }elseif($value['status'] == 3){
                    $status = 'info';
                    $text = 'perbaikan belum selesai';
                  }elseif($value['status'] == 4){
                    $status = 'success';
                    $text = 'perbaikan selesai';
                  }
                  ?>
                  <span class="badge badge-<?php echo $status; ?>"><?php echo $text; ?></span>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
</div>