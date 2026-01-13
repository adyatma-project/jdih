<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_interaksi');
    }

    public function pengaduan() {
        $data['judul'] = 'Pengaduan Hukum';
        $data['url_gform'] = $this->M_interaksi->get_link('pengaduan');
        
        // Load view template frontend Anda
        $this->load->view('front/layouts/header', $data); 
        $this->load->view('front/v_interaksi_embed', $data);
        $this->load->view('front/layouts/footer');
    }

    public function survei() {
        $data['judul'] = 'Survei Kepuasan Masyarakat';
        $data['url_gform'] = $this->M_interaksi->get_link('survei');
        
        $this->load->view('front/layouts/header', $data);
        $this->load->view('front/v_interaksi_embed', $data);
        $this->load->view('front/layouts/footer');
    }
}