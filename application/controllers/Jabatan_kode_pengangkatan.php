<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan_kode_pengangkatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Jabatan_kode_pengangkatan_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('jabatan_kode_pengangkatan/jabatan_kode_pengangkatan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jabatan_kode_pengangkatan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jabatan_kode_pengangkatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode' => $row->kode,
	    );
            $this->load->view('jabatan_kode_pengangkatan/jabatan_kode_pengangkatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_kode_pengangkatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jabatan_kode_pengangkatan/create_action'),
	    'id' => set_value('id'),
	    'kode' => set_value('kode'),
	);
        $this->load->view('jabatan_kode_pengangkatan/jabatan_kode_pengangkatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode' => $this->input->post('kode',TRUE),
	    );

            $this->Jabatan_kode_pengangkatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jabatan_kode_pengangkatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jabatan_kode_pengangkatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatan_kode_pengangkatan/update_action'),
		'id' => set_value('id', $row->id),
		'kode' => set_value('kode', $row->kode),
	    );
            $this->load->view('jabatan_kode_pengangkatan/jabatan_kode_pengangkatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_kode_pengangkatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kode' => $this->input->post('kode',TRUE),
	    );

            $this->Jabatan_kode_pengangkatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatan_kode_pengangkatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jabatan_kode_pengangkatan_model->get_by_id($id);

        if ($row) {
            $this->Jabatan_kode_pengangkatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatan_kode_pengangkatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_kode_pengangkatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode', 'kode', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jabatan_kode_pengangkatan.php */
/* Location: ./application/controllers/Jabatan_kode_pengangkatan.php */
/* Please DO NOT modify this information : */
/* Generated by mahrus@pcr.ac.id*/
