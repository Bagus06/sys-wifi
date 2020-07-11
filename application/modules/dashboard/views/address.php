<form method="post" action="" enctype="multipart/form-data" name="form_1" id="form_1">
		<div class="panel panel-default card card-default ">
			<div class="panel panel-heading card-header ">
				<h6 class="panel-title m-0 font-weight-bold text-primary">Tambah Data Desa</h6>
			</div>
			<div class="panel panel-body card-body">
				<div class="form-group ">
					<label for="Provinsi">Provinsi</label>
					<select name="province_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option value="0">None</option>
						<option value="33" selected="selected">JAWA TENGAH</option>
					</select>
					<span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-province_id-dx-container"><span class="select2-selection__rendered" id="select2-province_id-dx-container" title="JAWA TENGAH">JAWA TENGAH</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
				</div>
				<div class="form-group ">
					<label for="provinsi">Provinsi</label><input type="text" name="provinsi" value="" class="form-control" style="" onkeyup="this.value = this.value.toUpperCase();" onkeyup="this.value = this.value.toUpperCase();"></div>
				<div class="form-group ">
					<label for="Kabupaten">Kabupaten</label>
					<select name="regency_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option value="0">None</option>
						<option value="3318" selected="selected">KABUPATEN PATI</option>
					</select>
					<span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-regency_id-99-container"><span class="select2-selection__rendered" id="select2-regency_id-99-container" title="KABUPATEN PATI">KABUPATEN PATI</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
				</div>
				<div class="form-group ">
					<label for="kabupaten">Kabupaten</label><input type="text" name="kabupaten" value="" class="form-control" required="required" style="" onkeyup="this.value = this.value.toUpperCase();" onkeyup="this.value = this.value.toUpperCase();">
				</div>
				<div class="form-group">
					<label for="Kecamatan">Kecamatan</label>
					<select name="district_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option value="0">None</option>
					</select>
					<span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-district_id-2k-container"><span class="select2-selection__rendered" id="select2-district_id-2k-container" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
				</div>
				<div class="form-group ">
					<label for="kecamatan">Kecamatan</label><input type="text" name="kecamatan" value="" class="form-control" required="required" style="" onkeyup="this.value = this.value.toUpperCase();" onkeyup="this.value = this.value.toUpperCase();">
				</div>
				<div class="form-group">
					<label for="Desa">Desa</label>
					<select name="village_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option value="0" selected="">None</option>
					</select>
					<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-village_id-p6-container"><span class="select2-selection__rendered" id="select2-village_id-p6-container" title="None">None</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
				</div>
				<div class="form-group ">
					<label for="Kode Desa">Kode Desa</label><input type="text" name="kode" value="" class="form-control" style="" readonly="readonly" onkeyup="this.value = this.value.toUpperCase();">
				</div>
				<div class="form-group ">
					<label for="Nama Desa">Nama Desa</label><input type="text" name="nama" value="" class="form-control" required="required" style="" onkeyup="this.value = this.value.toUpperCase();" onkeyup="this.value = this.value.toUpperCase();">
				</div>
			</div>
			<div class="panel panel-footer card-footer">
				<!-- <button class="btn btn-default" onclick="window.history.back();" data-toggle="tooltip" title="go back"><i class="fa fa-arrow-left"></i></button> -->
				<button name="form_1" type="success" id="submit" value="true" class="btn btn-success"><i class="fa fa-floppy-o"></i> submit</button>
				<button name="reset" type="reset" id="reset" value="true" class="btn btn-warning"><i class="fa fa-undo"></i> reset</button>
			</div>
		</div>
	</form>