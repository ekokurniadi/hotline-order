<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Shop extends MY_Controller
{
	public function index()
	{
		$this->load->view('shop/header');
		$this->load->view('shop/index.php');
		$this->load->view('shop/footer');
	}
}
