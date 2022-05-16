<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for (all) non logged in users
 */
class Auth_client extends MY_Controller
{

	public function logged_in_check()
	{
		if ($this->session->userdata("user_logged_in")) {
			redirect("website");
		}
	}

	public function index()
	{
		$this->logged_in_check();

		$this->load->library('form_validation');
		$this->form_validation->set_rules("username", "username", "trim|required");
		$this->form_validation->set_rules("password", "password", "trim|required");
		if ($this->form_validation->run() == true) {
			$this->load->model('auth_model', 'auth');
			// check the username & password of user
			$status = $this->auth->validate();
			if ($status == ERR_INVALID_USERNAME) {
				$_SESSION['pesan'] = "User tidak terdaftar";
				$_SESSION['tipe'] = "error";
			} elseif ($status == ERR_INVALID_PASSWORD) {
				$_SESSION['pesan'] = "User tidak terdaftar";
				$_SESSION['tipe'] = "error";
			} else {
				// success
				// store the user data to session
				$this->session->set_userdata($this->auth->get_data());
				$this->session->set_userdata("user_logged_in", true);
				$_SESSION['pesan'] = "Selamat datang kembali " . $_SESSION['nama_lengkap'] . ". Selamat datang";
				$_SESSION['tipe'] = "success";
				redirect("website");
			}
		}
		$_SESSION['pesan'] = "User tidak terdaftar";
		$_SESSION['tipe'] = "error";
		redirect("website");
	}

	public function logout()
	{
		$this->session->unset_userdata("user_logged_in");
		$this->session->sess_destroy();
		$_SESSION['pesan'] = "Anda berhasil Logout !";
		$_SESSION['tipe'] = "success";
		redirect("website");
	}

	public function forget()
	{
		$this->load->view('forget');
	}
}