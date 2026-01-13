<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atur_halaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek sesi login administrator (sesuaikan dengan sistem login Anda)
        if($this->session->userdata('logged_in') == "") redirect('backend'); 
        $this->load->model('M_halaman');
    }

    // Fungsi Generic untuk Edit Halaman (bisa dipakai untuk sop, struktur, dll)
    public function edit($slug) {
        $data['page'] = $this->M_halaman->get_by_slug($slug);
        
        if(!$data['page']) {
            show_404(); // Tampilkan error jika slug tidak ada di database
        }

        $data['slug_aktif'] = $slug; // Untuk menandai menu aktif
        
        // Load view
        // $this->template->load('dashboard_admin/template', 'dashboard_admin/halaman/v_atur_interaksi', $data);
         $this->template->load('backend/template','backend/halaman/v_edit_halaman', $data);
    }

    public function update() {
        $slug = $this->input->post('slug');
        $isi  = $this->input->post('isi_konten'); // Ini data dari TinyMCE

        $data_update = [
            'isi_konten' => $isi,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->M_halaman->update_konten($slug, $data_update);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Diupdate!</div>');
        redirect('atur_halaman/edit/'.$slug);
    }
}