<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_model
{
	public function all()
	{
		$msg = [];
		$date = date('Y-m-d');

		$filter = $this->input->get();
		$filter_by_date = $this->input->get('date');
		$filter_by_name = $this->input->get('karyawan');

		if (!empty($filter)) {
			if (!empty($filter_by_date)) {
				$this->db->like('created', $filter_by_date);
			}else{
				$this->db->like('created', $date);
			}
			if (!empty($filter_by_name)) {
				$this->db->like('user_id', $filter_by_name);
			}
		}else{
			$this->db->like('created', $date);
		}
		$msg['data'] = $this->db->get('laporan')->result_array();
		return $msg;
	}

	public function count_laporan()
	{
		$msg = [];
		$date = date('Y-m-d');

		$filter = $this->input->get();
		$filter_by_date = @$filter['date'];
		$filter_by_name = @$filter['karyawan'];

		if (!empty($filter)) {
			if (!empty($filter_by_date)) {
				$this->db->like('created', $filter_by_date);
			}else{
				$this->db->like('created', $date);
			}
			if (!empty($filter_by_name)) {
				$this->db->like('user_id', $filter_by_name);
			}
		}else{
			$this->db->like('created', $date);
		}
		$msg = $this->db->get('laporan')->num_rows();
		return $msg;
	}

	public function save($id=0)
	{
		$msg = [];

		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'laporan gagal disimpan'];
			$data = $this->input->post();
			$user_id = get_user()['id'];
			if (!empty($id)) {
				$current_laporan = $this->db->get_where('laporan', ['id'=>$id])->row_array();
				if (!empty($current_laporan)) {
					$data = [
						'user_id' => $user_id,
						'ket' => $data['ket'],
					];

					$this->db->set($data);
					$this->db->where('id', $id);
					if ($this->db->update('laporan')) {
						$msg = ['status' => 'success', 'msg' => 'laporan berhasil diubah'];
					}else{
						$msg['msgs'][] = 'laporan gagal diubah.';
					}
				}else{
					$msg['msgs'][] = 'laporan yang anda edit tidak ditemukan di server.';
				}
			}else{
				$exits = $this->db->get_where('laporan', ['ket'=>$data['ket']])->row_array();
				$data = [
					'user_id' => $user_id,
					'ket' => $data['ket'],
				];
				if (empty($exits)) {
					if ($this->db->insert('laporan', $data)) {
						$msg = ['status' => 'success', 'msg' => 'laporan berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'laporan yang anda masukkan sudah ada.';
				}
			}
		}

		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('laporan', ['id'=>$id])->row_array();
		}

		return $msg;
	}
}