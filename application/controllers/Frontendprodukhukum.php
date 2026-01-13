<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontendprodukhukum extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load Model & Helper
        $this->load->model('Ta_produk_hukum_model');
        $this->load->model('Ta_link_eksternal_model'); 
        $this->load->library('form_validation');
        $this->load->library('pagination'); // Load library pagination disini
        $this->load->helper(array('statusperaturan_helper', 'tanggal_helper'));
    }

    public function index()
    {
        redirect(base_url('frontendprodukhukum/produk_hukum_list'));
    }

    public function produk_hukum_list()
    {
        // 1. TANGKAP SEMUA FILTER DARI URL (NAVBAR / FORM SEARCH)
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $no_peraturan = $this->input->get('no_peraturan');
        $tentang      = $this->input->get('tentang');
        $tahun        = $this->input->get('tahun');
        
        // Perhatikan ini: Nama variabel harus sama dengan ?ref_kategori= di URL Navbar
        $kategori     = $this->input->get('ref_kategori'); 
        $status       = $this->input->get('ref_status_peraturan');

        // 2. BANGUN QUERY STRING UNTUK PAGINATION (Agar filter tidak hilang saat pindah halaman)
        $params = array();
        if($no_peraturan) $params['no_peraturan'] = $no_peraturan;
        if($tentang)      $params['tentang'] = $tentang;
        if($tahun)        $params['tahun'] = $tahun;
        if($kategori)     $params['ref_kategori'] = $kategori;
        if($status)       $params['ref_status_peraturan'] = $status;
        if($q)            $params['q'] = $q;

        $query_string = http_build_query($params);
        
        // 3. KONFIGURASI PAGINATION
        $config['base_url']          = base_url() . 'frontendprodukhukum/produk_hukum_list?' . $query_string;
        $config['first_url']         = $config['base_url'];
        $config['per_page']          = 10;
        $config['page_query_string'] = TRUE;
        
        // Panggil Model (Pastikan urutan parameter sesuai di Model Anda)
        $config['total_rows'] = $this->Ta_produk_hukum_model->total_rows_produk_hukum(
            $q, $no_peraturan, $tentang, $tahun, $kategori, $status
        );
        
        $ta_produk_hukum = $this->Ta_produk_hukum_model->get_data(
            $config['per_page'], $start, $q, $no_peraturan, $tentang, $tahun, $kategori, $status
        );

        $this->pagination->initialize($config);

        // 4. DATA PENDUKUNG VIEW
        $ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
        $ref_status   = $this->db->get('ref_status_peraturan')->result(); // Tambahkan ini jika error ref_status
        
        // Sidebar Populer
        $ta_produk_hukum_populer = $this->db->query("
            SELECT ta_produk_hukum.*, ref_kategori.kategori 
            FROM ta_produk_hukum 
            LEFT JOIN ref_kategori ON ta_produk_hukum.id_kategori=ref_kategori.id_kategori
            WHERE ta_produk_hukum.status = '1'
            ORDER BY dilihat DESC LIMIT 5
        ")->result();

        // 5. PACKING DATA KE VIEW
        $data = array(
            'ta_produk_hukum_data'    => $ta_produk_hukum,
            'q'                       => $q,
            'pagination'              => $this->pagination->create_links(),
            'total_rows'              => $config['total_rows'],
            'ref_kategori'            => $ref_kategori,
            'ref_status_peraturan'    => $ref_status, // Kirim data status ke view
            'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
            
            // Re-populate Form Filters (Agar inputan tidak reset)
            'no_peraturan'      => $no_peraturan,
            'tentang'           => $tentang,
            'tahun'             => $tahun,
            'kategori_selected' => $kategori, // Variabel ini dipakai untuk menandai dropdown select
            'status_peraturan'  => $status,
            'start'             => $start
        );
        
        $this->template->load('frontend/template_public', 'frontend/produk_hukum_list', $data);
    }

    public function produk_hukum_page($id)
    {
        // ... (Kode produk_hukum_page Anda sudah benar, biarkan tetap sama) ...
        // Pastikan copy paste kode Anda sebelumnya disini
        $row = $this->Ta_produk_hukum_model->get_row($id);
        if ($row) {
             $this->Ta_produk_hukum_model->update_perubahan($id, array('dilihat' => $row->dilihat + 1));
             
             // Ambil Data Populer & Berita untuk Sidebar
             $ta_berita = $this->db->query('SELECT * FROM ta_berita ORDER BY tgl_insert DESC LIMIT 5')->result();
             $ta_produk_hukum_populer = $this->db->query("
                SELECT ta_produk_hukum.*, ref_kategori.kategori 
                FROM ta_produk_hukum 
                LEFT JOIN ref_kategori ON ta_produk_hukum.id_kategori=ref_kategori.id_kategori
                WHERE ta_produk_hukum.status = '1'
                ORDER BY dilihat DESC LIMIT 5
            ")->result();

             $data = array(
                'id_produk_hukum' => $id,
                'no_peraturan' => $row->no_peraturan,
                'tentang' => $row->tentang,
                'judul' => isset($row->judul) ? $row->judul : $row->tentang,
                'tahun' => $row->tahun,
                'kategori' => $row->kategori,
                'file' => $row->file,
                'abstrak' => $row->abstrak,
                'dilihat' => $row->dilihat,
                'didownload' => $row->didownload,
                
                // Metadata Lengkap
                'teu_badan' => isset($row->teu_badan) ? $row->teu_badan : '',
                'subjek' => isset($row->subjek) ? $row->subjek : '',
                'bahasa' => isset($row->bahasa) ? $row->bahasa : '',
                'lokasi' => isset($row->lokasi) ? $row->lokasi : '',
                'bidang_hukum' => isset($row->bidang_hukum) ? $row->bidang_hukum : '',
                'sumber' => isset($row->sumber) ? $row->sumber : '',
                'singkatan_jenis' => isset($row->singkatan_jenis) ? $row->singkatan_jenis : '',
                'tempat_penetapan' => isset($row->tempat_penetapan) ? $row->tempat_penetapan : '',
                'tgl_penetapan' => isset($row->tanggal_penetapan) ? $row->tanggal_penetapan : '',
                'tgl_pengundangan' => isset($row->tanggal_pengundangan) ? $row->tanggal_pengundangan : '',
                
                // Sidebar Data
                'ta_berita' => $ta_berita,
                'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
            );
            $this->template->load('frontend/template_public', 'frontend/produk_hukum_page', $data);
        } else {
            redirect(site_url('frontendprodukhukum'));
        }
    }

    public function download($id)
    {
        // ... (Kode download Anda sudah benar, biarkan tetap sama) ...
        $row = $this->Ta_produk_hukum_model->get_row($id);
        if ($row && !empty($row->file) && file_exists('./uploads/produk_hukum/' . $row->file)) {
            $this->Ta_produk_hukum_model->update_perubahan($id, array('didownload' => $row->didownload + 1));
            redirect(base_url("uploads/produk_hukum/$row->file"));
        } else {
            echo "<script>alert('File tidak ditemukan.'); window.close();</script>";
        }
    }
}