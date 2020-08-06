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
  <?php if (!empty($data['msg'])): ?>
  	<?php echo alert($data['status'],$data['msg']) ?>
  	<?php if (!empty($data['msgs'])): ?>
  		<?php foreach ($data['msgs'] as $key => $value): ?>
  			<?php echo alert($data['status'], $value) ?>
  		<?php endforeach ?>	
  	<?php endif ?>
  <?php endif ?>
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
              <th class="text-center">
                Status
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
                <?php
                	$status = '';
                	$text = '';
                	$date = date('d');
                	$month = date('m');
                	if ($value['rentan'] == 1) {
                		if (in_array($value['id'], $data['history'])) {
	                		if ($date <= '25') {
	                			$status = '#14D700';
	                		}elseif ($date > '25') {
	                			$status = '#E7E7E7';
	                		}
	                		$text = 'terbayar';
	                	}elseif(!in_array($value['id'], $data['history'])){
	                		if ($value['rentan'] == '1') {
	                			if ($date <= '4') {
	                				$status = '#E7E7E7';
	                			}elseif ($date <= '10') {
	                				$status = '#A7A7A7';
	                			}elseif ($date <= '15') {
	                				$status = '#FFF000';
	                			}elseif ($date <= '20') {
	                				$status = '#FF0000';
	                			}elseif ($date <= '25') {
	                				$status = '#000000';
	                			}elseif ($date > '25') {
	                				$status = '#000000';
	                			}
	                		}
	                		$text = 'belum terbayar';
	                	}
                	}elseif ($value['rentan'] == 2) {
                		if (in_array($value['id'], $data['history_month'])) {
	                		if ($month >= $value['jatuh_tempo']) {
	                			$status = '#A7A7A7';
	                		}elseif ($month < $value['jatuh_tempo']) {
	                			$status = '#14D700';
	                		}
	                		$text = 'terbayar';
	                	}elseif(!in_array($value['id'], $data['history_month'])){
	                		if ($month <= $value['jatuh_tempo']) {
	                			$status = '#FFF000';
	                		}elseif ($month > $value['jatuh_tempo']) {
	                			$status = '#000000';
	                		}
	                		$text = 'belum terbayar';
	                	}
                	}
                ?>
                <td class="text-center">
                	<?php if (in_array($value['id'], $data['history'])): ?>
                		<i class="fab fa-2x fa-cloudscale" style="color: <?php echo $status; ?>"></i>
                	<?php else: ?>
                		<i class="fas fa-2x fa-circle-notch" style="color: <?php echo $status; ?>"></i>
                	<?php endif ?><br>
                	<?php echo $text; ?>
                </td>
                <td class="text-right">
                	<?php if(!in_array($value['id'], $data['history'])): ?>
                		<?php if ($value['rentan'] == 1): ?>
	                  		<?php if ($date < '25'): ?>
	                  			<a href="" data-toggle="modal" data-target="#modal-pembayaran<?php echo $value['id'] ?>" class="btn btn-sm btn-success">Bayar</a>
                            <div class="modal fade" id="modal-pembayaran<?php echo $value['id'] ?>">
                              <div class="modal-dialog">
                                <div class="modal-content bg-success">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Pembayaran</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body" align="left">
                                      <h5>Pembayaran atas nama <?php echo $value['nama']; ?> sejumlah <?php echo money($value['nominal']); ?>.</h5>
                                    </div>
                                    <form action="" method="get">
                                      <input type="hidden" name="pembayaran" value="<?php echo $value['id'] ?>">
                                      <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-outline-light">Bayar</button>
                                      </div>
                                    </form>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
	                  		<?php endif ?>
                		<?php endif ?>
                  	<?php endif ?>
                  	<?php if(!in_array($value['id'], $data['history_month'])): ?>
	                  	<?php if($value['rentan'] == 2): ?>
  	                		<?php if ($month <= $value['jatuh_tempo']): ?>
  	                			<a href="" data-toggle="modal" data-target="#modal-pembayaran<?php echo $value['id'] ?>" class="btn btn-sm btn-success">Bayar</a>
  	                  			<div class="modal fade" id="modal-pembayaran<?php echo $value['id'] ?>">
  	                  				<div class="modal-dialog">
  	                  					<div class="modal-content bg-success">
  	                  						<div class="modal-header">
  	                  							<h4 class="modal-title">Pembayaran</h4>
  	                  							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  	                  								<span aria-hidden="true">&times;</span></button>
  	                  							</div>
  	                  							<div class="modal-body" align="left">
  	                  								<h5>Pembayaran atas nama <?php echo $value['nama']; ?> sejumlah <?php echo money($value['nominal']); ?>.</h5>
  	                  							</div>
  	                  							<form action="" method="get">
  	                  								<input type="hidden" name="pembayaran" value="<?php echo $value['id'] ?>">
  	                  								<div class="modal-footer justify-content-between">
  	                  									<button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
  	                  									<button type="submit" class="btn btn-outline-light">Bayar</button>
  	                  								</div>
  	                  							</form>
  	                  						</div>
  	                  						<!-- /.modal-content -->
  	                  					</div>
  	                  					<!-- /.modal-dialog -->
  	                  				</div>
  	                		<?php endif ?>
	                  	<?php endif ?>
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
  </div>
</section>
</div>