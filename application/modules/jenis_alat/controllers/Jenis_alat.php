<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_alat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenis_alat_model');
		// $this->check_login();
	}

	public function index()
	{

	}

	public function edit($id = 0)
	{
		$data = $this->jenis_alat_model->save($id);
		$this->load->view('index',['data'=>$data, 'tipe'=>$this->jenis_alat_model->tipe()]);
	}

	public function list()
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('jenis_alat/list');
		$config['total_rows'] = $this->jenis_alat_model->count_jenis_alat();
		$config['per_page'] = 12;

		// if ($this->input->get('filter')) {
		// 	$config['reuse_query_string'] = TRUE;
		// 	$config['suffix'] = '?filter=' . $this->input->get('filter');
		// 	$config['use_global_url_suffix'] = TRUE;
		// }


		$config['full_tag_open'] = '<ul class="pagination m-0 justify-content-center">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		$config['num_links'] = 2; 
		
		$this->pagination->initialize($config);

		$url = 0;
		$url = @$this->uri->rsegments[3];
		if (empty($this->uri->rsegments[3])) {
			$url = 0;
		}
		
		$data = $this->jenis_alat_model->save();
		$data['data'] = $this->jenis_alat_model->all($config['per_page'], $url);
		$data['url'] = $url;
		$this->load->view('index', ['data'=>$data, 'tipe'=>$this->jenis_alat_model->tipe(), 'count_alat'=>$this->jenis_alat_model-> count_data_alat()]);
	}

	public function alat_history()
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('jenis_alat/alat_history');
		$config['total_rows'] = $this->jenis_alat_model->count_alat_history();
		$config['per_page'] = 12;

		// if ($this->input->get('filter')) {
		// 	$config['reuse_query_string'] = TRUE;
		// 	$config['suffix'] = '?filter=' . $this->input->get('filter');
		// 	$config['use_global_url_suffix'] = TRUE;
		// }


		$config['full_tag_open'] = '<ul class="pagination m-0 justify-content-center">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		$config['num_links'] = 2; 
		
		$this->pagination->initialize($config);

		$url = 0;
		$url = @$this->uri->rsegments[3];
		if (empty($this->uri->rsegments[3])) {
			$url = 0;
		}
		
		$data['data'] = $this->jenis_alat_model->alat_history($config['per_page'], $url);
		// echo "<pre>";
		// print_r($url);
		// echo "</pre>";
		// die;
		$data['url'] = $url;
		$this->load->view('index', ['data'=>$data]);
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->jenis_alat_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}
}