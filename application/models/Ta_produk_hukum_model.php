<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_produk_hukum_model extends CI_Model
{

    public $table = 'ta_produk_hukum';
    public $id = 'id_produk_hukum';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // --- BAGIAN BACKEND (ADMIN) ---

    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    function get_row($id = NULL)
    {
        $this->db->select('ta_produk_hukum.*, 
                            ref_kategori.kategori,
                            ta_katalog.nama_katalog, ta_katalog.file as file_katalog
                    ');

        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        $this->db->join('ta_katalog', 'ta_produk_hukum.id_katalog=ta_katalog.id_katalog', 'left');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function total_rows($q = NULL)
    {
        $this->db->group_start();
        $this->db->like('id_produk_hukum', $q);
        $this->db->or_like('no_peraturan', $q);
        $this->db->or_like('tentang', $q);
        $this->db->or_like('tahun', $q);
        $this->db->or_like('penulis', $q);
        $this->db->or_like('nomor_putusan', $q);
        $this->db->group_end();
        
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->select('ta_produk_hukum.*, ref_kategori.kategori');
        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        
        $this->db->group_start();
        $this->db->like('ta_produk_hukum.tentang', $q);
        $this->db->or_like('ta_produk_hukum.no_peraturan', $q);
        $this->db->or_like('ta_produk_hukum.penulis', $q);
        $this->db->group_end();

        $this->db->limit($limit, $start);
        $this->db->order_by("ta_produk_hukum.tgl_peraturan DESC, ta_produk_hukum.id_produk_hukum DESC");
        return $this->db->get($this->table)->result();
    }

    // --- BAGIAN FRONTEND (LOGIKA PENCARIAN DIPERLUAS DISINI) ---

    // 1. Fungsi Ambil Data List
    function get_data($limit, $start = 0, $q = NULL, $no_peraturan = NULL, $tentang = NULL, $tahun = NULL, $id_kategori = NULL, $id_status_peraturan = NULL)
    {
        // Select kolom lengkap agar tidak error "Undefined property"
        $this->db->select('ta_produk_hukum.*, 
                           ref_kategori.kategori, 
                           ta_produk_hukum_katalog.no_register, 
                           ta_produk_hukum_katalog.pemrakarsa');
                           
        // Join Tabel Wajib
        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        $this->db->join('ta_produk_hukum_katalog', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum', 'left');

        // Filter Status: Hanya yang Publish (1)
        $this->db->where('ta_produk_hukum.status', '1'); 

        // --- LOGIKA PENCARIAN LUAS ($q / Kata Kunci Umum) ---
        if ($q) {
            $this->db->group_start(); // Mulai Grouping OR
            
            // Cari di kolom standar
            $this->db->like('ta_produk_hukum.tentang', $q);
            $this->db->or_like('ta_produk_hukum.no_peraturan', $q);
            $this->db->or_like('ta_produk_hukum.tahun', $q);
            
            // Cari di metadata baru
            $this->db->or_like('ta_produk_hukum.subjek', $q);
            $this->db->or_like('ta_produk_hukum.abstrak', $q);
            $this->db->or_like('ta_produk_hukum.penulis', $q);
            $this->db->or_like('ta_produk_hukum.nomor_putusan', $q);
            $this->db->or_like('ta_produk_hukum.tempat_penetapan', $q);
            $this->db->or_like('ta_produk_hukum.isbn', $q);
            
            // Cari di tabel relasi (Kategori & Katalog)
            $this->db->or_like('ref_kategori.kategori', $q); // Misal user ketik "Peraturan Bupati"
            $this->db->or_like('ta_produk_hukum_katalog.pemrakarsa', $q); // Misal user ketik "Dinas Kesehatan"
            
            $this->db->group_end(); // Selesai Grouping OR
        }

        // --- Filter Spesifik (Advanced Search) ---
        if ($no_peraturan) $this->db->like('ta_produk_hukum.no_peraturan', $no_peraturan);
        
        if ($tentang) {
            $this->db->group_start();
            $this->db->like('ta_produk_hukum.tentang', $tentang);
            $this->db->or_like('ta_produk_hukum.subjek', $tentang); // Jika cari tentang, cek subjek juga
            $this->db->group_end();
        }
        
        if ($tahun) $this->db->where('ta_produk_hukum.tahun', $tahun);
        if ($id_kategori) $this->db->where('ta_produk_hukum.id_kategori', $id_kategori);

        // Filter Status Peraturan (Berlaku/Dicabut)
        if ($id_status_peraturan) {
            $this->db->join('ta_produk_hukum_det', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum', 'left');
            $this->db->where('ta_produk_hukum_det.id_status_peraturan', $id_status_peraturan);
            $this->db->group_by('ta_produk_hukum.id_produk_hukum'); 
        }

        $this->db->limit($limit, $start);
        // Urutkan: Tahun terbaru dulu, lalu ID terbaru
        $this->db->order_by("ta_produk_hukum.tahun DESC, ta_produk_hukum.tgl_peraturan DESC, ta_produk_hukum.id_produk_hukum DESC");
        
        return $this->db->get($this->table)->result();
    }

    // 2. Fungsi Hitung Total (Untuk Pagination)
    // PENTING: Logika where/like harus SAMA PERSIS dengan get_data agar jumlah halaman sesuai
    function total_rows_produk_hukum($no_peraturan=NULL, $tentang=NULL, $tahun=NULL, $kategori=NULL, $status_peraturan=NULL) 
    {
        // Join tabel yang sama agar kolom pencarian dikenali
        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        $this->db->join('ta_produk_hukum_katalog', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum', 'left');
        
        $this->db->from($this->table);
        $this->db->where('ta_produk_hukum.status', '1'); 

        // Tangkap variabel 'q' dari $_GET secara manual karena ini fungsi hitung
        $q = isset($_GET['q']) ? urldecode($_GET['q']) : NULL;

        // --- LOGIKA PENCARIAN LUAS ($q) ---
        if ($q) {
            $this->db->group_start();
            $this->db->like('ta_produk_hukum.tentang', $q);
            $this->db->or_like('ta_produk_hukum.no_peraturan', $q);
            $this->db->or_like('ta_produk_hukum.tahun', $q);
            $this->db->or_like('ta_produk_hukum.subjek', $q);
            $this->db->or_like('ta_produk_hukum.abstrak', $q);
            $this->db->or_like('ta_produk_hukum.penulis', $q);
            $this->db->or_like('ta_produk_hukum.nomor_putusan', $q);
            $this->db->or_like('ta_produk_hukum.tempat_penetapan', $q);
            $this->db->or_like('ta_produk_hukum.isbn', $q);
            $this->db->or_like('ref_kategori.kategori', $q);
            $this->db->or_like('ta_produk_hukum_katalog.pemrakarsa', $q);
            $this->db->group_end();
        }

        // --- Filter Spesifik ---
        if ($no_peraturan) $this->db->like('ta_produk_hukum.no_peraturan', $no_peraturan);
        
        if ($tentang) {
            $this->db->group_start();
            $this->db->like('ta_produk_hukum.tentang', $tentang);
            $this->db->or_like('ta_produk_hukum.subjek', $tentang);
            $this->db->group_end();
        }
        
        if ($tahun) $this->db->where('ta_produk_hukum.tahun', $tahun);
        if ($kategori) $this->db->where('ta_produk_hukum.id_kategori', $kategori);

        if ($status_peraturan) {
            $this->db->join('ta_produk_hukum_det', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum', 'left');
            $this->db->where('ta_produk_hukum_det.id_status_peraturan', $status_peraturan);
        }

        return $this->db->count_all_results();
    }

    // --- CRUD BACKEND STANDAR ---

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    
    function update_perubahan($id, $data_perubahan)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data_perubahan);
	}

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}