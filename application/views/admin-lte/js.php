<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?php echo base_url(); ?>assets/vendor/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/vendor/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/vendor/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/vendor/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/vendor/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>assets/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/api_addres.js"></script> -->

<!-- loading script -->
<script>
	var loading = document.getElementById('loading');
	var not = document.getElementById('slod');

	window.addEventListener('load', function(){
		loading.style.display="none";
		not.style.display="";
	})
</script>

<script>
	$(function () {
	    //Initialize Select2 Elements
	    $('.select2').select2()

	    //Initialize Select2 Elements
	    $('.select2bs4').select2({
	    	theme: 'bootstrap4'
	    })

	    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	})
</script>
<?php
if($this->uri->uri_string == 'pelanggan/edit' || ($this->uri->segments[1] == 'pelanggan' && $this->uri->segments[2] == 'edit_pelanggan') || ($this->uri->segments[1] == 'pelanggan' && $this->uri->segments[2] == 'edit_selesai'))
{
	?>
	<script src="<?php echo base_url('assets/js/pelanggan.js');?>"></script>
	<script src="<?php echo base_url('assets/js/location.js');?>"></script>
	<?php
}
?>