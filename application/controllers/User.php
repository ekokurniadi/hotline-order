<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$user = $this->User_model->get_all();

		$data = array(
			'user_data' => $user
		);
		$this->load->view('header');
		$this->load->view('user/user_list', $data);
		$this->load->view('footer');
	}

	public function fetch_data()
	{
		$starts       = $this->input->post("start");
		$length       = $this->input->post("length");
		$LIMIT        = "LIMIT $starts, $length ";
		$draw         = $this->input->post("draw");
		$search       = $this->input->post("search")["value"];
		$orders       = isset($_POST["order"]) ? $_POST["order"] : '';

		$where = "WHERE 1=1 and role != 'user'";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (nama_lengkap LIKE '%$search%'
							OR jenis_kelamin LIKE '%$search%'
							OR alamat LIKE '%$search%'
							OR no_hp LIKE '%$search%'
							OR username LIKE '%$search%'
							OR password LIKE '%$search%'
							OR role LIKE '%$search%'
							OR status LIKE '%$search%'
						 )";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['nama_lengkap', 'jenis_kelamin', 'alamat', 'no_hp', 'username', 'password', 'role', 'status',];
				$order_clm  = $order_column[$order[0]['column']];
				$order_by   = $order[0]['dir'];
				$where .= " ORDER BY $order_clm $order_by ";
			} else {
				$where .= " ORDER BY id ASC ";
			}
		} else {
			$where .= " ORDER BY id ASC ";
		}
		if (isset($LIMIT)) {
			if ($LIMIT != '') {
				$where .= ' ' . $LIMIT;
			}
		}
		$index = 1;
		$button = "";
		$fetch = $this->db->query("SELECT * from user $where");
		$fetch2 = $this->db->query("SELECT * from user where role != 'user'");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('user/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
			$button2 = "<a href=" . base_url('user/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
			$button3 = "<a href=" . base_url('user/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='icon-copy dw dw-delete-3'></i></a>";

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->nama_lengkap;
			$sub_array[] = $rows->jenis_kelamin;
			$sub_array[] = $rows->alamat;
			$sub_array[] = $rows->no_hp;
			$sub_array[] = $rows->username;
			$sub_array[] = $rows->password;
			$sub_array[] = $rows->role;
			$sub_array[] = $rows->status;

			$sub_array[] = '<div class="table-actions">' . $button1 . " " . $button2 . " " . $button3 . '</div>';
			$result[]      = $sub_array;
			$index++;
		}
		$output = array(
			"draw"            =>     intval($this->input->post("draw")),
			"recordsFiltered" =>     $fetch2->num_rows(),
			"data"            =>     $result,

		);
		echo json_encode($output);
	}

	public function read($id)
	{
		$row = $this->User_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'nama_lengkap' => $row->nama_lengkap,
				'jenis_kelamin' => $row->jenis_kelamin,
				'alamat' => $row->alamat,
				'no_hp' => $row->no_hp,
				'username' => $row->username,
				'password' => $row->password,
				'role' => $row->role,
				'status' => $row->status,
			);
			$this->load->view('header');
			$this->load->view('user/user_read', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('user'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('user/create_action'),
			'id' => set_value('id'),
			'nama_lengkap' => set_value('nama_lengkap'),
			'jenis_kelamin' => set_value('jenis_kelamin'),
			'alamat' => set_value('alamat'),
			'no_hp' => set_value('no_hp'),
			'username' => set_value('username'),
			'password' => set_value('password'),
			'role' => set_value('role'),
			'status' => set_value('status'),
		);

		$this->load->view('header');
		$this->load->view('user/user_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'no_hp' => $this->input->post('no_hp', TRUE),
				'username' => $this->input->post('username', TRUE),
				'password' => $this->input->post('password', TRUE),
				'role' => $this->input->post('role', TRUE),
				'status' => $this->input->post('status', TRUE),
			);

			$this->User_model->insert($data);
			$_SESSION['pesan'] = "Create Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('user'));
		}
	}

	public function update($id)
	{
		$row = $this->User_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('user/update_action'),
				'id' => set_value('id', $row->id),
				'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
				'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
				'alamat' => set_value('alamat', $row->alamat),
				'no_hp' => set_value('no_hp', $row->no_hp),
				'username' => set_value('username', $row->username),
				'password' => set_value('password', $row->password),
				'role' => set_value('role', $row->role),
				'status' => set_value('status', $row->status),
			);
			$this->load->view('header');
			$this->load->view('user/user_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('user'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'no_hp' => $this->input->post('no_hp', TRUE),
				'username' => $this->input->post('username', TRUE),
				'password' => $this->input->post('password', TRUE),
				'role' => $this->input->post('role', TRUE),
				'status' => $this->input->post('status', TRUE),
			);

			$this->User_model->update($this->input->post('id', TRUE), $data);
			$_SESSION['pesan'] = "Update Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('user'));
		}
	}

	public function delete($id)
	{
		$row = $this->User_model->get_by_id($id);

		if ($row) {
			$this->User_model->delete($id);
			$_SESSION['pesan'] = "Delete Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('user'));
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('user'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('role', 'role', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-02-04 02:32:12 */
/* https://gocodings.web.com */
