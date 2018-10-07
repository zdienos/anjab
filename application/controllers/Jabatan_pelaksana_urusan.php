<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan_pelaksana_urusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Jabatan_pelaksana_urusan_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('jabatan_pelaksana_urusan/jabatan_pelaksana_urusan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jabatan_pelaksana_urusan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jabatan_pelaksana_urusan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_urusan' => $row->nama_urusan,
	    );
            $this->load->view('jabatan_pelaksana_urusan/jabatan_pelaksana_urusan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_pelaksana_urusan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jabatan_pelaksana_urusan/create_action'),
	    'id' => set_value('id'),
	    'nama_urusan' => set_value('nama_urusan'),
	);
        $this->load->view('jabatan_pelaksana_urusan/jabatan_pelaksana_urusan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_urusan' => $this->input->post('nama_urusan',TRUE),
	    );

            $this->Jabatan_pelaksana_urusan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jabatan_pelaksana_urusan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jabatan_pelaksana_urusan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatan_pelaksana_urusan/update_action'),
		'id' => set_value('id', $row->id),
		'nama_urusan' => set_value('nama_urusan', $row->nama_urusan),
	    );
            $this->load->view('jabatan_pelaksana_urusan/jabatan_pelaksana_urusan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_pelaksana_urusan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_urusan' => $this->input->post('nama_urusan',TRUE),
	    );

            $this->Jabatan_pelaksana_urusan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatan_pelaksana_urusan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jabatan_pelaksana_urusan_model->get_by_id($id);

        if ($row) {
            $this->Jabatan_pelaksana_urusan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatan_pelaksana_urusan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan_pelaksana_urusan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_urusan', 'nama urusan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jabatan_pelaksana_urusan.php */
/* Location: ./application/controllers/Jabatan_pelaksana_urusan.php */
/* Please DO NOT modify this information : */
/* Generated by mahrus@pcr.ac.id*/
