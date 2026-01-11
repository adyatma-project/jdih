<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_info_hukum_model');
        $this->load->model('Ta_berita_model');
        $this->load->model('Ta_produk_hukum_model');
        $this->load->library('form_validation');
        $this->load->helper('tanggal_helper');
        $this->load->model('Ref_kabag_model');
        $this->load->model('Ta_link_terkait_model');
    }
  public function index()
{
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    // Konfigurasi Pagination & Pencarian (Logika Lama)
    if ($q <> '') {
        $config['base_url'] = base_url() . 'frontend/index?q=' . urlencode($q);
        $config['first_url'] = base_url() . 'frontend/index?q=' . urlencode($q);
    } else {
        $config['base_url'] = base_url() . 'frontend/index';
        $config['first_url'] = base_url() . 'frontend/index';
    }

    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Ta_produk_hukum_model->total_rows($q);
    $ta_produk_hukum = $this->Ta_produk_hukum_model->get_limit_data($config['per_page'], $start, $q);
$links = $this->Ta_link_terkait_model->get_active_links();
    $this->load->library('pagination');
    $this->pagination->initialize($config);

    
    $this->load->model('Ref_kabag_model'); 
    $this->load->model('Ta_berita_model');
   
    $stats = array();
    
    // 1. Jumlah Peraturan (Cari yang mengandung kata 'Peraturan')
    $stats['peraturan'] = $this->db->query("
        SELECT COUNT(*) as total FROM ta_produk_hukum 
        JOIN ref_kategori ON ta_produk_hukum.id_kategori = ref_kategori.id_kategori 
        WHERE ref_kategori.kategori LIKE '%Peraturan%'
    ")->row()->total;

    // 2. Jumlah Monografi
    $stats['monografi'] = $this->db->query("
        SELECT COUNT(*) as total FROM ta_produk_hukum 
        JOIN ref_kategori ON ta_produk_hukum.id_kategori = ref_kategori.id_kategori 
        WHERE ref_kategori.kategori LIKE '%Monografi%'
    ")->row()->total;

    // 3. Jumlah Artikel
    $stats['artikel'] = $this->db->query("
        SELECT COUNT(*) as total FROM ta_produk_hukum 
        JOIN ref_kategori ON ta_produk_hukum.id_kategori = ref_kategori.id_kategori 
        WHERE ref_kategori.kategori LIKE '%Artikel%'
    ")->row()->total;

    // 4. Jumlah Putusan
    $stats['putusan'] = $this->db->query("
        SELECT COUNT(*) as total FROM ta_produk_hukum 
        JOIN ref_kategori ON ta_produk_hukum.id_kategori = ref_kategori.id_kategori 
        WHERE ref_kategori.kategori LIKE '%Putusan%'
    ")->row()->total;


    // Ambil Data Pendukung Lainnya
    $sliders = $this->db->where('status', '1')->order_by('urutan', 'ASC')->order_by('id_slider', 'DESC')->get('ta_slider')->result();
    $ta_berita = $this->Ta_berita_model->get_limit_data(4, 0); // Ambil 4 berita terbaru
    $ref_kategori = $this->db->get('ref_kategori')->result();
    $kabag_active = $this->Ref_kabag_model->get_active_kabag();

    // Packing Data
    $data = array(
        'ta_produk_hukum_data' => $ta_produk_hukum,
        'q' => $q,
        'pagination' => $this->pagination->create_links(),
        'total_rows' => $config['total_rows'],
        'start' => $start,
        'sliders' => $sliders,
        'ta_berita' => $ta_berita,
        'ref_kategori' => $ref_kategori,
        'kabag' => $kabag_active,
        'stats' => $stats, // <-- Variabel statistik dikirim ke view
        'links' => $links,
    );

    $this->template->load('frontend/template_public','frontend/beranda', $data);
}
    public function visimisi()
    {
        $visimisi = $this->db->query('SELECT * FROM ref_visimisi')->result();
        $data = array(
            'visimisi' => $visimisi,
        );
        $this->template->load('frontend/template_public', 'frontend/visimisi', $data);
    }

    public function statistik()
    {
        $this->template->load('frontend/template_grafik', 'frontend/statistik_produk_hukum');
    }
    public function grafik()
    {
        $this->template->load('frontend/template_grafik', 'frontend/grafik_produk_hukum');
    }
}