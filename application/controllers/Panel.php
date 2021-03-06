<?php

class Panel extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
	}



	public function index()
	{
		$this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');
	}

	public function profile()
	{
		$id = isset($_SESSION['id']) ? $_SESSION['id'] : "";
		$row = $this->User_model->get_by_id($id);
		$data = array(
			'button' => 'Update',
			'action' => site_url('dashboard/update_action'),
			'id' => set_value('id', $row->id),
			'nama' => set_value('nama', $row->nama),
			'username' => set_value('username', $row->username),
			'password' => set_value('password', $row->password),
			'role' => set_value('role', $row->role),
		);
		$this->load->view('header');
		$this->load->view('profile', $data);
		$this->load->view('footer');
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->profile($this->input->post('id', TRUE));
		} else {
			$data = array(
				'nama' => $this->input->post('nama', TRUE),
				'username' => $this->input->post('username', TRUE),
				'password' => $this->input->post('password', TRUE),
				'role' => $this->input->post('role', TRUE),
			);

			$this->User_model->update($this->input->post('id', TRUE), $data);
			$_SESSION['pesan'] = "Update Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('dashboard'));
		}
	}

	public function notifikasi(){
		$query= $this->db->query("SELECT * FROM notifikasi where id_user ='0' and status='0'")->result();
		$data=array();
		$id = 0;
		foreach($query as $rows){
			$sub_array=array();
			$sub_array[]=$rows->id;
			$sub_array[]="";
			$sub_array[]=base_url(''.$rows->link.'');
			$sub_array[]=$rows->pesan;
			$data[]=$sub_array;
			
		}

		echo json_encode(array(
			"data"=>$data
		));
	}
	public function _rules()
	{
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('role', 'role', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
