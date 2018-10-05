<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenjang_kategori_jf_tertentu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Jenjang_kategori_jf_tertentu_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('jenjang_kategori_jf_tertentu/jenjang_kategori_jf_tertentu_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jenjang_kategori_jf_tertentu_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jenjang_kategori_jf_tertentu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_jenjang' => $row->id_jenjang,
		'id_jenjang_kategori' => $row->id_jenjang_kategori,
	    );
            $this->load->view('jenjang_kategori_jf_tertentu/jenjang_kategori_jf_tertentu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang_kategori_jf_tertentu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenjang_kategori_jf_tertentu/create_action'),
	    'id' => set_value('id'),
	    'id_jenjang' => set_value('id_jenjang'),
	    'id_jenjang_kategori' => set_value('id_jenjang_kategori'),
	);
        $this->load->view('jenjang_kategori_jf_tertentu/jenjang_kategori_jf_tertentu_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_jenjang' => $this->input->post('id_jenjang',TRUE),
		'id_jenjang_kategori' => $this->input->post('id_jenjang_kategori',TRUE),
	    );

            $this->Jenjang_kategori_jf_tertentu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenjang_kategori_jf_tertentu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jenjang_kategori_jf_tertentu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenjang_kategori_jf_tertentu/update_action'),
		'id' => set_value('id', $row->id),
		'id_jenjang' => set_value('id_jenjang', $row->id_jenjang),
		'id_jenjang_kategori' => set_value('id_jenjang_kategori', $row->id_jenjang_kategori),
	    );
            $this->load->view('jenjang_kategori_jf_tertentu/jenjang_kategori_jf_tertentu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang_kategori_jf_tertentu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_jenjang' => $this->input->post('id_jenjang',TRUE),
		'id_jenjang_kategori' => $this->input->post('id_jenjang_kategori',TRUE),
	    );

            $this->Jenjang_kategori_jf_tertentu_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenjang_kategori_jf_tertentu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jenjang_kategori_jf_tertentu_model->get_by_id($id);

        if ($row) {
            $this->Jenjang_kategori_jf_tertentu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenjang_kategori_jf_tertentu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang_kategori_jf_tertentu'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_jenjang', 'id jenjang', 'trim|required');
	$this->form_validation->set_rules('id_jenjang_kategori', 'id jenjang kategori', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenjang_kategori_jf_tertentu.php */
/* Location: ./application/controllers/Jenjang_kategori_jf_tertentu.php */
/* Please DO NOT modify this information : */
/* Generated by mahrus@pcr.ac.id*/