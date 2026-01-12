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

    // =========================================================
    // BAGIAN 1: BACKEND / ADMIN
    // =========================================================

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
    
    // --- PERBAIKAN DI SINI (Komentar dihapus dari dalam string) ---
    function get_row($id = NULL)
    {
        $this->db->select('ta_produk_hukum.*, 
                            ref_kategori.kategori,
                            ta_produk_hukum_katalog.no_register, 
                            ta_produk_hukum_katalog.pemrakarsa,
                            ta_katalog.nama_katalog, 
                            ta_katalog.file as file_katalog
                    ');

        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        $this->db->join('ta_produk_hukum_katalog', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum', 'left');
        $this->db->join('ta_katalog', 'ta_produk_hukum.id_katalog=ta_katalog.id_katalog', 'left');
        
        $this->db->where('ta_produk_hukum.id_produk_hukum', $id);
        
        return $this->db->get($this->table)->row();
    }

    function total_rows($q = NULL)
    {
        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        $this->db->join('ta_produk_hukum_katalog', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum', 'left');
        
        $this->db->group_start();
        $this->db->like('ta_produk_hukum.tentang', $q);
        $this->db->or_like('ta_produk_hukum.no_peraturan', $q);
        $this->db->or_like('ta_produk_hukum.tahun', $q);
        $this->db->or_like('ref_kategori.kategori', $q);
        $this->db->or_like('ta_produk_hukum.subjek', $q);
        $this->db->or_like('ta_produk_hukum.penulis', $q);
        $this->db->or_like('ta_produk_hukum_katalog.pemrakarsa', $q);
        $this->db->group_end();
        
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->select('ta_produk_hukum.*, ref_kategori.kategori');
        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        $this->db->join('ta_produk_hukum_katalog', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum', 'left');
        
        $this->db->group_start();
        $this->db->like('ta_produk_hukum.tentang', $q);
        $this->db->or_like('ta_produk_hukum.no_peraturan', $q);
        $this->db->or_like('ta_produk_hukum.tahun', $q);
        $this->db->or_like('ref_kategori.kategori', $q);
        $this->db->or_like('ta_produk_hukum.subjek', $q);
        $this->db->or_like('ta_produk_hukum_katalog.pemrakarsa', $q);
        $this->db->group_end();

        $this->db->limit($limit, $start);
        $this->db->order_by("ta_produk_hukum.tahun DESC, ta_produk_hukum.tgl_peraturan DESC, ta_produk_hukum.id_produk_hukum DESC");
        return $this->db->get($this->table)->result();
    }

    // =========================================================
    // BAGIAN 2: FRONTEND
    // =========================================================

    function get_data($limit, $start = 0, $q = NULL, $no_peraturan = NULL, $tentang = NULL, $tahun = NULL, $id_kategori = NULL, $id_status_peraturan = NULL)
    {
        $this->db->select('ta_produk_hukum.*, 
                           ref_kategori.kategori,
                           ta_produk_hukum_katalog.no_register,
                           ta_produk_hukum_katalog.pemrakarsa'); 

        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        $this->db->join('ta_produk_hukum_katalog', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum', 'left');

        $this->db->where('ta_produk_hukum.status', '1');

        if ($q) {
            $this->db->group_start();
            $this->db->like('ta_produk_hukum.tentang', $q);
            $this->db->or_like('ta_produk_hukum.no_peraturan', $q);
            $this->db->or_like('ta_produk_hukum.tahun', $q);
            $this->db->or_like('ref_kategori.kategori', $q);
            $this->db->or_like('ta_produk_hukum.subjek', $q);
            $this->db->or_like('ta_produk_hukum_katalog.pemrakarsa', $q);
            $this->db->group_end();
        }

        if ($no_peraturan) $this->db->like('ta_produk_hukum.no_peraturan', $no_peraturan);
        
        if ($tentang) {
            $this->db->group_start();
            $this->db->like('ta_produk_hukum.tentang', $tentang);
            $this->db->or_like('ta_produk_hukum.subjek', $tentang);
            $this->db->group_end();
        }
        
        if ($tahun) $this->db->where('ta_produk_hukum.tahun', $tahun);
        if ($id_kategori) $this->db->where('ta_produk_hukum.id_kategori', $id_kategori);

        if ($id_status_peraturan) {
            $this->db->join('ta_produk_hukum_det', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum', 'left');
            $this->db->where('ta_produk_hukum_det.id_status_peraturan', $id_status_peraturan);
            $this->db->group_by('ta_produk_hukum.id_produk_hukum'); 
        }

        $this->db->limit($limit, $start);
        $this->db->order_by("ta_produk_hukum.tahun DESC, ta_produk_hukum.tgl_peraturan DESC, ta_produk_hukum.id_produk_hukum DESC");
        
        return $this->db->get($this->table)->result();
    }

    function total_rows_produk_hukum($q = NULL, $no_peraturan = NULL, $tentang = NULL, $tahun = NULL, $id_kategori = NULL, $id_status_peraturan = NULL)
    {
        $this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
        $this->db->join('ta_produk_hukum_katalog', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum', 'left');
        
        $this->db->where('ta_produk_hukum.status', '1');

        if ($q) {
            $this->db->group_start();
            $this->db->like('ta_produk_hukum.tentang', $q);
            $this->db->or_like('ta_produk_hukum.no_peraturan', $q);
            $this->db->or_like('ta_produk_hukum.tahun', $q);
            $this->db->or_like('ref_kategori.kategori', $q);
            $this->db->or_like('ta_produk_hukum.subjek', $q);
            $this->db->or_like('ta_produk_hukum_katalog.pemrakarsa', $q);
            $this->db->group_end();
        }

        if ($no_peraturan) $this->db->like('ta_produk_hukum.no_peraturan', $no_peraturan);
        
        if ($tentang) {
            $this->db->group_start();
            $this->db->like('ta_produk_hukum.tentang', $tentang);
            $this->db->or_like('ta_produk_hukum.subjek', $tentang);
            $this->db->group_end();
        }
        
        if ($tahun) $this->db->where('ta_produk_hukum.tahun', $tahun);
        if ($id_kategori) $this->db->where('ta_produk_hukum.id_kategori', $id_kategori);

        if ($id_status_peraturan) {
            $this->db->join('ta_produk_hukum_det', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum', 'left');
            $this->db->where('ta_produk_hukum_det.id_status_peraturan', $id_status_peraturan);
            $this->db->group_by('ta_produk_hukum.id_produk_hukum'); 
        }

        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // =========================================================
    // BAGIAN 3: CRUD STANDAR
    // =========================================================

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

    // Tambahkan fungsi ini di dalam Ta_produk_hukum_model
    function get_all_for_export($q = NULL) {
        $this->db->order_by($this->id, $this->order);
        // Sesuaikan logika like ini dengan kolom pencarian yang Anda inginkan
        $this->db->group_start(); // Mulai grouping OR
        $this->db->like('no_peraturan', $q);
        $this->db->or_like('tentang', $q);
        $this->db->or_like('tahun', $q);
        $this->db->or_like('teu_badan', $q);
        $this->db->or_like('subjek', $q);
        $this->db->group_end(); // Tutup grouping OR
        return $this->db->get($this->table)->result();
    }
}