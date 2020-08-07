<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_keuangan_model extends CI_model
{
	public function rekap_pendapatan()
	{
		$msg = [];
		$this->db->select('id, nominal, rentan, jatuh_tempo, created');
		$this->db->from('config_pembayaran');
		$config_pembayaran = $this->db->get()->result_array();

		$this->db->select('a.id, a.created, b.nominal');
		$this->db->from('history_pembayaran a');
		$this->db->join('config_pembayaran b', 'b.id=a.config_pembayaran_id', 'inner');
		$this->db->like('a.created', date('Y-m'), 'after');
		$history_pembayaran = $this->db->get()->result_array();

		$rentan1 = 0;
		$rentan2 = 0;
		foreach ($config_pembayaran as $key => $cp) {
			if ($cp['rentan'] == 1) {
				$rentan1 += $cp['nominal'];
			}elseif (($cp['rentan'] == 2) && (echo_date_year($cp['created']) != date('Y')) && ($cp['jatuh_tempo'] == date('m'))) {
				$rentan2 += $cp['nominal'];
			}
		}

		$rentan_all = 0;
		foreach ($history_pembayaran as $key => $hp) {
			$rentan_all += $hp['nominal'];
		}

		$msg['jml_pendapatan'] = $rentan1 + $rentan2;
		$msg['sudah_terbayar'] = $rentan_all;

		// print_r($msg);die;
		return $msg;
	}

	public function all($limit, $start)
	{
		$msg = [];
		$date =  date('m');
		if (substr(trim($date), 0, 1) == 0) {
			$date = substr(trim(date('m')), 1);
		}
		$user_id = get_user()['id'];
		$filter = $this->input->get();
		$rentan = $this->input->get('rentan');
		$pelanggan = $this->input->get('pelanggan');
		$desa = $this->input->get('desa');
		$pembayaran = $this->input->get('pembayaran');

		if (!empty($filter)) {
			if (!empty($pembayaran)) {
				$msg = ['status' => 'danger', 'msg' => 'Pembayaran gagal dilakukan'];
				$bind_config = $this->db->get_where('config_pembayaran', ['id'=>$pembayaran])->row_array();

				if ($this->db->insert('history_pembayaran', [
					'config_pembayaran_id' => $pembayaran,
					'user_id' => $user_id
				])) {
					$msg = ['status' => 'success', 'msg' => 'Pembayaran atas nama ' . get_name_pelanggan($bind_config['pelanggan_id']) . ' berhasil'];
				}else{
					$msg['msgs'][] = 'Pembayaran atas nama ' . get_name_pelanggan($bind_config['pelanggan_id']) . ' gagal';
				}
			}
		}

		$this->db->select('a.id, nama, b.desa, b.desa_id, nominal, jatuh_tempo, rentan');
		$this->db->from('config_pembayaran a');
		$this->db->join('pelanggan b', 'b.id=a.pelanggan_id', 'inner');
		if (!empty($filter)) {
			if (!empty($pelanggan)) {
				$this->db->where('b.id', $pelanggan);
			}elseif (!empty($desa)) {
				$this->db->where('b.desa_id', $desa);
			}elseif(!empty($rentan)){
				$this->db->like('a.rentan', $rentan);
				if ($rentan == 2) {
					$this->db->like('a.jatuh_tempo', $date);
					$this->db->not_like('a.created', date('Y'), 'after');
				}
			}
		}
		$this->db->order_by('b.desa ASC');
		$this->db->limit($limit, $start);
		$msg['data'] = $this->db->get()->result_array();

		$this->db->select('config_pembayaran_id');
		$this->db->from('history_pembayaran');
		$this->db->like('created', date('Y-m'), 'after');
		$msg['his'] = $this->db->get()->result_array();

		$forkey = 0;
		$describe[$forkey] = "";
		foreach ($msg['his'] as $key => $value) {
			$describe[$forkey] = $value['config_pembayaran_id'];
			$forkey++;
		}
		$msg['history'] = $describe;

		$this->db->select('config_pembayaran_id');
		$this->db->from('history_pembayaran');
		$this->db->like('created', date('Y'), 'after');
		$msg['his_mont'] = $this->db->get()->result_array();

		$forkey_month = 0;
		$describe_month[$forkey_month] = "";
		foreach ($msg['his_mont'] as $key => $value) {
			$describe_month[$forkey_month] = $value['config_pembayaran_id'];
			$forkey_month++;
		}
		$msg['history_month'] = $describe_month;

		return $msg;
	}

	public function history_pembayaran($limit, $start)
	{
		$msg = [];
		$filter = $this->input->get();
		$pelanggan = $this->input->get('pelanggan');
		$desa = $this->input->get('desa');

		$this->db->select('a.id, a.created, c.nama, c.desa, c.desa_id, b.nominal, b.jatuh_tempo, b.rentan');
		$this->db->from('history_pembayaran a');
		$this->db->join('config_pembayaran b', 'b.id=a.config_pembayaran_id', 'inner');
		$this->db->join('pelanggan c', 'c.id=b.pelanggan_id', 'inner');
		if (!empty($filter)) {
			if (!empty($pelanggan)) {
				$this->db->like('c.id', $pelanggan);
			}elseif (!empty($desa)) {
				$this->db->like('c.desa_id', $desa);
			}
		}
		$this->db->order_by('c.created DESC');
		$this->db->limit($limit, $start);
		$msg['data'] = $this->db->get()->result_array();

		return $msg;
	}

	public function count_history_pembayaran()
	{
		$filter = $this->input->get();
		$pelanggan = $this->input->get('pelanggan');
		$desa = $this->input->get('desa');
		if (!empty($filter)) {
			$this->db->select('a.id');
			$this->db->from('history_pembayaran a');
			$this->db->join('config_pembayaran b', 'b.id=a.config_pembayaran_id', 'inner');
			$this->db->join('pelanggan c', 'c.id=b.pelanggan_id', 'inner');
			if (!empty($pelanggan)) {
				$this->db->like('c.id', $pelanggan);
			}elseif (!empty($desa)) {
				$this->db->like('c.desa_id', $desa);
			}
			return $this->db->get()->num_rows();
		}else{
			$this->db->select('a.id');
			$this->db->from('history_pembayaran a');
			$this->db->join('config_pembayaran b', 'b.id=a.config_pembayaran_id', 'inner');
			$this->db->join('pelanggan c', 'c.id=b.pelanggan_id', 'inner');
			return $this->db->get()->num_rows();
		}
	}

	public function count_pembayaran()
	{
		$filter = $this->input->get();
		$date =  date('m');
		if (substr(trim($date), 0, 1) == 0) {
			$date = substr(trim(date('m')), 1);
		}
		$rentan = $this->input->get('rentan');
		$pelanggan = $this->input->get('pelanggan');
		$desa = $this->input->get('desa');
		if (!empty($filter)) {
			$this->db->select('a.id');
			$this->db->from('config_pembayaran a');
			$this->db->join('pelanggan b', 'b.id=a.pelanggan_id', 'inner');
			if (!empty($pelanggan)) {
				$this->db->like('b.id', $pelanggan);
			}elseif (!empty($desa)) {
				$this->db->like('b.desa_id', $desa);
			}elseif(!empty($rentan)){
				$this->db->like('a.rentan', $rentan);
				if ($rentan == 2) {
					$this->db->like('a.jatuh_tempo', $date);
				}
			}
			return $this->db->get()->num_rows();
		}else{
			$this->db->select('a.id');
			$this->db->from('config_pembayaran a');
			$this->db->join('pelanggan b', 'b.id=a.pelanggan_id', 'inner');
			return $this->db->get()->num_rows();
		}
	}

	public function all_config($limit, $start)
	{
		$msg = [];
		$this->db->select('a.id, nama, jatuh_tempo, nominal, rentan');
		$this->db->from('config_pembayaran a');
		$this->db->join('pelanggan b', 'b.id=a.pelanggan_id', 'inner');
		$this->db->order_by('b.nama ASC');
		if (!empty($this->input->get('pelanggan'))) {
			$this->db->where('a.pelanggan_id', $this->input->get('pelanggan'));
		}
		$this->db->limit($limit, $start);
		$msg['data'] = $this->db->get()->result_array();

		return $msg;
	}

	public function count_config()
	{
		if (!empty($this->input->get('pelanggan'))) {
			$ret = 0;
			return $ret;
		}else{
			return $this->db->get('config_pembayaran')->num_rows();
		}
	}

	public function save_config($id=0)
	{
		$msg = [];

		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'config pembayaran gagal disimpan'];
			$data = $this->input->post();
			if (!empty($id)) {
				$current_config_pembayaran = $this->db->get_where('config_pembayaran', ['id'=>$id])->row_array();
				if (!empty($current_config_pembayaran)) {
					if (!empty($data['bulan'])) {
						$data['jatuh_tempo'] = $data['bulan'];
					}elseif (!empty($data['tanggal'])) {
						$data['jatuh_tempo'] = $data['tanggal'];
					}else{
						$data['jatuh_tempo'] = null;
					}

					if ($data['jatuh_tempo'] == null) {
						$msg['msgs'][] = 'tetapkan tanggal atau bulan jatuh tempo.';
						if (!empty($id)) {
							$msg['data'] = $this->db->get_where('config_pembayaran', ['id'=>$id])->row_array();
						}

						return $msg;
					}

					$data = [
						'pelanggan_id' => $data['pelanggan_id'],
						'jatuh_tempo' => $data['jatuh_tempo'],
						'nominal' => preg_angka($data['nominal']),
						'rentan' => $data['rentan']
					];
					$this->db->select('id');
					$bind = $this->db->get_where('config_pembayaran', ['pelanggan_id'=>$data['pelanggan_id'], 'jatuh_tempo' => $data['jatuh_tempo']])->row_array();

					if ((@$bind['id'] == $id) || empty($bind)) {
						$this->db->set($data);
						$this->db->where('id', $id);
						if ($this->db->update('config_pembayaran')) {
							$msg = ['status' => 'success', 'msg' => 'config pembayaran berhasil diubah'];
						}else{
							$msg['msgs'][] = 'config pembayaran gagal diubah.';
						}
					}else{
						$msg['msgs'][] = 'jatuh tempo yang anda masukkan sudah digunakan.';
					}
				}else{
					$msg['msgs'][] = 'config pembayaran yang anda edit tidak ditemukan di server.';
				}
			}else{
				$exits = $this->db->get_where('config_pembayaran', ['pelanggan_id'=>$data['pelanggan_id'], 'rentan'=>$data['rentan']])->num_rows();

				if (!empty($data['bulan'])) {
					$data['jatuh_tempo'] = $data['bulan'];
				}elseif (!empty($data['tanggal'])) {
					$data['jatuh_tempo'] = $data['tanggal'];
				}else{
					$data['jatuh_tempo'] = null;
				}

				if ($data['jatuh_tempo'] == null) {
					$msg['msgs'][] = 'tetapkan tanggal atau bulan jatuh tempo.';
					if (!empty($id)) {
						$msg['data'] = $this->db->get_where('config_pembayaran', ['id'=>$id])->row_array();
					}

					return $msg;
				}

				$data = [
					'pelanggan_id' => $data['pelanggan_id'],
					'jatuh_tempo' => $data['jatuh_tempo'],
					'nominal' => preg_angka($data['nominal']),
					'rentan' => $data['rentan'],
					'status' => 1,
				];
				$this->db->select('id, jatuh_tempo');
				$bind = $this->db->get_where('config_pembayaran', ['pelanggan_id'=>$data['pelanggan_id'], 'jatuh_tempo' => $data['jatuh_tempo'], 'rentan'=>$data['rentan']])->row_array();
				if ($data['rentan'] == 1) {
					if (empty($bind)) {
						$this->db->delete('config_pembayaran', ['pelanggan_id'=>$data['pelanggan_id'], 'rentan'=>2]);
						if ($exits <= 3) {
							if ($this->db->insert('config_pembayaran', $data)) {
								$msg = ['status' => 'success', 'msg' => 'config pembayaran berhasil disimpan'];
							}
						}else{
							$msg['msgs'][] = 'config pembayaran tempo per bulan maximal hanya 3.';
						}
					}else{
						$msg['msgs'][] = 'jatuh tempo yang anda masukkan sudah ada.';
					}
				}elseif ($data['rentan'] == 2) {
					if (empty($bind)) {
						if ($exits < 1) {
							$this->db->delete('config_pembayaran', ['pelanggan_id'=>$data['pelanggan_id'], 'rentan'=>1]);
							if ($this->db->insert('config_pembayaran', $data)) {
								$msg = ['status' => 'success', 'msg' => 'config pembayaran berhasil disimpan'];
							}
						}else{
							$msg['msgs'][] = 'config pembayaran tempo per tahun maximal hanya 1.';
						}
					}else{
						$msg['msgs'][] = 'jatuh tempo yang anda masukkan sudah ada.';
					}
				}else{
					$msg['msgs'][] = 'anda harus mengisi tempo.';
				}
			}
		}

		if (!empty($id)) {
			$msg['data'] = $this->db->get_where('config_pembayaran', ['id'=>$id])->row_array();
		}

		return $msg;
	}

	public function date_pembayaran()
	{
		$date = [];
		$date['bulan'] = [
			'0' => ['id' => '01' , 'title' => 'Januari'],
			'1' => ['id' => '02' , 'title' => 'Februari'],
			'2' => ['id' => '03' , 'title' => 'Maret'],
			'3' => ['id' => '04' , 'title' => 'April'],
			'4' => ['id' => '05' , 'title' => 'Mei'],
			'5' => ['id' => '06' , 'title' => 'Juni'],
			'6' => ['id' => '07' , 'title' => 'July'],
			'7' => ['id' => '08' , 'title' => 'Agustus'],
			'8' => ['id' => '09' , 'title' => 'September'],
			'9' => ['id' => '10' , 'title' => 'Oktober'],
			'10' => ['id' => '11' , 'title' => 'November'],
			'11' => ['id' => '12' , 'title' => 'Desember'],
		];
		$date['tanggal'] = [
			'0' => ['id' => '01'],
			'1' => ['id' => '02'],
			'2' => ['id' => '03'],
			'3' => ['id' => '04'],
			'4' => ['id' => '05'],
			'5' => ['id' => '06'],
			'6' => ['id' => '07'],
			'7' => ['id' => '08'],
			'8' => ['id' => '09'],
			'9' => ['id' => '10'],
			'10' => ['id' => '11'],
			'11' => ['id' => '12'],
			'12' => ['id' => '12'],
			'13' => ['id' => '14'],
			'14' => ['id' => '15'],
			'15' => ['id' => '16'],
			'16' => ['id' => '17'],
			'17' => ['id' => '18'],
			'18' => ['id' => '19'],
			'19' => ['id' => '20'],
			'20' => ['id' => '21'],
			'21' => ['id' => '22'],
			'22' => ['id' => '23'],
			'23' => ['id' => '24'],
			'24' => ['id' => '25'],
			'25' => ['id' => '26'],
			'26' => ['id' => '27'],
			'27' => ['id' => '28'],
			'28' => ['id' => '29'],
			'29' => ['id' => '30'],
			'30' => ['id' => '31'],
		];

		return $date;
	}
	public function tempo()
	{
		$tempo = [
			'0' => ['id' => 1, 'title' => 'Per Bulan'],
			'1' => ['id' => 2, 'title' => 'Per Tahun'],
		];
		return $tempo;
	}

	public function desa()
	{
		$this->db->select('id, active, desa_id, desa');
		$bind_pelanggan = $this->db->get_where('pelanggan', ['active'=>3])->result_array();

		$templevelpa='-';
		$newkeypa=0;
		$grouparrpa[$templevelpa]="";

		foreach ($bind_pelanggan as $key => $val) {
			if ($templevelpa == $val['desa']){
				$grouparrpa[$templevelpa]=$val['desa_id'];
			} else {
				$grouparrpa[$val['desa']]=$val['desa_id'];
			}
			$newkeypa++;
		}
		return $grouparrpa;
	}
}