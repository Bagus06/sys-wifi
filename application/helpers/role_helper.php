<?php defined('BASEPATH') OR exit('No direct script access allowed');

function is_admin()
{
	return check_role('admin');
}

function is_net()
{
	return check_role('team_net');
}


function get_user()
{
	$link = str_replace('/', '_', base_url());
	$user = $_SESSION[$link.'_logged_in'];
	return $user;
}

function valid_role($role = '', $id=0)
{
	$output = false;
	if(!empty($role))
	{
		$ci =& get_instance();
		$user = $ci->db->get_where('user_has_role', ['user_id'=>$id])->result_array();
		$idrole = $ci->db->get_where('user_role', ['title'=>$role])->row_array();
		$output = false;
		foreach ($user as $key => $value) 
		{
			if($user[0]['user_role_id'] == $idrole['id']){
				$output = true;
			}
		}
	}
	return $output;
}

function role_by_name($role = ''){
	$output = 0;
	if(!empty($role))
	{
		$ci =& get_instance();
		$idrole = $ci->db->get_where('user_role', ['title'=>$role])->row_array();
		$output = $idrole;
	}
	return $output;
}

function check_role($role = '')
{
	$output = false;
	if(!empty($role))
	{
		$link = str_replace('/', '_', base_url());
		$user = @$_SESSION[$link.'_logged_in']['role'];
		$output = false;
		foreach ($user as $key => $value) 
		{
			if($value['title']==$role){
				$output = true;
			}
		}
	}
	return $output;
}