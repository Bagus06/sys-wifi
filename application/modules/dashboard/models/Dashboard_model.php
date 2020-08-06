<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_model
{
	public function all()
	{
		$this->db->select('alat_biaya, active, desa_id, desa');
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

		$msg['agndm']	= [];
		$msg['agndbs']	= [];

		$this->db->select('status');
		$bind_agenda = $this->db->get('agenda')->result_array();

		foreach ($bind_agenda as $key => $vba) {
			if ($vba['status'] == 1) {
				$msg['agndm'][$key]	= [$vba];
			}
			if ($vba['status'] == 2) {
				$msg['agndbs'][$key]	= [$vba];
			}
		}

		$msg['lhi']		= [];
		$msg['lbi']	= [];

		$this->db->select('created');
		$bind_laporan = $this->db->get('laporan')->result_array();

		foreach ($bind_laporan as $key => $vbl) {
			if (echo_date($vbl['created']) == date("j F Y")) {
				$msg['lhi'][$key]	= [$vbl];
			}
			if (echo_date_month($vbl['created']) == date("F")) {
				$msg['lbi'][$key]	= [$vbl];
			}
		}

		$templevelpa='-';
		$newkeypa=0;
		$grouparrpa[$templevelpa]="";

		foreach ($bind_pelanggan as $key => $val) {
			if ($val['active'] == 3) {
				if ($templevelpa==$val['desa']){
					$grouparrpa[$templevelpa][$newkeypa]=$val['desa_id'];
				} else {
					$grouparrpa[$val['desa']][$newkeypa]=$val['desa_id'];
				}
				$newkeypa++;
			}
		}

		$msg['jml_desa_pa']=[];
		$forkeypa=0;
		foreach ($grouparrpa as $key => $vco) {
			++$forkeypa;
			$msg['jml_desa_pa'][$key] = count((array)$grouparrpa[$key]);
		}

		$templevelcp='-';
		$newkeycp=0;
		$grouparrcp[$templevelcp]="";

		foreach ($bind_pelanggan as $key => $val) {
			if ($val['active'] == 1) {
				if ($templevelcp==$val['desa']){
					$grouparrcp[$templevelcp][$newkeycp]=$val['desa_id'];
				} else {
					$grouparrcp[$val['desa']][$newkeycp]=$val['desa_id'];
				}
				$newkeycp++;
			}
		}

		$msg['jml_desa_cp']=[];
		$forkeycp=0;
		foreach ($grouparrcp as $key => $vco) {
			++$forkeycp;
			$msg['jml_desa_cp'][$key] = count((array)$grouparrcp[$key]);
		}

		$templeveldp='-';
		$newkeydp=0;
		$grouparrdp[$templeveldp]="";

		foreach ($bind_pelanggan as $key => $val) {
			if ($val['active'] == 2) {
				if ($templeveldp==$val['desa']){
					$grouparrdp[$templeveldp][$newkeydp]=$val['desa_id'];
				} else {
					$grouparrdp[$val['desa']][$newkeydp]=$val['desa_id'];
				}
				$newkeydp++;
			}
		}

		$msg['jml_desa_dp']=[];
		$forkeydp=0;
		foreach ($grouparrdp as $key => $vco) {
			++$forkeydp;
			$msg['jml_desa_dp'][$key] = count((array)$grouparrdp[$key]);
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