<?php defined('BASEPATH') or exit('No direct script access allowed');?>

<section class="content">

  <!-- Default box -->
  <div class="card col-md-12">
    <div class="card-header">
      <h3 class="card-title">Projects</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
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
                    Nama alat
                  </th>
                  <th class="project-state">
                    jumlah
                  </th>
                  <th class="project-state">
                    Tanggal
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['data'] as $key => $value): ?>
                  <tr>
                    <td>
                      <?php echo ++$data['url']; ?>
                    </td>
                    <td>
                      <?php echo $value['title']; ?>
                    <td class="project-state">
                      <?php echo $value['jml_penambahan'] ?>
                    </td>
                     <td class="project-state">
                      <?php echo $value['created'] ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->