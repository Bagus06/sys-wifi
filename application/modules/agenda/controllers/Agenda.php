<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('laporan_model');
	}

	public function list()
	{
		$this->load->view('index');
	}
}