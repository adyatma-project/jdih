<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_link_terkait extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_link_terkait_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'ta_link_terkait/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'ta_link_terkait/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'ta_link_terkait/index.html';
                $config['first_url'] = base_url() . 'ta_link_terkait/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Ta_link_terkait_model->total_rows($q);
            $ta_link_terkait = $this->Ta_link_terkait_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'ta_link_terkait_data' => $ta_link_terkait,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->template->load('backend/template','backend/ta_link_terkait/ta_link_terkait_list', $data);
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

            $row = $this->Ta_link_terkait_model->get_by_id($id);
            if ($row) {
                $data = array(
    		'id' => $row->id,
    		'judul' => $row->judul,
    		'hyperlink' => $row->hyperlink,
    	    );
                $this->template->load('backend/template','backend/ta_link_terkait/ta_link_terkait_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ta_link_terkait'));
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
                'action' => site_url('ta_link_terkait/create_action'),
    	    'id' => set_value('id'),
    	    'judul' => set_value('judul'),
    	    'hyperlink' => set_value('hyperlink'),
    	   );
            $this->template->load('backend/template','backend/ta_link_terkait/ta_link_terkait_form', $data);
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
    		'judul' => $this->input->post('judul',TRUE),
    		'hyperlink' => $this->input->post('hyperlink',TRUE),
    	    );

                $this->Ta_link_terkait_model->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Berhasil Menambah Data.
                </div>');
                redirect(site_url('ta_link_terkait'));
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
            $row = $this->Ta_link_terkait_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('ta_link_terkait/update_action'),
    		'id' => set_value('id', $row->id),
    		'judul' => set_value('judul', $row->judul),
    		'hyperlink' => set_value('hyperlink', $row->hyperlink),
    	    );
                $this->template->load('backend/template','backend/ta_link_terkait/ta_link_terkait_form', $data);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Data Tidak Ditemukan.
                </div>');
                redirect(site_url('ta_link_terkait'));
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
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
    		'judul' => $this->input->post('judul',TRUE),
    		'hyperlink' => $this->input->post('hyperlink',TRUE),
    	    );

                $this->Ta_link_terkait_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Berhasil Mengupdate Data.
                </div>');
                redirect(site_url('ta_link_terkait'));
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
            $row = $this->Ta_link_terkait_model->get_by_id($id);

            if ($row) {
                $this->Ta_link_terkait_model->delete($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Berhasil Menghapus Data.
                    </div>');
                redirect(site_url('ta_link_terkait'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Tidak dapat dihapus karena Kategori digunakan pada Peraturan yang ada.
                        </div>');
                redirect(site_url('ta_link_terkait'));
            }
        }
        else
        {
            header('location:'.base_url().'backend');
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
    	$this->form_validation->set_rules('hyperlink', 'hyperlink', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ta_link_terkait.php */
/* Location: ./application/controllers/Ta_link_terkait.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-22 16:28:34 */
/* http://harviacode.com */