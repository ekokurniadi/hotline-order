<?php

class Laporan_pemesanan extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('laporan');
		$this->load->view('footer');
	}


	public function download_laporan()
	{

		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 900);
		
		
		
		$filter = [
			'start_date' => $this->input->post('start'),
			'end_date' => $this->input->post('end'),

		];
		$data['params']= $filter;

		$data['details'] = $this->db->query("SELECT a.*,b.* FROM pesanan a join pesanan_detail_barang b on a.kode_pesanan = b.kode_pesanan where a.id_pelanggan='{$_SESSION['id']}' and a.tanggal_dibuat between '{$filter['start_date']}' and  '{$filter['end_date']}'");            // log_r($data);

		$this->load->view("laporan_pembelian", $data);
	}
}
