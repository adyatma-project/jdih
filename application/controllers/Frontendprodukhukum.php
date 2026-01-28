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
        $this->load->library('pagination');
        $this->load->helper(array('statusperaturan_helper', 'tanggal_helper'));
    }

    public function index()
    {
        redirect(base_url('frontendprodukhukum/produk_hukum_list'));
    }

    public function produk_hukum_list()
    {
        // 1. TANGKAP FILTER DARI URL
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $no_peraturan = $this->input->get('no_peraturan');
        $tentang      = $this->input->get('tentang');
        $tahun        = $this->input->get('tahun');
        $kategori     = $this->input->get('ref_kategori'); 
        $status_per   = $this->input->get('ref_status_peraturan');

        // 2. QUERY STRING PAGINATION
        $params = array();
        if($no_peraturan) $params['no_peraturan'] = $no_peraturan;
        if($tentang)      $params['tentang'] = $tentang;
        if($tahun)        $params['tahun'] = $tahun;
        if($kategori)     $params['ref_kategori'] = $kategori;
        if($status_per)   $params['ref_status_peraturan'] = $status_per;
        if($q)            $params['q'] = $q;

        $query_string = http_build_query($params);
        $config['base_url'] = base_url() . 'frontendprodukhukum/produk_hukum_list?' . $query_string;
        $config['first_url'] = $config['base_url'];

        $config['per_page'] = 20;
        $config['page_query_string'] = TRUE;
        
        // --- FILTER STATUS PUBLISH (1) ---
        $this->db->where('ta_produk_hukum.status', '1'); 
        $config['total_rows'] = $this->Ta_produk_hukum_model->total_rows_produk_hukum(
            $q, $no_peraturan, $tentang, $tahun, $kategori, $status_per
        );
        
        $this->db->where('ta_produk_hukum.status', '1'); 
        $ta_produk_hukum = $this->Ta_produk_hukum_model->get_data(
            $config['per_page'], $start, $q, $no_peraturan, $tentang, $tahun, $kategori, $status_per
        );

        $this->pagination->initialize($config);

        // Sidebar Populer (Status 1)
        $ta_produk_hukum_populer = $this->db->query("
            SELECT ta_produk_hukum.*, ref_kategori.kategori 
            FROM ta_produk_hukum 
            LEFT JOIN ref_kategori ON ta_produk_hukum.id_kategori=ref_kategori.id_kategori
            WHERE ta_produk_hukum.status = '1' 
            ORDER BY dilihat DESC LIMIT 5
        ")->result();

        $ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
        
        // Link Eksternal
        if(class_exists('Ta_link_eksternal_model') && method_exists($this->Ta_link_eksternal_model, 'get_active_links')) {
             $link_terkait = $this->Ta_link_eksternal_model->get_active_links();
        } else {
             $link_terkait = array();
        }

        $data = array(
            'ta_produk_hukum_data' => $ta_produk_hukum,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'ref_kategori' => $ref_kategori,
            'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
            'link_terkait' => $link_terkait,
            'no_peraturan' => $no_peraturan,
            'tentang' => $tentang,
            'tahun' => $tahun,
            'kategori_selected' => $kategori, 
            'status_peraturan' => $status_per,
            'start' => $start
        );
        
        $this->template->load('frontend/template_public', 'frontend/produk_hukum_list', $data);
    }

    public function produk_hukum_page($id)
    {
        $row = $this->Ta_produk_hukum_model->get_row($id);
        
        // Filter: Hanya tampilkan jika Status == 1 (Publish)
        if ($row && $row->status == '1') {
             
             // Update counter dilihat
             $this->Ta_produk_hukum_model->update_perubahan($id, array('dilihat' => $row->dilihat + 1));
             
             // Data Sidebar
             $ta_berita = $this->db->query('SELECT * FROM ta_berita ORDER BY tgl_insert DESC LIMIT 5')->result();
             $ta_produk_hukum_populer = $this->db->query("
                SELECT ta_produk_hukum.*, ref_kategori.kategori 
                FROM ta_produk_hukum 
                LEFT JOIN ref_kategori ON ta_produk_hukum.id_kategori=ref_kategori.id_kategori
                WHERE ta_produk_hukum.status = '1'
                ORDER BY dilihat DESC LIMIT 5
            ")->result();

             // PACKING DATA LENGKAP KE VIEW
             $data = array(
                'id_produk_hukum' => $id,
                'no_peraturan'    => $row->no_peraturan,
                'tentang'         => $row->tentang,
                // Logika Judul: Gunakan field 'judul' jika ada, fallback ke 'tentang'
                'judul'           => !empty($row->judul) ? $row->judul : $row->tentang,
                'tahun'           => $row->tahun,
                'kategori'        => $row->kategori, // Dari Join di Model
                'jenis_peraturan' => isset($row->jenis_peraturan) ? $row->jenis_peraturan : '',
                'file'            => $row->file,
                'file_abstrak'    => $row->file_abstrak,
                'abstrak'         => $row->abstrak,
                'dilihat'         => $row->dilihat,
                'didownload'      => $row->didownload,
                
                // --- Metadata Umum & Peraturan ---
                'teu_badan'            => isset($row->teu_badan) ? $row->teu_badan : '',
                'subjek'               => isset($row->subjek) ? $row->subjek : '',
                'bahasa'               => isset($row->bahasa) ? $row->bahasa : '',
                'lokasi'               => isset($row->lokasi) ? $row->lokasi : '',
                'bidang_hukum'         => isset($row->bidang_hukum) ? $row->bidang_hukum : '',
                'sumber'               => isset($row->sumber) ? $row->sumber : '',
                'sumber_ln'            => isset($row->sumber_ln) ? $row->sumber_ln : '',
                'sumber_bn'            => isset($row->sumber_bn) ? $row->sumber_bn : '',
                'singkatan_jenis'      => isset($row->singkatan_jenis) ? $row->singkatan_jenis : '',
                'tempat_penetapan'     => isset($row->tempat_penetapan) ? $row->tempat_penetapan : '',
                'tgl_penetapan'        => isset($row->tanggal_penetapan) ? $row->tanggal_penetapan : '',
                'tgl_pengundangan'     => isset($row->tanggal_pengundangan) ? $row->tanggal_pengundangan : '',
                'status_peraturan'     => isset($row->status_peraturan) ? $row->status_peraturan : '',
                
                // --- Metadata Putusan Pengadilan ---
                'nomor_putusan'        => isset($row->nomor_putusan) ? $row->nomor_putusan : '',
                'jenis_peradilan'      => isset($row->jenis_peradilan) ? $row->jenis_peradilan : '',
                'lembaga_peradilan'    => isset($row->lembaga_peradilan) ? $row->lembaga_peradilan : '',
                'singkatan_peradilan'  => isset($row->singkatan_peradilan) ? $row->singkatan_peradilan : '',
                'tempat_peradilan'     => isset($row->tempat_peradilan) ? $row->tempat_peradilan : '',
                'tgl_putusan'          => isset($row->tanggal_dibacakan) ? $row->tanggal_dibacakan : '', // Mapping tanggal_dibacakan
                'status_putusan'       => isset($row->status_putusan) ? $row->status_putusan : '',
                'amar_putusan'         => isset($row->amar_putusan) ? $row->amar_putusan : '',

                // --- Metadata Monografi (Buku) ---
                'penulis'              => isset($row->penulis) ? $row->penulis : '',
                'penerbit'             => isset($row->penerbit) ? $row->penerbit : '',
                'isbn'                 => isset($row->isbn) ? $row->isbn : '',
                'cetakan_edisi'        => isset($row->cetakan_edisi) ? $row->cetakan_edisi : '',
                'deskripsi_fisik'      => isset($row->deskripsi_fisik) ? $row->deskripsi_fisik : '',
                'tempat_terbit'        => isset($row->tempat_terbit) ? $row->tempat_terbit : '',
                'nomor_panggil'        => isset($row->nomor_panggil) ? $row->nomor_panggil : '',
                'nomor_induk_buku'     => isset($row->nomor_induk_buku) ? $row->nomor_induk_buku : '',

                // --- Metadata Artikel ---
                'nama_jurnal'          => isset($row->nama_jurnal) ? $row->nama_jurnal : '',
                'volume'               => isset($row->volume) ? $row->volume : '',
                'halaman'              => isset($row->halaman) ? $row->halaman : '',

                // Sidebar Data
                'ta_berita'               => $ta_berita,
                'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
            );
            $this->template->load('frontend/template_public', 'frontend/produk_hukum_page', $data);
        } else {
            // Redirect jika data tidak ada atau statusnya DRAFT (0)
            redirect(site_url('frontendprodukhukum'));
        }
    }

    public function download($id)
    {
        $row = $this->Ta_produk_hukum_model->get_row($id);
        
        // Cek Status Publish sebelum download
        if ($row && $row->status == '1' && !empty($row->file) && file_exists('./uploads/produk_hukum/' . $row->file)) {
            $this->Ta_produk_hukum_model->update_perubahan($id, array('didownload' => $row->didownload + 1));
            redirect(base_url("uploads/produk_hukum/$row->file"));
        } else {
            echo "<script>alert('File tidak tersedia atau dokumen belum dipublikasikan.'); window.close();</script>";
        }
    }
}