<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenjang_kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Jenjang_kategori_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('jenjang_kategori/jenjang_kategori_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jenjang_kategori_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jenjang_kategori_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_kategori' => $row->nama_kategori,
		'id_kelas' => $row->id_kelas,
	    );
            $this->load->view('jenjang_kategori/jenjang_kategori_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang_kategori'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenjang_kategori/create_action'),
	    'id' => set_value('id'),
	    'nama_kategori' => set_value('nama_kategori'),
	    'id_kelas' => set_value('id_kelas'),
	);
        $this->load->view('jenjang_kategori/jenjang_kategori_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
		'id_kelas' => $this->input->post('id_kelas',TRUE),
	    );

            $this->Jenjang_kategori_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenjang_kategori'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jenjang_kategori_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenjang_kategori/update_action'),
		'id' => set_value('id', $row->id),
		'nama_kategori' => set_value('nama_kategori', $row->nama_kategori),
		'id_kelas' => set_value('id_kelas', $row->id_kelas),
	    );
            $this->load->view('jenjang_kategori/jenjang_kategori_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang_kategori'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
		'id_kelas' => $this->input->post('id_kelas',TRUE),
	    );

            $this->Jenjang_kategori_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenjang_kategori'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jenjang_kategori_model->get_by_id($id);

        if ($row) {
            $this->Jenjang_kategori_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenjang_kategori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang_kategori'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kategori', 'nama kategori', 'trim|required');
	$this->form_validation->set_rules('id_kelas', 'id kelas', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenjang_kategori.php */
/* Location: ./application/controllers/Jenjang_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by mahrus@pcr.ac.id*/
