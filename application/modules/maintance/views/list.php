<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="col-md-12">
 <!-- Main content -->
 <section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar maintance</h3>

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
                Nama pelanggan
              </th>
              <th>
                Team
              </th>
              <th>
                Keluhan
              </th>
              <?php if (!empty($this->input->get('fm'))): ?>
                <?php if ($this->input->get('fm') == 4): ?>
                  <th>
                    Solusi
                  </th>
                <?php endif ?>
              <?php endif ?>
              <th class="text-center">
                Status
              </th>
              <th>
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
                  <a>
                    <?php echo $value['nama'] . $value['user_id'] ?>
                  </a>
                  <br/>
                  <small>
                    <?php echo echo_date($value['created']); ?> | <?php echo echo_time($value['created']); ?>
                  </small>
                </td>
                <td>
                  <?php echo get_name($value['user_id']); ?>
                </td>
                <td>
                  <?php echo $value['keluhan'] ?>
                </td>
                <?php if (!empty($this->input->get('fm'))): ?>
                  <?php if ($this->input->get('fm') == 4): ?>
                    <td>
                      <?php echo $value['solusi'] ?>
                    </td>
                  <?php endif ?>
                <?php endif ?>
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
                  <?php if ($value['status'] == 3): ?>
                    <i class="fas fa-level-down-alt"></i>
                  <?php endif ?>
                </td>
                <td class="project-actions text-right">
                  <?php
                    $bind_fm = $this->input->get('fm');
                    $btn_text = '';
                  ?>
                  <?php if (!empty($bind_fm)): ?>
                    <?php if ($bind_fm == 2): ?>
                      <a href="<?php echo base_url('pemasangan/edit/' . $value['pelanggan_id']) ?>" class="btn btn-sm bg-warning">
                        <i class="fas fa-satellite-dish"></i> Update alat
                      </a>
                      <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-maintance<?php echo $value['id'] ?>">
                        <i class="fas fa-file-signature"></i> Laporan belum selesai
                      </button>
                      <div class="modal fade" id="modal-maintance<?php echo $value['id'] ?>">
                        <div class="modal-dialog">
                          <form action="<?php echo base_url('maintance/ubah_status/' . $value['id'] . '?maintance=3') ?>" method="post">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 style="color:black" class="modal-title">Laporan belum selesai</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">
                                  <div class="form-group">
                                    <textarea type="text" class="form-control" name="laporan" placeholder="laporan" required></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                    <?php endif ?>
                  <?php endif ?>
                  <?php if (!empty($bind_fm)): ?>
                    <?php if ($bind_fm != 4): ?>
                      <?php if($bind_fm == 1): ?>
                        <a class="btn btn-info btn-sm" href="<?php echo base_url('maintance/ubah_status/' . $value['id'] . '?maintance=2') ?>">
                          <i class="fas fa-toolbox">
                          </i>
                          Mulai Maintance
                        </a>
                      <?php elseif($bind_fm == 2 || $bind_fm == 3): ?>
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-selesai<?php echo $value['id'] ?>">
                         <i class="fas fa-toolbox">
                          </i>
                          Maintance Selesai
                        </button>
                        <div class="modal fade" id="modal-selesai<?php echo $value['id'] ?>">
                          <div class="modal-dialog">
                            <form action="<?php echo base_url('maintance/ubah_status/' . $value['id'] . '?maintance=4') ?>" method="post">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 style="color:black" class="modal-title">Solusi dari keluhan maintance</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <div class="form-group">
                                      <textarea type="text" class="form-control" name="solusi" placeholder="solusi" required></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                    <?php if ($bind_fm == 4): ?>
                      <?php echo echo_date($value['updated']); ?> | <?php echo echo_time($value['updated']); ?>
                    <?php endif ?>
                  <?php endif ?>
                </td>
              </tr>
              <?php if ($value['status'] == 3): ?>
                <tr>
                  <td></td>
                   <td colspan="5">
                     <?php echo $value['alasan'] ?>
                   </td>
                </tr>
               <?php endif ?>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
      <nav aria-label="Contacts Page Navigation">
        <?php echo $this->pagination->create_links(); ?>
      </nav>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
</div>