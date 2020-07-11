<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_profile($id=0)
{
	 $ci =& get_instance();
	 $user_profile = $ci->db->get_where('user_profile', ['user_id'=>$id])->row_array();
	 return $user_profile;
}

function get_name($id=0)
{
	 $ci =& get_instance();
	 $ci->db->select('nama');
	 $ci->db->where('user_id', $id);
	 $user_name = $ci->db->get('user_profile')->row_array();
	 $name = $user_name['nama'];
	 return $name;
}

function get_name_pelanggan($id=0)
{
	 $ci =& get_instance();
	 $ci->db->select('nama');
	 $ci->db->where('id', $id);
	 $pelanggan_name = $ci->db->get('pelanggan')->row_array();
	 $name = $pelanggan_name['nama'];
	 return $name;
}

function count_p()
{
	 $pelanggan = [];
	 $ci =& get_instance();
	 $ci->db->where('active', 1);
	 $pelanggan['calon'] = $ci->db->get('pelanggan')->num_rows();

	 $ci->db->where('active', 2);
	 $pelanggan['proses'] = $ci->db->get('pelanggan')->num_rows();

	 $ci->db->where('active', 3);
	 $pelanggan['active'] = $ci->db->get('pelanggan')->num_rows();

	 $ci->db->where('active', 4);
	 $pelanggan['bl'] = $ci->db->get('pelanggan')->num_rows();

	 $ci->db->where('active', 5);
	 $pelanggan['dc'] = $ci->db->get('pelanggan')->num_rows();

	 return $pelanggan;
}