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
				$_SESSION['pesan'] = "Selamat datang kembali " . $_SESSION['nama_lengkap'] . ".";
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

	public function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("nama_lengkap", "nama_lengkap", "trim|required");
		$this->form_validation->set_rules("jenis_kelamin", "jenis_kelamin", "trim|required");
		$this->form_validation->set_rules("no_telepon", "no_telepon", "trim|required");
		$this->form_validation->set_rules("alamat", "alamat", "trim|required");
		$this->form_validation->set_rules("username", "username", "trim|required");
		$this->form_validation->set_rules("password", "password", "trim|required");

		if ($this->form_validation->run() == true) {
			$data = array(
				"nama_lengkap" => $this->input->post("nama_lengkap"),
				"jenis_kelamin" => $this->input->post("jenis_kelamin"),
				"no_hp" => $this->input->post("no_telepon"),
				"alamat" => $this->input->post("alamat"),
				"password" => $this->input->post("password"),
				"username" => $this->input->post("username"),
				"role" => "user",
				"status" => "active"
			);

			$check = $this->db->get_where('user', ['username' => $this->input->post("username")])->num_rows();
			if ($check <= 0) {
				$insert = $this->db->insert("user", $data);
				if ($insert) {
					$_SESSION['pesan'] = "Registrasi Berhasil, silahkan login ke akun anda";
					$_SESSION['tipe'] = "success";
					redirect("website");
				}
			} else {
				$_SESSION['pesan'] = "Username sudah terdaftar";
				$_SESSION['tipe'] = "error";
				redirect("website");
			}
		}
	}
}
