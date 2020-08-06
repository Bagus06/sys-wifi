<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_model
{
	public function save($id = 0)
	{
		$msg = [];
		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'pelanggan gagal disimpan'];
			$data = $this->input->post();

			if (!empty($id)) {
				$this->db->select('id');
				$exist = $this->db->get_where('pelanggan', ['nik' => $data['nik']])->row_array();
				$current_user = $this->db->get_where('pelanggan', ['id' => $id])->row_array();
				if ($current_user['id'] == $exist['id'] || empty($exist)) {


					if (!empty($_FILES['foto_pelanggan']['name']) || !empty($_FILES['foto_pelanggan']['name'])) {
						$sizep = $_FILES['foto_pelanggan']['size']/1000;
						if ($sizep > $config['max_size']) {
							$msg = ['status'=>'danger', 'msg'=>'ukuran gambar terlalu besar, max ukuran gambar 3Mb'];
							return $msg;
						}

						$sizer = $_FILES['foto_rumah']['size']/1000;
						if ($sizer > $config['max_size']) {
							$msg = ['status'=>'danger', 'msg'=>'ukuran gambar terlalu besar, max ukuran gambar 3Mb'];
							return $msg;
						}
					}

					if (!empty($_FILES['foto_pelanggan']['name'])) {
						$format = "";
						if ($_FILES['foto_pelanggan']['type'] == "image/png") {
							$format = ".png";
						}elseif ($_FILES['foto_pelanggan']['type'] == "image/jpg") {
							$format = ".jpg";
						}elseif ($_FILES['foto_pelanggan']['type'] == "image/jpeg") {
							$format = ".jpeg";
						}else {
							$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
							return $msg;
						}

						$image_name_p = 'pelanggan-' . date('dmY') . time() . $format;

						$config['upload_path']          = FCPATH .'assets/images/pelanggan/';
						$config['allowed_types']        = '*';
						$config['max_size']             = 3048;
						$config['overwrite']			= true;
						$config['file_name'] = $image_name_p;

						$this->load->library('upload');
						$this->upload->initialize($config);
						if ($this->upload->do_upload('foto_pelanggan')) {
							
						}else{
							$msg['msgs'][] = 'foto pelanggan gagal disimpan';
							return $msg;
						}

					}else{
						$image_name_p = $current_user['foto_pelanggan'];
					}

					if (!empty($_FILES['foto_rumah']['name'])) {
						$format = "";
						if ($_FILES['foto_rumah']['type'] == "image/png") {
							$format = ".png";
						}elseif ($_FILES['foto_rumah']['type'] == "image/jpg") {
							$format = ".jpg";
						}elseif ($_FILES['foto_rumah']['type'] == "image/jpeg") {
							$format = ".jpeg";
						}else {
							$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
							return $msg;
						}


						$image_name_r = 'rumah-' . date('dmY') . time() . $format;

						$config['upload_path']          = FCPATH .'assets/images/rumah/';
						$config['allowed_types']        = '*';
						$config['max_size']             = 3048;
						$config['overwrite']			= true;
						$config['file_name'] = $image_name_r;

						$this->load->library('upload');
						$this->upload->initialize($config);
						if ($this->upload->do_upload('foto_rumah')) {
							
						}else{
							$msg['msgs'][] = 'foto rumah gagal disimpan';
							return $msg;
						}

					}else{
						$image_name_r = $current_user['foto_rumah'];
					}

					if (empty($data['kordinat'])) {
						if (!empty($data['koordinat'])) {
							$data['kordinat'] = $data['koordinat'];
						}else{
							$data['kordinat'] = '-';
						}
					}

					// echo "<pre>";
					// print_r($data);
					// echo "</pre>";die;

					$this->db->where('id', $id);
					if ($this->db->update('pelanggan', [
						'user_id' => get_user()['id'],
						'nama' => $data['nama'],
						'no_tlp' => $data['no_tlp'],
						'prov' => $data['prov'],
						'prov_id' => $data['prov_id'],
						'kab' => $data['kab'],
						'kab_id' => $data['kab_id'],
						'kec' => $data['kec'],
						'kec_id' => $data['kec_id'],
						'desa' => $data['desa'],
						'desa_id' => $data['desa_id'],
						'alamat' => $data['alamat'],
						'alat_biaya' => $data['alat_biaya'],
						'nik' => $data['nik'],
						'kk' => $data['kk'],
						'pekerjaan' => $data['pekerjaan'],
						'kordinat' => $data['kordinat'],
						'foto_pelanggan' => $image_name_p,
						'foto_rumah' => $image_name_r,
						'no_pelanggan' => $data['no_pelanggan'],
						'active' => $current_user['active'],
					])) {
						if (!empty($data['trx']) && !empty($data['ccq'])) {
							$this->db->set([
								'trx' => $data['trx'],
								'ccq' => $data['ccq']
							]);
							$this->db->where('pelanggan_id', $id);
							$this->db->update('pemasangan');
						}
						$msg = ['status' => 'success', 'msg' => 'Pelanggan berhasil disimpan'];
					}
				}
			} else {
				$this->db->select('id');
				$exist = $this->db->get_where('pelanggan', ['nama' => $data['nama']])->row_array();
				if (empty($exist)) {

					if (empty($data['kordinat'])) {
						if (!empty($data['koordinat'])) {
							$data['kordinat'] = $data['koordinat'];
						}else{
							$data['kordinat'] = '-';
						}
					}

					// echo "<pre>";
					// print_r($data);
					// echo "</pre>";die;

					if ($this->db->insert('pelanggan', [
						'user_id' => get_user()['id'],
						'nama' => $data['nama'],
						'no_tlp' => $data['no_tlp'],
						'prov' => $data['prov'],
						'prov_id' => $data['prov_id'],
						'kab' => $data['kab'],
						'kab_id' => $data['kab_id'],
						'kec' => $data['kec'],
						'kec_id' => $data['kec_id'],
						'desa' => $data['desa'],
						'desa_id' => $data['desa_id'],
						'alamat' => $data['alamat'],
						'alat_biaya' => $data['alat_biaya'],
						'nik' => '-',
						'kk' => '-',
						'pekerjaan' => '-',
						'kordinat' => $data['kordinat'],
						'foto_pelanggan' => '-',
						'foto_rumah' => '-',
						'no_pelanggan' => '-',
						'active' => 1,
					])) {
						$msg = ['status' => 'success', 'msg' => 'Pelanggan berhasil disimpan'];
					}
				} else {
					$msg['msgs'][] = 'Pelanggan sudah ada';
				}
			}
		}
		if (!empty($id)) {

			$this->db->select('*');
			$this->db->from('pelanggan a');
			$this->db->join('pemasangan b', 'b.pelanggan_id=a.id', 'inner');
			$this->db->where('a.id', $id);
			$msg['data'] = $this->db->get()->row_array();

		}
		return $msg;
	}

	public function edit_selesai($id=0){
		$msg = [];

		if (!empty($this->input->post())) {
			$msg = ['status' => 'danger', 'msg' => 'pelanggan gagal disimpan'];
			$msg['data'] = $this->db->get_where('pelanggan', ['id'=>$id])->row_array();
			$data = $this->input->post();

			if (!empty($id)) {
				$current_user = $this->db->get_where('pelanggan', ['id' => $id])->row_array();
				if (!empty($current_user['id'])) {

					if (!empty($_FILES['foto_pelanggan']['name']) || !empty($_FILES['foto_pelanggan']['name'])) {
						$sizep = $_FILES['foto_pelanggan']['size']/1000;
						if ($sizep > $config['max_size']) {
							$msg = ['status'=>'danger', 'msg'=>'ukuran gambar terlalu besar, max ukuran gambar 3Mb'];
							return $msg;
						}

						$sizer = $_FILES['foto_rumah']['size']/1000;
						if ($sizer > $config['max_size']) {
							$msg = ['status'=>'danger', 'msg'=>'ukuran gambar terlalu besar, max ukuran gambar 3Mb'];
							return $msg;
						}
					}


					if (!empty($_FILES['foto_pelanggan']['name'])) {
						$format = "";
						if ($_FILES['foto_pelanggan']['type'] == "image/png") {
							$format = ".png";
						}elseif ($_FILES['foto_pelanggan']['type'] == "image/jpg") {
							$format = ".jpg";
						}elseif ($_FILES['foto_pelanggan']['type'] == "image/jpeg") {
							$format = ".jpeg";
						}else {
							$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
							return $msg;
						}

						$image_name_p = 'pelanggan-' . date('dmY') . time() . $format;

						$config['upload_path']          = FCPATH .'assets/images/pelanggan/';
						$config['allowed_types']        = '*';
						$config['file_name'] 			= $image_name_p;
						$config['max_size']             = 3048;
						$config['overwrite']			= TRUE;

						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('foto_pelanggan')) {
							
						}else{
							$msg['msgs'][] = 'foto pelanggan gagal disimpan';
							return $msg;
						}

					}else{
						$image_name_p = $current_user['foto_pelanggan'];
					}

					if (!empty($_FILES['foto_rumah']['name'])) {
						$format = "";
						if ($_FILES['foto_rumah']['type'] == "image/png") {
							$format = ".png";
						}elseif ($_FILES['foto_rumah']['type'] == "image/jpg") {
							$format = ".jpg";
						}elseif ($_FILES['foto_rumah']['type'] == "image/jpeg") {
							$format = ".jpeg";
						}else {
							$msg['msgs'][] = 'format file yang anda masukkan tidak didukung';
							return $msg;
						}

						$image_name_r = 'rumah-' . date('dmY') . time() . $format;

						$config['upload_path']          = FCPATH .'assets/images/rumah/';
						$config['allowed_types']        = '*';
						$config['max_size']             = 3048;
						$config['file_name'] 			= $image_name_r;
						$config['overwrite']			= TRUE;

						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('foto_rumah')) {
							
						}else{
							$msg['msgs'][] = 'foto rumah gagal disimpan';
							return $msg;
						}

					}else{
						$image_name_r = $current_user['foto_rumah'];
					}

					$this->db->set([
						'trx' => $data['trx'],
						'ccq' => $data['ccq'],
					]);

					if (empty($data['kordinat'])) {
						if (!empty($data['koordinat'])) {
							$data['kordinat'] = $data['koordinat'];
						}else{
							$data['kordinat'] = '-';
						}
					}

					$this->db->where('pelanggan_id', $id);
					if ($this->db->update('pemasangan')){
						$this->db->set([
							'nik' => $data['nik'],
							'kordinat' => $data['kordinat'],
							'kk' => $data['kk'],
							'pekerjaan' => $data['pekerjaan'],
							'foto_pelanggan' => $image_name_p,
							'foto_rumah' => $image_name_r,
							'no_pelanggan' => $data['no_pelanggan'],
							'active' => $current_user['active'],
						]);
						$this->db->where('id', $id);
						if ($this->db->update('pelanggan')) {
							redirect(base_url('pemasangan/selesai/' . $id));
						}
					}
				} else {
					die;
					$msg['msgs'][] = 'Pelanggan tidak ditemukan';
					return $msg;
				}
			} else {
				$msg['msgs'][] = 'Pelanggan tidak ditemukan';
				return $msg;
			}
		}
		return $msg;
	}

	public function all($limit, $start, $id = 0)
	{
		$msg = [];
		$filter = @$this->input->get('filter');
		$metode = @$this->input->get('metode');
		$date = @$this->input->get('date');
		$search = @$this->input->post('search');
		if (!empty($filter)) {
			$this->db->select('*, a.created pendaftaran');
			$this->db->from('pelanggan a');
				if ($filter == 2) {
					$this->db->join('pemasangan b', 'b.pelanggan_id=a.id', 'inner');
					$this->db->order_by('a.updated DESC, a.nama ASC');
					if (!empty($search)) {
						$this->db->like('a.nama', $search);
						$this->db->like('a.active', 2);
					}
					$this->db->where('active', 2);
				}elseif ($filter == 3) {
					$this->db->join('pemasangan b', 'b.pelanggan_id=a.id', 'inner');
					$this->db->join('selesai c', 'c.pelanggan_id=a.id', 'inner');
					$this->db->order_by('a.updated DESC, a.nama ASC');
					if (!empty($search)) {
						$this->db->like('a.nama', $search);
						$this->db->like('a.active', 3);
					}
					if (!empty($metode)) {
						$this->db->like('b.metode', $metode);
						$this->db->like('b.pemasangan', 2);
					}
					if (!empty($date)) {
						$this->db->like('c.tgl_pks', $date);
						$this->db->like('a.active', 3);
					}
					$this->db->where('active', 3);
				}elseif ($filter == 1) {
					$this->db->order_by('a.updated DESC, a.nama ASC');
					if (!empty($search)) {
						$this->db->like('a.nama', $search);
						$this->db->like('a.active', 1);
					}
					$this->db->where('active', 1);
				}elseif ($filter == 4) {
					$this->db->order_by('a.updated DESC, a.nama ASC');
					if (!empty($search)) {
						$this->db->like('a.nama', $search);
						$this->db->like('a.active', 4);
					}
					$this->db->where('active', 4);
				}elseif ($filter == 5) {
					$this->db->order_by('a.updated DESC, a.nama ASC');
					if (!empty($search)) {
						$this->db->like('a.nama', $search);
						$this->db->like('a.active', 5);
					}
					$this->db->where('active', 5);
				}else{
					redirect(base_url('pelanggan/list/?filter=1'),'refresh');
				}
			$this->db->limit($limit, $start);
			$msg['data'] = $this->db->get()->result_array();
		}else{
			redirect(base_url('pelanggan/list/?filter=3'),'refresh');
		}

		$this->db->select('alat_list_id');
		$tmp_alat_dipakai = $this->db->get_where('alat_dipakai', ['pelanggan_id' => $id])->result_array();

		if (!empty($tmp_alat_dipakai)) {
			foreach ($tmp_alat_dipakai as $key => $value) {
				$msg['alat'][] = $value['alat_list_id'];
			}
		}

		$msg['maintance'] = $this->db->get_where('maintance', ['status !='=>4])->result_array();

		return $msg;
	}

	public function for_api()
	{
		$this->db->select('id,nama, desa_id');
		return $this->db->get_where('pelanggan', ['active'=>3])->result_array();
	}

	public function detail($id=0)
	{
		$this->db->select('*, b.created pendaftaran');
		$this->db->from('pemasangan a');
		$this->db->join('pelanggan b', 'b.id=a.pelanggan_id', 'inner');
		$this->db->join('selesai c', 'c.pelanggan_id=a.pelanggan_id', 'inner');
		$this->db->where('a.pelanggan_id', $id);
		$msg = $this->db->get()->row_array();

		$this->db->from('alat_dipakai a');
		$this->db->join('alat_list b', 'b.id=a.alat_list_id', 'inner');
		$this->db->join('jenis_alat c', 'c.id=b.alat_jenis_id', 'inner');
		$this->db->where('a.pelanggan_id', $id);
		$msg['alat'] = $this->db->get()->result_array();

		$this->db->from('library_scurity');
		$this->db->where('pelanggan_id', $id);
		$msg['ip'] = $this->db->get()->result_array();
		
		return $msg;
	}

	public function count_pelanggan()
	{
		$metode = @$this->input->get('metode');
		$date = @$this->input->get('date');
		if (!empty($metode) || !empty($date)) {
			$this->db->select('a.id');
			$this->db->from('pelanggan a');
			$this->db->join('pemasangan b', 'b.pelanggan_id=a.id', 'inner');
			$this->db->join('selesai c', 'c.pelanggan_id=a.id', 'inner');
			if (!empty($metode)) {
				$this->db->like('b.metode', $metode);
			}
			if (!empty($date)) {
				$this->db->like('c.tgl_pks', $date);
			}
			$this->db->like('a.active', 3);
			return $this->db->get()->num_rows();
		}elseif (empty($this->input->post('search'))) {
			if (!empty($this->input->get('filter'))) {
				return $this->db->get_where('pelanggan', ['active'=>$this->input->get('filter')])->num_rows();
			}else{
				return $this->db->get_where('pelanggan', ['active'=>2])->num_rows();
			}
		}
	}

	public function pencabutan($id = 0)
	{

		if (!empty($id)) {
			if ($this->db->delete('pemasangan', ['pelanggan_id'=>$id])) {
				$this->db->delete('alat_dipakai', ['pelanggan_id'=>$id]);
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
				$this->db->set([
					'active' => 5
				]);
				$this->db->where('id', $id);
				if ($this->db->update('pelanggan')) {
					return ['status' => 'success', 'msg' => 'PENCABUTAN berhasil dilakukan'];
				}
			}else{
				return ['status' => 'danger', 'msg' => 'PENCABUTAN gagal dilakukan'];
			}
		}else{
			return ['status' => 'danger', 'msg' => 'PENCABUTAN gagal dilakukan'];
		}
	}

	public function blacklist($id = 0)
	{
		if (!empty($id)) {
			$bind_pelanggan = $this->db->get_where('pelanggan', ['id'=>$id])->row_array();
			if ($bind_pelanggan['active'] == 1) {
				$this->db->set([
					'active'=>4
				]);
				$this->db->where('id', $id);
				if ($this->db->update('pelanggan')) {
					return ['status' => 'success', 'msg' => 'data berhasil diblaclist'];
				}else{
					return ['status' => 'danger', 'msg' => 'data gagal diblaclist'];
				}
			}elseif($bind_pelanggan['active'] == 4){
				$this->db->set([
					'active'=>1
				]);
				$this->db->where('id', $id);
				if ($this->db->update('pelanggan')) {
					return ['status' => 'success', 'msg' => 'buka diblaclist berhasil'];
				}else{
					return ['status' => 'danger', 'msg' => 'buka blacklist gagal'];
				}
			}elseif($bind_pelanggan['active'] == 5){
				$this->db->set([
					'active'=>1
				]);
				$this->db->where('id', $id);
				if ($this->db->update('pelanggan')) {
					return ['status' => 'success', 'msg' => 'penghubungan ulang berhasil dilakukan, pelanggan masuk ke calon pelanggan'];
				}else{
					return ['status' => 'danger', 'msg' => 'penghubungan ulang gagal dilakukan'];
				}
			}
		}
	}
}
