<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load database default dari konfigurasi CodeIgniter
        $this->load->database();
        $this->load->helper('url');
    }

    public function jdihn()
    {
        // 1. Header JSON (Wajib)
        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *"); // Agar bisa diakses server JDIHN

        $varjson = array();

        // 2. Query Data Lengkap (Join Table)
        // Kita ambil data yang statusnya Publish (1)
        $this->db->select('
            a.*, 
            b.kategori, 
            c.nama_status_peraturan,
            d.pemrakarsa,
            d.no_register
        ');
        $this->db->from('ta_produk_hukum a');
        $this->db->join('ref_kategori b', 'a.id_kategori = b.id_kategori', 'left');
        
        // Join Status (Ambil status terakhir/utama)
        // Logika: Kita ambil status dari tabel detail yang paling relevan
        $this->db->join('ta_produk_hukum_det det', 'a.id_produk_hukum = det.id_produk_hukum', 'left');
        $this->db->join('ref_status_peraturan c', 'det.id_status_peraturan = c.id_status_peraturan', 'left');
        
        // Join Katalog (untuk pemrakarsa)
        $this->db->join('ta_produk_hukum_katalog d', 'a.id_produk_hukum = d.id_produk_hukum', 'left');

        $this->db->where('a.status', '1'); // Hanya tampilkan yang statusnya PUBLISH
        $this->db->group_by('a.id_produk_hukum'); // Hindari duplikat data
        $this->db->order_by('a.id_produk_hukum', 'DESC');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $row_array = new stdClass();

                // --- MAPPING DATA SESUAI STANDAR JDIHN ---

                // Identitas Utama
                $row_array->idData = $row->id_produk_hukum;
                $row_array->tahun_pengundangan = $row->tahun;
                
                // Tanggal: Prioritas Tgl Pengundangan -> Tgl Penetapan -> Tgl Upload
                if(!empty($row->tgl_pengundangan) && $row->tgl_pengundangan != '0000-00-00') {
                    $row_array->tanggal_pengundangan = $row->tgl_pengundangan;
                } elseif(!empty($row->tgl_penetapan) && $row->tgl_penetapan != '0000-00-00') {
                    $row_array->tanggal_pengundangan = $row->tgl_penetapan;
                } else {
                    $row_array->tanggal_pengundangan = $row->tgl_peraturan; // Fallback
                }

                $row_array->jenis = $row->kategori; // Perda, Perbup, dll
                $row_array->noPeraturan = $row->no_peraturan;
                $row_array->judul = $row->tentang; // Di JDIH lokal 'tentang', di JDIHN 'judul'

                // Khusus Buku/Monografi
                $row_array->noPanggil = $row->klasifikasi ? $row->klasifikasi : '-'; 
                
                // Singkatan Jenis (Manual Logic sederhana)
                $jenis_upper = strtoupper($row->kategori);
                if(strpos($jenis_upper, 'DAERAH') !== false) $singkatan = "PERDA";
                elseif(strpos($jenis_upper, 'BUPATI') !== false) $singkatan = "PERBUP";
                elseif(strpos($jenis_upper, 'KEPUTUSAN') !== false) $singkatan = "KEP";
                elseif(strpos($jenis_upper, 'SURAT') !== false) $singkatan = "SE";
                else $singkatan = "-";
                $row_array->singkatanJenis = $singkatan;

                $row_array->tempatTerbit = $row->tempat_penetapan ? $row->tempat_penetapan : 'Donggala';
                $row_array->penerbit = $row->penerbit ? $row->penerbit : 'Pemerintah Kabupaten Donggala';
                $row_array->deskripsiFisik = $row->halaman ? $row->halaman . ' Halaman' : '-';
                
                // Sumber (Gabungan LN/TLN/BN)
                $sumber_text = "";
                if($row->sumber_ln) $sumber_text .= "LN: ".$row->sumber_ln." ";
                if($row->sumber_tln) $sumber_text .= "TLN: ".$row->sumber_tln." ";
                if($row->sumber_bn) $sumber_text .= "BN: ".$row->sumber_bn;
                $row_array->sumber = $sumber_text ? $sumber_text : '-';

                $row_array->subjek = $row->subjek ? $row->subjek : '-';
                $row_array->isbn = $row->isbn ? $row->isbn : '-';
                
                // Status (Berlaku/Dicabut)
                $row_array->status = $row->nama_status_peraturan ? $row->nama_status_peraturan : 'Berlaku';
                
                $row_array->bahasa = "Indonesia";
                $row_array->bidangHukum = "-"; // Bisa disesuaikan jika ada kolom bidang hukum
                
                // Author / TEU Badan
                if(!empty($row->pemrakarsa)){
                    $row_array->teuBadan = $row->pemrakarsa;
                } elseif(!empty($row->penulis)) {
                    $row_array->teuBadan = $row->penulis;
                } else {
                    $row_array->teuBadan = "Pemerintah Kabupaten Donggala";
                }

                $row_array->nomorIndukBuku = "-"; // Kosongkan jika tidak ada

                // File & URL
                $row_array->fileDownload = $row->file;
                // Pastikan base_url di config.php sudah benar (https)
                $row_array->urlDownload = base_url('uploads/produk_hukum/' . $row->file);
                
                $row_array->abstrak = strip_tags($row->abstrak); // Bersihkan tag HTML
                
                // URL Abstrak (Jika ada file abstrak terpisah, jika tidak samakan dengan detail)
                $row_array->urlabstrak = base_url('frontendprodukhukum/produk_hukum_page/' . $row->id_produk_hukum);
                
                // URL Detail
                $row_array->urlDetailPeraturan = base_url('frontendprodukhukum/produk_hukum_page/' . $row->id_produk_hukum);
                
                $row_array->operasi = "4"; // Kode Integrasi (Insert/Update)
                $row_array->display = "1"; // Tampilkan

                array_push($varjson, $row_array);
            }
            
            echo json_encode($varjson, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(["message" => "0 results"]);
        }
    }
}