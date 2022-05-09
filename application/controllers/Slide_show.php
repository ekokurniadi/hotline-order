<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Slide_show extends MY_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->load->model('Slide_show_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$slide_show = $this->Slide_show_model->get_all();

		$data = array(
			'slide_show_data' => $slide_show
		);
		$this->load->view('header');
		$this->load->view('slide_show/slide_show_list', $data);
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
				$where .= " AND (gambar LIKE '%$search%'
	OR judul LIKE '%$search%'
	OR deskripsi LIKE '%$search%'
	 )";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['gambar', 'judul', 'deskripsi',];
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
		$fetch = $this->db->query("SELECT * from slide_show $where");
		$fetch2 = $this->db->query("SELECT * from slide_show ");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('slide_show/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
			$button2 = "<a href=" . base_url('slide_show/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
			$button3 = "<a href=" . base_url('slide_show/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = "<img src=" . base_url('uploads/slide_show/') . $rows->gambar . " width='100px'/>";
			$sub_array[] = $rows->judul;
			$sub_array[] = $rows->deskripsi;

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
		$row = $this->Slide_show_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'gambar' => $row->gambar,
				'judul' => $row->judul,
				'deskripsi' => $row->deskripsi,
			);
			$this->load->view('header');
			$this->load->view('slide_show/slide_show_read', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('slide_show'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('slide_show/create_action'),
			'id' => set_value('id'),
			'gambar' => set_value('gambar'),
			'judul' => set_value('judul'),
			'deskripsi' => set_value('deskripsi'),
		);

		$this->load->view('header');
		$this->load->view('slide_show/slide_show_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{

		$data = array(
			'gambar' => upload_gambar_biasa('gambar', 'uploads/slide_show/', 'png', 1000000, 'gambar'),
			'judul' => $this->input->post('judul', TRUE),
			'deskripsi' => $this->input->post('deskripsi', TRUE),
		);

		$this->Slide_show_model->insert($data);
		$_SESSION['pesan'] = "Create Record Success";
		$_SESSION['tipe'] = "success";
		redirect(site_url('slide_show'));
	}

	public function update($id)
	{
		$row = $this->Slide_show_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('slide_show/update_action'),
				'id' => set_value('id', $row->id),
				'gambar' => set_value('gambar', $row->gambar),
				'judul' => set_value('judul', $row->judul),
				'deskripsi' => set_value('deskripsi', $row->deskripsi),
			);
			$this->load->view('header');
			$this->load->view('slide_show/slide_show_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('slide_show'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'gambar' => $this->input->post('gambar', TRUE),
				'judul' => $this->input->post('judul', TRUE),
				'deskripsi' => $this->input->post('deskripsi', TRUE),
			);

			$this->Slide_show_model->update($this->input->post('id', TRUE), $data);
			$_SESSION['pesan'] = "Update Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('slide_show'));
		}
	}

	public function delete($id)
	{
		$row = $this->Slide_show_model->get_by_id($id);

		if ($row) {
			$this->Slide_show_model->delete($id);
			$_SESSION['pesan'] = "Delete Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('slide_show'));
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('slide_show'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
		$this->form_validation->set_rules('judul', 'judul', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Slide_show.php */
/* Location: ./application/controllers/Slide_show.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-05-06 09:49:48 */
/* https://gocodings.web.com */
