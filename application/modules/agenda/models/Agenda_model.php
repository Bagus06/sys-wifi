<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_model extends CI_model
{
	public function all($limit, $start)
	{
		$msg = [];
		if (empty($this->input->get('fa'))) {
			$this->db->limit($limit, $start);
			$this->db->where('status', 1);
			$msg['data'] = $this->db->get('agenda')->result_array();
		}else{
			$this->db->where('status', $this->input->get('fa'));
			$this->db->limit($limit, $start);
			$msg['data'] = $this->db->get('agenda')->result_array();
		}

		return $msg;
	}

	public function count_agenda()
	{
		if (empty($this->input->get('fa'))) {
			return $this->db->get_where('agenda', ['status'=>1])->num_rows();
		}else{
			return $this->db->get_where('agenda', ['status'=>$this->input->get('fa')])->num_rows();
		}
	}

	public function save($id=0)
	{
		$msg = [];

		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'agenda gagal disimpan'];
			$data = $this->input->post();
			$user_id = get_user()['id'];
			if (!empty($id)) {
				$current_agenda = $this->db->get_where('agenda', ['id'=>$id])->row_array();
				if (!empty($current_agenda)) {
					if (!empty($this->input->get('status'))) {
						$status = $this->input->get('status');
						$pesan = '';
						if ($status == 2) {
							$data = [
								'status' => $this->input->get('status'),
							];
							$pesan = 'status agenda berhasil dirubah menjadi dalam proses eksekusi.';
						}elseif ($status == 3) {
							$data = [
								'exsekusi' => $user_id,
								'status' => $this->input->get('status'),
							];
							$pesan = 'status agenda berhasil dirubah menjadi dalam telah di eksekusi.';
						}

						$this->db->set($data);
						$this->db->where('id', $id);
						if ($this->db->update('agenda')) {
							$msg = ['status' => 'success', 'msg' => $pesan];
						}else{
							$msg['msgs'][] = 'ubah status agenda gagal.';
						}
					}else{
						$data = [
							'pembuat' => $user_id,
							'exsekusi' => 0,
							'ket' => $data['ket'],
						];

						$this->db->set($data);
						$this->db->where('id', $id);
						if ($this->db->update('agenda')) {
							$msg = ['status' => 'success', 'msg' => 'agenda berhasil diubah'];
						}else{
							$msg['msgs'][] = 'agenda gagal diubah.';
						}
					}
				}else{
					$msg['msgs'][] = 'Agenda yang anda edit tidak ditemukan di server.';
				}
			}else{
				$exits = $this->db->get_where('agenda', ['ket'=>$data['ket'], 'status' => 1])->row_array();
				$data = [
					'pembuat' => $user_id,
					'exsekusi' => 0,
					'ket' => $data['ket'],
					'status' => 1,
				];
				if (empty($exits)) {
					if ($this->db->insert('agenda', $data)) {
						$msg = ['status' => 'success', 'msg' => 'agenda berhasil disimpan'];
					}
				}else{
					$msg['msgs'][] = 'Agenda yang anda masukkan sudah ada.';
				}
			}
		}

		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('agenda', ['id'=>$id])->row_array();
		}

		return $msg;
	}

	public function ubah_status($id=0)
	{
		$msg = [];

		$msg = ['status' => 'danger', 'msg' => 'agenda gagal disimpan'];
		$user_id = get_user()['id'];
		if (!empty($id)) {
			$current_agenda = $this->db->get_where('agenda', ['id'=>$id])->row_array();
			if (!empty($current_agenda)) {
				if (!empty($this->input->get('status'))) {
					$status = $this->input->get('status');
					$pesan = '';
					if ($status == 2) {
						$data = [
							'status' => $this->input->get('status'),
						];
						$pesan = 'status agenda berhasil dirubah menjadi dalam proses eksekusi.';
					}elseif ($status == 3) {
						$data = [
							'exsekusi' => $user_id,
							'status' => $this->input->get('status'),
						];
						$pesan = 'status agenda berhasil dirubah menjadi dalam telah di eksekusi.';
					}

					if ($status == 2) {
						$ket = 'Mulai mengerjakan agenda ' . $current_agenda['ket'];
					}elseif ($status == 3) {
						$ket = 'Agenda ' . $current_agenda['ket'] . ' selesai dikerjakan.';
					}

					$this->db->set($data);
					$this->db->where('id', $id);
					if ($this->db->update('agenda')) {

						$this->db->insert('laporan', [
							'user_id' => $user_id,
							'ket' => $ket
						]);

						$msg = ['status' => 'success', 'msg' => $pesan];
					}else{
						$msg['msgs'][] = 'ubah status agenda gagal.';
					}
				}
			}else{
				$msg['msgs'][] = 'Agenda yang anda edit tidak ditemukan di server.';
			}
		}

		return $msg;
	}

	public function delete($id = 0)
	{
		if (!empty($id)) {
			if ($this->db->delete('agenda', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			}else {
				return ['status' => 'danger', 'msg' => 'data gagal dihapus'];
			}
		}
	}
}