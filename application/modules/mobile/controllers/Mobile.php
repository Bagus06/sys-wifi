<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller
{
	public function home()
	{
		$this->load->view('index');
	}
}