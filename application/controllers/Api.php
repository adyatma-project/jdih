<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load database default dari konfigurasi CI
        $this->load->database();
    }

    public function index()
    {
        // Header JSON Wajib
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: *"); // Opsional: agar bisa diakses dari domain lain

        $varjson = array();

        // 1. QUERY DATA
        // Menggabungkan tabel produk hukum dengan kategori untuk mendapatkan nama jenisnya
        $this->db->select('t.*, k.kategori as nama_kategori');
        $this->db->from('ta_produk_hukum t');
        $this->db->join('ref_kategori k', 't.id_kategori = k.id_kategori', 'left');
        $this->db->where('t.status', '1'); // Hanya ambil yang statusnya Publish/Aktif
        $this->db->order_by('t.id_produk_hukum', 'DESC');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                
                // Objek penampung sementara
                $item = new stdClass();

                // --- MAPPING DATA (Sesuai Standar Permenkumham 8/2019) ---

                
                $item->idData = $row->id_produk_hukum;
           
                if (!empty($row->tahun)) {
                    $item->tanggal_penetapan = $row->tahun;
                } elseif (!empty($row->tanggal_penetapan) && $row->tanggal_penetapan != '0000-00-00') {
                    $item->tahun_pengundangan = date('Y', strtotime($row->tanggal_penetapan));
                } else {
                    $item->tahun_pengundangan = "0000";
                }
                
             
                $tgl = !empty($row->tanggal_pengundangan) ? $row->tanggal_pengundangan : 
                       (!empty($row->tanggal_penetapan) ? $row->tanggal_penetapan : date('Y-m-d'));
                
                $item->tanggal_pengundangan = $tgl;

                
                $item->jenis = $row->nama_kategori; // Contoh: Peraturan Bupati
                $item->noPeraturan = !empty($row->no_peraturan) ? $row->no_peraturan : "-";

                
                $judul_final = !empty($row->tentang) ? $row->tentang : $row->judul;
                // Jika Putusan, formatnya beda
                if(empty($judul_final) && !empty($row->nomor_putusan)) {
                    $judul_final = "Putusan " . $row->jenis_peradilan . " Nomor " . $row->nomor_putusan;
                }
                $item->judul = $judul_final;

                // 5. METADATA MONOGRAFI (Buku)
                $item->noPanggil = !empty($row->nomor_panggil) ? $row->nomor_panggil : "-";
                $item->penerbit = !empty($row->penerbit) ? $row->penerbit : "-";
                $item->deskripsiFisik = !empty($row->deskripsi_fisik) ? $row->deskripsi_fisik : "-";
                $item->isbn = !empty($row->isbn) ? $row->isbn : "-";
                $item->nomorIndukBuku = !empty($row->nomor_induk_buku) ? $row->nomor_induk_buku : "-";

                // 6. SINGKATAN JENIS (Wajib untuk Peraturan)
                $item->singkatanJenis = !empty($row->singkatan_jenis) ? $row->singkatan_jenis : "-";

                // 7. TEMPAT TERBIT (Bisa tempat penetapan atau tempat terbit buku)
                $tempat = !empty($row->tempat_penetapan) ? $row->tempat_penetapan : 
                          (!empty($row->tempat_terbit) ? $row->tempat_terbit : "-");
                $item->tempatTerbit = $tempat;

                // 8. SUMBER
                $item->sumber = !empty($row->sumber) ? $row->sumber : "-";

                // 9. SUBJEK
                $item->subjek = !empty($row->subjek) ? $row->subjek : "-";

                // 10. STATUS (Teks)
                // Mapping logika status ID ke Teks (Sesuaikan dengan referensi Anda)
                // Asumsi: Status '1' di tabel utama adalah 'Berlaku'
                // Jika Anda punya tabel ref_status_peraturan yang kompleks, perlu join tambahan
                $item->status = "Berlaku"; 

                // 11. BAHASA
                $item->bahasa = !empty($row->bahasa) ? $row->bahasa : "Indonesia";

                // 12. BIDANG HUKUM
                $item->bidangHukum = !empty($row->bidang_hukum) ? $row->bidang_hukum : "-";

                // 13. T.E.U BADAN / PENGARANG
                $teu = !empty($row->teu_badan) ? $row->teu_badan : 
                       (!empty($row->penulis) ? $row->penulis : "-");
                $item->teuBadan = $teu;

                // 14. FILE DOWNLOAD
                $file_name = !empty($row->file) ? $row->file : "";
                $item->fileDownload = $file_name;
                
                // URL Download Lengkap
                $base_download = base_url('uploads/produk_hukum/');
                $item->urlDownload = !empty($file_name) ? $base_download . $file_name : "";

                // 15. ABSTRAK
                $item->abstrak = !empty($row->abstrak) ? strip_tags($row->abstrak) : "-";
                $item->urlabstrak = ""; // Kosongkan jika tidak ada file khusus abstrak

                // 16. URL DETAIL HALAMAN
                $item->urlDetailPeraturan = base_url('frontendprodukhukum/produk_hukum_page/' . $row->id_produk_hukum);

                // 17. FIELD WAJIB JDIHN
                $item->operasi = "4"; // 4 = Data Gabungan (Insert/Update)
                $item->display = "1"; // 1 = Tampilkan

                // Masukkan ke array utama
                array_push($varjson, $item);
            }
            
            // Output JSON
            echo json_encode($varjson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        
        } else {
            // Jika data kosong
            echo json_encode(["message" => "0 results"]);
        }
    }
}