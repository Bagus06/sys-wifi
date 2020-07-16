<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="col-md-12">
 <!-- Main content -->
 <section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Agenda Non Teknis</h3>

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
                Dibuat
              </th>
              <th>
                Dieksekusi
              </th>
              <th>
                Keterangan
              </th>
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
                    <?php echo get_name($value['pembuat']); ?>
                  </a>
                  <br/>
                  <small>
                    <?php echo echo_date($value['created']); ?> | <?php echo echo_time($value['created']); ?>
                  </small>
                </td>
                <td>
                  <a>
                    <?php
                      if ($value['exsekusi'] == 0) {
                        echo "-";
                      }else{
                        echo get_name($value['exsekusi']);
                      }
                    ?>
                  </a>
                  <br/>
                  <?php if ($value['exsekusi'] != 0): ?>
                    <small>
                      <?php echo echo_date($value['updated']); ?> | <?php echo echo_time($value['updated']); ?>
                    </small>
                  <?php endif ?>
                </td>
                <td>
                  <?php echo $value['ket'] ?>
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
                      $text = 'proses';
                    }elseif($value['status'] == 3){
                      $status = 'info';
                      $text = 'agenda selesai';
                    }
                  ?>
                  <span class="badge badge-<?php echo $status; ?>"><?php echo $text; ?></span>
                </td>
                <td class="project-actions text-right">
                  <?php
                    $bind_fm = $this->input->get('search');
                  ?>
                  <?php if ($value['status'] == 1): ?>
                  	<a href="<?php echo base_url('agenda/ubah_status/' . $value['id'] . '?status=2') ?>" class="bt btn-sm btn-primary">Eksekusi</a>
                  	<a href="<?php echo base_url('agenda/edit/' . $value['id']) ?>" class="bt btn-sm btn-info">Edit</a>
                  	<a href="<?php echo base_url('agenda/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus agenda ini.')){}else{return false;};" class="bt btn-sm btn-danger">Delete</a>
                  <?php elseif($value['status'] == 2): ?>
                  	<a href="<?php echo base_url('agenda/ubah_status/' . $value['id'] . '?status=3') ?>" class="bt btn-sm btn-primary">Telah Di Eksekusi</a>
                  <?php elseif($value['status'] == 3): ?>
                  	<a href="<?php echo base_url('agenda/delete/' . $value['id']) ?>" onclick="if(confirm('apakah anda yakin ingin menghapus agenda ini.')){}else{return false;};" class="bt btn-sm btn-danger">Delete</a>
                  <?php endif ?>
                </td>
              </tr>
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