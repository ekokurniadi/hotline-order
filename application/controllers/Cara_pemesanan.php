<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cara_pemesanan extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cara_pemesanan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $cara_pemesanan = $this->Cara_pemesanan_model->get_all();

        $data = array(
            'cara_pemesanan_data' => $cara_pemesanan
        );
        $this->load->view('header');
        $this->load->view('cara_pemesanan/cara_pemesanan_list', $data);
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
                $where .= " AND (urutan LIKE '%$search%'
	 AND (cara_pemesanan LIKE '%$search%'
	 )";
	
              }
          }
    
        if (isset($orders)) {
            if ($orders != '') {
              $order = $orders;
              $order_column =['urutan','cara_pemesanan',];
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
        $fetch = $this->db->query("SELECT * from cara_pemesanan $where");
        $fetch2 = $this->db->query("SELECT * from cara_pemesanan ");
        foreach($fetch->result() as $rows){
            $button1= "<a href=".base_url('cara_pemesanan/read/'.$rows->id)." data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
            $button2= "<a href=".base_url('cara_pemesanan/update/'.$rows->id)." data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
            $button3 = "<a href=".base_url('cara_pemesanan/delete/'.$rows->id)." data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";
        
            $sub_array=array();
            $sub_array[]=$index;$sub_array[]=$rows->urutan;
	 $sub_array[]=$rows->cara_pemesanan;
	 
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
        $row = $this->Cara_pemesanan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'urutan' => $row->urutan,
		'cara_pemesanan' => $row->cara_pemesanan,
	    );
            $this->load->view('header');
            $this->load->view('cara_pemesanan/cara_pemesanan_read', $data);
            $this->load->view('footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('cara_pemesanan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('cara_pemesanan/create_action'),
	    'id' => set_value('id'),
	    'urutan' => set_value('urutan'),
	    'cara_pemesanan' => set_value('cara_pemesanan'),
	);

        $this->load->view('header');
        $this->load->view('cara_pemesanan/cara_pemesanan_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'urutan' => $this->input->post('urutan',TRUE),
		'cara_pemesanan' => $this->input->post('cara_pemesanan',TRUE),
	    );

            $this->Cara_pemesanan_model->insert($data);
            $_SESSION['pesan'] = "Create Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('cara_pemesanan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Cara_pemesanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cara_pemesanan/update_action'),
		'id' => set_value('id', $row->id),
		'urutan' => set_value('urutan', $row->urutan),
		'cara_pemesanan' => set_value('cara_pemesanan', $row->cara_pemesanan),
	    );
            $this->load->view('header');
            $this->load->view('cara_pemesanan/cara_pemesanan_form', $data);
            $this->load->view('footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('cara_pemesanan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'urutan' => $this->input->post('urutan',TRUE),
		'cara_pemesanan' => $this->input->post('cara_pemesanan',TRUE),
	    );

            $this->Cara_pemesanan_model->update($this->input->post('id', TRUE), $data);
            $_SESSION['pesan'] = "Update Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('cara_pemesanan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Cara_pemesanan_model->get_by_id($id);

        if ($row) {
            $this->Cara_pemesanan_model->delete($id);
            $_SESSION['pesan'] = "Delete Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('cara_pemesanan'));
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('cara_pemesanan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('urutan', 'urutan', 'trim|required');
	$this->form_validation->set_rules('cara_pemesanan', 'cara pemesanan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Cara_pemesanan.php */
/* Location: ./application/controllers/Cara_pemesanan.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-05-09 16:39:07 */
/* https://gocodings.web.com */