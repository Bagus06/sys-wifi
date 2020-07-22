<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Library_scurity_model extends CI_model
{
	public function all($id, $limit, $start)
	{
		$msg = [];

		if (!empty($id)) {
			$status = $this->input->get('switch');
			if (!empty($status)) {
				$to_set = 0;
				if ($status == 1) {
					$to_set = 2;
				}elseif ($status == 2) {
					$to_set = 1;
				}
				$this->db->set([
					'status' => $to_set
				]);
				$this->db->where('id', $id);
				if ($this->db->update('library_scurity')) {
					redirect(base_url('library_scurity/list'));
				}else{
					redirect(base_url('library_scurity/list'));
				}
			}
		}

		if (!empty($this->input->get('pelanggan'))) {
			$this->db->order_by('id DESC');
			$this->db->limit($limit, $start);
			$msg['data'] = $this->db->get_where('library_scurity', ['pelanggan_id'=>$this->input->get('pelanggan')])->result_array();
		}else{
			$this->db->order_by('id DESC');
			$this->db->limit($limit, $start);
			$msg['data'] = $this->db->get('library_scurity')->result_array();
		}

		return $msg;
	}

	public function count_library_scurity()
	{
		if (!empty($this->input->get('pelanggan'))) {
			return $this->db->get_where('library_scurity', ['pelanggan_id'=>$this->input->get('pelanggan')])->num_rows();
		}else{
			return $this->db->get_where('library_scurity')->num_rows();
		}
	}

	public function save($id=0)
	{
		$msg = [];

		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'library scurity gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$current_library_scurity = $this->db->get_where('library_scurity', ['id'=>$id])->row_array();
				if (!empty($current_library_scurity)) {
					$data = [
						'pelanggan_id' => $data['pelanggan_id'],
						'ip' => $data['ip'],
						'mac' => $data['mac'],
						'username' => $data['username'],
						'password' => $data['password'],
					];

					$this->db->set($data);
					$this->db->where('id', $id);
					if ($this->db->update('library_scurity')) {
						$msg = ['status' => 'success', 'msg' => 'library scurity berhasil diubah'];
					}else{
						$msg['msgs'][] = 'library scurity gagal diubah.';
					}
				}else{
					$msg['msgs'][] = 'library scurity yang anda edit tidak ditemukan di server.';
				}
			}else{
				$exits = $this->db->get_where('library_scurity', ['ip'=>$data['ip']])->row_array();
				$data = [
					'pelanggan_id' => $data['pelanggan_id'],
					'ip' => $data['ip'],
					'mac' => $data['mac'],
					'username' => $data['username'],
					'password' => $data['password'],
					'status' => 1,
				];

				if (empty($exits)) {
					if ($this->db->insert('library_scurity', $data)) {
						$msg = ['status' => 'success', 'msg' => 'library scurity berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'library scurity yang anda masukkan sudah ada.';
				}
			}
		}

		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('library_scurity', ['id'=>$id])->row_array();
		}

		return $msg;
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('library_scurity', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			}else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}
}