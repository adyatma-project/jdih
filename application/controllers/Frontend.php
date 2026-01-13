<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load Model & Helper Sekali Saja di Construct
        $this->load->model(array(
            'Ta_info_hukum_model',
            'Ta_berita_model',
            'Ta_produk_hukum_model',
            'Ref_kabag_model',
            'Ta_link_terkait_model',
            'Ta_link_eksternal_model' // Pastikan model ini ada
        ));
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->helper(array('tanggal_helper', 'url', 'form'));
    }

    public function index()
    {
        // 1. Konfigurasi Pencarian & Pagination
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
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
        $this->pagination->initialize($config);

        // 2. Ambil Data Utama
        $ta_produk_hukum = $this->Ta_produk_hukum_model->get_limit_data($config['per_page'], $start, $q);
        
        // 3. Ambil Statistik Angka (Dashboard Box) - PERBAIKAN QUERY
        $stats = array();
        
        // Perbaikan: Query menghitung Peraturan ATAU Keputusan dalam satu perintah
        $stats['peraturan'] = $this->db->query("
            SELECT COUNT(*) as total FROM ta_produk_hukum 
            JOIN ref_kategori ON ta_produk_hukum.id_kategori = ref_kategori.id_kategori 
            WHERE ref_kategori.kategori LIKE '%Peraturan%' 
            OR ref_kategori.kategori LIKE '%Keputusan%'
        ")->row()->total;

        $stats['monografi'] = $this->db->query("
            SELECT COUNT(*) as total FROM ta_produk_hukum 
            JOIN ref_kategori ON ta_produk_hukum.id_kategori = ref_kategori.id_kategori 
            WHERE ref_kategori.kategori LIKE '%Monografi%'
        ")->row()->total;

        $stats['artikel'] = $this->db->query("
            SELECT COUNT(*) as total FROM ta_produk_hukum 
            JOIN ref_kategori ON ta_produk_hukum.id_kategori = ref_kategori.id_kategori 
            WHERE ref_kategori.kategori LIKE '%Artikel%'
        ")->row()->total;

        $stats['putusan'] = $this->db->query("
            SELECT COUNT(*) as total FROM ta_produk_hukum 
            JOIN ref_kategori ON ta_produk_hukum.id_kategori = ref_kategori.id_kategori 
            WHERE ref_kategori.kategori LIKE '%Pengadilan%'
        ")->row()->total;

        // 4. Ambil Data Grafik (Line Chart Tahunan)
        $query_grafik = $this->db->query("
            SELECT 
                t.tahun,
                SUM(CASE WHEN k.kategori LIKE '%Peraturan%' OR k.kategori LIKE '%Keputusan%' THEN 1 ELSE 0 END) as jum_peraturan,
                SUM(CASE WHEN k.kategori LIKE '%Monografi%' THEN 1 ELSE 0 END) as jum_monografi,
                SUM(CASE WHEN k.kategori LIKE '%Artikel%' THEN 1 ELSE 0 END) as jum_artikel,
                SUM(CASE WHEN k.kategori LIKE '%Pengadilan%' THEN 1 ELSE 0 END) as jum_putusan
            FROM ta_produk_hukum t
            JOIN ref_kategori k ON t.id_kategori = k.id_kategori
            WHERE t.status = '1' AND t.tahun > 0 
            GROUP BY t.tahun 
            ORDER BY t.tahun ASC
        ")->result();

        // 5. Ambil Data Pendukung Lainnya
        // Pastikan nama fungsi di model benar (saya asumsikan get_active_links)
        $links = $this->Ta_link_terkait_model->get_active_links(); 
        
        // Cek apakah fungsi get_active_links1 ada di model Ta_link_eksternal_model
        // Jika tidak ada, gunakan get_active_links() standar
        if(method_exists($this->Ta_link_eksternal_model, 'get_active_links1')) {
             $links1 = $this->Ta_link_eksternal_model->get_active_links1();
        } else {
             $links1 = $this->Ta_link_eksternal_model->get_active_links();
        }

        $sliders = $this->db->where('status', '1')->order_by('urutan', 'ASC')->order_by('id_slider', 'DESC')->get('ta_slider')->result();
        $ta_berita = $this->Ta_berita_model->get_limit_data(4, 0); // Ambil 4 berita terbaru
        $ref_kategori = $this->db->get('ref_kategori')->result();
        $kabag_active = $this->Ref_kabag_model->get_active_kabag();

        // 6. Packing Data ke View
        $data = array(
            'ta_produk_hukum_data' => $ta_produk_hukum,
            'q'             => $q,
            'pagination'    => $this->pagination->create_links(),
            'total_rows'    => $config['total_rows'],
            'start'         => $start,
            'sliders'       => $sliders,
            'ta_berita'     => $ta_berita,
            'ref_kategori'  => $ref_kategori,
            'kabag'         => $kabag_active,
            'stats'         => $stats,
            'links'         => $links,
            'links1'        => $links1,
            
            // Data Grafik JSON untuk Chart.js (DIPECAH PER KATEGORI)
            'grafik_tahun'      => json_encode(array_column($query_grafik, 'tahun')),
            'grafik_peraturan'  => json_encode(array_column($query_grafik, 'jum_peraturan')),
            'grafik_monografi'  => json_encode(array_column($query_grafik, 'jum_monografi')),
            'grafik_artikel'    => json_encode(array_column($query_grafik, 'jum_artikel')),
            'grafik_putusan'    => json_encode(array_column($query_grafik, 'jum_putusan'))
        );

        $this->template->load('frontend/template_public', 'frontend/beranda', $data);
    }

    public function dasar_hukum($slug)
    {
        // 1. Ambil data dari tabel tbl_halaman
        $halaman = $this->db->get_where('tbl_halaman', ['slug' => $slug])->row();

        // Cek jika halaman tidak ditemukan
        if (!$halaman) {
            show_404();
        }

        $data['judul']   = $halaman->judul;
        $data['konten']  = $halaman->isi_konten;
        $data['updated'] = $halaman->updated_at;

        // 2. Load View Frontend
        $this->template->load('frontend/template_public', 'frontend/v_halaman_statis', $data);
    }

    public function interaksi($jenis = 'pengaduan')
    {
        // 1. Tentukan Jenis dan Ambil Link dari DB
        if ($jenis == 'survei') {
            $data['judul'] = 'Survei Kepuasan Masyarakat';
            $db_jenis = 'survei';
        } else {
            $data['judul'] = 'Pengaduan & Konsultasi Hukum';
            $db_jenis = 'pengaduan';
        }

        $row = $this->db->get_where('tbl_interaksi', ['jenis' => $db_jenis])->row();
        $data['url_gform'] = ($row) ? $row->link_url : '#';

        // 2. Load View (Menggunakan template frontend Anda)
        // Pastikan nama file view sesuai langkah 3.B dibawah
        $this->template->load('frontend/template_public', 'frontend/v_interaksi_embed', $data);
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