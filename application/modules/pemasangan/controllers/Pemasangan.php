<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasangan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('alat_list/alat_list_model');
		$this->load->model('pemasangan_model');
		// $this->check_login();
	}

	public function index()
	{

	}

	public function edit($id = 0)
	{
		$data = $this->pemasangan_model->save($id);
		// print_r($data);die;
		$this->load->view('index',['data'=>$data, 'alat'=>$this->alat_list_model->for_select(), 'metode'=>$this->pemasangan_model->metode()]);
	}

	public function selesai($id = 0)
	{
		$data = $this->pemasangan_model->selesai($id);
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->pemasangan_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}
}