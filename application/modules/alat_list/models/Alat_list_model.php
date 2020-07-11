<?php defined('BASEPATH') or exit('No direct script access allowed');

class Alat_list_model extends CI_model
{
	public function save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'alat gagal disimpan'];
			$data = $this->input->post();
			if (@$data['status'] == null || @$data['status'] == 0) {
				@$data['status'] = 1;
			}

			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('alat_list', ['sn' => $data['sn']])->row_array();
				$current_user = $this->db->get_where('alat_list', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					if ($current_user['status'] == 2) {
						$data['status'] = 2;
					}

					$this->db->where('id', $id);
					if ($this->db->update('alat_list', [
						'alat_jenis_id' => $data['alat_jenis_id'],
						'sn' 			=> $data['sn'],
						'status' 		=> $data['status'],
					])) {
						$msg = ['status' => 'success', 'msg' => 'alat berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'SN alat sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('alat_list', ['sn' => $data['sn']])->row_array();
				if (empty($exist)) {
					if ($this->db->insert('alat_list', [
						'alat_jenis_id' => $data['alat_jenis_id'],
						'sn' 			=> $data['sn'],
						'status' 		=> $data['status'],
					])) {
						$last_id = $this->db->insert_id();
						if ($this->db->insert('alat_history', [
							'alat_jenis_id' => $data['alat_jenis_id'],
							'alat_list_id' => $last_id,
							'jumlah' => 1
						])) {
							$msg = ['status' => 'success', 'msg' => 'Alat tidak dipakai/baru berhasil disimpan'];
						}
					}
				} else {
					$msg['msgs'][] = 'SN alat sudah ada';
				}
			}
		}

		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('alat_list', ['id'=>$id])->row_array();

		}
		return $msg;
	}

	public function all($limit, $start, $id = 0)
	{
		$msg = [];
		$this->db->select('*, a.id alat_id');
		$this->db->from('alat_list a');
		$this->db->join('jenis_alat b', 'a.alat_jenis_id=b.id', 'inner');
		if (!empty($this->input->get('jenis'))) {
			$this->db->where('alat_jenis_id', $this->input->get('jenis'));
		}elseif (!empty($this->input->get('fa'))) {
			if ($this->input->get('fa') == 2) {
				$this->db->join('alat_dipakai c', 'c.alat_list_id=a.id', 'inner');
				$this->db->join('pelanggan d', 'd.id=c.pelanggan_id', 'inner');
				$this->db->where('a.status', $this->input->get('fa'));
			}elseif($this->input->get('fa') == 1 || $this->input->get('fa') == 3){
				$this->db->where('a.status', $this->input->get('fa'));
			}
		}
		$this->db->limit($limit, $start);
		$msg = $this->db->get()->result_array();
		return $msg;
	}

	public function count_alat_list()
	{
		if (!empty($this->input->get('jenis'))) {
			return $this->db->get_where('alat_list', ['alat_jenis_id'=>$this->input->get('jenis')])->num_rows();
		}elseif(!empty($this->input->get('fa'))){
			return $this->db->get_where('alat_list', ['status'=>$this->input->get('fa')])->num_rows();
		}else{
			return $this->db->get('alat_list')->num_rows();
		}
	}

	public function count_data_tipe()
	{
		$msg = [];
		if (!empty($this->input->get('jenis'))) {
			$msg['baru'] = $this->db->get_where('alat_list', ['alat_jenis_id'=>$this->input->get('jenis'), 'status'=>1])->num_rows();
			$msg['dipakai'] = $this->db->get_where('alat_list', ['alat_jenis_id'=>$this->input->get('jenis'), 'status'=>2])->num_rows();
			$msg['rusak'] = $this->db->get_where('alat_list', ['alat_jenis_id'=>$this->input->get('jenis'), 'status'=>3])->num_rows();
		}else{
			$msg['baru'] = $this->db->get_where('alat_list', ['status'=>1])->num_rows();
			$msg['dipakai'] = $this->db->get_where('alat_list', ['status'=>2])->num_rows();
			$msg['rusak'] = $this->db->get_where('alat_list', ['status'=>3])->num_rows();
		}
		return $msg;
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$bind_alat = $this->db->get_where('alat_list', ['id'=>$id])->row_array();

			if ($bind_alat['status'] == 3) {
				if ($this->db->delete('alat_list', ['id' => $id])) {
					return ['status' => 'success', 'msg' => 'alat rusak berhasil dihapus'];
				}else{
					return ['status' => 'danger', 'msg' => 'alat rusak gagal dihapus'];
				}
			}else if($bind_alat['status'] == 1){
				if ($this->db->delete('alat_list', ['id' => $id])) {
					return ['status' => 'success', 'msg' => 'alat tidak dipakai berhasil dihapus'];
				}else{
					return ['status' => 'danger', 'msg' => 'alat tidak dipakai gagal dihapus'];
				}
			}else{
				return ['status' => 'danger', 'msg' => 'alat sedang digunakan'];
			}
		}
	}

	public function alat_status()
	{
		$data = [
			'0' => ['id' => '1', 'title' => 'tidak dipakai/baru'],
			'1' => ['id' => '2', 'title' => 'dipakai'],
			'2' => ['id' => '3', 'title' => 'rusak']
		];
		return $data;
	}

	public function for_select()
	{
		$msg = [];
		$this->db->select('*, a.id alat_id');
		$this->db->from('alat_list a');
		$this->db->join('jenis_alat b', 'a.alat_jenis_id=b.id', 'inner');
		$this->db->where('tipe', 1);
		$msg = $this->db->get()->result_array();
		return $msg;
	}
}
