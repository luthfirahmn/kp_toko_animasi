<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// if (!$this->session->userdata('logged_in')) {
		// 	redirect('backend/login');
		// }
		// $this->user = $this->session->userdata('user');
		$this->user = 'admin';
		$this->table = 'ms_product';
	}

	public function index()
	{
		/** DATA SEND TO VIEW */

		$data_content                 = array();
		$data_content['title']        = 'Product';
		$data_content['breadcrumb']   = 'Product';
		$data_content['breadcrumb1']  = 'Product List';


		$config["js"] = 'product/index';
		$config["content_file"] = "product/index";
		$config["content_data"] = $data_content;

		$this->template->initialize($config);
		$this->template->render();
	}

	public function table_list($all_data, $recordsTotal, $recordsFiltered)
	{
		$data = array();
		$number = $_POST['start'];
		foreach ($all_data as $key => $val) {

			$btn_edit = '<button type="button" onclick="myForm_edit(' . $val->id . ')" class="btn btn-icon rounded-circle btn-outline-primary btn-sm">
						<i data-feather="edit"></i> </button>';
			$btn_delete = '<button type="button" onclick="btn_delete(' . $val->id . ')" class="btn btn-icon rounded-circle btn-outline-danger btn-sm">
			<i data-feather="trash"></i> </button>';
			$number++;
			$row = array();
			$row[] = $btn_edit . ' ' . $btn_delete;
			$row[] = '<img src="' . FOLDER_SRC . $val->gambar . '" width="100">';
			$row[] = $val->nama;
			$row[] = $val->judul;
			$row[] = $val->harga;
			$row[] = limit_text($val->desc, 5);
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
		$this->db->select("*");
		$this->db->from($this->table . ' table1');


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
		$this->db->select("*");
		$this->db->from($this->table . ' table1');
		$recordsTotal = $this->db->get()->num_rows();


		/* SELECT COUNT FILTR DATA */
		$this->db->select("*");
		$this->db->from($this->table . ' table1');
		$recordsFiltered = $this->db->get()->result();

		$this->table_list($all_data, $recordsTotal, $recordsFiltered);
	}

	public function form()
	{
		$query = $this->db->query("SELECT *
									FROM ms_kategori
								");
		$kategori = $query->result();


		/** DATA SEND TO VIEW */

		$data_content                 = array();
		$data_content['title']        = 'Product';
		$data_content['breadcrumb']   = 'Product';
		$data_content['breadcrumb1']  = 'Product Form';
		$data_content['status_form']  = 0;
		$data_content['kategori']  = $kategori;


		$config["content_file"] = "product/form";
		$config["content_data"] = $data_content;

		$this->template->initialize($config);
		$this->template->render();
	}

	public function form_edit($param)
	{

		$query = $this->db->query("SELECT *
										FROM {$this->table} table1 
										WHERE id = {$param} 
										");
		$all_data = $query->row();

		/** DATA SEND TO VIEW */

		$data_content                 = array();
		$data_content['title']        = 'Product';
		$data_content['breadcrumb']   = 'Product';
		$data_content['breadcrumb1']  = 'Product Form Edit';
		$data_content['status_form']  = 1;
		$data_content['id']  = $all_data->id;
		$data_content['all_data']  = $all_data;


		$config["content_file"] = "product/form";
		$config["content_data"] = $data_content;

		$this->template->initialize($config);
		$this->template->render();
	}

	public function validation($data)
	{
		foreach ($data as $key => $val) {
			$this->form_validation->set_rules($key, $key, "required");
		}
		if ($this->form_validation->run() == FALSE) {
			return validation_errors();
		} else {
			return false;
		}
	}

	public function add()
	{
		$data = array();
		$data['nama'] 	= $_POST["nama"];
		$data['judul']     	= $_POST['judul'];
		$data['desc'] 	= $_POST["desc"];
		$data['harga'] 	= $_POST["harga"];
		$data['id_kategori'] 	= $_POST["id_kategori"];

		$validation = $this->validation($data);

		$data['rbt'] = date("Y-m-d H:i:s");

		if ($validation) {
			echo json_encode(['error' => true, 'msg' => $validation]);
			die;
		}

		if ($_FILES['gambar']['tmp_name'] == "") {
			echo json_encode(['error' => true, 'msg' => 'Gambar is required']);
			die;
		} else {
			$filename         = isset($_FILES['gambar']['name']) ? $_FILES['gambar']['name'] : NULL;
			$info             = pathinfo($filename);
			$image_name       = url_title(basename($filename, '.' . $info['extension']));
			$random           = get_random_string("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", 5);
			$image_filename   = $image_name . '_' . $random . '.' . $info['extension'];

			if (!file_exists(FOLDER_UPLOAD . $image_filename)) {
				$image_filename = $image_filename;
			}

			$configImage['upload_path']     = FOLDER_UPLOAD;
			$configImage['allowed_types']   = 'jpg|png|gif|jpeg';
			$configImage['max_size']        = 5000;
			$configImage['file_name']       = $image_filename;
			$configImage['overwrite']       = FALSE;

			$this->load->library('upload', $configImage);
			$this->upload->initialize($configImage);

			if (!$this->upload->do_upload("gambar")) {
				$error = $this->upload->display_errors('', '');
				echo json_encode(['error' => true, 'msg' => $error]);
				die;
			} else {
				$data["gambar"] =  $image_filename;
			}
		}


		$this->db->insert($this->table, $data);
		$lastid = $this->db->insert_id();
		if ($lastid > 1) {
			echo json_encode(['error' => false, 'msg' => 'Success insert data']);
		} else {
			echo json_encode(['error' => true, 'msg' => 'Error insert data']);
		}
	}

	public function edit($param)
	{
		$data = array();
		$data['nama'] 	= $_POST["nama"];
		$data['judul']     	= $_POST['judul'];
		$data['desc'] 	= $_POST["desc"];

		$validation = $this->validation($data);

		$data['rbt'] = date("Y-m-d H:i:s");


		if ($validation) {
			echo json_encode(['error' => true, 'msg' => $validation]);
			die;
		}
		$this->db->where('id', $param);
		$update = $this->db->update($this->table, $data);
		if ($update) {
			echo json_encode(['error' => false, 'msg' => 'Success update data']);
		} else {
			echo json_encode(['error' => true, 'msg' => 'Error update data']);
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