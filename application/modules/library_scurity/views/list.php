<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="col-md-12">
 <!-- Main content -->
 <section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar IP</h3>

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
                Pelanggan
              </th>
              <th>
                IP
              </th>
              <th>
                Mac Address
              </th>
              <th>
                Username
              </th>
              <th>
                Password
              </th>
              <th class="text-center">
                Action
              </th>
              <th class="text-center">
                
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
                    <?php echo get_name_pelanggan($value['pelanggan_id']) ?>
                  </a>
                </td>
                <td>
                  <a>
                    <span onclick="copyTeks()" id="dataCopy"><?php echo $value['ip'] ?></span>
                  </a>
                </td>
                <td>
                  <a>
                    <span onclick="copyTeks()" id="dataCopy"><?php echo $value['mac'] ?></span>
                  </a>
                </td>
                <td>
                  <span onclick="copyTeks()" id="dataCopy"><?php echo $value['username'] ?></span>
                </td>
                <td>
                  <span onclick="copyTeks()" id="dataCopy"><?php echo $value['password'] ?></span>
                </td>
                <td class="project-actions text-center">
                  <a href="<?php echo base_url('library_scurity/edit/' . $value['id']) ?>" class="bt btn-sm btn-info">Edit</a>
                </td>
                <td class="project-actions text-right">
                  <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <?php $selected = ''; ?>
                      <?php if ($value['status'] == 2) : ?>
                        <?php $selected = 'checked'; ?>
                      <?php endif ?>
                      <input onclick="window.location.href='<?php echo base_url('library_scurity/list/') . $value['id'] ?>?switch=<?php echo $value['status'] ?>'"  type="checkbox" class="custom-control-input" id="customSwitch<?php echo $value['id'] ?>" <?php echo $selected ?> >
                      <label class="custom-control-label" for="customSwitch<?php echo $value['id'] ?>"></label>
                    </div>
                  </div>
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