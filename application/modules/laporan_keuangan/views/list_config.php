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
          <div class="form-group col-md-6">
            <label>Pelanggan</label>
            <select name="pelanggan" class="form-control select2" style="width: 100%;">
              <option value="0">none</option>
              <?php foreach ($pelanggan as $key => $vp): ?>
                <?php $selected = ''; ?>
                <?php if ($vp['id'] == @$this->input->get('pelanggan')): ?>
                  <?php $selected='selected' ?>
                <?php endif ?>
                <option value="<?php echo $vp['id'] ?>" <?php echo $selected; ?>><?php echo $vp['nama'] ?></option>
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
      <h3 class="card-title"><i class="fas fa-cog"></i> Data <?php echo $this->uri->rsegments[2] ?></h3>
        
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
                Nama Pelanggan
              </th>
              <th>
                Rentan
              </th>
              <th>
                Jatuh Tempo
              </th>
              <th>
                Tagihan
              </th>
              <th class="text-right">
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['data'] as $key => $value): ?>
              <tr>
                <td><?php echo ++$data['url']; ?></td>
                <td>
                  <?php echo $value['nama'] ?>
                </td>
                <td>
                  <?php
                    foreach ($tempo as $key => $vt) {
                      if ($vt['id'] == $value['rentan']) {
                        echo $vt['title'];
                      }
                    }
                  ?>
                </td>
                <td>
                  <?php if ($value['rentan'] == 1): ?>
                    <?php echo $value['jatuh_tempo'] ?>
                  <?php elseif ($value['rentan'] == 2): ?>
                    <?php
                      foreach ($date_pembayaran['bulan'] as $key => $vdp) {
                        if ($vdp['id'] == $value['jatuh_tempo']) {
                          echo $vdp['title'];
                        }
                      }
                    ?>
                  <?php endif ?>
                </td>
                <td>
                  <?php echo money($value['nominal']); ?>
                </td>
                <td class="text-right">
                  <a href="<?php echo base_url('laporan_keuangan/edit_config/') . $value['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-sm fa-pencil-alt"></i> Edit</a>
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
  </div>
</section>
</div>