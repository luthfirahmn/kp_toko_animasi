<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// if (!$this->session->userdata('logged_in')) {
		// 	redirect('backend/login');
		// }
		// $this->user = $this->session->userdata('user');
		$this->user = 'admin';
		$this->table = 'tr_log';
	}

	public function index()
	{
		/** DATA SEND TO VIEW */

		$data_content                 = array();
		$data_content['title']        = 'Transaksi';
		$data_content['breadcrumb']   = 'Transaksi';
		$data_content['breadcrumb1']  = 'Transaksi List';


		$config["content_file"] = "transaksi/index";
		$config["content_data"] = $data_content;

		$this->template->initialize($config);
		$this->template->render();
	}

	public function table_list($all_data, $recordsTotal, $recordsFiltered)
	{
		$data = array();
		$number = $_POST['start'];
		foreach ($all_data as $key => $val) {

			$btn_delete = '<button type="button" onclick="btn_delete(' . $val->id . ')" class="btn btn-icon rounded-circle btn-outline-danger btn-sm">
			<i data-feather="trash"></i> </button>';
			$btn_status = '<button type="button" onclick="change_status(' . $val->id . ')" class="btn btn-icon rounded-circle btn-outline-primary btn-sm">
			<i data-feather="settings"></i> </button>';

			switch ($val->status) {
				case 'PENDING':
					$span_status = '<span class="badge badge-warning">Pending</span>';
					break;
				case 'SELESAI':
					$span_status = '<span class="badge badge-success">Selesai</span>';
					break;
				case 'CANCEL':
					$span_status = '<span class="badge badge-danger">Cancel</span>';
					break;
				default:
					$span_status = '<span class="badge badge-secondary">Invalid</span>';
					break;
			}
			$number++;
			$row = array();
			$row[] = $btn_delete . ' ' . $btn_status;
			$row[] = $val->nama;
			$row[] = $val->nama_lengkap;
			$row[] = 'Rp. ' . $val->harga;
			$row[] = date("d M Y / H:i", strtotime($val->tgl_transaksi));
			$row[] = $span_status;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $recordsTotal,
			"recordsFiltered" => count($recordsFiltered),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function get_list()
	{
		/* SELECT DATA ALL */
		$this->db->select("table1.*, t2.nama_lengkap, t3.nama,t3.harga");
		$this->db->from($this->table . ' table1');
		$this->db->join("ms_customer as t2", "table1.id_customer  = t2.id", "LEFT");
		$this->db->join("ms_product as t3", "table1.id_product  = t3.id", "LEFT");


		/* ORDER */
		$order = array('id' => 'DESC');
		$order  = $this->input->post("order");
		$col = 0;
		$dir = "";
		if (empty($order)) {
			$this->db->order_by("id", "DESC");
		} else {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}
		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}
		$valid_columns = array(
			// 0 => 'EmpID',
			// 1 => 'FullName',
			// 2 => 'Department',
			// 3 => 'Position',
			// 4 => 'Email',
			// 5 => 'Active',
		);

		if (!isset($valid_columns[$col])) {
			$ordr = null;
		} else {
			$ordr = $valid_columns[$col];
		}
		if ($ordr != null) {
			$this->db->order_by($ordr, $dir);
		}

		if ($_REQUEST['length'] != -1)
			$this->db->limit($_REQUEST['length'], $_REQUEST['start']);
		$all_data = $this->db->get()->result();



		/* SELECT COUNT DATA ALL */
		$this->db->select("table1.*, t2.nama_lengkap, t3.nama,t3.harga");
		$this->db->from($this->table . ' table1');
		$this->db->join("ms_customer as t2", "table1.id_customer  = t2.id", "LEFT");
		$this->db->join("ms_product as t3", "table1.id_product  = t3.id", "LEFT");
		$recordsTotal = $this->db->get()->num_rows();


		/* SELECT COUNT FILTR DATA */
		$this->db->select("table1.*, t2.nama_lengkap, t3.nama,t3.harga");
		$this->db->from($this->table . ' table1');
		$this->db->join("ms_customer as t2", "table1.id_customer  = t2.id", "LEFT");
		$this->db->join("ms_product as t3", "table1.id_product  = t3.id", "LEFT");
		$recordsFiltered = $this->db->get()->result();

		$this->table_list($all_data, $recordsTotal, $recordsFiltered);
	}

	public function change_status()
	{
		$data = array();
		$id	= $_POST["id"];
		$data['status']   = $_POST['status'];

		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $data);
		if ($update) {
			echo json_encode(['error' => false, 'msg' => 'Sukses merubah status..']);
		} else {
			echo json_encode(['error' => true, 'msg' => 'Error merubah status']);
		}
	}

	public function delete()
	{
		$this->db->where('id', $_POST['id']);
		$this->db->delete($this->table);

		if ($this->db->affected_rows() > 0 ? TRUE : FALSE) {
			echo json_encode(['error' => false, 'msg' => 'Sukses menghapus  data']);
		} else {
			echo json_encode(['error' => true, 'msg' => 'Gagal menghapus data']);
		}
	}
}