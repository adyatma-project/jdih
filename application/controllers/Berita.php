<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_berita_model');
        $this->load->helper('text'); // Untuk word_limiter
    }

    public function index()
    {
        // Konfigurasi Pagination Modern
        $this->load->library('pagination');
        
        $config['base_url'] = base_url('berita/index');
        $config['total_rows'] = $this->db->where('status', '1')->count_all_results('ta_berita'); // Hanya yang publish
        $config['per_page'] = 6; // Tampilkan 6 berita per halaman
        
        // Styling Pagination (Bootstrap 3/4 Compatible)
        $config['full_tag_open']    = '<ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['attributes']       = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $start = $this->uri->segment(3);
        
        // Ambil data berita join kategori
        $this->db->select('ta_berita.*, ref_kategori_berita.kategori as nama_kategori');
        $this->db->join('ref_kategori_berita', 'ta_berita.jenis_berita = ref_kategori_berita.id_kategori', 'left');
        $this->db->where('ta_berita.status', '1');
        $this->db->order_by('ta_berita.tgl_insert', 'DESC');
        $data['berita'] = $this->db->get('ta_berita', $config['per_page'], $start)->result();
        
        $data['pagination'] = $this->pagination->create_links();

        // Ganti 'frontend/template' sesuai nama template utama website Anda
        $this->template->load('frontend/template_public', 'frontend/berita/list', $data);
    }

    public function detail($id)
    {
        // Update Viewer (+1 setiap diklik)
        $this->db->where('id_berita', $id);
        $this->db->set('viewer', 'viewer+1', FALSE);
        $this->db->update('ta_berita');

        // Ambil Data
        $this->db->select('ta_berita.*, ref_kategori_berita.kategori as nama_kategori');
        $this->db->join('ref_kategori_berita', 'ta_berita.jenis_berita = ref_kategori_berita.id_kategori', 'left');
        $this->db->where('ta_berita.id_berita', $id);
        $row = $this->db->get('ta_berita')->row();

        if ($row) {
            $data['berita'] = $row;
            $data['berita_terbaru'] = $this->Ta_berita_model->get_limit_data(5, 0); // Sidebar berita terbaru
            $this->template->load('frontend/template_public', 'frontend/berita/detail', $data);
        } else {
            redirect('berita');
        }
    }
}