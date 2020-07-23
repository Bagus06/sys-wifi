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
		$this->load->view('index');
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