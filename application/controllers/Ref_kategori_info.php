<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_kategori_info extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_kategori_info_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			
			if ($q <> '') {
				$config['base_url'] = base_url() . 'ref_kategori_info?q=' . urlencode($q);
				$config['first_url'] = base_url() . 'ref_kategori_info?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . 'ref_kategori_info';
				$config['first_url'] = base_url() . 'ref_kategori_info';
			}

			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Ref_kategori_info_model->total_rows($q);
			$ref_kategori_info = $this->Ref_kategori_info_model->get_limit_data($config['per_page'], $start, $q);
			
			
			
			
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'ref_kategori_info_data' => $ref_kategori_info,
				'q' => $q,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
			);
			
			$this->template->load('backend/template','backend/ref_kategori_info/ref_kategori_info_list', $data);
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }

    public function read($id) 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$row = $this->Ref_kategori_info_model->get_by_id($id);
			if ($row) {
				$data = array(
					'id_kategori' => $row->id_kategori,
					'kategori' => $row->kategori,
					'status' => $row->status,
				);
				
				$this->template->load('backend/template','backend/ref_kategori_info/ref_kategori_info_read', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ref_kategori_info'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }

    public function create() 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$data = array(
				'button' => 'Simpan',
				'action' => site_url('ref_kategori_info/create_action'),
				'id_kategori' => set_value('id_kategori'),
				'kategori' => set_value('kategori'),
				'status' => set_value('status'),
			);
			
			$this->template->load('backend/template','backend/ref_kategori_info/ref_kategori_info_form', $data);
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }
    
    public function create_action() 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{	
			$this->_rules();

			if ($this->form_validation->run() == FALSE) {
				$this->create();
			} else {
				$data = array(
					'kategori' => $this->input->post('kategori',TRUE),
					'status' => $this->input->post('status',TRUE),
				);

				$this->Ref_kategori_info_model->insert($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Berhasil Menambah Data.
				</div>');
				redirect(site_url('ref_kategori_info'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }
    
    public function update($id) 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$row = $this->Ref_kategori_info_model->get_by_id($id);
			if ($row) {
				$data = array(
					'button' => 'Ubah',
					'action' => site_url('ref_kategori_info/update_action'),
					'id_kategori' => set_value('id_kategori', $row->id_kategori),
					'kategori' => set_value('kategori', $row->kategori),
					'status' => set_value('status', $row->status),
				);
				
				$this->template->load('backend/template','backend/ref_kategori_info/ref_kategori_info_form', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ref_kategori_info'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }
    
    public function update_action() 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$this->_rules();

			if ($this->form_validation->run() == FALSE) {
				$this->update($this->input->post('id_kategori', TRUE));
			} else {
				$data = array(
					'kategori' => $this->input->post('kategori',TRUE),
					'status' => $this->input->post('status',TRUE),
				);

				$this->Ref_kategori_info_model->update($this->input->post('id_kategori', TRUE), $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Berhasil Mengupdate Data.
				</div>');
				redirect(site_url('ref_kategori_info'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }
    
    public function delete($id) 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$row = $this->Ref_kategori_info_model->get_by_id($id);
			if ($row) {
				$this->Ref_kategori_info_model->delete($id);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Berhasil Menghapus Data.
				</div>');
				redirect(site_url('ref_kategori_info'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ref_kategori_info'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ref_kategori_info.php */
/* Location: ./application/controllers/Ref_kategori_info.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-20 09:01:31 */
/* http://harviacode.com */