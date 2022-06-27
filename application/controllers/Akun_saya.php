<?php

class Akun_saya extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/index');
		$this->load->view('akun_saya/components/footer');
	}

	public function keranjang()
	{
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/keranjang');
		$this->load->view('akun_saya/components/footer');
	}
	public function checkout()
	{
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/checkout');
		$this->load->view('akun_saya/components/footer');
	}
	public function pembayaran()
	{
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/pembayaran');
		$this->load->view('akun_saya/components/footer');
	}
	public function profile()
	{
		
		$user = $this->db->get_where('user', ['id' => $_SESSION['id']])->row();
		$data = array(
			"id" => $user->id,
			"nama_lengkap" => $user->nama_lengkap,
			"jenis_kelamin" => $user->jenis_kelamin,
			"alamat" => $user->alamat,
			"username" => $user->username,
			"password" => $user->password,
		);
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/profile', $data);
		$this->load->view('akun_saya/components/footer');
	}

	public function tracking()
	{
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/tracking');
		$this->load->view('akun_saya/components/footer');
	}
	public function detail_pesanan($kode)
	{
		$data['header_pesanan'] = $this->db->get_where('pesanan', ['kode_pesanan' => $kode])->row();
		$data['detail_pesanan'] = $this->db->get_where('pesanan_detail_barang', ['kode_pesanan' => $kode])->result();
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/detail_pesanan', $data);
		$this->load->view('akun_saya/components/footer');
	}

	public function send_checkout()
	{
		$data = $_POST['item'];
		echo json_encode($data);
	}



	public function delete_keranjang()
	{
		$id = $this->input->post('id');
		$delete = $this->db->query("DELETE FROM keranjang where id='$id'");
		if ($delete) {
			$response = [
				"status" => 200,
				"message" => "Berhasil menghapus keranjang"
			];
			echo json_encode($response);
		}
	}

	function acak($panjang)
	{
		$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
		$string = '';
		for ($i = 0; $i < $panjang; $i++) {
			$pos = rand(0, strlen($karakter) - 1);
			$string .= $karakter{
				$pos};
		}
		// echo json_encode(array(
		// 	"data" => $string,
		// ));
		return $string;
	}

	public function proses_checkout()
	{
		date_default_timezone_set('Asia/Jakarta');
		$detail = json_decode($_POST['details']);
		$dt = array();
		$kode = $this->acak(10);
		ini_set('max_upload_filesize', '200M');

		$data = array(
			"kode_pesanan" => $kode,
			"tanggal_dibuat" => date('Y-m-d'),
			"id_pelanggan" => $_SESSION['id'],
			"nama_lengkap" => $this->input->post('nama_lengkap'),
			"alamat" => $this->input->post('alamat'),
			"no_telepon" => $this->input->post('no_telepon'),
			"no_mesin" => $this->input->post('no_mesin'),
			"no_rangka" => $this->input->post('no_rangka'),
			"no_polisi" => $this->input->post('no_polisi'),
			"tahun_perakitan" => $this->input->post('tahun_perakitan'),
			"foto_stnk" => upload_gambar_biasa($kode, 'uploads/pesanan/', 'png|', 1000000, 'foto_stnk'),
			"foto_motor" => upload_gambar_biasa($kode, 'uploads/pesanan/', 'png|', 1000000, 'foto_motor'),
			"status" => "belum_bayar",
			"is_payment" => 0,
			"is_come" => 0
		);

		$insert_header = $this->db->insert('pesanan', $data);
		if ($insert_header) {

			foreach ($detail as $rows) {
				$dt = array(
					"kode_pesanan" => $kode,
					"kode_barang" => $rows->kode_barang,
					"nama_barang" => $rows->nama_barang,
					"harga_barang" => $rows->harga_barang,
					"qty_pesanan" => $rows->qty_pesanan,
					"subtotal" => $rows->subtotal
				);
				$insert_detail = $this->db->insert('pesanan_detail_barang', $dt);
				if ($insert_detail) {
					$this->db->query("DELETE FROM keranjang where id='$rows->id'");
				}
			}
			echo json_encode(array(
				"status" => 200,
				"message" => "Pesanan berhasil di proses, silahkan lakukan pembayaran untuk pesanan anda."
			));
		}
	}

	public function fetch_data_pesanan()
	{
		$starts       = $this->input->post("start");
		$length       = $this->input->post("length");
		$LIMIT        = "LIMIT $starts, $length ";
		$search       = $this->input->post("search")["value"];
		$orders       = isset($_POST["order"]) ? $_POST["order"] : '';
		$status       = $this->input->post('status') == "" ? "belum_bayar" : $this->input->post('status');

		$where = "WHERE 1=1 AND status ='{$status}'";
		$result = array();
		if (isset($search)) {
			if ($search != '') {
				$where .= " AND (kode_pesanan LIKE '%$search%'
						OR tanggal_dibuat LIKE '%$search%'
						OR id_pelanggan LIKE '%$search%'
						OR nama_lengkap LIKE '%$search%'
						OR nomor_mesin LIKE '%$search%'
						OR nomor_plat_kendaraan LIKE '%$search%'
						OR foto_stnk LIKE '%$search%'
						OR nomor_hp LIKE '%$search%'
						OR keterangan LIKE '%$search%'
						OR status LIKE '%$search%'
						OR foto_motor LIKE '%$search%')";
			}
		}

		if (isset($orders)) {
			if ($orders != '') {
				$order = $orders;
				$order_column = ['kode_pesanan', 'tanggal_dibuat', 'id_pelanggan', 'nama_lengkap', 'nomor_mesin', 'nomor_plat_kendaraan', 'foto_stnk', 'nomor_hp', 'keterangan', 'status', 'foto_motor',];
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
		$fetch2 = $this->db->query("SELECT * from pesanan where status ='{$status}'");
		foreach ($fetch->result() as $rows) {
			$button = '<a href="' . base_url('akun_saya/detail_pesanan/' . $rows->kode_pesanan) . '" class="btn btn-success btn-sm btn-flat">Detail</a>';

			$sub_array = array();
			$sub_array[] = $index;
			$sub_array[] = $rows->kode_pesanan;
			$sub_array[] = formatTanggal($rows->tanggal_dibuat);
			$sub_array[] = number_format($this->db->query("SELECT COALESCE(SUM(subtotal)) as subtotal from pesanan_detail_barang where kode_pesanan='$rows->kode_pesanan'")->row()->subtotal, 0, ',', '.');
			$sub_array[] = $rows->is_payment == 0 ? '<span class="badge badge-danger">Belum Lunas</span>' : '<span class="badge badge-success">Lunas</span>';
			$sub_array[] = $button;
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

	public function upload_bukti_bayar()
	{
		$kode = $this->input->post('kode_pesanan');

		$data = array(
			"is_payment" => 1,
			"status" => "proses",
			"bukti_bayar" => upload_gambar_biasa('bukti_bayar', 'uploads/pesanan/', 'png|', 1000000, 'bukti_bayar'),
		);

		$this->db->where('kode_pesanan', $kode);
		$update = $this->db->update('pesanan', $data);
		if ($update) {
			echo json_encode(array(
				"status" => 200,
				"message" => "Bukti pembayaran berhasil di upload"
			));
		}
	}

	public function no_rekening()
	{
		$data = array();
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/no_rekening', $data);
		$this->load->view('akun_saya/components/footer');
	}

	public function save_profile()
	{
		
		$data = array(
			"nama_lengkap" => $_POST['nama_lengkap'],
			"jenis_kelamin" => $_POST['jenis_kelamin'],
			"alamat" => $_POST['alamat'],
			"username" => $_POST['username'],
			"password" => $_POST['password'],
		);
		$this->db->where('id', $_POST['id']);
		$insert = $this->db->update('user', $data);
		if ($insert) {
			$_SESSION['pesan'] = "Simpan Data Profil Berhasil";
			$_SESSION['tipe'] = "success";
			redirect(site_url('akun_saya/profile'));
		} else {
			$_SESSION['pesan'] = "Simpan Data Profil Gagal";
			$_SESSION['tipe'] = "error";
			redirect(site_url('akun_saya/profile'));
		}
	}
}
