<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

	public function index()
	{
		$query = $this->db->query("SELECT * FROM ms_contact");
		$result = $query->row();

		$data['content']            =    'frontend/contact';
		$data['data']            	=    $result;
		$this->load->view('frontend/app', $data);
	}
}
