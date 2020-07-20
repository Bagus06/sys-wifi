<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
		$this->load->model('pemasangan/pemasangan_model');
		// $this->check_login();
	}

	public function index()
	{

	}

	public function detail_json($id=0)
	{
		$data = $this->pelanggan_model->detail($id);
		echo json_encode($data);
	}

	public function detail($id=0)
	{
		$data = $this->pelanggan_model->detail($id);
		$this->load->view('index',['data'=>$data]);
	}

	public function edit($id = 0)
	{
		$data = $this->pelanggan_model->save($id);
		$this->load->view('index',['data'=>$data]);
	}

	public function edit_pelanggan($id = 0)
	{
		$data = $this->pelanggan_model->save($id);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die;
		$this->load->view('index',['data'=>$data,'id'=>$id]);
	}

	public function edit_selesai($id = 0)
	{
		$data = $this->pelanggan_model->edit_selesai($id);
		$this->load->view('index',['data'=>$data]);
	}

	public function list()
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('pelanggan/list');
		$config['total_rows'] = $this->pelanggan_model->count_pelanggan();
		$config['per_page'] = 12;

		if ($this->input->get('filter')) {
			if (!empty($this->input->get('date')) || !empty($this->input->get('metode'))) {
				$config['reuse_query_string'] = TRUE;
				$config['suffix'] = '?filter=' . $this->input->get('filter') . '&date=' . $this->input->get('date') . '&metode=' . $this->input->get('metode');
				$config['use_global_url_suffix'] = TRUE;
			}else{
				$config['reuse_query_string'] = TRUE;
				$config['suffix'] = '?filter=' . $this->input->get('filter');
				$config['use_global_url_suffix'] = TRUE;
			}
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

		$data = $this->pelanggan_model->all($config['per_page'], $url);
		$data['url'] = $url;
		$this->load->view('index', ['data'=>$data, 'count_all'=>$config['total_rows'], 'metode' => $this->pemasangan_model->metode()]);
	}

	public function pencabutan($id=0)
	{
		if(!empty($id))
		{
			$data = $this->pelanggan_model->pencabutan($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}

	public function blacklist($id=0)
	{
		if(!empty($id))
		{
			$data = $this->pelanggan_model->blacklist($id);
			$this->load->view('index', ['data'=>$data]);
		}
	}

	public function get_provinces()
	{
		echo file_get_contents('https://sipapat.patikab.go.id/admin/provinces/all');
		// echo file_get_contents('http://localhost/sipapat/admin/provinces/all');
	}
	public function get_regencies()
	{
		echo file_get_contents('https://sipapat.patikab.go.id/admin/regencies/all');
		// echo file_get_contents('http://localhost/sipapat/admin/regencies/all');
	}
	public function get_districts()
	{
		echo file_get_contents('https://sipapat.patikab.go.id/admin/districts/all');
		// echo file_get_contents('http://localhost/sipapat/admin/districts/all');
	}
	public function get_villages($district_id = 0)
	{
		echo file_get_contents('https://sipapat.patikab.go.id/admin/villages/by_district_id/'.$district_id);
		// echo file_get_contents('http://localhost/sipapat/admin/villages/by_district_id/'.$district_id);
	}
}