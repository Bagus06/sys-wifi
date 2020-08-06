<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pemasangan_model extends CI_model
{
	public function save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'pemasangan gagal disimpan'];
			$data = $this->input->post();
			$this->db->select('id');
			$exist = $this->db->get_where('pemasangan', ['pelanggan_id' => $data['pelanggan_id']])->row_array();
			$current_user = $this->db->get_where('pemasangan', ['id' => $exist['id']])->row_array();

			if (!empty($exist)) {
				if ($current_user['id'] == $exist['id']) {

					$bind_kabel = $this->db->get_where('jenis_alat', ['title'=>'kabel'])->row_array();
					$bind_tiang = $this->db->get_where('jenis_alat', ['title'=>'tiang'])->row_array();

					$bind_jml_kabel = $this->db->query('SELECT SUM(kabel) AS sjk FROM pemasangan WHERE pelanggan_id !=' . $data['pelanggan_id'])->row_array();
					$bind_jml_tiang = $this->db->query('SELECT SUM(tiang) AS sjt FROM pemasangan WHERE pelanggan_id !=' . $data['pelanggan_id'])->row_array();


					$tks = $bind_kabel['jumlah'] - $bind_jml_kabel['sjk'];
					if ($tks < $data['kabel']) {
						$this->db->where(['pelanggan_id' => $id]);
						$msg['data'] = $this->db->get('pemasangan')->row_array();

						$this->db->select('alat_list_id');
						$tmp_alat_dipakai = $this->db->get_where('alat_dipakai', ['pelanggan_id' => $id])->result_array();
						if (!empty($tmp_alat_dipakai)) {
							foreach ($tmp_alat_dipakai as $key => $value) {
								$msg['alat'][] = $value['alat_list_id'];
							}
						}
						$msg['msgs'][] = 'jumlah kabel yang tersisa ' . $tks . ' Meter, lakukan penambahan kabel';
						return $msg;
					}

					$tts = $bind_tiang['jumlah'] - $bind_jml_tiang['sjt'];
					if ($tts < $data['tiang']) {
						$this->db->where(['pelanggan_id' => $id]);
						$msg['data'] = $this->db->get('pemasangan')->row_array();

						$this->db->select('alat_list_id');
						$tmp_alat_dipakai = $this->db->get_where('alat_dipakai', ['pelanggan_id' => $id])->result_array();
						if (!empty($tmp_alat_dipakai)) {
							foreach ($tmp_alat_dipakai as $key => $value) {
								$msg['alat'][] = $value['alat_list_id'];
							}
						}
						$msg['msgs'][] = 'jumlah tiang yang tersisa ' . $tts . ' lakukan penambahan tiang';
						return $msg;
					}

					$this->db->where('id', $current_user['id']);
					if ($this->db->update('pemasangan', [
						'pelanggan_id' => $data['pelanggan_id'],
						'tiang' => $data['tiang'],
						'kabel' => $data['kabel'],
						'trx' => $data['trx'],
						'ccq' => $data['ccq'],
						'metode' => $data['metode'],
						'pemasangan' => $current_user['pemasangan'],
					])) {

						$this->db->select('*');
						$this->db->where(['pelanggan_id' => $data['pelanggan_id']]);
						$current_alat = $this->db->get('alat_dipakai')->result_array();

						if (!empty($data['alat'])) {
							$q_delete = [];
							foreach ($current_alat as $key => $value) {
								if (!in_array($value['pelanggan_id'], $data['alat'])) {
									$q_delete[] = $value['id'];
								} else {
									$alat_key = array_search($value['pelanggan_id'], $data['alat']);
									unset($data['alat'][$alat_key]);
								}
							}
							$q = [];
							foreach ($data['alat'] as $key => $value) {
								$q[] = ['alat_list_id' => $value, 'pelanggan_id' => $data['pelanggan_id']];
							}
							if (!empty($q)) {
								if (!$this->db->insert_batch('alat_dipakai', $q)) {
									$msg['msgs'][] = 'alat gagal disimpan';
								}
							}
							foreach ($q_delete as $key => $value) {
								$this->db->delete('alat_dipakai', ['id' => $value]);
							}

							$ba = $this->db->get_where('alat_list', ['status'=>2])->result_array();
							if (!empty($ba)) {
								foreach ($ba as $key => $value) {
									$set_alat_1 = array(
										'status' => 1,
									);

									$this->db->set($set_alat_1);
									$this->db->where('id', $value['id']);
									$this->db->update('alat_list');
								}
							}
							$bad = $this->db->get('alat_dipakai')->result_array();
							foreach ($bad as $key => $value) {
								$set_alat_2 = array(
									'status' => 2,
								);

								$this->db->set($set_alat_2);
								$this->db->where('id', $value['alat_list_id']);
								$this->db->update('alat_list');
							}

						$msg = ['status' => 'success', 'msg' => 'pemasangan berhasil disimpan'];

						} else {
							$this->db->delete('alat_dipakai', ['pelanggan_id' => $data['pelanggan_id']]);
						}
					}

				} else {
					$msg['msgs'][] = 'pemasangan sudah ada';
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('pemasangan', ['pelanggan_id' => $data['pelanggan_id']])->row_array();
				if (empty($exist)) {

					$bind_kabel = $this->db->get_where('jenis_alat', ['title'=>'kabel'])->row_array();
					$bind_tiang = $this->db->get_where('jenis_alat', ['title'=>'tiang'])->row_array();

					$bind_jml_kabel = $this->db->query('SELECT SUM(kabel) AS sjk FROM pemasangan')->row_array();
					$bind_jml_tiang = $this->db->query('SELECT SUM(tiang) AS sjt FROM pemasangan')->row_array();


					$tks = $bind_kabel['jumlah'] - $bind_jml_kabel['sjk'];
					if ($tks < $data['kabel']) {
						return $msg = ['status' => 'danger', 'msg' => 'jumlah kabel yang tersisa' . $tks];
					}

					$tts = $bind_tiang['jumlah'] - $bind_jml_tiang['sjt'];
					if ($tts < $data['tiang']) {
						return $msg = ['status' => 'danger', 'msg' => 'jumlah tiang yang tersisa' . $tts];
					}

					if ($this->db->insert('pemasangan', [
						'pelanggan_id' => $data['pelanggan_id'],
						'tiang' => $data['tiang'],
						'kabel' => $data['kabel'],
						'trx' => $data['trx'],
						'ccq' => $data['ccq'],
						'metode' => $data['metode'],
						'pemasangan' => 1,
					])) {
						$set_pelanggan = array(
							'active' => 2,
						);

						$this->db->set($set_pelanggan);
						$this->db->where('id', $data['pelanggan_id']);
						$this->db->update('pelanggan');

						$q = [];
						foreach ($data['alat'] as $key => $value) {
							$q[] = ['alat_list_id' => $value, 'pelanggan_id' => $data['pelanggan_id']];
						}
						if (!$this->db->insert_batch('alat_dipakai', $q)) {
							$msg['msgs'][] = 'alat gagal disimpan';
						}

						$set_alat_1 = $this->db->get_where('alat_list', ['status'=>2])->result_array();
						if (!empty($set_alat_1)) {
							foreach ($set_alat_1 as $key => $value) {
								$set_alat_1 = array(
									'status' => 1,
								);

								$this->db->set($set_alat_1);
								$this->db->where('id', $value['id']);
								$this->db->update('alat_list');
							}
						}
						
						$set_alat_2 = $this->db->get('alat_dipakai')->result_array();
						foreach ($set_alat_2 as $key => $value) {
							$set_alat_2 = array(
								'status' => 2,
							);

							$this->db->set($set_alat_2);
							$this->db->where('id', $value['alat_list_id']);
							$this->db->update('alat_list');
						}

						$ket = 'Mulai pemasangan di rumah ' . get_name_pelanggan($data['pelanggan_id']);
						$this->db->insert('laporan', [
							'user_id' => get_user()['id'],
							'ket' => $ket
						]);

						$msg = ['status' => 'success', 'msg' => 'pemasangan berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'pemasangan sudah ada';
				}
			}
		}
		if (!empty($id)) {
			$this->db->where(['pelanggan_id' => $id]);
			$msg['data'] = $this->db->get('pemasangan')->row_array();

			$this->db->select('alat_list_id');
			$tmp_alat_dipakai = $this->db->get_where('alat_dipakai', ['pelanggan_id' => $id])->result_array();
			// print_r($msg['data']);die;
			if (!empty($tmp_alat_dipakai)) {
				foreach ($tmp_alat_dipakai as $key => $value) {
					$msg['alat'][] = $value['alat_list_id'];
				}
			}

		}
		return $msg;
	}

	public function selesai($id=0)
	{
		$user = get_user()['id'];
		$bind = $this->db->get_where('selesai', ['pelanggan_id'=>$id])->row_array();
		if (!empty($bind)) {
			$this->db->delete('selesai', ['id'=>$bind['id']]);

			if ($this->db->insert('selesai', [
				'pelanggan_id' => $id,
				'user_id' => $user
			])) {

				$set_pelanggan = array(
					'active' => 3,
				);

				$this->db->set($set_pelanggan);
				$this->db->where('id', $id);
				if ($this->db->update('pelanggan')) {

					$set_pemasangan = array(
						'pemasangan' => 2,
					);

					$this->db->set($set_pemasangan);
					$this->db->where('pelanggan_id', $id);
					if ($this->db->update('pemasangan')) {

						$ket = 'Pemasangan di rumah ' . get_name_pelanggan($id) . ' Selesai.';
						$this->db->insert('laporan', [
							'user_id' => get_user()['id'],
							'ket' => $ket
						]);

						redirect(base_url("pelanggan/list/?filter=3"));
					}else{
						redirect(base_url("pelanggan/list/?filter=1"));
					}

				}else{
					redirect(base_url("pelanggan/list/?filter=2"));
				}

			}else{
				redirect(base_url("pelanggan/list/?filter=2"));
			}
		}else{
			if ($this->db->insert('selesai', [
				'pelanggan_id' => $id,
				'user_id' => $user
			])) {

				$set_pelanggan = array(
					'active' => 3,
				);

				$this->db->set($set_pelanggan);
				$this->db->where('id', $id);
				if ($this->db->update('pelanggan')) {

					$set_pemasangan = array(
						'pemasangan' => 2,
					);

					$this->db->set($set_pemasangan);
					$this->db->where('pelanggan_id', $id);
					if ($this->db->update('pemasangan')) {
						
						$ket = 'Pemasangan di rumah ' . get_name_pelanggan($id) . ' Selesai.';
						$this->db->insert('laporan', [
							'user_id' => get_user()['id'],
							'ket' => $ket
						]);

						redirect(base_url("pelanggan/list/?filter=3"));
					}else{
						redirect(base_url("pelanggan/list/?filter=1"));
					}

				}else{
					redirect(base_url("pelanggan/list/?filter=2"));
				}

			}else{
				redirect(base_url("pelanggan/list/?filter=2"));
			}
		}
	}

	public function delete($id = 0)
	{
		// $current_user = $this->db->get_where('pemasangan', ['id' => $id])->row_array();
		if (!empty($id)) {
			if ($this->db->delete('pemasangan', ['id' => $id])) {
				return ['status' => 'success', 'msg' => 'data berhasil dihapus'];
			}
		}
	}

	public function metode()
	{
		$data = [
			'0' => ['id' => '1', 'title' => 'PTP'],
			'1' => ['id' => '2', 'title' => 'PTP (INDUK)'],
			'2' => ['id' => '3', 'title' => 'PTMP'],
			'3' => ['id' => '4', 'title' => 'PULL WIRES'],
		];
		return $data;
	}
}
