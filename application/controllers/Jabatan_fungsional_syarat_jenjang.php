<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan_fungsional_syarat_jenjang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Jabatan_fungsional_syarat_jenjang_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('jabatan_fungsional_syarat_jenjang/jabatan_fungsional_syarat_jenjang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jabatan_fungsional_syarat_jenjang_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jabatan_fungsional_syarat_jenjang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_syarat_kelompok' => $row->id_syarat_kelompok,
		'id_jenjang' => $row->id_jenjang,
	    );
            $this->load->view('jabatan_fungsional_syarat_jenjang/jabatan_fungsional_syarat_jenjang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_fungsional_syarat_jenjang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jabatan_fungsional_syarat_jenjang/create_action'),
	    'id' => set_value('id'),
	    'id_syarat_kelompok' => set_value('id_syarat_kelompok'),
	    'id_jenjang' => set_value('id_jenjang'),
	);
        $this->load->view('jabatan_fungsional_syarat_jenjang/jabatan_fungsional_syarat_jenjang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_syarat_kelompok' => $this->input->post('id_syarat_kelompok',TRUE),
		'id_jenjang' => $this->input->post('id_jenjang',TRUE),
	    );

            $this->Jabatan_fungsional_syarat_jenjang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jabatan_fungsional_syarat_jenjang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jabatan_fungsional_syarat_jenjang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatan_fungsional_syarat_jenjang/update_action'),
		'id' => set_value('id', $row->id),
		'id_syarat_kelompok' => set_value('id_syarat_kelompok', $row->id_syarat_kelompok),
		'id_jenjang' => set_value('id_jenjang', $row->id_jenjang),
	    );
            $this->load->view('jabatan_fungsional_syarat_jenjang/jabatan_fungsional_syarat_jenjang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_fungsional_syarat_jenjang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_syarat_kelompok' => $this->input->post('id_syarat_kelompok',TRUE),
		'id_jenjang' => $this->input->post('id_jenjang',TRUE),
	    );

            $this->Jabatan_fungsional_syarat_jenjang_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatan_fungsional_syarat_jenjang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jabatan_fungsional_syarat_jenjang_model->get_by_id($id);

        if ($row) {
            $this->Jabatan_fungsional_syarat_jenjang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatan_fungsional_syarat_jenjang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_fungsional_syarat_jenjang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_syarat_kelompok', 'id syarat kelompok', 'trim|required');
	$this->form_validation->set_rules('id_jenjang', 'id jenjang', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jabatan_fungsional_syarat_jenjang.php */
/* Location: ./application/controllers/Jabatan_fungsional_syarat_jenjang.php */
/* Please DO NOT modify this information : */
/* Generated by mahrus@pcr.ac.id*/