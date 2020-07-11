<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="col-md-12">
 <!-- Main content -->
 <section class="content">

  <!-- Default box -->
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
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
</div>