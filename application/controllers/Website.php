<?php

class Website extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Slide_show_model');
		$this->load->model('Cara_pemesanan_model');
		$this->load->model('Master_parts_model');
	}

	public function index()
	{
		$this->load->view('website/components/header');
		$data['slide_show'] = $this->Slide_show_model->get_all();
		$this->load->view('website/components/index', $data);
		$this->load->view('website/components/footer');
	}

	public function katalog()
	{
		$this->load->view('website/components/header');
		$this->load->view('website/pages/katalog_product');
		$this->load->view('website/components/footer');
	}

	public function notifikasi(){
		$id = $this->input->post('id');
		$query = $this->db->get_where('notifikasi',['id_user'=>$id,'status'=>0])->num_rows();
		echo json_encode(array(
			"total"=> $query,
		));
	}

	public function fetch_katalog()
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


			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode_motor;
			$sub_array[] = $rows->tipe_motor;
			$sub_array[] = formatTanggal($rows->tahun_pembuatan);
			$sub_array[] = $rows->no_seri_mesin;
			$sub_array[] = $rows->no_seri_rangka;
			$sub_array[] = "<a class='btn btn-primary btn-md' href=" . base_url('website/download_katalog/') . $rows->katalog . "><i class='fa fa-download'></i> Download</a>";


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

	public function download_katalog($katalog)
	{
		force_download('katalog/' . $katalog, NULL);
	}

	public function cara_pemesanan()
	{
		$this->load->view('website/components/header');
		$data['data'] = $this->Cara_pemesanan_model->get_all();
		$this->load->view('website/pages/cara_pemesanan', $data);
		$this->load->view('website/components/footer');
	}

	public function keranjang_add()
	{
		$id = $this->input->post('id');
		$part =  $this->Master_parts_model->get_by_id($id);

		$data = array(
			"id_user" => $_SESSION['id'],
			"kode_barang" => $part->kode_barang,
			"nama_barang" => $part->nama_barang,
			"harga_barang" => $part->harga,
			"qty_pesanan" => 1,
			"subtotal" => $part->harga * 1,
		);

		$insert = $this->db->insert('keranjang', $data);
		if ($insert) {
			$response = [
				"message" => "Berhasil menambahkan keranjang belanja",
				"status" => 200,
				"url" => base_url('akun_saya/keranjang'),
			];
			echo json_encode($response);
		}
	}

	public function get_keranjang()
	{
		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * FROM keranjang where id_user ='$id'");
		$response = [
			"total" => $data->num_rows(),
		];

		echo json_encode($response);
	}
}
