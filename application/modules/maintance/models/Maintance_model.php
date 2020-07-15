<?php defined('BASEPATH') or exit('No direct script access allowed');

class Maintance_model extends CI_model
{
	public function all($limit, $start)
	{
		$msg = [];
		$filter = $this->input->get('fm');

		$this->db->select('
			a.created,
			a.updated,
			a.id,
			a.user_id,
			a.pelanggan_id,
			b.nama,
			keluhan,
			solusi,
			alasan,
			status,
		');
		$this->db->from('maintance a');
		$this->db->join('pelanggan b', 'b.id=a.pelanggan_id', 'inner');
		if (!empty($filter)) {
			$this->db->order_by('a.updated ASC, b.nama ASC');
			$this->db->where('status', $filter);
		}else{
			$this->db->order_by('a.created ASC, b.nama ASC');
			$this->db->where('status', 1);
		}
		$this->db->limit($limit, $start);
		$msg['data'] = $this->db->get()->result_array();

		return $msg;
	}

	public function count_maintance()
	{
		if (!empty($this->input->get('fm'))) {
			return $this->db->get_where('maintance', ['status'=>$this->input->get('fm')])->num_rows();
		}else{
			return $this->db->get_where('maintance', ['status'=>1])->num_rows();
		}
	}

	public function save($id=0)
	{
		$msg = [];
		$maintance = $this->input->get('maintance');
		$pelanggan_id = $this->input->get('pelanggan');
		$data = $this->input->post();
		$get_user_id = get_user()['id'];


		if (!empty($id)) {
			$msg = ['status' => 'danger', 'msg' => 'maintance gagal ditambahkan'];

			$ket = '';
			$exits = $this->db->get_where('maintance', ['id'=>$id])->row_array();
			if ($maintance == 2) {
				$ket = 'Mulai maintance di rumah ' . get_name_pelanggan($exits['pelanggan_id']);
			}elseif ($maintance == 3) {
				if (!empty($this->input->post('laporan'))) {
					$ket = 'Maintance di rumah ' . get_name_pelanggan($exits['pelanggan_id']) . ' Belum selesai. Permasalahan : ' . $this->input->post('laporan');
				}
			}elseif ($maintance == 4) {
				$ket = 'Maintance di rumah ' . get_name_pelanggan($exits['pelanggan_id']) . ' selesai.';
			}

			if (!empty($this->input->post('solusi'))) {
				$solusi = $this->input->post('solusi');
			}else{
				$solusi = '-';
			}

			if (!empty($this->input->post('laporan'))) {
				$alasan = $this->input->post('laporan');
			}else{
				$alasan = $exits['alasan'];
			}

			if (!empty($maintance)) {
				$this->db->set([
					'solusi' => $solusi,
					'status' => $maintance,
					'alasan' => $this->input->post('laporan'),
					'user_id' => $get_user_id,
				]);
				$this->db->where('id', $id);
				if ($this->db->update('maintance')) {

					$this->db->insert('laporan', [
						'user_id' => get_user()['id'],
						'ket' => $ket
					]);

					$msg = ['status' => 'success', 'msg' => 'ubah status maintance berhasil dilakukan'];
				}else{
					$msg = ['status' => 'danger', 'msg' => 'ubah status maintance gagal dilakukan'];
				}
			}
			return $msg;
		}else{
			$msg = ['status' => 'danger', 'msg' => 'maintance gagal ditambahkan'];

			if (!empty($maintance) && !empty($pelanggan_id)) {
				$check_maintance = $this->db->get_where('maintance', ['pelanggan_id'=>$pelanggan_id, 'status' => 1])->row_array();

				if (!empty($check_maintance)) {
					if (!empty($data)) {
						$this->db->set([
							'keluhan' => $data['keluhan']
						]);
						$this->db->where('id', $check_maintance['id']);
						if ($this->db->update('maintance')) {
							$msg = ['status' => 'success', 'msg' => 'keluhan maintance berhasil dirubah'];
						}
					}
				}else{
					if (!empty($data)) {
						if ($this->db->insert('maintance', [
							'pelanggan_id' => $pelanggan_id,
							'user_id' 	=> $get_user_id,
							'keluhan' 	=> $data['keluhan'],
							'solusi'	=> '-',
							'alasan'	=> '-',
							'status'	=> 1
						])) {
							$msg = ['status' => 'success', 'msg' => 'maintance berhasil ditambahkan kedalam list maintance'];
						}
					}
				}
			}

			return $msg;
		}
	}
}