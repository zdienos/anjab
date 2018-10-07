<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan_fungsional_kategori_jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Jabatan_fungsional_kategori_jabatan_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('jabatan_fungsional_kategori_jabatan/jabatan_fungsional_kategori_jabatan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jabatan_fungsional_kategori_jabatan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jabatan_fungsional_kategori_jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_kategori' => $row->id_kategori,
		'id_jabatan' => $row->id_jabatan,
	    );
            $this->load->view('jabatan_fungsional_kategori_jabatan/jabatan_fungsional_kategori_jabatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_fungsional_kategori_jabatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jabatan_fungsional_kategori_jabatan/create_action'),
	    'id' => set_value('id'),
	    'id_kategori' => set_value('id_kategori'),
	    'id_jabatan' => set_value('id_jabatan'),
	);
        $this->load->view('jabatan_fungsional_kategori_jabatan/jabatan_fungsional_kategori_jabatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'id_jabatan' => $this->input->post('id_jabatan',TRUE),
	    );

            $this->Jabatan_fungsional_kategori_jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jabatan_fungsional_kategori_jabatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jabatan_fungsional_kategori_jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatan_fungsional_kategori_jabatan/update_action'),
		'id' => set_value('id', $row->id),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
	    );
            $this->load->view('jabatan_fungsional_kategori_jabatan/jabatan_fungsional_kategori_jabatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_fungsional_kategori_jabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'id_jabatan' => $this->input->post('id_jabatan',TRUE),
	    );

            $this->Jabatan_fungsional_kategori_jabatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatan_fungsional_kategori_jabatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jabatan_fungsional_kategori_jabatan_model->get_by_id($id);

        if ($row) {
            $this->Jabatan_fungsional_kategori_jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatan_fungsional_kategori_jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_fungsional_kategori_jabatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	$this->form_validation->set_rules('id_jabatan', 'id jabatan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jabatan_fungsional_kategori_jabatan.php */
/* Location: ./application/controllers/Jabatan_fungsional_kategori_jabatan.php */
/* Please DO NOT modify this information : */
/* Generated by mahrus@pcr.ac.id*/
