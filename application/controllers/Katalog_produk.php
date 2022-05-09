<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Katalog_produk extends MY_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->load->model('Katalog_produk_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$katalog_produk = $this->Katalog_produk_model->get_all();

		$data = array(
			'katalog_produk_data' => $katalog_produk
		);
		$this->load->view('header');
		$this->load->view('katalog_produk/katalog_produk_list', $data);
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
				$where .= " AND (kode_motor LIKE '%$search%'
				OR tipe_motor LIKE '%$search%'
				OR tahun_pembuatan LIKE '%$search%'
				OR no_seri_mesin LIKE '%$search%'
				OR no_seri_rangka LIKE '%$search%'
				OR katalog LIKE '%$search%'
	 )";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['kode_motor', 'tipe_motor', 'tahun_pembuatan', 'no_seri_mesin', 'no_seri_rangka', 'katalog',];
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
		$fetch = $this->db->query("SELECT * from katalog_produk $where");
		$fetch2 = $this->db->query("SELECT * from katalog_produk ");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('katalog_produk/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
			$button2 = "<a href=" . base_url('katalog_produk/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
			$button3 = "<a href=" . base_url('katalog_produk/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode_motor;
			$sub_array[] = $rows->tipe_motor;
			$sub_array[] = $rows->tahun_pembuatan;
			$sub_array[] = $rows->no_seri_mesin;
			$sub_array[] = $rows->no_seri_rangka;
			$sub_array[] = $rows->katalog;

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
		$row = $this->Katalog_produk_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'kode_motor' => $row->kode_motor,
				'tipe_motor' => $row->tipe_motor,
				'tahun_pembuatan' => $row->tahun_pembuatan,
				'no_seri_mesin' => $row->no_seri_mesin,
				'no_seri_rangka' => $row->no_seri_rangka,
				'katalog' => $row->katalog,
			);
			$this->load->view('header');
			$this->load->view('katalog_produk/katalog_produk_read', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('katalog_produk'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('katalog_produk/create_action'),
			'id' => set_value('id'),
			'kode_motor' => set_value('kode_motor'),
			'tipe_motor' => set_value('tipe_motor'),
			'tahun_pembuatan' => set_value('tahun_pembuatan'),
			'no_seri_mesin' => set_value('no_seri_mesin'),
			'no_seri_rangka' => set_value('no_seri_rangka'),
			'katalog' => set_value('katalog'),
		);

		$this->load->view('header');
		$this->load->view('katalog_produk/katalog_produk_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{
		ini_set('upload_max_filesize', '200M');

		$data = array(
			'kode_motor' => $this->input->post('kode_motor', TRUE),
			'tipe_motor' => $this->input->post('tipe_motor', TRUE),
			'tahun_pembuatan' => $this->input->post('tahun_pembuatan', TRUE),
			'no_seri_mesin' => $this->input->post('no_seri_mesin', TRUE),
			'no_seri_rangka' => $this->input->post('no_seri_rangka', TRUE),
			'katalog' =>  upload_gambar_biasa('katalog', 'katalog/', 'pdf|', 1000000, 'katalog'),
		);

		$this->Katalog_produk_model->insert($data);
		$_SESSION['pesan'] = "Create Record Success";
		$_SESSION['tipe'] = "success";
		redirect(site_url('katalog_produk'));
	}

	public function update($id)
	{
		$row = $this->Katalog_produk_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('katalog_produk/update_action'),
				'id' => set_value('id', $row->id),
				'kode_motor' => set_value('kode_motor', $row->kode_motor),
				'tipe_motor' => set_value('tipe_motor', $row->tipe_motor),
				'tahun_pembuatan' => set_value('tahun_pembuatan', $row->tahun_pembuatan),
				'no_seri_mesin' => set_value('no_seri_mesin', $row->no_seri_mesin),
				'no_seri_rangka' => set_value('no_seri_rangka', $row->no_seri_rangka),
				'katalog' => set_value('katalog', $row->katalog),
			);
			$this->load->view('header');
			$this->load->view('katalog_produk/katalog_produk_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('katalog_produk'));
		}
	}

	public function update_action()
	{
		$this->_rules();
		$id = $this->input->post('id', TRUE);
		$row = $this->Katalog_produk_model->get_by_id($id);
		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'kode_motor' => $this->input->post('kode_motor', TRUE),
				'tipe_motor' => $this->input->post('tipe_motor', TRUE),
				'tahun_pembuatan' => $this->input->post('tahun_pembuatan', TRUE),
				'no_seri_mesin' => $this->input->post('no_seri_mesin', TRUE),
				'no_seri_rangka' => $this->input->post('no_seri_rangka', TRUE),
				'katalog' => $_FILES['katalog']['name'] == "" ? $row->katalog : upload_gambar_biasa('katalog', 'katalog/', 'pdf|', 1000000, 'katalog'),
			);

			$this->Katalog_produk_model->update($this->input->post('id', TRUE), $data);
			$_SESSION['pesan'] = "Update Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('katalog_produk'));
		}
	}

	public function delete($id)
	{
		$row = $this->Katalog_produk_model->get_by_id($id);

		if ($row) {
			$this->Katalog_produk_model->delete($id);
			$_SESSION['pesan'] = "Delete Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('katalog_produk'));
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('katalog_produk'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('kode_motor', 'kode motor', 'trim|required');
		$this->form_validation->set_rules('tipe_motor', 'tipe motor', 'trim|required');
		$this->form_validation->set_rules('tahun_pembuatan', 'tahun pembuatan', 'trim|required');
		$this->form_validation->set_rules('no_seri_mesin', 'no seri mesin', 'trim|required');
		$this->form_validation->set_rules('no_seri_rangka', 'no seri rangka', 'trim|required');
		$this->form_validation->set_rules('katalog', 'katalog', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Katalog_produk.php */
/* Location: ./application/controllers/Katalog_produk.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-04-27 08:24:44 */
/* https://gocodings.web.com */
