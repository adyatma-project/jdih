<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_produk_hukum extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Ta_produk_hukum_model', 'Ta_katalog_model', 'Ta_produk_hukum_det_model', 'Ta_produk_hukum_katalog_model'));
        $this->load->library('form_validation');
        $this->load->library('upload'); // Load library upload di construct
        $this->load->helper('statusperaturan_helper');
        $this->load->helper('tanggal_helper');
    }

    public function excel()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $q = urldecode($this->input->get('q', TRUE));
            $data['produk_hukum_data'] = $this->Ta_produk_hukum_model->get_all_for_export($q);
            
            $filename = "Data_Produk_Hukum_" . date('Ymd') . ".xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            
            $this->load->view('backend/ta_produk_hukum/ta_produk_hukum_excel', $data);
        } else {
            redirect(base_url('backend'));
        }
    }

    public function delete($id) 
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            $row = $this->Ta_produk_hukum_model->get_by_id($id);

            if ($row) {
                // 1. Hapus File Utama
                if ($row->file != "" && file_exists("./uploads/produk_hukum/" . $row->file)) {
                    unlink("./uploads/produk_hukum/" . $row->file);
                }

                // 2. Hapus File Abstrak (JIKA ADA) - TAMBAHAN
                if ($row->file_abstrak != "" && file_exists("./uploads/produk_hukum/" . $row->file_abstrak)) {
                    unlink("./uploads/produk_hukum/" . $row->file_abstrak);
                }
                
                $this->Ta_produk_hukum_model->delete($id);
                $this->Ta_produk_hukum_det_model->delete($id); 

                $this->session->set_flashdata('message', '<div class="alert alert-success">Hapus Berhasil</div>');
                redirect(site_url('ta_produk_hukum'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Data Tidak Ditemukan</div>');
                redirect(site_url('ta_produk_hukum'));
            }
        } else {
            redirect(site_url('backend')); 
        }
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'ta_produk_hukum?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'ta_produk_hukum?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'ta_produk_hukum';
                $config['first_url'] = base_url() . 'ta_produk_hukum';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Ta_produk_hukum_model->total_rows($q);
            $ta_produk_hukum = $this->Ta_produk_hukum_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'ta_produk_hukum_data' => $ta_produk_hukum,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_list', $data);
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function create()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            $kategori = $this->db->query("SELECT * FROM ref_kategori WHERE status=1 ORDER BY id_kategori ASC")->result();
            
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('ta_produk_hukum/create_action'),
                'id_produk_hukum' => set_value('id_produk_hukum'),
                'id_kategori' => set_value('id_kategori'),
                'file' => set_value('file'),
                'file_abstrak' => set_value('file_abstrak'), // TAMBAHAN
                'status' => set_value('status', '1'),
                
                // Metadata
                'teu_badan' => set_value('teu_badan'),
                'subjek' => set_value('subjek'),
                'bahasa' => set_value('bahasa', 'Indonesia'),
                'lokasi' => set_value('lokasi'),
                'bidang_hukum' => set_value('bidang_hukum'),
                'jenis_peraturan' => set_value('jenis_peraturan'),
                'status_peraturan' => set_value('status_peraturan'),
                'tentang' => set_value('tentang'),
                'no_peraturan' => set_value('no_peraturan'),
                'tahun' => set_value('tahun'),
                'singkatan_jenis' => set_value('singkatan_jenis'),
                'tempat_penetapan' => set_value('tempat_penetapan'),
                'tgl_penetapan' => set_value('tgl_penetapan'),
                'tgl_pengundangan' => set_value('tgl_pengundangan'),
                'sumber' => set_value('sumber'),
                'judul_buku' => set_value('judul_buku'),
                'penulis' => set_value('penulis'),
                'nomor_panggil' => set_value('nomor_panggil'),
                'cetakan_edisi' => set_value('cetakan_edisi'),
                'tempat_terbit' => set_value('tempat_terbit'),
                'penerbit' => set_value('penerbit'),
                'tahun_terbit' => set_value('tahun_terbit'),
                'deskripsi_fisik' => set_value('deskripsi_fisik'),
                'isbn' => set_value('isbn'),
                'nomor_induk_buku' => set_value('nomor_induk_buku'),
                'judul_artikel' => set_value('judul_artikel'),
                'penulis_artikel' => set_value('penulis_artikel'),
                'nama_jurnal' => set_value('nama_jurnal'),
                'volume' => set_value('volume'),
                'halaman' => set_value('halaman'),
                'tahun_terbit_art' => set_value('tahun_terbit_art'),
                'tempat_terbit_art' => set_value('tempat_terbit_art'),
                'nomor_putusan' => set_value('nomor_putusan'),
                'jenis_peradilan' => set_value('jenis_peradilan'),
                'singkatan_peradilan' => set_value('singkatan_peradilan'),
                'tempat_peradilan' => set_value('tempat_peradilan'),
                'tanggal_dibacakan' => set_value('tanggal_dibacakan'),
                'lembaga_peradilan' => set_value('lembaga_peradilan'),
                'amar_putusan' => set_value('amar_putusan'),
                'status_putusan' => set_value('status_putusan'),

                'ref_kategori' => $kategori,
            );
            $this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_form', $data);
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function create_action()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            if (empty($this->input->post('id_kategori'))) {
                 $this->session->set_flashdata('message', '<div class="alert alert-danger">Kategori wajib dipilih!</div>');
                 redirect('ta_produk_hukum/create');
            }

            // Mapping Variable
            $judul = $this->input->post('tentang', TRUE); 
            if(empty($judul)) $judul = $this->input->post('judul_buku', TRUE);
            if(empty($judul)) $judul = $this->input->post('judul_artikel', TRUE);
            
            $teu = $this->input->post('teu_badan', TRUE);
            if(empty($teu)) $teu = $this->input->post('penulis', TRUE);
            if(empty($teu)) $teu = $this->input->post('penulis_artikel', TRUE);

            $tahun = $this->input->post('tahun', TRUE);
            if(empty($tahun)) $tahun = $this->input->post('tahun_terbit', TRUE);
            if(empty($tahun)) $tahun = $this->input->post('tahun_terbit_art', TRUE);

            $tempat = $this->input->post('tempat_penetapan', TRUE);
            if(empty($tempat)) $tempat = $this->input->post('tempat_terbit', TRUE);
            if(empty($tempat)) $tempat = $this->input->post('tempat_terbit_art', TRUE);
            if(empty($tempat)) $tempat = $this->input->post('tempat_peradilan', TRUE);

            $sumber = $this->input->post('sumber', TRUE);
            if(empty($sumber)) $sumber = $this->input->post('nama_jurnal', TRUE);

            // --- PROSES UPLOAD FILE UTAMA ---
            $gambar_file = "";
            if (!empty($_FILES['file']['name'])) {
                $namafile = "Dokumen-" . date('YmdHis');
                $config['upload_path']   = "./uploads/produk_hukum/";
                $config['allowed_types'] = "pdf|doc|docx";
                $config['max_size']      = "50480"; // 50MB
                $config['file_name']     = $namafile;
                
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $gambar = $this->upload->data();
                    $gambar_file = $gambar['file_name'];
                }
            }

            // --- PROSES UPLOAD FILE ABSTRAK (TAMBAHAN) ---
            $abstrak_file = "";
            if (!empty($_FILES['file_abstrak']['name'])) {
                $namafile_abs = "Abstrak-" . date('YmdHis');
                $config_abs['upload_path']   = "./uploads/produk_hukum/";
                $config_abs['allowed_types'] = "pdf|doc|docx";
                $config_abs['max_size']      = "50480"; // 50MB
                $config_abs['file_name']     = $namafile_abs;
                
                // Penting: Initialize ulang untuk file kedua
                $this->upload->initialize($config_abs);
                if ($this->upload->do_upload('file_abstrak')) {
                    $up_abs = $this->upload->data();
                    $abstrak_file = $up_abs['file_name'];
                }
            }

            $data = array(
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'status' => $this->input->post('status', TRUE),
                'file' => $gambar_file,
                'file_abstrak' => $abstrak_file, // SIMPAN FILENAME ABSTRAK
                'tgl_peraturan' => date('Y-m-d'),
                'jenis_peraturan' => $this->input->post('jenis_peraturan',TRUE),
                'status_peraturan' => $this->input->post('status_peraturan',TRUE),
                'tentang' => $judul,
                'judul' => $judul,
                'teu_badan' => $teu,
                'tahun' => $tahun,
                'subjek' => $this->input->post('subjek', TRUE),
                'bahasa' => $this->input->post('bahasa', TRUE),
                'lokasi' => $this->input->post('lokasi', TRUE),
                'bidang_hukum' => $this->input->post('bidang_hukum', TRUE),
                'sumber' => $sumber,
                'no_peraturan' => $this->input->post('no_peraturan', TRUE),
                'singkatan_jenis' => $this->input->post('singkatan_jenis', TRUE),
                'tempat_penetapan' => $tempat,
                'tanggal_penetapan' => $this->input->post('tgl_penetapan', TRUE),
                'tanggal_pengundangan' => $this->input->post('tgl_pengundangan', TRUE),
                'nomor_panggil' => $this->input->post('nomor_panggil', TRUE),
                'cetakan_edisi' => $this->input->post('cetakan_edisi', TRUE),
                'penerbit' => $this->input->post('penerbit', TRUE),
                'deskripsi_fisik' => $this->input->post('deskripsi_fisik', TRUE),
                'isbn' => $this->input->post('isbn', TRUE),
                'nomor_induk_buku' => $this->input->post('nomor_induk_buku', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'halaman' => $this->input->post('halaman', TRUE),
                'nomor_putusan' => $this->input->post('nomor_putusan', TRUE),
                'jenis_peradilan' => $this->input->post('jenis_peradilan', TRUE),
                'singkatan_peradilan' => $this->input->post('singkatan_peradilan', TRUE),
                'tanggal_dibacakan' => $this->input->post('tanggal_dibacakan', TRUE),
                'status_putusan' => $this->input->post('status_putusan', TRUE),
                'lembaga_peradilan' => $this->input->post('lembaga_peradilan', TRUE),
                'amar_putusan' => $this->input->post('amar_putusan', TRUE),
            );

            $this->Ta_produk_hukum_model->insert($data);
            
            $insert_id = $this->db->insert_id();
            $data_perubahan = array(
                'id_produk_hukum' => $insert_id,
                'id_sumber_perubahan' => 0,
                'id_status_peraturan' => 0, 
            );
            $this->Ta_produk_hukum_det_model->insert($data_perubahan);

            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Disimpan</div>');
            redirect(site_url('ta_produk_hukum'));
            
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function update($id)
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $row = $this->Ta_produk_hukum_model->get_row($id);
            $kategori = $this->db->query("SELECT * FROM ref_kategori WHERE status=1 ORDER BY id_kategori ASC")->result();
            
            if ($row) {
                $data = array(
                    'button' => 'Ubah',
                    'action' => site_url('ta_produk_hukum/update_action'),
                    'id_produk_hukum' => set_value('id_produk_hukum', $row->id_produk_hukum),
                    'jenis_peraturan' => set_value('jenis_peraturan', $row->jenis_peraturan),
                    'status_peraturan' => set_value('status_peraturan', $row->status_peraturan),
                    'id_kategori' => set_value('id_kategori', $row->id_kategori),
                    'file' => set_value('file', $row->file),
                    'file_abstrak' => set_value('file_abstrak', $row->file_abstrak), // TAMBAHAN
                    'status' => set_value('status', $row->status),
                    'ref_kategori' => $kategori,

                    // Mapping Data (Sama seperti sebelumnya)
                    'teu_badan' => set_value('teu_badan', $row->teu_badan),
                    'subjek' => set_value('subjek', $row->subjek),
                    'bahasa' => set_value('bahasa', $row->bahasa),
                    'lokasi' => set_value('lokasi', $row->lokasi),
                    'bidang_hukum' => set_value('bidang_hukum', $row->bidang_hukum),
                    'tentang' => set_value('tentang', $row->tentang),
                    'no_peraturan' => set_value('no_peraturan', $row->no_peraturan),
                    'tahun' => set_value('tahun', $row->tahun),
                    'singkatan_jenis' => set_value('singkatan_jenis', $row->singkatan_jenis),
                    'tempat_penetapan' => set_value('tempat_penetapan', $row->tempat_penetapan),
                    'tgl_penetapan' => set_value('tgl_penetapan', $row->tanggal_penetapan),
                    'tgl_pengundangan' => set_value('tgl_pengundangan', $row->tanggal_pengundangan),
                    'sumber' => set_value('sumber', $row->sumber),
                    'judul_buku' => $row->tentang, 
                    'penulis' => $row->teu_badan,
                    'tahun_terbit' => $row->tahun,
                    'nomor_panggil' => set_value('nomor_panggil', $row->nomor_panggil),
                    'cetakan_edisi' => set_value('cetakan_edisi', $row->cetakan_edisi),
                    'tempat_terbit' => set_value('tempat_terbit', $row->tempat_penetapan),
                    'penerbit' => set_value('penerbit', $row->penerbit),
                    'deskripsi_fisik' => set_value('deskripsi_fisik', $row->deskripsi_fisik),
                    'isbn' => set_value('isbn', $row->isbn),
                    'nomor_induk_buku' => set_value('nomor_induk_buku', $row->nomor_induk_buku),
                    'judul_artikel' => $row->tentang,
                    'penulis_artikel' => $row->teu_badan,
                    'tahun_terbit_art' => $row->tahun,
                    'tempat_terbit_art' => $row->tempat_penetapan,
                    'nama_jurnal' => $row->sumber,
                    'volume' => set_value('volume', $row->volume),
                    'halaman' => set_value('halaman', $row->halaman),
                    'nomor_putusan' => set_value('nomor_putusan', $row->nomor_putusan),
                    'jenis_peradilan' => set_value('jenis_peradilan', $row->jenis_peradilan),
                    'singkatan_peradilan' => set_value('singkatan_peradilan', $row->singkatan_peradilan),
                    'tempat_peradilan' => set_value('tempat_peradilan', $row->tempat_peradilan),
                    'tanggal_dibacakan' => set_value('tanggal_dibacakan', $row->tanggal_dibacakan),
                    'status_putusan' => set_value('status_putusan', $row->status_putusan),
                    'lembaga_peradilan' => set_value('lembaga_peradilan', $row->lembaga_peradilan),
                    'amar_putusan' => set_value('amar_putusan', $row->amar_putusan),
                );
                $this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
                redirect(site_url('ta_produk_hukum'));
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function update_action()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            // Mapping Variabel (Sama dengan create)
            $judul = $this->input->post('tentang', TRUE); 
            if(empty($judul)) $judul = $this->input->post('judul_buku', TRUE);
            if(empty($judul)) $judul = $this->input->post('judul_artikel', TRUE);
            
            $teu = $this->input->post('teu_badan', TRUE);
            if(empty($teu)) $teu = $this->input->post('penulis', TRUE);
            if(empty($teu)) $teu = $this->input->post('penulis_artikel', TRUE);

            $tahun = $this->input->post('tahun', TRUE);
            if(empty($tahun)) $tahun = $this->input->post('tahun_terbit', TRUE);
            if(empty($tahun)) $tahun = $this->input->post('tahun_terbit_art', TRUE);

            $tempat = $this->input->post('tempat_penetapan', TRUE);
            if(empty($tempat)) $tempat = $this->input->post('tempat_terbit', TRUE);
            if(empty($tempat)) $tempat = $this->input->post('tempat_terbit_art', TRUE);
            if(empty($tempat)) $tempat = $this->input->post('tempat_peradilan', TRUE);

            $sumber = $this->input->post('sumber', TRUE);
            if(empty($sumber)) $sumber = $this->input->post('nama_jurnal', TRUE);

            $data = array(
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'status' => $this->input->post('status', TRUE),
                'tentang' => $judul,
                'judul' => $judul,
                'teu_badan' => $teu,
                'tahun' => $tahun,
                'subjek' => $this->input->post('subjek', TRUE),
                'bahasa' => $this->input->post('bahasa', TRUE),
                'lokasi' => $this->input->post('lokasi', TRUE),
                'bidang_hukum' => $this->input->post('bidang_hukum', TRUE),
                'sumber' => $sumber,
                'jenis_peraturan' => $this->input->post('jenis_peraturan',TRUE),
                'status_peraturan' => $this->input->post('status_peraturan',TRUE),
                'no_peraturan' => $this->input->post('no_peraturan', TRUE),
                'singkatan_jenis' => $this->input->post('singkatan_jenis', TRUE),
                'tempat_penetapan' => $tempat,
                'tanggal_penetapan' => $this->input->post('tgl_penetapan', TRUE),
                'tanggal_pengundangan' => $this->input->post('tgl_pengundangan', TRUE),
                'nomor_panggil' => $this->input->post('nomor_panggil', TRUE),
                'cetakan_edisi' => $this->input->post('cetakan_edisi', TRUE),
                'penerbit' => $this->input->post('penerbit', TRUE),
                'deskripsi_fisik' => $this->input->post('deskripsi_fisik', TRUE),
                'isbn' => $this->input->post('isbn', TRUE),
                'nomor_induk_buku' => $this->input->post('nomor_induk_buku', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'halaman' => $this->input->post('halaman', TRUE),
                'nomor_putusan' => $this->input->post('nomor_putusan', TRUE),
                'jenis_peradilan' => $this->input->post('jenis_peradilan', TRUE),
                'singkatan_peradilan' => $this->input->post('singkatan_peradilan', TRUE),
                'tanggal_dibacakan' => $this->input->post('tanggal_dibacakan', TRUE),
                'status_putusan' => $this->input->post('status_putusan', TRUE),
                'lembaga_peradilan' => $this->input->post('lembaga_peradilan', TRUE),
                'amar_putusan' => $this->input->post('amar_putusan', TRUE),
            );

            // HANDLE UPLOAD FILE UTAMA
            if (!empty($_FILES['file']['name'])) {
                $row = $this->Ta_produk_hukum_model->get_by_id($this->input->post('id_produk_hukum'));
                if ($row->file != "" && file_exists("./uploads/produk_hukum/" . $row->file)) {
                    unlink("./uploads/produk_hukum/" . $row->file);
                }

                $namafile = "Dokumen-" . date('YmdHis');
                $config['upload_path']   = "./uploads/produk_hukum/";
                $config['allowed_types'] = "pdf|doc|docx";
                $config['file_name']     = $namafile;
                $config['max_size']      = "50480";
                
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $data['file'] = $upload_data['file_name'];
                }
            }

            // HANDLE UPLOAD FILE ABSTRAK (TAMBAHAN)
            if (!empty($_FILES['file_abstrak']['name'])) {
                $row = $this->Ta_produk_hukum_model->get_by_id($this->input->post('id_produk_hukum'));
                
                // Hapus abstrak lama jika ada
                if ($row->file_abstrak != "" && file_exists("./uploads/produk_hukum/" . $row->file_abstrak)) {
                    unlink("./uploads/produk_hukum/" . $row->file_abstrak);
                }

                $namafile_abs = "Abstrak-" . date('YmdHis');
                $config_abs['upload_path']   = "./uploads/produk_hukum/";
                $config_abs['allowed_types'] = "pdf|doc|docx";
                $config_abs['file_name']     = $namafile_abs;
                $config_abs['max_size']      = "50480";
                
                $this->upload->initialize($config_abs);
                if ($this->upload->do_upload('file_abstrak')) {
                    $up_abs = $this->upload->data();
                    $data['file_abstrak'] = $up_abs['file_name'];
                }
            }

            $this->Ta_produk_hukum_model->update($this->input->post('id_produk_hukum', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Update Berhasil</div>');
            redirect(site_url('ta_produk_hukum'));

        } else {
            header('location:' . base_url() . 'backend');
        }
    }
}