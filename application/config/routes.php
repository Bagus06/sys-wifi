<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   	= 'dashboard/list';
$route['dashboard']   			= 'dashboard/list';
$route['user']   			 	= 'user/list';
$route['login']                	= 'user/login';
$route['logout']               	= 'user/logout';
$route['jenis_alat']            = 'jenis_alat/list';
$route['alat_list']            	= 'alat_list/list';
$route['pelanggan']            	= 'pelanggan/list';

$route['404_override']         	= '';
$route['translate_uri_dashes'] 	= FALSE;
