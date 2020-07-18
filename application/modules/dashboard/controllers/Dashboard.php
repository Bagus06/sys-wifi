<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function index()
	{
		
	}

	public function list()
	{
		$this->user_model->check_login();

		$data = $this->dashboard_model->all();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";die;
		$this->load->view('index', ['data'=>$data]);
	}
}