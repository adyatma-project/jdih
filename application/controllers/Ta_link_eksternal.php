<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_link_eksternal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_link_eksternal_model');
        $this->load->library('form_validation');
        
        if ($this->session->userdata('logged_in') == "" || $this->session->userdata('stts') != "administrator") {
            redirect('backend');
        }
    }

    public function index()
    {
        $data_link = $this->Ta_link_eksternal_model->get_all();
        $data = array(
            'data_link' => $data_link,
        );
        // Pastikan Anda membuat folder view 'backend/ta_link_eksternal' nanti
        $this->template->load('backend/template', 'backend/ta_link_eksternal/list', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('ta_link_eksternal/create_action'),
            'id_link' => set_value('id_link'),
            'nama_link' => set_value('nama_link'),
            'url' => set_value('url'),
            'status' => set_value('status', '1'),
            'urutan' => set_value('urutan', '0'),
        );
        $this->template->load('backend/template', 'backend/ta_link_eksternal/form', $data);
    }

    public function create_action()
    {
        $this->form_validation->set_rules('nama_link', 'Nama Link', 'trim|required');
        $this->form_validation->set_rules('url', 'URL', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_link' => $this->input->post('nama_link', TRUE),
                'url' => $this->input->post('url', TRUE),
                'status' => $this->input->post('status', TRUE),
                'urutan' => $this->input->post('urutan', TRUE),
            );

            $this->Ta_link_eksternal_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Disimpan</div>');
            redirect(site_url('ta_link_eksternal'));
        }
    }

    public function update($id)
    {
        $row = $this->Ta_link_eksternal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('ta_link_eksternal/update_action'),
                'id_link' => set_value('id_link', $row->id_link),
                'nama_link' => set_value('nama_link', $row->nama_link),
                'url' => set_value('url', $row->url),
                'status' => set_value('status', $row->status),
                'urutan' => set_value('urutan', $row->urutan),
            );
            $this->template->load('backend/template', 'backend/ta_link_eksternal/form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('ta_link_eksternal'));
        }
    }

    public function update_action()
    {
        $this->form_validation->set_rules('nama_link', 'Nama Link', 'trim|required');
        $this->form_validation->set_rules('url', 'URL', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_link', TRUE));
        } else {
            $data = array(
                'nama_link' => $this->input->post('nama_link', TRUE),
                'url' => $this->input->post('url', TRUE),
                'status' => $this->input->post('status', TRUE),
                'urutan' => $this->input->post('urutan', TRUE),
            );

            $this->Ta_link_eksternal_model->update($this->input->post('id_link', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Update Berhasil</div>');
            redirect(site_url('ta_link_eksternal'));
        }
    }

    public function delete($id)
    {
        $row = $this->Ta_link_eksternal_model->get_by_id($id);
        if ($row) {
            $this->Ta_link_eksternal_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Hapus Berhasil</div>');
            redirect(site_url('ta_link_eksternal'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('ta_link_eksternal'));
        }
    }
}