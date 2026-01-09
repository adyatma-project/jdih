<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_status_peraturan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_status_peraturan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'ref_status_peraturan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ref_status_peraturan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ref_status_peraturan';
            $config['first_url'] = base_url() . 'ref_status_peraturan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ref_status_peraturan_model->total_rows($q);
        $ref_status_peraturan = $this->Ref_status_peraturan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ref_status_peraturan_data' => $ref_status_peraturan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('ref_status_peraturan/ref_status_peraturan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Ref_status_peraturan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_status_peraturan' => $row->id_status_peraturan,
		'nama_status_peraturan' => $row->nama_status_peraturan,
	    );
            $this->load->view('ref_status_peraturan/ref_status_peraturan_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
            redirect(site_url('ref_status_peraturan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ref_status_peraturan/create_action'),
	    'id_status_peraturan' => set_value('id_status_peraturan'),
	    'nama_status_peraturan' => set_value('nama_status_peraturan'),
	);
        $this->load->view('ref_status_peraturan/ref_status_peraturan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_status_peraturan' => $this->input->post('nama_status_peraturan',TRUE),
	    );

            $this->Ref_status_peraturan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Berhasil Menambah Data.
				</div>');
            redirect(site_url('ref_status_peraturan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Ref_status_peraturan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ref_status_peraturan/update_action'),
		'id_status_peraturan' => set_value('id_status_peraturan', $row->id_status_peraturan),
		'nama_status_peraturan' => set_value('nama_status_peraturan', $row->nama_status_peraturan),
	    );
            $this->load->view('ref_status_peraturan/ref_status_peraturan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ref_status_peraturan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_status_peraturan', TRUE));
        } else {
            $data = array(
		'nama_status_peraturan' => $this->input->post('nama_status_peraturan',TRUE),
	    );

            $this->Ref_status_peraturan_model->update($this->input->post('id_status_peraturan', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Berhasil Mengupdate Data.
				</div>');
            redirect(site_url('ref_status_peraturan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ref_status_peraturan_model->get_by_id($id);

        if ($row) {
            $this->Ref_status_peraturan_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Berhasil Menghapus Data.
				</div>');
            redirect(site_url('ref_status_peraturan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ref_status_peraturan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_status_peraturan', 'nama status peraturan', 'trim|required');

	$this->form_validation->set_rules('id_status_peraturan', 'id_status_peraturan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ref_status_peraturan.php */
/* Location: ./application/controllers/Ref_status_peraturan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-16 00:36:54 */
/* http://harviacode.com */