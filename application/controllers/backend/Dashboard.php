<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// if (!$this->session->userdata('logged_in')) {
		// 	redirect('backend/login');
		// }
		// $this->user = $this->session->userdata('user');
	}

	public function index()
	{
		/** DATA SEND TO VIEW */
		$trx_pending = $this->db->query("SELECT * FROM tr_log WHERE status ='PENDING'")->num_rows();

		$trx_selesai = $this->db->query("SELECT * FROM tr_log WHERE status ='SELESAI'")->num_rows();

		$trx_cancel = $this->db->query("SELECT * FROM tr_log WHERE status ='CANCEL'")->num_rows();

		$data_content                 = array();
		$data_content['title']        = 'Dashboard';
		$data_content['breadcrumb']   = 'Dashboard';
		$data_content['breadcrumb1']  = 'Index';
		$data_content['trx_pending']  = $trx_pending;
		$data_content['trx_selesai']  = $trx_selesai;
		$data_content['trx_cancel']  = $trx_cancel;

		$config["content_file"] = "dashboard/index";
		$config["content_data"] = $data_content;

		$this->template->initialize($config);
		$this->template->render();
	}
}
