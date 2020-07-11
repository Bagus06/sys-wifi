<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Alat_list extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenis_alat/jenis_alat_model');
		$this->load->model('alat_list_model');
		// $this->check_login();
	}

	public function index()
	{

	}

	public function edit($id = 0)
	{
		$data = $this->alat_list_model->save($id);
		$this->load->view('index',['data'=>$data, 'status'=>$this->alat_list_model->alat_status(), 'jenis_alat'=>$this->jenis_alat_model->for_select()]);
	}
	public function list()
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('alat_list/list');
		$config['total_rows'] = $this->alat_list_model->count_alat_list();
		$config['per_page'] = 12;

		if ($this->input->get('jenis')) {
			$config['reuse_query_string'] = TRUE;
			$config['suffix'] = '?jenis=' . $this->input->get('jenis');
			$config['use_global_url_suffix'] = TRUE;
		}
		if ($this->input->get('fa')) {
			$config['reuse_query_string'] = TRUE;
			$config['suffix'] = '?fa=' . $this->input->get('fa');
			$config['use_global_url_suffix'] = TRUE;
		}


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

		$data = $this->alat_list_model->save();
		$data['data'] = $this->alat_list_model->all($config['per_page'], $url);
		$data['url'] = $url;
		$tipe = $this->alat_list_model->count_data_tipe();
		$this->load->view('index', ['data'=>$data, 'status'=>$this->alat_list_model->alat_status(), 'jenis_alat'=>$this->jenis_alat_model->for_select(), 'count'=>$tipe]);
	}

	public function delete($id=0)
	{
		if(!empty($id))
		{
			$data = $this->alat_list_model->delete($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}
}