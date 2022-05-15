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
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/profile');
		$this->load->view('akun_saya/components/footer');
	}

	public function tracking()
	{
		$this->load->view('akun_saya/components/header');
		$this->load->view('akun_saya/pages/tracking');
		$this->load->view('akun_saya/components/footer');
	}

	public function send_checkout()
	{
		$data = $_POST['item'];
		echo json_encode($data);
	}
}
