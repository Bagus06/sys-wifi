<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_model
{
	public function all()
	{
		$this->db->select('alat_biaya, active');
		$bind_pelanggan = $this->db->get('pelanggan')->result_array();

		$msg['cnab']	= [];
		$msg['cnanb']	= [];
		$msg['cab']		= [];
		$msg['canb']	= [];

		$msg['mm']	= [];
		$msg['mbs']	= [];

		if (!empty($bind_pelanggan)) {
			foreach ($bind_pelanggan as $key => $value) {
				if ($value['active'] == 1) {
					if ($value['alat_biaya'] != 0) {
						$msg['cnab'][$key] = [$value];
					}
				}
				if ($value['active'] == 1) {
					if ($value['alat_biaya'] == 0) {
						$msg['cnanb'][$key] = [$value];
					}
				}
				if ($value['active'] == 3) {
					if ($value['alat_biaya'] != 0) {
						$msg['cab'][$key] = [$value];
					}
				}
				if ($value['active'] == 3) {
					if ($value['alat_biaya'] == 0) {
						$msg['canb'][$key] = [$value];
					}
				}
			}
		}

		$this->db->select('status');
		$bind_maintance = $this->db->get('maintance')->result_array();


		if (!empty($bind_maintance)) {
			foreach ($bind_maintance as $key => $value) {
				if ($value['status'] == 1) {
					$msg['mm'][$key]	= [$value];
				}
				if ($value['status'] == 3) {
					$msg['mbs'][$key]	= [$value];
				}
			}
		}

		return $msg;
	}
}