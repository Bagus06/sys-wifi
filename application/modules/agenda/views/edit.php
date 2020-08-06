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
	<form action="" method="post" enctype="multipart/form-data">
		<div class="panel panel-default card card-default">
			<div class="panel-heading card-header">
				<?php if (empty($data['data'])): ?>
				 	tambah
				 	<?php else: ?>
				 	ubah
				 <?php endif ?> Agenda
			</div>
			<div class="panel-body card-body">
				<div class="form-group">
					<label for="">Keterangan <small style="color:red"><i>*masukkan satu agenda dan tambah agenda lagi jika masih ada agenda lain</i></small></label>
					<textarea placeholder="Tulis keterangan agenda" name="ket" id="" cols="20" rows="5" class="form-control" value="<?php echo @$data['data']['ket'] ?>" required><?php echo @$data['data']['ket'] ?></textarea>
				</div>
			</div>
			<div class="panel-footer card-footer">
				<button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Simpan</button>
				<button class="btn btn-warning btn-sm" type="reset"><i class="fa fa-undo"></i> Reset</button>
			</div>
		</div>
	</form>
</div>