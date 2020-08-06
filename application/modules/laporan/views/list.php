<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="col-md-12">
 <section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Filter</h3>
    </div>
    <div class="card-body">
      <form action="" method="get">
        <div class="col-md-12 row" style="margin: 1px">
          <?php if (empty($this->input->get('date'))): ?>
            <?php if (!empty($this->input->get('bi'))): ?>
              <input type="hidden" name="bi" value="<?php echo @$this->input->get('bi') ?>">
            <?php endif ?>
          <?php endif ?>
          <div class="form-group col-md-5">
            <label>Tanggal </label>
            <div class="input-group">
              <input value="<?php echo @$this->input->get('date') ?>" name="date" type="date" class="form-control float-right">
            </div>
            <!-- /.input group -->
          </div>
          <div class="form-group col-md-6">
            <label>Karyawan</label>
            <select name="karyawan" class="form-control select2" style="width: 100%;">
              <option value="0">none</option>
              <?php foreach ($data['user'] as $key => $vu): ?>
                <?php $selected = ''; ?>
                <?php if ($vu['user_id'] == @$this->input->get('karyawan')): ?>
                  <?php $selected='selected' ?>
                <?php endif ?>
                <option value="<?php echo $vu['user_id'] ?>" <?php echo $selected; ?>><?php echo $vu['nama'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-1" style="text-align: right; padding-top: 3%">
            <button type="submit" class="btn btn-success">Filter</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Laporan Karyawan tgl <?php echo date('j F Y') ?></h3>
        
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th>
                No.
              </th>
              <th>
                Nama Karyawan
              </th>
              <th>
                Keterangan
              </th>
              <th class="text-center">
                Tanggal
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['data'] as $key => $value): ?>
              <tr>
                <td><?php echo ++$data['url']; ?></td>
                <td>
                  <?php echo get_name($value['user_id']) ?>
                </td>
                <td>
                  <?php echo $value['ket'] ?>
                </td>
                <td class="text-center">
                  <?php echo echo_date($value['created']) ?> | <?php echo echo_time($value['created']) ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
</div>