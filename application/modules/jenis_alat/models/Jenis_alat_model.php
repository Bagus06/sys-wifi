<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_alat_model extends CI_model
{
	public function save($id = 0)
	{
		$msg = [];
		$url = base_url('jenis_alat/list');
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'jenis alat gagal disimpan'];
			$data = $this->input->post();

			if (!empty($data['tambah'])) {
				$current_alat = $this->db->get_where('jenis_alat', ['id' => $data['alat_id']])->row_array();
				if (!empty($current_alat)) {
					$total = $current_alat['jumlah'] + $data['tambah'];
					$this->db->set([
						'jumlah' => $total
					]);
					$this->db->where('id', $data['alat_id']);
					if ($this->db->update('jenis_alat')) {
						if ($this->db->insert('alat_history', [
							'alat_jenis_id' => $data['alat_id'],
							'alat_list_id' => 0,
							'jumlah' => $data['tambah']
						])) {
							return $msg = ['status' => 'success', 'msg' => 'Penambahan jumlah ' . $current_alat['title'] . ' sebanyak ' . $data['tambah'] . ' success dilakukan'];
						}
					}
				}
			}

			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('jenis_alat', ['title' => @$data['title']])->row_array();
				$current_user = $this->db->get_where('jenis_alat', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {
					$this->db->set([
						'title' => $data['title']
					]);
					$this->db->where('id', $id);
					if ($this->db->update('jenis_alat')) {
						$msg = ['status' => 'success', 'msg' => 'Jenis alat berhasil disimpan'];
					}

				} else {
					$msg['msgs'][] = 'Jenis alat sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('jenis_alat', ['title' => $data['title']])->row_array();
				if (empty($exist)) {
					if ($this->db->insert('jenis_alat', [
						'title' => $data['title'],
						'jumlah' => $data['jumlah'],
						'tipe' => $data['tipe'],
					])) {
						$msg = ['status' => 'success', 'msg' => 'Jenis alat berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'Jenis alat sudah ada';
				}
			}
		}
		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('jenis_alat', ['id'=>$id])->row_array();

		}
		return $msg;
	}

	public function all($limit, $start, $id = 0)
	{
		$msg = [];
		$this->db->select('*');
		$this->db->from('jenis_alat a');
		$this->db->limit($limit, $start);
		$msg = $this->db->get()->result_array();

		return $msg;
	}

	public function alat_history($limit, $start)
	{
		$msg = [];
		$this->db->select('* , a.jumlah jml_penambahan');
		$this->db->from('alat_history a');
		$this->db->join('jenis_alat b', 'b.id=a.alat_jenis_id', 'inner');
		$this->db->limit($limit, $start);
		$msg = $this->db->get()->result_array();

		return $msg;
	}

	public function count_alat_history()
	{
		return $this->db->get('alat_history')->num_rows();
	}

	public function count_jenis_alat()
	{
		return $this->db->get('jenis_alat')->num_rows();
	}

	public function count_data_alat()
	{
		$msg = [];
		$bind_tipe = $this->db->get_where('jenis_alat', ['tipe'=>1])->result_array();
		foreach ($bind_tipe as $key => $value) {
			$msg[$value['id']] = $this->db->get_where('alat_list', ['alat_jenis_id'=>$value['id']])->num_rows();
			$msg['terpakai'][$value['id']] = $this->db->get_where('alat_list', ['alat_jenis_id'=>$value['id'], 'status'=>2])->num_rows();
		}
		$this->db->select_sum('tiang');
		$msg['tiang'] = $this->db->get('pemasangan')->row_array();

		$this->db->select_sum('kabel');
		$msg['kabel'] = $this->db->get('pemasangan')->row_array();
		// print_r($msg);die;
		return $msg;
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			$bind_jenis = $this->db->get_where('jenis_alat', ['id'=>$id])->row_array();
			if ($bind_jenis['tipe'] == 2) {
				if ($bind_jenis['title'] != 'tiang' && $bind_jenis['title'] != 'kabel') {
					if ($this->db->delete('jenis_alat', ['id' => $id])) {
						return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
					}else{
						return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
					}
				}else{
					return ['status' => 'danger', 'msg' => 'jenis ini tidak dapat dihapus'];
				}
			}elseif ($bind_jenis['tipe'] == 1) {
				$dipakai = $this->db->get_where('alat_list', ['alat_jenis_id'=>$id])->row_array();
				if (!empty($dipakai)) {
					return ['status' => 'danger', 'msg' => 'jenis ini tidak dapat dihapus karena memiliki list alat'];
				}else{
					if ($this->db->delete('jenis_alat', ['id' => $id])) {
						return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
					}else{
						return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
					}
				}
			}
		}
	}

	public function for_select()
	{
		$msg = [];
		$this->db->select('*');
		$this->db->from('jenis_alat a');
		$msg = $this->db->get()->result_array();
		return $msg;
	}

	public function tipe()
	{
		$data = [
			'0' => ['id' => '1', 'title' => 'SN'],
			'1' => ['id' => '2', 'title' => 'Not SN'],
		];
		return $data;
	}
}
