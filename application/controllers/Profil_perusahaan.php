<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Profil_perusahaan extends MY_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->load->model('Profil_perusahaan_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$profil_perusahaan = $this->Profil_perusahaan_model->get_all();

		$data = array(
			'profil_perusahaan_data' => $profil_perusahaan
		);
		$this->load->view('header');
		$this->load->view('profil_perusahaan/profil_perusahaan_list', $data);
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

		$where = "WHERE 1=1";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (logo LIKE '%$search%'
				OR alamat LIKE '%$search%'
	 		)";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['logo', 'alamat',];
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
		$fetch = $this->db->query("SELECT * from profil_perusahaan $where");
		$fetch2 = $this->db->query("SELECT * from profil_perusahaan ");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('profil_perusahaan/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
			$button2 = "<a href=" . base_url('profil_perusahaan/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
			$button3 = "<a href=" . base_url('profil_perusahaan/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->logo;
			$sub_array[] = $rows->alamat;

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
		$row = $this->Profil_perusahaan_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'logo' => $row->logo,
				'alamat' => $row->alamat,
			);
			$this->load->view('header');
			$this->load->view('profil_perusahaan/profil_perusahaan_read', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('profil_perusahaan'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('profil_perusahaan/create_action'),
			'id' => set_value('id'),
			'logo' => set_value('logo'),
			'alamat' => set_value('alamat'),
		);

		$this->load->view('header');
		$this->load->view('profil_perusahaan/profil_perusahaan_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{
		$this->_rules();
		$data = array(
			'logo' =>  upload_gambar_biasa('logo', 'uploads/logo/', 'png|', 1000000, 'logo'),
			'alamat' => $this->input->post('alamat', TRUE),
		);

		$this->Profil_perusahaan_model->insert($data);
		$_SESSION['pesan'] = "Create Record Success";
		$_SESSION['tipe'] = "success";
		redirect(site_url('profil_perusahaan'));
	}

	public function update($id)
	{
		$row = $this->Profil_perusahaan_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('profil_perusahaan/update_action'),
				'id' => set_value('id', $row->id),
				'logo' => set_value('logo', $row->logo),
				'alamat' => set_value('alamat', $row->alamat),
			);
			$this->load->view('header');
			$this->load->view('profil_perusahaan/profil_perusahaan_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('profil_perusahaan'));
		}
	}

	public function update_action()
	{
		$this->_rules();
		$id = $this->input->post('id', TRUE);
		$row = $this->Profil_perusahaan_model->get_by_id($id);

		$data = array(
			'logo' => $_FILES['logo']['name'] == "" ? $row->logo : upload_gambar_biasa('logo', 'uploads/logo', 'png|', 1000000, 'logo'),
			'alamat' => $this->input->post('alamat', TRUE),
		);

		$this->Profil_perusahaan_model->update($this->input->post('id', TRUE), $data);
		$_SESSION['pesan'] = "Update Record Success";
		$_SESSION['tipe'] = "success";
		redirect(site_url('profil_perusahaan'));
	}

	public function delete($id)
	{
		$row = $this->Profil_perusahaan_model->get_by_id($id);

		if ($row) {
			$this->Profil_perusahaan_model->delete($id);
			$_SESSION['pesan'] = "Delete Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('profil_perusahaan'));
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('profil_perusahaan'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('logo', 'logo', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Profil_perusahaan.php */
/* Location: ./application/controllers/Profil_perusahaan.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-04-28 15:48:46 */
/* https://gocodings.web.com */
