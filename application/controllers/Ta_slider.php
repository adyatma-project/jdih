<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_slider extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_slider_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'ta_slider?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'ta_slider?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'ta_slider';
                $config['first_url'] = base_url() . 'ta_slider';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Ta_slider_model->total_rows($q);
            $ta_slider = $this->Ta_slider_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'ta_slider_data' => $ta_slider,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->template->load('backend/template','backend/ta_slider/ta_slider_list', $data);
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
            $row = $this->Ta_slider_model->get_by_id($id);
            if ($row) {
                $data = array(
                    'id_slider' => $row->id_slider,
                    'judul' => $row->judul,
                    'sub_judul' => $row->sub_judul,
                    'foto' => $row->foto,
                    'urutan' => $row->urutan,
                    'status' => $row->status,
                    'tgl_input' => $row->tgl_input,
                );
                $this->template->load('backend/template','backend/ta_slider/ta_slider_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ta_slider'));
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
                'action' => site_url('ta_slider/create_action'),
                'id_slider' => set_value('id_slider'),
                'judul' => set_value('judul'),
                'sub_judul' => set_value('sub_judul'),
                'foto' => set_value('foto'),
                'urutan' => set_value('urutan', '0'),
                'status' => set_value('status', '1'),
            );
            $this->template->load('backend/template','backend/ta_slider/ta_slider_form', $data);
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
                $data['judul'] = $this->input->post('judul',TRUE);
                $data['sub_judul'] = $this->input->post('sub_judul',TRUE);
                $data['urutan'] = $this->input->post('urutan',TRUE);
                $data['status'] = $this->input->post('status',TRUE);
                $data['tgl_input'] = date("Y-m-d H:i:s");

                if(!empty($_FILES['foto']['name']))
                {
                    $nm = str_replace(" ","_",$_FILES['foto']['name']);
                    $n_baru = date('YmdHis')."_".$nm;
                    
                    $config['upload_path']   = "./uploads/slider/";
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name']     = $n_baru;
                    $config['max_size']      = '5000'; // 5MB
             
                    $this->load->library('upload', $config);
             
                    if ($this->upload->do_upload("foto")) {
                        $data_file = $this->upload->data();
                        $data['foto'] = $data_file['file_name'];
                    }
                }

                $this->Ta_slider_model->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil Menambah Data Slider</div>');
                redirect(site_url('ta_slider'));
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
            $row = $this->Ta_slider_model->get_by_id($id);
            if ($row) {
                $data = array(
                    'button' => 'Ubah',
                    'action' => site_url('ta_slider/update_action'),
                    'id_slider' => set_value('id_slider', $row->id_slider),
                    'judul' => set_value('judul', $row->judul),
                    'sub_judul' => set_value('sub_judul', $row->sub_judul),
                    'foto' => set_value('foto', $row->foto),
                    'urutan' => set_value('urutan', $row->urutan),
                    'status' => set_value('status', $row->status),
                );
                $this->template->load('backend/template','backend/ta_slider/ta_slider_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ta_slider'));
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
                $this->update($this->input->post('id_slider', TRUE));
            } else {
                $data['judul'] = $this->input->post('judul',TRUE);
                $data['sub_judul'] = $this->input->post('sub_judul',TRUE);
                $data['urutan'] = $this->input->post('urutan',TRUE);
                $data['status'] = $this->input->post('status',TRUE);

                // Cek jika ada upload foto baru
                if(!empty($_FILES['foto']['name']))
                {
                    $row = $this->Ta_slider_model->get_by_id($this->input->post('id_slider'));
                    // Hapus foto lama
                    if ($row->foto != "" && file_exists('./uploads/slider/' . $row->foto)) {
                        unlink('./uploads/slider/' . $row->foto);
                    }

                    $nm = str_replace(" ","_",$_FILES['foto']['name']);
                    $n_baru = date('YmdHis')."_".$nm;
                    
                    $config['upload_path']   = "./uploads/slider/";
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name']     = $n_baru;
                    $config['max_size']      = '5000';
             
                    $this->load->library('upload', $config);
             
                    if ($this->upload->do_upload("foto")) {
                        $data_file = $this->upload->data();
                        $data['foto'] = $data_file['file_name'];
                    }
                }

                $this->Ta_slider_model->update($this->input->post('id_slider', TRUE), $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Update Record Success</div>');
                redirect(site_url('ta_slider'));
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
            $row = $this->Ta_slider_model->get_by_id($id);
            if ($row) {
                // Hapus file fisik
                if ($row->foto != "" && file_exists('./uploads/slider/' . $row->foto)) {
                    unlink('./uploads/slider/' . $row->foto);
                }
                
                $this->Ta_slider_model->delete($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Delete Record Success</div>');
                redirect(site_url('ta_slider'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ta_slider'));
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
        $this->form_validation->set_rules('id_slider', 'id_slider', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}