<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pesanan extends MY_Controller {

  
    
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

    public function fetch_data(){
        $starts       = $this->input->post("start");
        $length       = $this->input->post("length");
        $LIMIT        = "LIMIT $starts, $length ";
        $draw         = $this->input->post("draw");
        $search       = $this->input->post("search")["value"];
        $orders       = isset($_POST["order"]) ? $_POST["order"] : ''; 
        
        $where ="WHERE 1=1";
        $result=array();
        if (isset($search)) {
          if ($search != '') {
                $where .= " AND (kode_pesanan LIKE '%$search%'
	 AND (tanggal_dibuat LIKE '%$search%'
	 AND (id_pelanggan LIKE '%$search%'
	 AND (nama_lengkap LIKE '%$search%'
	 AND (nomor_mesin LIKE '%$search%'
	 AND (nomor_plat_kendaraan LIKE '%$search%'
	 AND (foto_stnk LIKE '%$search%'
	 AND (nomor_hp LIKE '%$search%'
	 AND (keterangan LIKE '%$search%'
	 AND (status LIKE '%$search%'
	 AND (foto_motor LIKE '%$search%'
	 )";
	
              }
          }
    
        if (isset($orders)) {
            if ($orders != '') {
              $order = $orders;
              $order_column =['kode_pesanan','tanggal_dibuat','id_pelanggan','nama_lengkap','nomor_mesin','nomor_plat_kendaraan','foto_stnk','nomor_hp','keterangan','status','foto_motor',];
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
        $index=1;
        $button="";
        $fetch = $this->db->query("SELECT * from pesanan $where");
        $fetch2 = $this->db->query("SELECT * from pesanan ");
        foreach($fetch->result() as $rows){
            $button1= "<a href=".base_url('pesanan/read/'.$rows->id)." data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
            $button2= "<a href=".base_url('pesanan/update/'.$rows->id)." data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
            $button3 = "<a href=".base_url('pesanan/delete/'.$rows->id)." data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";
        
            $sub_array=array();
            $sub_array[]=$index;$sub_array[]=$rows->kode_pesanan;
	 $sub_array[]=$rows->tanggal_dibuat;
	 $sub_array[]=$rows->id_pelanggan;
	 $sub_array[]=$rows->nama_lengkap;
	 $sub_array[]=$rows->nomor_mesin;
	 $sub_array[]=$rows->nomor_plat_kendaraan;
	 $sub_array[]=$rows->foto_stnk;
	 $sub_array[]=$rows->nomor_hp;
	 $sub_array[]=$rows->keterangan;
	 $sub_array[]=$rows->status;
	 $sub_array[]=$rows->foto_motor;
	 
            $sub_array[]='<div class="table-actions">'.$button1." ".$button2." ".$button3.'</div>';
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
        $row = $this->Pesanan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_pesanan' => $row->kode_pesanan,
		'tanggal_dibuat' => $row->tanggal_dibuat,
		'id_pelanggan' => $row->id_pelanggan,
		'nama_lengkap' => $row->nama_lengkap,
		'nomor_mesin' => $row->nomor_mesin,
		'nomor_plat_kendaraan' => $row->nomor_plat_kendaraan,
		'foto_stnk' => $row->foto_stnk,
		'nomor_hp' => $row->nomor_hp,
		'keterangan' => $row->keterangan,
		'status' => $row->status,
		'foto_motor' => $row->foto_motor,
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
	    'nomor_mesin' => set_value('nomor_mesin'),
	    'nomor_plat_kendaraan' => set_value('nomor_plat_kendaraan'),
	    'foto_stnk' => set_value('foto_stnk'),
	    'nomor_hp' => set_value('nomor_hp'),
	    'keterangan' => set_value('keterangan'),
	    'status' => set_value('status'),
	    'foto_motor' => set_value('foto_motor'),
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
		'kode_pesanan' => $this->input->post('kode_pesanan',TRUE),
		'tanggal_dibuat' => $this->input->post('tanggal_dibuat',TRUE),
		'id_pelanggan' => $this->input->post('id_pelanggan',TRUE),
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'nomor_mesin' => $this->input->post('nomor_mesin',TRUE),
		'nomor_plat_kendaraan' => $this->input->post('nomor_plat_kendaraan',TRUE),
		'foto_stnk' => $this->input->post('foto_stnk',TRUE),
		'nomor_hp' => $this->input->post('nomor_hp',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'foto_motor' => $this->input->post('foto_motor',TRUE),
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
		'nomor_mesin' => set_value('nomor_mesin', $row->nomor_mesin),
		'nomor_plat_kendaraan' => set_value('nomor_plat_kendaraan', $row->nomor_plat_kendaraan),
		'foto_stnk' => set_value('foto_stnk', $row->foto_stnk),
		'nomor_hp' => set_value('nomor_hp', $row->nomor_hp),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'status' => set_value('status', $row->status),
		'foto_motor' => set_value('foto_motor', $row->foto_motor),
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
		'kode_pesanan' => $this->input->post('kode_pesanan',TRUE),
		'tanggal_dibuat' => $this->input->post('tanggal_dibuat',TRUE),
		'id_pelanggan' => $this->input->post('id_pelanggan',TRUE),
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'nomor_mesin' => $this->input->post('nomor_mesin',TRUE),
		'nomor_plat_kendaraan' => $this->input->post('nomor_plat_kendaraan',TRUE),
		'foto_stnk' => $this->input->post('foto_stnk',TRUE),
		'nomor_hp' => $this->input->post('nomor_hp',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'foto_motor' => $this->input->post('foto_motor',TRUE),
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
	$this->form_validation->set_rules('nomor_mesin', 'nomor mesin', 'trim|required');
	$this->form_validation->set_rules('nomor_plat_kendaraan', 'nomor plat kendaraan', 'trim|required');
	$this->form_validation->set_rules('foto_stnk', 'foto stnk', 'trim|required');
	$this->form_validation->set_rules('nomor_hp', 'nomor hp', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('foto_motor', 'foto motor', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pesanan.php */
/* Location: ./application/controllers/Pesanan.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-05-14 06:42:42 */
/* https://gocodings.web.com */