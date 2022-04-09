<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Master_parts extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Master_parts_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$master_parts = $this->Master_parts_model->get_all();

		$data = array(
			'master_parts_data' => $master_parts
		);
		$this->load->view('header');
		$this->load->view('master_parts/master_parts_list', $data);
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
				$where .= " AND (kode_barang LIKE '%$search%'
							OR nama_barang LIKE '%$search%'
							OR foto LIKE '%$search%'
							OR harga LIKE '%$search%'
							)";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['kode_barang', 'nama_barang', 'foto', 'harga',];
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
		$fetch = $this->db->query("SELECT * from master_parts $where");
		$fetch2 = $this->db->query("SELECT * from master_parts ");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('master_parts/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
			$button2 = "<a href=" . base_url('master_parts/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
			$button3 = "<a href=" . base_url('master_parts/delete/' . $rows->id) . " data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode_barang;
			$sub_array[] = $rows->nama_barang;
			$sub_array[] = "<img src='" . base_url('uploads/parts/') . $rows->foto . "' class='img-fluid' width='80px'>";
			$sub_array[] = number_format($rows->harga, 0, ',', '.');

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
		$row = $this->Master_parts_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'kode_barang' => $row->kode_barang,
				'nama_barang' => $row->nama_barang,
				'foto' => $row->foto,
				'harga' => $row->harga,
			);
			$this->load->view('header');
			$this->load->view('master_parts/master_parts_read', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_parts'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('master_parts/create_action'),
			'id' => set_value('id'),
			'kode_barang' => set_value('kode_barang'),
			'nama_barang' => set_value('nama_barang'),
			'foto' => set_value('foto'),
			'harga' => set_value('harga'),
		);

		$this->load->view('header');
		$this->load->view('master_parts/master_parts_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'kode_barang' => $this->input->post('kode_barang', TRUE),
				'nama_barang' => $this->input->post('nama_barang', TRUE),
				'foto' => upload_gambar_biasa('foto', 'uploads/parts/', 'jpeg|png|jpg|gif|svg|SVG', 10000, 'foto'),
				'harga' => $this->input->post('harga', TRUE),
			);

			$this->Master_parts_model->insert($data);
			$_SESSION['pesan'] = "Create Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_parts'));
		}
	}

	public function update($id)
	{
		$row = $this->Master_parts_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('master_parts/update_action'),
				'id' => set_value('id', $row->id),
				'kode_barang' => set_value('kode_barang', $row->kode_barang),
				'nama_barang' => set_value('nama_barang', $row->nama_barang),
				'foto' => set_value('foto', $row->foto),
				'harga' => set_value('harga', $row->harga),
			);
			$this->load->view('header');
			$this->load->view('master_parts/master_parts_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_parts'));
		}
	}

	public function update_action()
	{
		$this->_rules();
		$id = $this->input->post('id', TRUE);
		$row = $this->Master_parts_model->get_by_id($id);

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'kode_barang' => $this->input->post('kode_barang', TRUE),
				'nama_barang' => $this->input->post('nama_barang', TRUE),
				'foto' => $_FILES['foto']['name'] == "" ? $row->foto : upload_gambar_biasa('foto', 'uploads/parts/', 'jpeg|png|jpg|gif|svg|SVG', 10000, 'foto'),
				'harga' => $this->input->post('harga', TRUE),
			);

			$this->Master_parts_model->update($this->input->post('id', TRUE), $data);
			$_SESSION['pesan'] = "Update Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_parts'));
		}
	}

	public function delete($id)
	{
		$row = $this->Master_parts_model->get_by_id($id);

		if ($row) {
			$this->Master_parts_model->delete($id);
			$_SESSION['pesan'] = "Delete Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('master_parts'));
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('master_parts'));
		}
	}

	public function upload_master_parts()
	{
		date_default_timezone_set('Asia/Jakarta');
		$filename = $_FILES['file_part']['name'];
		$this->load->library('upload');
		$config['upload_path']   = './excel/';
		$config['overwrite']     = true;
		$config['allowed_types'] = 'xlsx';
		$config['file_name'] = $_FILES['file_part']['name'];
		$this->upload->initialize($config);
		if ($_FILES['file_part']['name']) {
			if ($this->upload->do_upload('file_part')) {
				$gbr = $this->upload->data();
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/' . $filename . '');
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
				unset($sheet[1]);
				foreach ($sheet as $rows) {
					$cek = $this->db->get_where('master_parts', array('kode_barang' => $rows['A']));
					$data = array(
						"kode_barang" => $rows['A'],
						"nama_barang" => $rows['B'],
						"foto" => "",
						"harga" => $rows['C'],
					);


					if ($cek->num_rows() <= 0) {
						$insert = $this->db->insert('master_parts', $data);
					}
				}
				if ($insert) {
					echo json_encode(array("status" => "sukses", "link" => base_url('master_parts')));
					$_SESSION['pesan'] = "Data Berhasil di Upload.";
					$_SESSION['tipe'] = "success";
				} else {
					echo json_encode(array("status" => "error", "link" => base_url('master_parts')));
					$_SESSION['pesan'] = "Data Gagal di Upload.";
					$_SESSION['tipe'] = "error";
				}
			}
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
		$this->form_validation->set_rules('foto', 'foto', '');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required|numeric');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Master_parts.php */
/* Location: ./application/controllers/Master_parts.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-02-04 02:48:18 */
/* https://gocodings.web.com */
