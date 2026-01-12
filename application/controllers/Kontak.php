<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load database jika belum di autoload
        $this->load->database();
    }

    public function index()
    {
        // 1. Ambil Data Profil dari tabel 'ref_aplikasi'
        // Biasanya ID 1 adalah data utama aplikasi
        $this->db->where('id', 1); 
        $profil = $this->db->get('ref_aplikasi')->row();

        // Cek jika data ada
        if ($profil) {
            $data['profil'] = $profil;
        } else {
            // Data dummy jika tabel kosong (mencegah error)
            $data['profil'] = (object) [
                'nama_instansi' => 'Bagian Hukum Setda Kab. Donggala',
                'alamat' => 'Jalan Jati No. 1, Donggala',
                'no_telp' => '0457-712345',
                'email' => 'hukum@donggala.go.id',
                'logo' => 'logo.png' // Pastikan ini ada atau ganti default
            ];
        }

        // 2. Load View dengan Template Public
        $this->template->load('frontend/template_public', 'frontend/kontak/index', $data);
    }
}