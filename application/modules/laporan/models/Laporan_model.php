<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_model
{
	public function all()
	{
		$msg = [];
		$date = date('Y-m-d');

		$this->db->like('created', $date);
		$msg['data'] = $this->db->get('laporan')->result_array();
		return $msg;
	}

	public function count_laporan()
	{
		$date = date('Y-m-d');

		$this->db->like('created', $date);
		return $this->db->get('laporan')->num_rows();
	}
}