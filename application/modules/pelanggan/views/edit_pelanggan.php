<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="col-md-12">
	<?php if (!empty($data['msg'])): ?>
		<?php echo alert($data['status'],$data['msg']) ?>
		<?php if (!empty($data['msgs'])): ?>
			<?php foreach ($data['msgs'] as $key => $value): ?>
					<?php echo alert($data['status'], $value) ?>
				<?php endforeach ?>	
		<?php endif ?>
	<?php endif ?>
	<a href="<?php echo base_url('pelanggan/detail/' . @$data['data']['id']) ?>" class="btn btn-sm btn-warning"><i class="fas fa-angle-left"></i> Kembali</a>
	<form action="" method="post" id="form_pelanggan" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['data'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> pelanggan
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
			</div>
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<input type="hidden" name="prov" value="">
					<input type="hidden" name="kab" value="">
					<input type="hidden" name="kec" value="">
					<input type="hidden" name="desa" value="">
					<label for="nama">nama</label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['data']['nama'] ?>" required>
				</div>
				<div class="form-group">
					<label for="nik">NIK</label>
					<input type="number" class="form-control" name="nik" placeholder="nik" value="<?php echo @$data['data']['nik'] ?>" required>
				</div>
				<div class="form-group">
					<label for="kk">No KK</label>
					<input type="number" class="form-control" name="kk" placeholder="kk" value="<?php echo @$data['data']['kk'] ?>" required>
				</div>
				<div class="form-group">
					<label for="">Provinsi</label>
					<select name="prov_id" id="prov_id" class="form-control select2"></select>
				</div>
				<div class="form-group">
					<label for="">Kabupaten</label>
					<select name="kab_id" id="kab_id" class="form-control select2"></select>
				</div>
				<div class="form-group">
					<label for="">Kecamatan</label>
					<select name="kec_id" id="kec_id" class="form-control select2"></select>
				</div>
				<div class="form-group">
					<label for="">Desa</label>
					<select name="desa_id" id="desa_id" class="form-control select2"></select>
				</div>
				<div class="form-group">
					<label for="">Alamat</label>
					<textarea placeholder="Alamat seperti nomor, nama jalan, atau RT RW" name="alamat" id="" cols="20" rows="5" class="form-control" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $data['data']['alamat'] ?>" required><?php echo $data['data']['alamat'] ?></textarea>
				</div>
				<div class="form-group">
					<label for="no_tlp">no tlp/wa</label>
					<input type="number" class="form-control" name="no_tlp" placeholder="no_tlp" value="<?php echo @$data['data']['no_tlp'] ?>" required>
				</div>
				<div class="form-group">
					<label for="pekerjaan">pekerjaan</label>
					<input type="text" class="form-control" name="pekerjaan" placeholder="pekerjaan" value="<?php echo @$data['data']['pekerjaan'] ?>" required>
				</div>
				<div class="form-group">
					<label for="no_pelanggan">No PKS</label>
					<input type="text" class="form-control" name="no_pelanggan" placeholder="no_pelanggan" value="<?php echo @$data['data']['no_pelanggan'] ?>" required>
				</div>
				<div class="form-group">
					<label for="alat_biaya">Biaya promo <small style="color: red">*isi dengan 0 jika tidak ada penambahan biaya alat dari pelanggan</small></label>
					<input type="number" class="form-control" name="alat_biaya" placeholder="alat_biaya" value="<?php echo @$data['data']['alat_biaya'] ?>" required>
				</div>
				<div class="form-group">
					<label for="kordinat">kordinat lokasi</label>
					<input type="text" class="form-control" name="kordinat" placeholder="kordinat" value="<?php echo @$data['data']['kordinat'] ?>" required>
				</div>
				<?php if (!empty($data['data']['foto_pelanggan']) && $data['data']['foto_pelanggan'] != '-'): ?>
					<a href="<?php echo base_url('assets/images/pelanggan/' . $data['data']['foto_pelanggan']) ?>" data-toggle="lightbox" data-title="<?php echo $data['data']['foto_pelanggan']; ?>" data-gallery="gallery" target="_blank">
						<img style="display: block;max-width: 100%;object-fit: cover;height: 150px;width: 110px" src="<?php echo base_url('assets/images/pelanggan/' . $data['data']['foto_pelanggan']) ?>" class="img-fluid mb-2" alt="white sample"/>
					</a>
					
				<?php endif ?>
				<div class="form-group">
					<label for="foto_pelanggan">foto pelanggan (max file size 3Mb)</label>
					<div class="custom-file">
						<input type="file" name="foto_pelanggan" class="form-control custom-file-label" id="foto_pelanggan">
					</div>
				</div>
				<?php if (!empty($data['data']['foto_rumah']) && $data['data']['foto_rumah'] != '-'): ?>
					<a href="<?php echo base_url('assets/images/rumah/' . $data['data']['foto_rumah']) ?>" data-toggle="lightbox" data-title="<?php echo $data['data']['foto_rumah']; ?>" data-gallery="gallery" target="_blank">
						<img style="display: block;max-width: 100%;object-fit: cover;height: 150px;" src="<?php echo base_url('assets/images/rumah/' . $data['data']['foto_rumah']) ?>" class="img-fluid mb-2" alt="white sample"/>
					</a>

				<?php endif ?>
				<div class="form-group">
					<label for="foto_rumah">foto rumah (max file size 3Mb)</label>
					<div class="custom-file">
						<input type="file" name="foto_rumah" class="form-control custom-file-label" id="foto_rumah">
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<input name="trx" type="number" value="<?php echo $data['data']['trx'] ?>" class="form-control" placeholder="TRX" min="1" max="100" required>
					</div>
					<div class="col-6">
						<input name="ccq" value="<?php echo $data['data']['ccq'] ?>" type="number" class="form-control" placeholder="CCQ" min="1" max="100" required>
					</div>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>
<script>
	var _URL = "<?php echo base_url();?>";
	var _ID = "<?php echo $id;?>";
</script>