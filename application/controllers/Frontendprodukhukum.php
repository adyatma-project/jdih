<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontendprodukhukum extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_produk_hukum_model');
        $this->load->model('Ta_katalog_model');
        $this->load->model('Ta_link_eksternal_model'); 
        $this->load->library('form_validation');
        $this->load->helper('statusperaturan_helper');
        $this->load->helper('tanggal_helper');
    }

    public function index()
    {
        redirect(base_url('frontendprodukhukum/produk_hukum_list'));
    }

    public function produk_hukum_list()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $no_peraturan = $this->input->get('no_peraturan');
        $tentang = $this->input->get('tentang');
        $tahun = $this->input->get('tahun');
        $kategori = $this->input->get('ref_kategori');
        $status_peraturan = $this->input->get('ref_status_peraturan');

        // Logic URL Pagination yang rapi
        $params = array();
        if($no_peraturan) $params['no_peraturan'] = $no_peraturan;
        if($tentang) $params['tentang'] = $tentang;
        if($tahun) $params['tahun'] = $tahun;
        if($kategori) $params['ref_kategori'] = $kategori;
        if($status_peraturan) $params['ref_status_peraturan'] = $status_peraturan;
        if($q) $params['q'] = $q;

        $query_string = http_build_query($params);
        $config['base_url'] = base_url() . 'Frontendprodukhukum/produk_hukum_list?' . $query_string;
        $config['first_url'] = $config['base_url'];

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        
        $config['total_rows'] = $this->Ta_produk_hukum_model->total_rows_produk_hukum(
            $q, $no_peraturan, $tentang, $tahun, $kategori, $status_peraturan
        );
        
        $ta_produk_hukum = $this->Ta_produk_hukum_model->get_data(
            $config['per_page'], $start, $q, $no_peraturan, $tentang, $tahun, $kategori, $status_peraturan
        );

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        // Sidebar Data - PERBAIKAN DI SINI (Hapus 'seen_count', ganti jadi 'dilihat')
        $ta_produk_hukum_populer = $this->db->query("
            SELECT ta_produk_hukum.*, ref_kategori.kategori 
            FROM ta_produk_hukum 
            LEFT JOIN ref_kategori ON ta_produk_hukum.id_kategori=ref_kategori.id_kategori
            WHERE ta_produk_hukum.status = '1'
            ORDER BY dilihat DESC LIMIT 5
        ")->result();

        $ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
        
        // Cek jika model link eksternal ada
        if(class_exists('Ta_link_eksternal_model') && method_exists($this->Ta_link_eksternal_model, 'get_active_links')) {
             $link_terkait = $this->Ta_link_eksternal_model->get_active_links();
        } else {
             $link_terkait = array(); // Kosongkan jika belum ada modelnya
        }

        $data = array(
            'ta_produk_hukum_data' => $ta_produk_hukum,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'ref_kategori' => $ref_kategori,
            'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
            'link_terkait' => $link_terkait,
            
            // Re-populate filter form
            'no_peraturan' => $no_peraturan,
            'tentang' => $tentang,
            'tahun' => $tahun,
            'kategori_selected' => $kategori, 
            'status_peraturan' => $status_peraturan,
            'start' => $start
        );
        
        $this->template->load('frontend/template_public', 'frontend/produk_hukum_list', $data);
    }

    public function produk_hukum_page($id)
    {
        // Pastikan Model mengambil semua kolom (*) agar metadata baru terbaca
        $row = $this->Ta_produk_hukum_model->get_row($id);
        
        if ($row) {
            // Update Statistik Dilihat
            $this->Ta_produk_hukum_model->update_perubahan($id, array('dilihat' => $row->dilihat + 1));

            // Ambil Sidebar Berita & Populer
            $ta_berita = $this->db->query('SELECT * FROM ta_berita ORDER BY tgl_insert DESC LIMIT 5')->result();
            $ta_produk_hukum_populer = $this->db->query("
                SELECT ta_produk_hukum.*, ref_kategori.kategori 
                FROM ta_produk_hukum 
                LEFT JOIN ref_kategori ON ta_produk_hukum.id_kategori=ref_kategori.id_kategori
                WHERE ta_produk_hukum.status = '1'
                ORDER BY dilihat DESC LIMIT 5
            ")->result();

            // PACKING DATA KE VIEW
            $data = array(
                'id_produk_hukum' => $id,
                
                // Data Utama
                'no_peraturan' => $row->no_peraturan,
                'tentang' => $row->tentang,
                'judul' => isset($row->judul) ? $row->judul : $row->tentang, // Fallback ke tentang
                'tahun' => $row->tahun,
                'kategori' => $row->kategori, // Dari Join Model
                'file' => $row->file,
                'abstrak' => $row->abstrak,
                'dilihat' => $row->dilihat,
                'didownload' => $row->didownload,
                
                // Metadata Umum
                'teu_badan' => isset($row->teu_badan) ? $row->teu_badan : '',
                'subjek' => isset($row->subjek) ? $row->subjek : '',
                'bahasa' => isset($row->bahasa) ? $row->bahasa : '',
                'lokasi' => isset($row->lokasi) ? $row->lokasi : '',
                'bidang_hukum' => isset($row->bidang_hukum) ? $row->bidang_hukum : '',
                'sumber' => isset($row->sumber) ? $row->sumber : '',
                
                // Peraturan
                'singkatan_jenis' => isset($row->singkatan_jenis) ? $row->singkatan_jenis : '',
                'tempat_penetapan' => isset($row->tempat_penetapan) ? $row->tempat_penetapan : '',
                'tgl_penetapan' => isset($row->tanggal_penetapan) ? $row->tanggal_penetapan : '',
                'tgl_pengundangan' => isset($row->tanggal_pengundangan) ? $row->tanggal_pengundangan : '',
                
                // Legacy Sumber
                'sumber_ln' => isset($row->sumber_ln) ? $row->sumber_ln : '',
                'sumber_bn' => isset($row->sumber_bn) ? $row->sumber_bn : '',

                // Monografi
                'judul_buku' => isset($row->judul) ? $row->judul : '',
                'penulis' => isset($row->penulis) ? $row->penulis : '',
                'penerbit' => isset($row->penerbit) ? $row->penerbit : '',
                'isbn' => isset($row->isbn) ? $row->isbn : '',
                'deskripsi_fisik' => isset($row->deskripsi_fisik) ? $row->deskripsi_fisik : '',
                
                // Artikel
                'nama_jurnal' => isset($row->nama_jurnal) ? $row->nama_jurnal : '',
                'volume' => isset($row->volume) ? $row->volume : '',
                
                // Putusan
                'nomor_putusan' => isset($row->nomor_putusan) ? $row->nomor_putusan : '',
                'jenis_peradilan' => isset($row->jenis_peradilan) ? $row->jenis_peradilan : '',
                'lembaga_peradilan' => isset($row->lembaga_peradilan) ? $row->lembaga_peradilan : '',
                'amar_putusan' => isset($row->amar_putusan) ? $row->amar_putusan : '',
                'tgl_putusan' => isset($row->tanggal_dibacakan) ? $row->tanggal_dibacakan : '', 

                // Sidebar Data
                'ta_berita' => $ta_berita,
                'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
            );

            $this->template->load('frontend/template_public', 'frontend/produk_hukum_page', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Tidak Ditemukan.</div>');
            redirect(site_url('frontendprodukhukum'));
        }
    }

    public function download($id)
    {
        $row = $this->Ta_produk_hukum_model->get_row($id);
        if ($row && !empty($row->file) && file_exists('./uploads/produk_hukum/' . $row->file)) {
            // Update Statistik Download
            $this->Ta_produk_hukum_model->update_perubahan($id, array('didownload' => $row->didownload + 1));
            
            // Force Download / Redirect
            redirect(base_url("uploads/produk_hukum/$row->file"));
        } else {
            echo "<script>alert('File dokumen fisik tidak ditemukan di server.'); window.close();</script>";
        }
    }
}