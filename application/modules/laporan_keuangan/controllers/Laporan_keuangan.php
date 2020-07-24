<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_keuangan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan_keuangan_model');
		$this->load->model('pelanggan/pelanggan_model');
	}

	public function list()
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('laporan_keuangan/list');
		$config['total_rows'] = $this->laporan_keuangan_model->count_pembayaran();
		$config['per_page'] = 12;

		if ($this->input->get()) {
			$config['reuse_query_string'] = TRUE;
			$config['suffix'] = '?desa=' . $this->input->get('desa') . '&pelanggan=' . $this->input->get('pelanggan');
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

		$desa = $this->laporan_keuangan_model->desa();
		$data = $this->laporan_keuangan_model->all($config['per_page'], $url);
		$data['url'] = $url;
		$tempo = $this->laporan_keuangan_model->tempo();
		$date_pembayaran = $this->laporan_keuangan_model->date_pembayaran();
		$pelanggan = $this->pelanggan_model->for_api();

		$this->load->view('index', ['data'=>$data, 'tempo'=>$tempo, 'date_pembayaran'=>$date_pembayaran, 'pelanggan'=>$pelanggan, 'desa'=>$desa]);
	}

	public function list_config()
	{
		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = base_url('laporan_keuangan/list_config');
		$config['total_rows'] = $this->laporan_keuangan_model->count_config();
		$config['per_page'] = 12;

		if ($this->input->get('pelanggan')) {
			$config['reuse_query_string'] = TRUE;
			$config['suffix'] = '?pelanggan=' . $this->input->get('pelanggan');
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

		$data = $this->laporan_keuangan_model->all_config($config['per_page'], $url);
		$data['url'] = $url;
		// echo "<pre>";
		// print_r($data);die;
		// echo "</pre>";

		$tempo = $this->laporan_keuangan_model->tempo();
		$date_pembayaran = $this->laporan_keuangan_model->date_pembayaran();
		$pelanggan = $this->pelanggan_model->for_api();

		$this->load->view('index', ['data'=>$data, 'tempo'=>$tempo, 'date_pembayaran'=>$date_pembayaran, 'pelanggan'=>$pelanggan]);
	}

	public function edit_config($id=0)
	{
		$data = $this->laporan_keuangan_model->save_config($id);
		$date = $this->laporan_keuangan_model->date_pembayaran();
		$tempo = $this->laporan_keuangan_model->tempo();
		$pelanggan = $this->pelanggan_model->for_api();

		$this->load->view('index', ['data'=>$data, 'date'=>$date, 'tempo'=>$tempo, 'pelanggan'=>$pelanggan]);
	}
}