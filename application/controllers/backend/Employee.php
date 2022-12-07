<?php defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('backend/login');
		}
		$this->user = $this->session->userdata('user');
	}

	public function index()
	{
		/** DATA SEND TO VIEW */
		if (privilage($this->user, "employee", "MAdd")) {
			$bt_add = 1;
		} else {
			$bt_add = 0;
		}
		$data_content                 = array();
		$data_content['bt_add']       = $bt_add;
		$data_content['title']        = 'Employee ';
		$data_content['breadcrumb']   = 'Dashboard';
		$data_content['breadcrumb1']  = 'Employee ';
		$data_content['data_tabel']   = 'DataTable Employee ';
		$data_content['success_msg']  = $this->session->flashdata("success_msg");
		$data_content['error_msg']    = $this->session->flashdata("error_msg");
		$data_content['info_msg']     = $this->session->flashdata("info_msg");

		$config["content_file"] = "Employee/index";
		$config["content_data"] = $data_content;

		$this->template->initialize($config);
		$this->template->render();
	}

	public function get_list()
	{
		/* SELECT DATA ALL */
		$this->db->select("*, (SELECT ParamValue FROM ms_parameter p WHERE ParamVariable = 'PROPERTY' AND p.ParamID = ms_employee.Property) AS PropertyValue ");
		$this->db->from("ms_employee");
		$this->db->where("(EmpID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or FullName LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or Department LIKE '%" . $_REQUEST['search']['value'] . "%'
                            or Position LIKE '%" . $_REQUEST['search']['value'] . "%'
                            )");


		/* ORDER */
		$order = array('RBT' => 'DESC');
		$order  = $this->input->post("order");
		$col = 0;
		$dir = "";
		if (empty($order)) {
			$this->db->order_by("RBT", "DESC");
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
			0 => 'EmpID',
			1 => 'FullName',
			2 => 'Department',
			3 => 'Position',
			4 => 'Email',
			5 => 'Active',
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
		$this->db->select("*, (SELECT ParamValue FROM ms_parameter p WHERE ParamVariable = 'PROPERTY' AND p.ParamID = ms_employee.Property) AS PropertyValue");
		$this->db->from("ms_employee");
		$recordsTotal = $this->db->get()->num_rows();


		/* SELECT COUNT FILTR DATA */
		$this->db->select("* , (SELECT ParamValue FROM ms_parameter p WHERE ParamVariable = 'PROPERTY' AND p.ParamID = ms_employee.Property) AS PropertyValue");
		$this->db->from("ms_employee");
		$this->db->where("(EmpID LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or FullName LIKE '%" . $_REQUEST['search']['value'] . "%' 
                            or Department LIKE '%" . $_REQUEST['search']['value'] . "%'
                            or Position LIKE '%" . $_REQUEST['search']['value'] . "%'
                            )");
		$recordsFiltered = $this->db->get()->result();

		$urlAc = "'" . base_url("backend/Employee/active") . "'";
		$urlDl = "'" . base_url("backend/Employee/delete") . "'";
		$path = "upload/EMPLOYEE/";


		$data = array();
		$number = $_POST['start'];
		foreach ($all_data as $key => $val) {
			$number++;
			$row = array();
			// $row[] = $number;
			$row[] = $val->EmpID;
			// $row[] = '<center><img src="' . base_url($path) . $val->EmpPhoto . '" width="200" height="100"></center>';
			$row[] = $val->FullName;
			$row[] = $val->Department;
			$row[] = $val->Position;
			$row[] = $val->PropertyValue;
			// $row[] = $val->Phone;
			$row[] = $val->Email;
			// $row[] = $val->Bank;
			// $row[] = $val->BankAccountNo;
			$row[] = $val->Active != 1 ? '<center>' . Buttons("disabled", "myActive($val->DID, 1, $urlAc)") . '</center>' :
				'<center>' . Buttons("actived", "myActive($val->DID, 0, $urlAc)") . '</center>';
			// $row[] = $val->RBU;
			// $row[] = date("d-M-Y H:i:s", strtotime($val->RBT));
			$row[] = '<center><button type="button" class="btn btn-primary btn-sm" onclick="detailModal(' . $val->DID . ')"><i class="fas fa-info-circle"></i></button></center>';
			if (privilage($this->user, "employee", "MEdit")) {
				$bt_edit =  Buttons("edit", "location.href='" . base_url("/backend/Employee/form_edit/" . $val->DID . "") . "'");
			} else {
				$bt_edit =  "";
			}

			if (privilage($this->user, "employee", "MDelete")) {
				$bt_delete =  Buttons("delete", "myDelete($val->DID, $urlDl)");
			} else {
				$bt_delete =  "";
			}

			$row[] = '<center>' . $bt_edit . " " .  $bt_delete . '</center>';
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


	public function detail()
	{
		$query = $this->db->query("SELECT *
								   FROM ms_employee
								   WHERE DID = '{$this->input->post("id")}'
								 ");
		$result = $query->row();

		$output = "";

		$output .= '
				<div class="table-responsive">  
					<table class="table">';
		$output .= '  
						<tr>  
							<td width="30%"><label>Employee ID</label></td>  
							<td width="70%">' . $result->EmpID . '</td>  
						</tr>
						<tr>  
							<td width="30%"><label>Photo</label></td>  
							<td width="70%"><img src="' . base_url("upload/EMPLOYEE/") . $result->EmpPhoto . '" width="200" height="100"></td>  
						</tr>
						<tr>  
							<td width="30%"><label>Name</label></td>  
							<td width="70%">' . $result->FullName . '</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Department</label></td>  
							<td width="70%">' . $result->Department . '</td>  
						</tr>
						<tr>  
							<td width="30%"><label>Position</label></td>  
							<td width="70%">' . $result->Position . '</td>  
						</tr>
						<tr>  
							<td width="30%"><label>Phone</label></td>  
							<td width="70%">' . $result->Phone . '</td>  
						</tr>
						<tr>  
							<td width="30%"><label>Email</label></td>  
							<td width="70%">' . $result->Email . '</td>  
						</tr>
						<tr>  
							<td width="30%"><label>Bank</label></td>  
							<td width="70%">' . $result->Bank . '</td>  
						</tr>
						<tr>  
							<td width="30%"><label>Bank Account</label></td>  
							<td width="70%">' . $result->BankAccountNo . '</td>  
						</tr>
						';
		$output .= "
					</table>
				</div>
				";
		echo $output;
	}

	public function active()
	{
		if ($this->input->post("DID") != "") {
			// pre($_POST);
			$data["Active"] = $this->input->post("active");
			// $data["RBU"]    = $this->user;
			$data["RBT"]    = dateSekarang();

			$this->db->save_queries = TRUE;
			$this->db->where("DID", $this->input->post("DID"));
			$this->db->update("ms_employee", $data);

			if ($this->db->affected_rows() > 0 ? TRUE : FALSE) {
				$sql         = $this->db->last_query();
				$page         = base_url('backend/Employee/active');
				tr_log($sql, $page, $this->user);

				$res = array(
					"status" => true,
				);
				echo json_encode($res);
			} else {
				$res = array(
					"status" => false
				);
				echo json_encode($res);
			}
		} else {
			$res = array(
				"status" => "Invalid Id"
			);
			echo json_encode($res);
		}
	}

	public function delete()
	{
		if ($this->input->post("DID") != "") {

			$this->db->save_queries = TRUE;
			$this->db->where('DID', $this->input->post("DID"));
			$this->db->delete('ms_employee');

			if ($this->db->affected_rows() > 0 ? TRUE : FALSE) {

				$sql         = $this->db->last_query();
				$page         = base_url('backend/Employee/delete');
				tr_log($sql, $page, $this->user);

				$res = array(
					"status" => true,
				);
				echo json_encode($res);
			} else {

				$res = array(
					"status" => false
				);
				echo json_encode($res);
			}
		} else {
			$res = array(
				"status" => "Invalid Id"
			);
			echo json_encode($res);
		}
	}

	public function form($id = null)
	{
		/* DATA ACTIVE */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "EMPLOYEE");
		$query = $this->db->get();
		$active = $query->result();

		/* DATA DEPARTMENT */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "DEPARTMENT");
		$query = $this->db->get();
		$department = $query->result();

		/* DATA POSITION */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "POSITION");
		$query = $this->db->get();
		$position = $query->result();

		/* DATA PROPERTY */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "PROPERTY");
		$query = $this->db->get();
		$property = $query->result();

		/* DATA ACTIVE */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "BANK");
		$query = $this->db->get();
		$bank = $query->result();

		$data_content                 = array();
		$data_content['success_msg']  = $this->session->flashdata("success_msg");
		$data_content['error_msg']    = $this->session->flashdata("error_msg");
		$data_content['info_msg']     = $this->session->flashdata("info_msg");
		$data_content['status_edit']  = 0;
		$data_content['title']        = 'Employee Form';
		$data_content['breadcrumb']   = 'List Employee';
		$data_content['breadcrumb1']  = 'Employee Form';
		$data_content['data_tabel']   = 'Employee Form';
		$data_content['active']       = $active;
		$data_content['department']   = $department;
		$data_content['position']     = $position;
		$data_content['bank']         = $bank;
		$data_content['property']     = $property;

		$config["content_file"] = "Employee/form";
		$config["content_data"] = $data_content;

		$this->template->initialize($config);
		$this->template->render();
	}

	public function add()
	{
		$this->form_validation->set_error_delimiters('', '<br>');
		$this->form_validation->set_rules('EmpID', 'Employee ID', 'required');
		$this->form_validation->set_rules('FirstName', 'Firstname', 'required');
		$this->form_validation->set_rules('LastName', 'Lastname', 'required');
		$this->form_validation->set_rules('Department', 'Department', 'required');
		$this->form_validation->set_rules('Position', 'Position', 'required');
		$this->form_validation->set_rules('Property', 'Property', 'required');
		$this->form_validation->set_rules('Email', 'Email', 'required|valid_email|is_unique[ms_employee.email]');
		$this->form_validation->set_rules('Active', 'Active', 'required');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			echo json_encode(['error' => $errors]);
		} else {

			$insert["EmpID"]                 = $this->input->post("EmpID");
			$insert["FullName"]              = $this->input->post("FirstName") . ' ' . $this->input->post("LastName");
			$insert["FirstName"]             = $this->input->post("FirstName");
			$insert["LastName"]              = $this->input->post("LastName");
			$insert["Department"]           = $this->input->post("Department");
			$insert["Position"]              = $this->input->post("Position");
			$insert["Property"]              = $this->input->post("Property");
			$insert["Phone"]                 = $this->input->post("Phone");
			$insert["Email"]                 = $this->input->post("Email");
			$insert["Bank"]                  = $this->input->post("Bank");
			$insert["BankAccountNo"]         = $this->input->post("BankAccountNo");
			$insert["Active"]                = $this->input->post("Active");
			$insert["RBU"]                    = $this->user;
			$insert["RBT"]                   = dateSekarang();

			if ($_FILES['EmpPhoto']['tmp_name'] == "") {
				$this->db->save_queries = TRUE;
				$this->db->insert("ms_employee", $insert);

				if ($this->db->insert_id() > 1) {

					$sql         = $this->db->last_query();
					$page         = base_url('backend/Employee/add');
					tr_log($sql, $page, $this->user);

					$DID = $this->db->query("SELECT DID FROM ms_employee ORDER BY DID DESC LIMIT 1")->row()->DID;

					echo json_encode(['success' => 'Berhasil']);
				} else {
					echo json_encode(['error' => 'error insert employee']);
				}
			} else {
				$filename         = isset($_FILES['EmpPhoto']['name']) ? $_FILES['EmpPhoto']['name'] : NULL;
				$info             = pathinfo($filename);
				$image_name       = url_title(basename($filename, '.' . $info['extension']));
				$random           = get_random_string("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", 5);
				$image_filename   = $image_name . '_' . $random . '.' . $info['extension'];

				if (!file_exists(IMAGE_BLOCK_APPS_ROOT_EMPLOYEE . $image_filename)) {
					$image_filename = $image_filename;
				}

				$configImage['upload_path']     = IMAGE_BLOCK_APPS_ROOT_EMPLOYEE;
				$configImage['allowed_types']   = 'jpg|png|gif|jpeg';
				$configImage['max_size']        = 500;
				$configImage['file_name']       = $image_filename;
				$configImage['overwrite']       = FALSE;


				$this->load->library('upload', $configImage);
				$this->upload->initialize($configImage);

				if (!$this->upload->do_upload("EmpPhoto")) {
					$error = $this->upload->display_errors('', '');
					echo json_encode(['error' => $error]);
				} else {
					$file   = IMAGE_BLOCK_APPS_ROOT_EMPLOYEE . $image_filename;

					$NewImageWidth          = 400;
					$NewImageHeight         = 400;
					$Quality                = 50;

					resizeImage($file, $file, $NewImageWidth, $NewImageHeight, $Quality);


					$insert["EmpPhoto"] =  $image_filename;

					$this->db->save_queries = TRUE;
					$this->db->insert("ms_employee", $insert);

					if ($this->db->insert_id() > 1) {

						$sql         = $this->db->last_query();
						$page         = base_url('backend/Employee/add');
						tr_log($sql, $page, $this->user);

						$DID = $this->db->query("SELECT DID FROM ms_employee ORDER BY DID DESC LIMIT 1")->row()->DID;

						echo json_encode(['success' => 'Berhasil']);
					} else {
						echo json_encode(['error' => 'error insert data']);
					}
				}
			}
		}
	}

	public function form_edit($id = null)
	{

		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "EMPLOYEE");
		$query = $this->db->get();
		$active = $query->result();


		/* DATA DEPARTMENT */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "DEPARTMENT");
		$query = $this->db->get();
		$department = $query->result();

		/* DATA POSITION */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "POSITION");
		$query = $this->db->get();
		$position = $query->result();

		/* DATA ACTIVE */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "PROPERTY");
		$query = $this->db->get();
		$property = $query->result();

		/* DATA ACTIVE */
		$this->db->select("*");
		$this->db->from("ms_parameter");
		$this->db->where("ParamVariable", "BANK");
		$query = $this->db->get();
		$bank = $query->result();



		$this->db->select("* , (SELECT ParamValue FROM ms_parameter p WHERE ParamVariable = 'PROPERTY' AND p.ParamID = ms_employee.Property) AS PropertyValue");
		$this->db->from("ms_employee");
		$this->db->where("DID", $id);

		$query = $this->db->get();
		$result = $query->row();

		if (!$result) {
			$this->session->set_flashdata("error_msg", "Empty ID");
			redirect('backend/Employee');
		}

		$data_content                 = array();
		$data_content['success_msg']  = $this->session->flashdata("success_msg");
		$data_content['error_msg']    = $this->session->flashdata("error_msg");
		$data_content['info_msg']     = $this->session->flashdata("info_msg");
		$data_content['status_edit']  = 1;
		$data_content['title']        = 'General Form';
		$data_content['breadcrumb']   = 'List Employee';
		$data_content['breadcrumb1']  = 'Employee Form Update';
		$data_content['data_tabel']   = 'Employee Form Update';
		$data_content['all_data']     = $result;
		$data_content['active']       = $active;
		$data_content['department']   = $department;
		$data_content['position']     = $position;
		$data_content['property']     = $property;
		$data_content['bank']         = $bank;

		$config["content_file"] = "Employee/form";
		$config["content_data"] = $data_content;

		$this->template->initialize($config);
		$this->template->render();
	}

	public function edit($did = null)
	{
		$this->form_validation->set_error_delimiters('', '<br>');
		$this->form_validation->set_rules('EmpID', 'Employee ID', 'required');
		$this->form_validation->set_rules('FirstName', 'Firstname', 'required');
		$this->form_validation->set_rules('LastName', 'Lastname', 'required');
		$this->form_validation->set_rules('Department', 'Department', 'required');
		$this->form_validation->set_rules('Position', 'Position', 'required');
		$this->form_validation->set_rules('Property', 'Property', 'required');
		$this->form_validation->set_rules('Email', 'Email', 'required');
		$this->form_validation->set_rules('Active', 'Active', 'required');


		/*$this->form_validation->set_rules('Phone','Phone', 'required');
		$this->form_validation->set_rules('Bank','Bank', 'required');
		$this->form_validation->set_rules('BankAccountNo','No Bank Account', 'required');*/
		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
			echo json_encode(['error' => $errors]);
		} else {

			if ($this->input->post()) {
				$update["EmpID"]                 = $this->input->post("EmpID");
				$update["FullName"]              = $this->input->post("FirstName") . ' ' . $this->input->post("LastName");
				$update["FirstName"]             = $this->input->post("FirstName");
				$update["LastName"]              = $this->input->post("LastName");
				$update["Department"]            = $this->input->post("Department");
				$update["Position"]              = $this->input->post("Position");
				$update["Property"]              = $this->input->post("Property");
				$update["Phone"]                 = $this->input->post("Phone");
				$update["Email"]                 = $this->input->post("Email");
				$update["Bank"]                  = $this->input->post("Bank");
				$update["BankAccountNo"]         = $this->input->post("BankAccountNo");
				$update["Active"]                = $this->input->post("Active");
				$update["RBU"]                   = $this->user;
				$update["RBT"]                   = dateSekarang();

				if ($_FILES['EmpPhoto']['name'] == "") :

					$this->db->select("*");
					$this->db->from("ms_employee");
					$this->db->where("DID", $did);

					$result = $this->db->get()->row();

					$update['EmpPhoto'] = $result->EmpPhoto;

					$this->db->save_queries = TRUE;
					$this->db->where("DID", $did);
					$this->db->update("ms_employee", $update);
					$sql         = $this->db->last_query();
					$page         = base_url('backend/Employee/edit');
					tr_log($sql, $page, $this->user);

					echo json_encode(['success' => 'Berhasil']);

				else :

					$filename         = isset($_FILES['EmpPhoto']['name']) ? $_FILES['EmpPhoto']['name'] : NULL;
					$info             = pathinfo($filename);
					$image_name       = url_title(basename($filename, '.' . $info['extension']));
					$random           = get_random_string("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", 5);
					$image_filename   = $image_name . '_' . $random . '.' . $info['extension'];

					if (!file_exists(IMAGE_BLOCK_APPS_ROOT_EMPLOYEE . $image_filename)) {
						$image_filename = $image_filename;
					}

					$configImage['upload_path']     = IMAGE_BLOCK_APPS_ROOT_EMPLOYEE;
					$configImage['allowed_types']   = 'jpg|png|gif|jpeg';
					$configImage['max_size']        = 500;
					$configImage['file_name']       = $image_filename;
					$configImage['overwrite']       = FALSE;


					$this->load->library('upload', $configImage);
					$this->upload->initialize($configImage);


					if (!$this->upload->do_upload("EmpPhoto")) {
						$error = $this->upload->display_errors('', '');
						echo json_encode(['error' => $error]);
					} else {
						$file   = IMAGE_BLOCK_APPS_ROOT_EMPLOYEE . $image_filename;

						$NewImageWidth          = 400;
						$NewImageHeight         = 400;
						$Quality                = 50;

						resizeImage($file, $file, $NewImageWidth, $NewImageHeight, $Quality);
						$update["EmpPhoto"] =  $image_filename;

						$this->db->save_queries = TRUE;
						$this->db->where("DID", $did);
						$this->db->update("ms_employee", $update);
						$sql         = $this->db->last_query();
						$page         = base_url('backend/Employee/edit');
						tr_log($sql, $page, $this->user);

						echo json_encode(['success' => 'Berhasil']);
					}

				endif;
			}
		}
	}
}
