<?php

class Website extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Slide_show_model');
	}

	public function index()
	{
		$this->load->view('website/components/header');
		$data['slide_show'] = $this->Slide_show_model->get_all();
		$this->load->view('website/components/index', $data);
		$this->load->view('website/components/footer');
	}
}
