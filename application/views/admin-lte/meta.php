<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>MANDALA | <?php echo $this->uri->rsegments[1] ?> <?php echo $this->uri->rsegments[2] ?></title>
<link rel="icon" href="<?php echo base_url(); ?>assets/images/logo_mandala.png">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/ekko-lightbox/ekko-lightbox.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/summernote/summernote-bs4.css">
<!-- loading style -->
<style type="text/css">
	strong{
		cursor: pointer;
	}
	strong:hover{
		color: blue
	}
</style>
<style>
	#loading{
		width: 70px;
		height: 70px;
		border: solid 10px #ccc;
		border-top-color: #00AAFF;
		border-bottom-color: #00AAFF;
		border-right-color: transparent;
		border-left-color: transparent;
		border-radius: 100%;

		position: fixed;
		left: 0;
		top: 0;
		right: 0;
		bottom: 0;
		margin: auto;

		animation: putar 0.7s linear infinite;
	}

	@keyframes putar{
		from{transform: rotate(0deg)}
		to{transform: rotate(360deg)}
	}
</style>
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">