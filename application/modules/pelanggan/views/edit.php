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
					<label for="nama">Nama <small style="color: red">*Masukan nama lengkap sesuai ktp</small></label>
					<input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo @$data['data']['nama'] ?>" onkeyup="this.value = this.value.toUpperCase()" required>
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
					<textarea placeholder="Alamat seperti nomor, nama jalan, atau RT RW" name="alamat" id="" cols="20" rows="5" class="form-control" onkeyup="this.value = this.value.toUpperCase()" required></textarea>
				</div>
				<div class="form-group">
					<label for="no_tlp">no tlp/wa</label>
					<input type="number" class="form-control" name="no_tlp" placeholder="no_tlp" value="<?php echo @$data['data']['no_tlp'] ?>" required>
				</div>
				<div class="form-group">
					<label for="alat_biaya">Biaya promo <small style="color: red">*isi dengan 0 jika tidak ada penambahan biaya alat dari pelanggan</small></label>
					<input type="number" class="form-control" name="alat_biaya" placeholder="alat_biaya" value="<?php echo @$data['data']['alat_biaya'] ?>" required>
				</div>
				<div class="form-group">
					<label for="kordinat">kordinat lokasi <small style="color: red">*format input (latitude,longitude) masukkan sesuai format</small></label>
					<input type="text" class="form-control" name="kordinat" placeholder="kordinat" value="<?php echo @$data['data']['kordinat'] ?>">
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
	var _ID = 0;
</script>