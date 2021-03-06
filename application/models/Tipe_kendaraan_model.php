<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipe_kendaraan_model extends CI_Model
{

    public $table = 'tipe_kendaraan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('kode_motor', $q);
	$this->db->or_like('tipe_motor', $q);
	$this->db->or_like('tahun_pembuatan', $q);
	$this->db->or_like('no_seri_mesin', $q);
	$this->db->or_like('no_seri_rangka', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('kode_motor', $q);
	$this->db->or_like('tipe_motor', $q);
	$this->db->or_like('tahun_pembuatan', $q);
	$this->db->or_like('no_seri_mesin', $q);
	$this->db->or_like('no_seri_rangka', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}





/* End of file Tipe_kendaraan_model.php */
/* Location: ./application/models/Tipe_kendaraan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2022-04-28 03:26:49 */
/* https://gocodings.web.app */