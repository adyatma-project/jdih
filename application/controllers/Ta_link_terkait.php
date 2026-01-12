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
        $this->load->library('upload');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'ta_link_terkait?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'ta_link_terkait?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'ta_link_terkait';
                $config['first_url'] = base_url() . 'ta_link_terkait';
            }

            $config['per_page'] = 25;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Ta_link_terkait_model->total_rows($q);
            $ta_link = $this->Ta_link_terkait_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'ta_link_data' => $ta_link,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->template->load('backend/template','backend/ta_link_terkait/ta_link_terkait_list', $data);
        } else {
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
                'id_link' => set_value('id_link'),
                'nama_link' => set_value('nama_link'),
                'url' => set_value('url'),
                'logo' => set_value('logo'),
                'urutan' => set_value('urutan', '0'),
            );
            $this->template->load('backend/template','backend/ta_link_terkait/ta_link_terkait_form', $data);
        } else {
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
                    'nama_link' => $this->input->post('nama_link',TRUE),
                    'url' => $this->input->post('url',TRUE),
                    'urutan' => $this->input->post('urutan',TRUE),
                    'tgl_input' => date('Y-m-d H:i:s'),
                );

                if(!empty($_FILES['logo']['name'])) {
                    $nm = str_replace(" ","_",$_FILES['logo']['name']);
                    $n_baru = "Logo-".date('YmdHis')."-".$nm;
                    
                    // Folder upload: uploads/links/
                    $config['upload_path']   = FCPATH . 'uploads/links/'; 
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name']     = $n_baru;
                    $config['max_size']      = '5000'; 
             
                    $this->upload->initialize($config);
             
                    if ($this->upload->do_upload("logo")) {
                        $data_file = $this->upload->data();
                        $data['logo'] = $data_file['file_name'];
                        
                        $this->Ta_link_terkait_model->insert($data);
                        $this->session->set_flashdata('message', '<div class="alert alert-success">Simpan Data Berhasil</div>');
                        redirect(site_url('ta_link_terkait'));
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">Gagal Upload: '.$this->upload->display_errors().'</div>');
                        $this->create();
                    }
                } else {
                     // Boleh tanpa logo? Sebaiknya wajib untuk carousel
                     $this->session->set_flashdata('message', '<div class="alert alert-warning">Logo wajib diupload</div>');
                     $this->create();
                }
            }
        } else {
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
                    'button' => 'Ubah',
                    'action' => site_url('ta_link_terkait/update_action'),
                    'id_link' => set_value('id_link', $row->id_link),
                    'nama_link' => set_value('nama_link', $row->nama_link),
                    'url' => set_value('url', $row->url),
                    'logo' => set_value('logo', $row->logo),
                    'urutan' => set_value('urutan', $row->urutan),
                );
                $this->template->load('backend/template','backend/ta_link_terkait/ta_link_terkait_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Data tidak ditemukan');
                redirect(site_url('ta_link_terkait'));
            }
        } else {
            header('location:'.base_url().'backend');
        }
    }
    
    public function update_action() 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_link', TRUE));
            } else {
                $id = $this->input->post('id_link', TRUE);
                $data = array(
                    'nama_link' => $this->input->post('nama_link',TRUE),
                    'url' => $this->input->post('url',TRUE),
                    'urutan' => $this->input->post('urutan',TRUE),
                );

                if(!empty($_FILES['logo']['name']))
                {
                    $row = $this->Ta_link_terkait_model->get_by_id($id);
                    // Hapus file lama
                    if ($row->logo != "" && file_exists(FCPATH . 'uploads/links/' . $row->logo)) {
                        @unlink(FCPATH . 'uploads/links/' . $row->logo);
                    }

                    $nm = str_replace(" ","_",$_FILES['logo']['name']);
                    $n_baru = "Logo-".date('YmdHis')."-".$nm;
                    
                    $config['upload_path']   = FCPATH . 'uploads/links/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name']     = $n_baru;
                    $config['max_size']      = '5000';
             
                    $this->upload->initialize($config);
             
                    if ($this->upload->do_upload("logo")) {
                        $data_file = $this->upload->data();
                        $data['logo'] = $data_file['file_name'];
                    }
                }

                $this->Ta_link_terkait_model->update($id, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Update Berhasil</div>');
                redirect(site_url('ta_link_terkait'));
            }
        } else {
            header('location:'.base_url().'backend');
        }
    }
    
    public function delete($id) 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $row = $this->Ta_link_terkait_model->get_by_id($id);
            if ($row) {
                if ($row->logo != "" && file_exists(FCPATH . 'uploads/links/' . $row->logo)) {
                    @unlink(FCPATH . 'uploads/links/' . $row->logo);
                }
                
                $this->Ta_link_terkait_model->delete($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Hapus Berhasil</div>');
                redirect(site_url('ta_link_terkait'));
            } else {
                $this->session->set_flashdata('message', 'Data tidak ditemukan');
                redirect(site_url('ta_link_terkait'));
            }
        } else {
            header('location:'.base_url().'backend');
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('nama_link', 'nama link', 'trim|required');
        $this->form_validation->set_rules('url', 'url', 'trim|required');
        $this->form_validation->set_rules('id_link', 'id_link', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}