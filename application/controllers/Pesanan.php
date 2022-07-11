<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pesanan extends MY_Controller
{



	function __construct()
	{
		parent::__construct();
		$this->load->model('Pesanan_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$pesanan = $this->Pesanan_model->get_all();

		$data = array(
			'pesanan_data' => $pesanan
		);
		$this->load->view('header');
		$this->load->view('pesanan/pesanan_list', $data);
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
				$where .= " AND (kode_pesanan LIKE '%$search%'
				OR tanggal_dibuat LIKE '%$search%'
				OR id_pelanggan LIKE '%$search%'
				OR nama_lengkap LIKE '%$search%'
				OR alamat LIKE '%$search%'
				OR no_mesin LIKE '%$search%'
				OR no_rangka LIKE '%$search%'
				OR no_polisi LIKE '%$search%'
				OR no_telepon LIKE '%$search%'
				OR foto_stnk LIKE '%$search%'
				OR foto_motor LIKE '%$search%'
				OR status LIKE '%$search%'
				OR tahun_perakitan LIKE '%$search%'
				OR is_payment LIKE '%$search%'
				OR is_come LIKE '%$search%'
				OR bukti_bayar LIKE '%$search%'
	 )";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['kode_pesanan', 'tanggal_dibuat', 'id_pelanggan', 'nama_lengkap', 'alamat', 'no_mesin', 'no_rangka', 'no_polisi', 'no_telepon', 'foto_stnk', 'foto_motor', 'status', 'tahun_perakitan', 'is_payment', 'is_come', 'bukti_bayar',];
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
		$fetch = $this->db->query("SELECT * from pesanan $where");
		$fetch2 = $this->db->query("SELECT * from pesanan ");
		foreach ($fetch->result() as $rows) {
			$button1 = "<a href=" . base_url('pesanan/read/' . $rows->id) . " data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
			$button2 = "<a href=" . base_url('pesanan/update/' . $rows->id) . " data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
			$button3 = "<a href=" . base_url('pesanan/download_pesanan/' . $rows->id) . " data-color='green' style='color: green'><i class='icon-copy dw dw-download'></i></a>";


			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode_pesanan;
			$sub_array[] = formatTanggal($rows->tanggal_dibuat);
			$sub_array[] = $rows->id_pelanggan;
			$sub_array[] = $rows->nama_lengkap;
			$sub_array[] = $rows->alamat;
			$sub_array[] = $rows->no_mesin;
			$sub_array[] = $rows->no_rangka;
			$sub_array[] = $rows->no_polisi;
			$sub_array[] = $rows->no_telepon;
			$sub_array[] = $rows->status;
			$sub_array[] = $rows->tahun_perakitan;


			$sub_array[] = '<div class="table-actions">' . $button1 . " " . $button2 . " "  . $button3 . '</div>';
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


	public function fetch_data_pesanan()
	{
		$starts       = $this->input->post("start");
		$length       = $this->input->post("length");
		$LIMIT        = "LIMIT $starts, $length ";
		$kode         = $this->input->post("kode");
		$search       = $this->input->post("search")["value"];
		$orders       = isset($_POST["order"]) ? $_POST["order"] : '';

		$where = "WHERE 1=1  AND a.kode_pesanan ='$kode' ";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (a.kode_barang LIKE '%$search%' OR a.nama_barang LIKE '%$search%')";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['a.kode_pesanan'];
				$order_clm  = $order_column[$order[0]['column']];
				$order_by   = $order[0]['dir'];
				$where .= " ORDER BY $order_clm $order_by ";
			} else {
				$where .= " ORDER BY a.id ASC ";
			}
		} else {
			$where .= " ORDER BY a.id ASC ";
		}
		if (isset($LIMIT)) {
			if ($LIMIT != '') {
				$where .= ' ' . $LIMIT;
			}
		}
		$index = 1;
		$button = "";
		$fetch = $this->db->query("SELECT a.*,b.* from pesanan_detail_barang a join pesanan b on a.kode_pesanan=b.kode_pesanan $where");
		$fetch2 = $this->db->query("SELECT a.*,b.* from pesanan_detail_barang a join pesanan b on a.kode_pesanan=b.kode_pesanan where a.kode_pesanan ='$kode'");
		foreach ($fetch->result() as $rows) {

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode_barang;

			$sub_array[] = $rows->nama_barang;
			$sub_array[] = $rows->harga_barang;
			$sub_array[] = $rows->qty_pesanan;
			$sub_array[] = $rows->subtotal;

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
	public function fetch_data_pesanan_datang()
	{
		$starts       = $this->input->post("start");
		$length       = $this->input->post("length");
		$LIMIT        = "LIMIT $starts, $length ";
		$search       = $this->input->post("search")["value"];
		$orders       = isset($_POST["order"]) ? $_POST["order"] : '';

		$where = "WHERE 1=1 AND a.come ='1' AND a.is_take ='0' AND b.id_pelanggan='{$_SESSION['id']}' ";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (a.kode_barang LIKE '%$search%' OR a.nama_barang LIKE '%$search%')";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['a.kode_pesanan'];
				$order_clm  = $order_column[$order[0]['column']];
				$order_by   = $order[0]['dir'];
				$where .= " ORDER BY $order_clm $order_by ";
			} else {
				$where .= " ORDER BY a.id ASC ";
			}
		} else {
			$where .= " ORDER BY a.id ASC ";
		}
		if (isset($LIMIT)) {
			if ($LIMIT != '') {
				$where .= ' ' . $LIMIT;
			}
		}
		$index = 1;
		$button = "";
		$fetch = $this->db->query("SELECT a.*,b.* from pesanan_detail_barang a join pesanan b on a.kode_pesanan=b.kode_pesanan $where");
		$fetch2 = $this->db->query("SELECT a.*,b.* from pesanan_detail_barang a join pesanan b on a.kode_pesanan=b.kode_pesanan  where a.come ='1' and a.is_take ='0' and b.id_pelanggan='{$_SESSION['id']}'");
		foreach ($fetch->result() as $rows) {

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode_pesanan;
			$sub_array[] = $rows->kode_barang;
			$sub_array[] = $rows->nama_barang;
			$sub_array[] = $rows->harga_barang;
			$sub_array[] = $rows->qty_pesanan;
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
	public function fetch_data_pesanan2()
	{
		$starts       = $this->input->post("start");
		$length       = $this->input->post("length");
		$LIMIT        = "LIMIT $starts, $length ";
		$kode         = $this->input->post("kode");
		$search       = $this->input->post("search")["value"];
		$orders       = isset($_POST["order"]) ? $_POST["order"] : '';

		$where = "WHERE 1=1  AND kode_pesanan ='$kode' ";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (kode_barang LIKE '%$search%' OR nama_barang LIKE '%$search%')";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['kode_pesanan'];
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
		$fetch = $this->db->query("SELECT * from pesanan_detail_barang $where");
		$fetch2 = $this->db->query("SELECT * from pesanan_detail_barang  where kode_pesanan ='$kode'");
		foreach ($fetch->result() as $rows) {
			
			$button = "";
			$button2 = "";
			if($rows->come == 1){
				$button= '<input type="checkbox" id="come-true" value="'.$rows->id.'" checked="checked" name="come-true" onclick="handleCheckbox(this)"">';
			}else{
				$button= '<input type="checkbox" id="come-false" value="'.$rows->id.'" name="come-false" onclick="handleCheckbox(this)"">';
			}
			if($rows->is_take == 1){
				$button2= '<input type="checkbox" id="come-true" value="'.$rows->id.'" checked="checked" disabled name="come-true" onclick="handleCheckboxTake(this)"">';
			}else{
				$button2= '<input type="checkbox" id="come-false" value="'.$rows->id.'" name="come-false" onclick="handleCheckboxTake(this)"">';
			}

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode_barang;
			$sub_array[] = $rows->nama_barang;
			$sub_array[] = $rows->harga_barang;
			$sub_array[] = $rows->qty_pesanan;
			$sub_array[] = $rows->subtotal;
			$sub_array[] = $button;
			$sub_array[] = $button2;

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


	public function sudah_datang(){
		$id = $this->input->post('id');
		$state = $this->input->post('state');
		$this->db->where('id',$id);
		$update=  $this->db->update('pesanan_detail_barang',['come'=>$state == "true" ? 1 : 0]);

		if($update){
			echo json_encode(array(
				"status"=>$state,
				"message"=>"Berhasil mengubah status barang",
			));
		}
	}
	public function sudah_datang_take(){
		$id = $this->input->post('id');
		$state = $this->input->post('state');
		$this->db->where('id',$id);
		$update=  $this->db->update('pesanan_detail_barang',['is_take'=>$state == "true" ? 1 : 0]);

		if($update){
			echo json_encode(array(
				"status"=>$state,
				"message"=>"Berhasil mengubah status barang",
			));
		}
	}

	public function read($id)
	{
		$row = $this->Pesanan_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'kode_pesanan' => $row->kode_pesanan,
				'tanggal_dibuat' => $row->tanggal_dibuat,
				'id_pelanggan' => $row->id_pelanggan,
				'nama_lengkap' => $row->nama_lengkap,
				'alamat' => $row->alamat,
				'no_mesin' => $row->no_mesin,
				'no_rangka' => $row->no_rangka,
				'no_polisi' => $row->no_polisi,
				'no_telepon' => $row->no_telepon,
				'foto_stnk' => $row->foto_stnk,
				'foto_motor' => $row->foto_motor,
				'status' => $row->status,
				'tahun_perakitan' => $row->tahun_perakitan,
				'is_payment' => $row->is_payment,
				'is_come' => $row->is_come,
				'bukti_bayar' => $row->bukti_bayar,
			);
			$this->load->view('header');
			$this->load->view('pesanan/pesanan_read', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('pesanan'));
		}
	}

	public function download_pesanan($id)
	{
		$row = $this->Pesanan_model->get_by_id($id);
		$data = array(
			'id' => $row->id,
			'kode_pesanan' => $row->kode_pesanan,
			'tanggal_dibuat' => $row->tanggal_dibuat,
			'id_pelanggan' => $row->id_pelanggan,
			'nama_lengkap' => $row->nama_lengkap,
			'alamat' => $row->alamat,
			'no_mesin' => $row->no_mesin,
			'no_rangka' => $row->no_rangka,
			'no_polisi' => $row->no_polisi,
			'no_telepon' => $row->no_telepon,
			'foto_stnk' => $row->foto_stnk,
			'foto_motor' => $row->foto_motor,
			'status' => $row->status,
			'tahun_perakitan' => $row->tahun_perakitan,
			'is_payment' => $row->is_payment,
			'is_come' => $row->is_come,
			'bukti_bayar' => $row->bukti_bayar,
		);
		
		
		$this->load->library('pdf');
		$mpdf                           = $this->pdf->load();
		$mpdf->allow_charset_conversion = false;  // Set by default to TRUE
		$mpdf->charset_in               = 'UTF-8';
		$mpdf->autoLangToFont           = true;
		$mpdf->AddPage('P');
		$mpdf = new mPDF(
			'',    // mode - default ''
			'',    // format - A4, for example, default ''
			0,     // font size - default 0
			'',    // default font family
			10,    // margin_left
			10,    // margin right
			5,     // margin top
			-1,    // margin bottom
			0,     // margin header
			0,     // margin footer
			'P'
		);
		$mpdf->SetDisplayMode('fullwidth');
		$html = $this->load->view('pesanan/ahm_order', $data, true);

		$mpdf->WriteHTML($html);
		$output = 'Form Hasil Pembacaan Gambar' . '.pdf';
		$mpdf->Output("$output", 'I');
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('pesanan/create_action'),
			'id' => set_value('id'),
			'kode_pesanan' => set_value('kode_pesanan'),
			'tanggal_dibuat' => set_value('tanggal_dibuat'),
			'id_pelanggan' => set_value('id_pelanggan'),
			'nama_lengkap' => set_value('nama_lengkap'),
			'alamat' => set_value('alamat'),
			'no_mesin' => set_value('no_mesin'),
			'no_rangka' => set_value('no_rangka'),
			'no_polisi' => set_value('no_polisi'),
			'no_telepon' => set_value('no_telepon'),
			'foto_stnk' => set_value('foto_stnk'),
			'foto_motor' => set_value('foto_motor'),
			'status' => set_value('status'),
			'tahun_perakitan' => set_value('tahun_perakitan'),
			'is_payment' => set_value('is_payment'),
			'is_come' => set_value('is_come'),
			'bukti_bayar' => set_value('bukti_bayar'),
		);

		$this->load->view('header');
		$this->load->view('pesanan/pesanan_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'kode_pesanan' => $this->input->post('kode_pesanan', TRUE),
				'tanggal_dibuat' => $this->input->post('tanggal_dibuat', TRUE),
				'id_pelanggan' => $this->input->post('id_pelanggan', TRUE),
				'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'no_mesin' => $this->input->post('no_mesin', TRUE),
				'no_rangka' => $this->input->post('no_rangka', TRUE),
				'no_polisi' => $this->input->post('no_polisi', TRUE),
				'no_telepon' => $this->input->post('no_telepon', TRUE),
				'foto_stnk' => $this->input->post('foto_stnk', TRUE),
				'foto_motor' => $this->input->post('foto_motor', TRUE),
				'status' => $this->input->post('status', TRUE),
				'tahun_perakitan' => $this->input->post('tahun_perakitan', TRUE),
				'is_payment' => $this->input->post('is_payment', TRUE),
				'is_come' => $this->input->post('is_come', TRUE),
				'bukti_bayar' => $this->input->post('bukti_bayar', TRUE),
			);

			$this->Pesanan_model->insert($data);
			$_SESSION['pesan'] = "Create Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('pesanan'));
		}
	}

	public function update($id)
	{
		$row = $this->Pesanan_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('pesanan/update_action'),
				'id' => set_value('id', $row->id),
				'kode_pesanan' => set_value('kode_pesanan', $row->kode_pesanan),
				'tanggal_dibuat' => set_value('tanggal_dibuat', $row->tanggal_dibuat),
				'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
				'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
				'alamat' => set_value('alamat', $row->alamat),
				'no_mesin' => set_value('no_mesin', $row->no_mesin),
				'no_rangka' => set_value('no_rangka', $row->no_rangka),
				'no_polisi' => set_value('no_polisi', $row->no_polisi),
				'no_telepon' => set_value('no_telepon', $row->no_telepon),
				'foto_stnk' => set_value('foto_stnk', $row->foto_stnk),
				'foto_motor' => set_value('foto_motor', $row->foto_motor),
				'status' => set_value('status', $row->status),
				'tahun_perakitan' => set_value('tahun_perakitan', $row->tahun_perakitan),
				'is_payment' => set_value('is_payment', $row->is_payment),
				'is_come' => set_value('is_come', $row->is_come),
				'bukti_bayar' => set_value('bukti_bayar', $row->bukti_bayar),
			);
			$this->load->view('header');
			$this->load->view('pesanan/pesanan_form', $data);
			$this->load->view('footer');
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('pesanan'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'kode_pesanan' => $this->input->post('kode_pesanan', TRUE),
				'tanggal_dibuat' => $this->input->post('tanggal_dibuat', TRUE),
				'id_pelanggan' => $this->input->post('id_pelanggan', TRUE),
				'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'no_mesin' => $this->input->post('no_mesin', TRUE),
				'no_rangka' => $this->input->post('no_rangka', TRUE),
				'no_polisi' => $this->input->post('no_polisi', TRUE),
				'no_telepon' => $this->input->post('no_telepon', TRUE),
				'foto_stnk' => $this->input->post('foto_stnk', TRUE),
				'foto_motor' => $this->input->post('foto_motor', TRUE),
				'status' => $this->input->post('is_payment', TRUE) == '0' ? "belum_bayar" : $this->input->post('status', TRUE),
				'tahun_perakitan' => $this->input->post('tahun_perakitan', TRUE),
				'is_payment' => $this->input->post('is_payment', TRUE),
				'is_come' => $this->input->post('is_come', TRUE),
				'bukti_bayar' => $this->input->post('bukti_bayar', TRUE),
			);

			$this->Pesanan_model->update($this->input->post('id', TRUE), $data);
			$_SESSION['pesan'] = "Update Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('pesanan'));
		}
	}

	public function delete($id)
	{
		$row = $this->Pesanan_model->get_by_id($id);

		if ($row) {
			$this->Pesanan_model->delete($id);
			$_SESSION['pesan'] = "Delete Record Success";
			$_SESSION['tipe'] = "success";
			redirect(site_url('pesanan'));
		} else {
			$_SESSION['pesan'] = "Record Not Found";
			$_SESSION['tipe'] = "error";
			redirect(site_url('pesanan'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('kode_pesanan', 'kode pesanan', 'trim|required');
		$this->form_validation->set_rules('tanggal_dibuat', 'tanggal dibuat', 'trim|required');
		$this->form_validation->set_rules('id_pelanggan', 'id pelanggan', 'trim|required');
		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('no_mesin', 'no mesin', 'trim|required');
		$this->form_validation->set_rules('no_rangka', 'no rangka', 'trim|required');
		$this->form_validation->set_rules('no_polisi', 'no polisi', 'trim|required');
		$this->form_validation->set_rules('no_telepon', 'no telepon', 'trim|required');
		$this->form_validation->set_rules('foto_stnk', 'foto stnk', 'trim|required');
		$this->form_validation->set_rules('foto_motor', 'foto motor', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		$this->form_validation->set_rules('tahun_perakitan', 'tahun perakitan', 'trim|required');
		$this->form_validation->set_rules('is_payment', 'is payment', 'trim|required');
		$this->form_validation->set_rules('is_come', 'is come', 'trim|required');
		$this->form_validation->set_rules('bukti_bayar', 'bukti bayar', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Pesanan.php */
/* Location: ./application/controllers/Pesanan.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-05-21 10:02:23 */
/* https://gocodings.web.com */
