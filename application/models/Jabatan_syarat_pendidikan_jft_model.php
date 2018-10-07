<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan_syarat_pendidikan_jft_model extends CI_Model
{

    public $table = 'jabatan_syarat_pendidikan_jft';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,id_jabatan,jpendidikan_id,bidang_id');
        $this->datatables->from('jabatan_syarat_pendidikan_jft');
        //add this line for join
        //$this->datatables->join('table2', 'jabatan_syarat_pendidikan_jft.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('jabatan_syarat_pendidikan_jft/update/$1'),'<i class="fa fa-pencil"></i>','class="btn btn-warning btn-xs"' )." ".anchor(site_url('jabatan_syarat_pendidikan_jft/delete/$1'),'<i class="fa fa-trash"></i>','class="btn btn-danger btn-xs" onclick="javasciprt: return confirm(\'Apakah Anda Yakin Menghapus Data Ini ?\')"'), 'id');
        return $this->datatables->generate();
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
	$this->db->or_like('id_jabatan', $q);
	$this->db->or_like('jpendidikan_id', $q);
	$this->db->or_like('bidang_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('id_jabatan', $q);
	$this->db->or_like('jpendidikan_id', $q);
	$this->db->or_like('bidang_id', $q);
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

/* End of file Jabatan_syarat_pendidikan_jft.php */
/* Location: ./application/controllers/Jabatan_syarat_pendidikan_jft.php */
/* Please DO NOT modify this information : */
/* Generated by mahrus@pcr.ac.id*/