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
        	<div class="form-group col-md-5">
        		<label>Desa</label>
        		<select name="desa" class="form-control select2" style="width: 100%;">
        			<option value="0">none</option>
        			<?php foreach ($desa as $key => $vd): ?>
        				<?php if (!empty($key) && $key != '-'): ?>
        					<?php $selected = ''; ?>
        					<?php if ($vd == @$this->input->get('desa')): ?>
        						<?php $selected='selected' ?>
        					<?php endif ?>
        					<option value="<?php echo $vd ?>" <?php echo $selected; ?>><?php echo $key ?></option>
        				<?php endif ?>
        			<?php endforeach ?>
        		</select>
        	</div>
        	<div class="form-group col-md-6">
        		<label>Pelanggan</label>
        		<select name="pelanggan" class="form-control select2" style="width: 100%;">
        			<option value="0">none</option>
        			<?php foreach ($pelanggan as $key => $vp): ?>
        				<?php $selected = ''; ?>
        				<?php $disabled = ''; ?>
        				<?php if ($vp['id'] == @$this->input->get('pelanggan')): ?>
        					<?php $selected='selected' ?>
        				<?php endif ?>
        				<?php if (!empty($this->input->get('desa'))): ?>
        					<?php if ($vp['desa_id'] == @$this->input->get('desa')): ?>
	        					<option value="<?php echo $vp['id'] ?>" <?php echo $selected; ?>><?php echo $vp['nama'] ?><?php echo $vp['desa_id'] ?></option>
	        				<?php endif ?>
	        			<?php elseif (empty($this->input->get('desa'))): ?>
        					<option value="<?php echo $vp['id'] ?>" <?php echo $selected; ?>><?php echo $vp['nama'] ?></option>
        				<?php endif ?>
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
      <h3 class="card-title">Data <?php echo $this->uri->rsegments[2] ?></h3>
        
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
                Desa
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
                  <?php echo $value['desa'] ?>
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