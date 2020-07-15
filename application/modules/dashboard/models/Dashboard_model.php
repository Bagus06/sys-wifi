<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_model
{
	public function all()
	{
		// $this->db->select('kab, kec, desa, kordinat, no_tlp, created, user_id');
		$this->db->order_by('updated ASC');
		$this->db->limit(12, 0);
		// $this->db->where('active', 1);
		$msg['bind'] = $this->db->get('pelanggan')->result_array();

		$msg['not_active_biaya'] = [];
		$msg['not_active_no_biaya'] = [];
		foreach ($msg['bind'] as $key => $value) {
			if ($value['active'] == 1) {
				if ($value['alat_biaya'] != 0) {
					$msg['not_active_biaya'][$key] = $value;
				}
			}elseif ($value['active'] == 1) {
				if ($value['alat_biaya'] == 0) {
					$msg['not_active_no_biaya'][$key] = $value;
				}
			}elseif ($value['active'] == 2) {
				if ($value['alat_biaya'] != 0) {
					$msg['active_biaya'][$key] = $value;
				}
			}
		}

		// echo "<pre>";
		// print_r($msg['c']);
		// echo "</pre>";
		// die;

		$this->db->where('active', 1);
		$this->db->where('alat_biaya !=', 0);
		$msg['cnab'] = $this->db->get('pelanggan')->num_rows();

		$this->db->where('active', 1);
		$this->db->where('alat_biaya', 0);
		$msg['cnanb'] = $this->db->get('pelanggan')->num_rows();


		$this->db->where('active', 3);
		$this->db->where('alat_biaya !=', 0);
		$msg['cab'] = $this->db->get('pelanggan')->num_rows();

		$this->db->select('*, a.created pendaftaran');
		$this->db->from('pelanggan a');
		$this->db->join('pemasangan b', 'b.pelanggan_id=a.id', 'inner');
		$this->db->join('selesai c', 'c.pelanggan_id=a.id', 'inner');
		$this->db->where('active', 3);
		$this->db->where('alat_biaya', 0);
		$this->db->order_by('a.updated ASC, nama ASC');
		$this->db->limit(12, 0);
		$msg['active_no_biaya'] = $this->db->get()->result_array();

		$this->db->where('active', 3);
		$this->db->where('alat_biaya', 0);
		$msg['canb'] = $this->db->get('pelanggan')->num_rows();

		$this->db->select('*, a.created komplain_c, a.updated komplain_u, a.id maintance_id');
		$this->db->from('maintance a');
		$this->db->join('pelanggan b', 'b.id=a.pelanggan_id', 'inner');
		$this->db->order_by('a.created ASC, b.nama ASC');
		$this->db->where('status', 1);
		$this->db->limit(12, 0);
		$msg['maintance'] = $this->db->get()->result_array();

		return $msg;
	}
}