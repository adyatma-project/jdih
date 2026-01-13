<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atur_interaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('logged_in') == "") redirect('backend'); // Cek Login sesuai Backend.php
    }

    public function index() {
        // Ambil data link
        $data['link_pengaduan'] = $this->db->get_where('tbl_interaksi', ['jenis' => 'pengaduan'])->row()->link_url;
        $data['link_survei']    = $this->db->get_where('tbl_interaksi', ['jenis' => 'survei'])->row()->link_url;
        
        // Load view sesuai struktur AdminLTE Anda

        $this->template->load('backend/template','backend/interaksi/v_atur_interaksi', $data);
    }

    public function update() {
        $link_pengaduan = $this->input->post('link_pengaduan', TRUE);
        $link_survei    = $this->input->post('link_survei', TRUE);

        $this->db->where('jenis', 'pengaduan')->update('tbl_interaksi', ['link_url' => $link_pengaduan]);
        $this->db->where('jenis', 'survei')->update('tbl_interaksi', ['link_url' => $link_survei]);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Link Berhasil Diupdate!</div>');
        redirect('atur_interaksi');
    }
}