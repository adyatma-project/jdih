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
        $this->load->helper('statusperaturan_helper');
        $this->load->helper('tanggal_helper');
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

    public function read($id)
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $row = $this->Ta_produk_hukum_model->get_row($id);
            if ($row) {
                $data = array(
                    'id_produk_hukum' => $row->id_produk_hukum,
                    'no_peraturan' => $row->no_peraturan,
                    'tentang' => $row->tentang,
                    'tahun' => $row->tahun,
                    'id_pengarang' => $row->id_pengarang,
                    'id_kategori' => $row->kategori,
                    'id_status_peraturan' => "",
                    'file' => $row->file,
                    'abstrak' => $row->abstrak,
                    'id_katalog' => $row->id_katalog,
                    'tempat_terbit' => $row->tempat_terbit,
                    'tgl_peraturan' => $row->tgl_peraturan,
                    'dilihat' => $row->dilihat,
                    'didownload' => $row->didownload,
                    // Tambahan Metadata
                    'nomor_putusan' => $row->nomor_putusan,
                    'jenis_peradilan' => $row->jenis_peradilan,
                    'lembaga_peradilan' => $row->lembaga_peradilan,
                    'amar_putusan' => $row->amar_putusan,
                    'tgl_putusan' => $row->tgl_putusan,
                    'isbn' => $row->isbn,
                    'penulis' => $row->penulis,
                    'penerbit' => $row->penerbit,
                    'klasifikasi' => $row->klasifikasi,
                    'nama_jurnal' => $row->nama_jurnal,
                    'volume' => $row->volume,
                    'halaman' => $row->halaman,
                    'tempat_penetapan' => $row->tempat_penetapan,
                    'tgl_penetapan' => $row->tgl_penetapan,
                    'tgl_pengundangan' => $row->tgl_pengundangan,
                    'sumber_ln' => $row->sumber_ln,
                    'sumber_tln' => $row->sumber_tln,
                    'sumber_bn' => $row->sumber_bn,
                    'subjek' => $row->subjek,
                );

                $this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_read', $data);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Data Tidak Ditemukan.
                </div>');
                redirect(site_url('ta_produk_hukum'));
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function create()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $kategori = $this->db->query("SELECT * FROM ref_kategori WHERE status=1 ORDER BY id_kategori ASC")->result();
            $katalog = $this->db->query("SELECT * FROM ta_katalog ORDER BY id_katalog ASC")->result();
            $list_produk_hukum = $this->db->query("SELECT * FROM ta_produk_hukum LEFT JOIN ta_produk_hukum_det ON ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum where (ta_produk_hukum_det.id_status_peraturan=0) OR  (ta_produk_hukum_det.id_status_peraturan=1) OR (ta_produk_hukum_det.id_status_peraturan=3) OR (ta_produk_hukum_det.id_status_peraturan=4) OR (ta_produk_hukum_det.id_status_peraturan=5)  ORDER BY no_peraturan ASC")->result();
            $status_peraturan = $this->db->query("SELECT * FROM ref_status_peraturan WHERE status=1 ORDER BY id_status_peraturan ASC")->result();
            $pengarang = $this->db->query("SELECT * FROM ref_pengarang WHERE status=1")->result();
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('ta_produk_hukum/create_action'),
                'id_produk_hukum' => set_value('id_produk_hukum'),
                'judul_peraturan' => "Peraturan Daerah",
                'no_peraturan' => set_value('no_peraturan'),
                'tentang' => set_value('tentang'),
                'tahun' => set_value('tahun'),
                'pengarang' => $pengarang,
                'id_kategori' => set_value('id_kategori'),
                'id_status_peraturan' => "-",
                'file' => set_value('file'),
                'file_lampiran' => set_value('file_lampiran'),
                'abstrak' => set_value('abstrak'),
                'file_abstrak' => set_value('file_abstrak'),
                'id_katalog' => set_value('id_katalog'),
                'tempat_terbit' => set_value('tempat_terbit'),
                'tgl_peraturan' => set_value('tgl_peraturan'),
                'dilihat' => set_value('dilihat'),
                'didownload' => set_value('didownload'),
                'kategori' => $kategori,
                'katalog' => $katalog,
                'status_peraturan' => $status_peraturan,
                'list_produk_hukum' => $list_produk_hukum,
                'disabled' => "",
                'keterangan_lainnya' => set_value('keterangan_lainnya'),
                'ktlglembaran_jenis' => set_value('ktlglembaran_jenis'),
                'ktlglembaran_tahun' => set_value('ktlglembaran_tahun'),
                'ktlglembaran_no' => set_value('ktlglembaran_no'),
                'ktlglembaran_jum_halaman' => set_value('ktlglembaran_jum_halaman'),
                'ktlgtambahan_jenis' => set_value('ktlgtambahan_jenis'),
                'ktlgtambahan_tahun' => set_value('ktlgtambahan_tahun'),
                'ktlgtambahan_no' => set_value('ktlgtambahan_no'),
                'ktlgtambahan_jum_halaman' => set_value('ktlgtambahan_jum_halaman'),
                'pemrakarsa' => set_value('pemrakarsa'),
                'no_register' => set_value('no_register'),
                'status' => set_value('status', '1'), // Default status publish

                // Metadata Baru (Inisialisasi)
                'tempat_penetapan' => set_value('tempat_penetapan'),
                'tgl_penetapan' => set_value('tgl_penetapan'),
                'tgl_pengundangan' => set_value('tgl_pengundangan'),
                'sumber_ln' => set_value('sumber_ln'),
                'sumber_tln' => set_value('sumber_tln'),
                'sumber_bn' => set_value('sumber_bn'),
                'subjek' => set_value('subjek'),
                'nomor_putusan' => set_value('nomor_putusan'),
                'jenis_peradilan' => set_value('jenis_peradilan'),
                'lembaga_peradilan' => set_value('lembaga_peradilan'),
                'amar_putusan' => set_value('amar_putusan'),
                'tgl_putusan' => set_value('tgl_putusan'),
                'isbn' => set_value('isbn'),
                'penulis' => set_value('penulis'),
                'penerbit' => set_value('penerbit'),
                'klasifikasi' => set_value('klasifikasi'),
                'nama_jurnal' => set_value('nama_jurnal'),
                'volume' => set_value('volume'),
                'halaman' => set_value('halaman'),
                'judul_buku' => set_value('judul_buku'), // Menampung judul buku sementara
                'judul_artikel' => set_value('judul_artikel'), // Menampung judul artikel sementara
                'penulis_artikel' => set_value('penulis_artikel'), // Menampung penulis artikel sementara
                'tahun_terbit' => set_value('tahun_terbit'), // Menampung tahun terbit sementara
            );
            $this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_form', $data);
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function create_action()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            // Validasi manual yang lebih fleksibel, karena _rules() standar terlalu kaku untuk form dinamis
            // $this->_rules(); 

            // Cek manual field wajib dasar
            if (empty($this->input->post('id_kategori'))) {
                 $this->session->set_flashdata('message', '<div class="alert alert-danger">Kategori harus dipilih.</div>');
                 $this->create();
                 return;
            }

            // Logic Penanganan Judul/Tentang berdasarkan input yang diisi
            $tentang_final = $this->input->post('tentang', TRUE);
            if(empty($tentang_final)) {
                $tentang_final = $this->input->post('judul_buku', TRUE);
            }
            if(empty($tentang_final)) {
                $tentang_final = $this->input->post('judul_artikel', TRUE);
            }

            // Logic Penanganan Tahun
            $tahun_final = $this->input->post('tahun', TRUE);
            if(empty($tahun_final)){
                $tahun_final = $this->input->post('tahun_terbit', TRUE);
            }

            // Logic Penanganan Penulis
            $penulis_final = $this->input->post('penulis', TRUE);
            if(empty($penulis_final)){
                $penulis_final = $this->input->post('penulis_artikel', TRUE);
            }

            $this->load->library('upload');
            $namafile = "Produk-Hukum-" . $this->input->post('no_peraturan', TRUE) . "-" . time();
            $namafile_lampiran = "Lampiran" . $this->input->post('no_peraturan', TRUE) . "-" . time();
            
            $config = array(
                'upload_path' => "./uploads/produk_hukum/", 
                'allowed_types' => "pdf", 
                'overwrite' => TRUE,
                'max_size' => "50480000", // ~50MB
                'file_name' => $namafile 
            );
            $config_lampiran = array(
                'upload_path' => "./uploads/produk_hukum/", 
                'allowed_types' => "pdf", 
                'overwrite' => TRUE,
                'max_size' => "50480000", 
                'file_name' => $namafile_lampiran 
            );

            $data_lampiran_file = "";
            $this->upload->initialize($config_lampiran);
            if ($this->upload->do_upload('file_lampiran')) {
                $data_lampiran =  $this->upload->data();
                $data_lampiran_file = $data_lampiran['file_name'];
            }

            $gambar_file = "";
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) { // Ganti 'imgName' jadi 'file' sesuai view
                $gambar =  $this->upload->data();
                $gambar_file = $gambar['file_name'];
            }

            // Data Utama
            $data = array(
                'no_peraturan' => $this->input->post('no_peraturan', TRUE),
                'judul_peraturan' => $this->input->post('judul_peraturan', TRUE), // Bisa dihapus jika tidak perlu
                'tentang' => $tentang_final,
                'tahun' => $tahun_final,
                'id_pengarang' => $this->input->post('id_pengarang', TRUE), // Opsional
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'file' => $gambar_file,
                'file_lampiran' => $data_lampiran_file,
                'tempat_terbit' => $this->input->post('tempat_terbit', TRUE),
                'tgl_peraturan' => $this->input->post('tgl_peraturan', TRUE), // Tgl Upload
                'keterangan_lainnya' => $this->input->post('keterangan_lainnya', TRUE),
                'dilihat' => "0",
                'didownload' => "0",
                'status' => $this->input->post('status', TRUE),

                // METADATA BARU
                'tempat_penetapan' => $this->input->post('tempat_penetapan', TRUE),
                'tgl_penetapan' => $this->input->post('tgl_penetapan', TRUE),
                'tgl_pengundangan' => $this->input->post('tgl_pengundangan', TRUE),
                'sumber_ln' => $this->input->post('sumber_ln', TRUE),
                'sumber_tln' => $this->input->post('sumber_tln', TRUE),
                'sumber_bn' => $this->input->post('sumber_bn', TRUE),
                'subjek' => $this->input->post('subjek', TRUE),
                'nomor_putusan' => $this->input->post('nomor_putusan', TRUE),
                'jenis_peradilan' => $this->input->post('jenis_peradilan', TRUE),
                'lembaga_peradilan' => $this->input->post('lembaga_peradilan', TRUE),
                'amar_putusan' => $this->input->post('amar_putusan', TRUE),
                'tgl_putusan' => $this->input->post('tgl_putusan', TRUE),
                'isbn' => $this->input->post('isbn', TRUE),
                'penulis' => $penulis_final,
                'penerbit' => $this->input->post('penerbit', TRUE),
                'klasifikasi' => $this->input->post('klasifikasi', TRUE),
                'nama_jurnal' => $this->input->post('nama_jurnal', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'halaman' => $this->input->post('halaman', TRUE),
            );

            $this->Ta_produk_hukum_model->insert($data);
            $insert_id = $this->db->insert_id();

            // LOGIKA STATUS PERATURAN (Default ke 0/Berlaku jika tidak diisi)
            $data_perubahan = array(
                'id_produk_hukum' => $insert_id,
                'id_sumber_perubahan' => 0,
                'id_status_peraturan' => 0, // Default Berlaku
            );
            $this->Ta_produk_hukum_det_model->insert($data_perubahan);

            // LOGIKA KATALOG (Opsional, jika masih dipakai)
            // ... (Kode katalog lama tetap bisa dipertahankan jika perlu, atau dihapus jika sudah digantikan metadata baru) ...

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Berhasil Menambah Data
                </div>');
            redirect(site_url('ta_produk_hukum'));
            
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function update($id)
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $row = $this->Ta_produk_hukum_model->get_by_id($id);
            $kategori = $this->db->query("SELECT * FROM ref_kategori WHERE status=1 ORDER BY id_kategori ASC")->result();
            $katalog = $this->db->query("SELECT * FROM ta_katalog ORDER BY id_katalog ASC")->result();
            $list_produk_hukum = $this->db->query("SELECT * FROM ta_produk_hukum WHERE id_produk_hukum<>$id ORDER BY no_peraturan ASC")->result();
            $status_peraturan = $this->db->query("SELECT * FROM ref_status_peraturan ORDER BY nama_status_peraturan ASC")->result();
            $pengarang = $this->db->query("SELECT * FROM ref_pengarang WHERE status=1")->result();

            if ($row) {
                // ... (Logika ambil data katalog lama jika ada) ...
                $ktlglembaran_jenis = ""; // Default kosongkan dulu biar simple
                $ktlglembaran_tahun = "";
                $ktlglembaran_no = "";
                // dst...

                $data = array(
                    'button' => 'Ubah',
                    'action' => site_url('ta_produk_hukum/update_action'),
                    'id_produk_hukum' => set_value('id_produk_hukum', $row->id_produk_hukum),
                    'no_peraturan' => set_value('no_peraturan', $row->no_peraturan),
                    'judul_peraturan' => set_value('judul_peraturan', "Peraturan Daerah"),
                    'tentang' => set_value('tentang', $row->tentang),
                    'tahun' => set_value('tahun', $row->tahun),
                    'pengarang' => $pengarang,
                    'id_pengarang' => set_value('id_pengarang', $row->id_pengarang),
                    'id_kategori' => set_value('id_kategori', $row->id_kategori),
                    'id_status_peraturan' => set_value('id_status_peraturan', $row->id_status_peraturan), // Perlu join tabel det kalau mau fix
                    'file' => set_value('file', $row->file),
                    'file_lampiran' => set_value('file_lampiran', $row->file_lampiran),
                    'abstrak' => set_value('abstrak', $row->abstrak),
                    'id_katalog' => set_value('id_katalog', $row->id_katalog),
                    'tempat_terbit' => set_value('tempat_terbit', $row->tempat_terbit),
                    'tgl_peraturan' => set_value('tgl_peraturan', $row->tgl_peraturan),
                    'disabled' => "disabled",
                    'kategori' => $kategori,
                    'katalog' => $katalog,
                    'status_peraturan' => $status_peraturan,
                    'list_produk_hukum' => $list_produk_hukum,
                    'keterangan_lainnya' => set_value('keterangan_lainnya', $row->keterangan_lainnya),
                    'status' => set_value('status', $row->status),

                    // METADATA BARU (Isi value dari $row)
                    'tempat_penetapan' => set_value('tempat_penetapan', $row->tempat_penetapan),
                    'tgl_penetapan' => set_value('tgl_penetapan', $row->tgl_penetapan),
                    'tgl_pengundangan' => set_value('tgl_pengundangan', $row->tgl_pengundangan),
                    'sumber_ln' => set_value('sumber_ln', $row->sumber_ln),
                    'sumber_tln' => set_value('sumber_tln', $row->sumber_tln),
                    'sumber_bn' => set_value('sumber_bn', $row->sumber_bn),
                    'subjek' => set_value('subjek', $row->subjek),
                    'nomor_putusan' => set_value('nomor_putusan', $row->nomor_putusan),
                    'jenis_peradilan' => set_value('jenis_peradilan', $row->jenis_peradilan),
                    'lembaga_peradilan' => set_value('lembaga_peradilan', $row->lembaga_peradilan),
                    'amar_putusan' => set_value('amar_putusan', $row->amar_putusan),
                    'tgl_putusan' => set_value('tgl_putusan', $row->tgl_putusan),
                    'isbn' => set_value('isbn', $row->isbn),
                    'penulis' => set_value('penulis', $row->penulis),
                    'penerbit' => set_value('penerbit', $row->penerbit),
                    'klasifikasi' => set_value('klasifikasi', $row->klasifikasi),
                    'nama_jurnal' => set_value('nama_jurnal', $row->nama_jurnal),
                    'volume' => set_value('volume', $row->volume),
                    'halaman' => set_value('halaman', $row->halaman),
                    
                    // Field Bantuan (Dummy)
                    'judul_buku' => '', 
                    'judul_artikel' => '',
                    'penulis_artikel' => '',
                    'tahun_terbit' => '',
                    
                    // Field Katalog (Optional)
                    'ktlglembaran_jenis' => '', 'ktlglembaran_tahun' => '', 'ktlglembaran_no' => '', 'ktlglembaran_jum_halaman' => '',
                    'ktlgtambahan_jenis' => '', 'ktlgtambahan_tahun' => '', 'ktlgtambahan_no' => '', 'ktlgtambahan_jum_halaman' => '',
                    'pemrakarsa' => '', 'no_register' => '',
                );
                $this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_form', $data);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">Data Tidak Ditemukan.</div>');
                redirect(site_url('ta_produk_hukum'));
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function update_action()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            $id = $this->input->post('id_produk_hukum', TRUE);
            $row = $this->Ta_produk_hukum_model->get_by_id($id);

            // Logic Penanganan Judul/Tentang
            $tentang_final = $this->input->post('tentang', TRUE);
            if(empty($tentang_final)) $tentang_final = $this->input->post('judul_buku', TRUE);
            if(empty($tentang_final)) $tentang_final = $this->input->post('judul_artikel', TRUE);

            // Logic Penanganan Tahun
            $tahun_final = $this->input->post('tahun', TRUE);
            if(empty($tahun_final)) $tahun_final = $this->input->post('tahun_terbit', TRUE);

            // Logic Penanganan Penulis
            $penulis_final = $this->input->post('penulis', TRUE);
            if(empty($penulis_final)) $penulis_final = $this->input->post('penulis_artikel', TRUE);

            $data = array(
                'no_peraturan' => $this->input->post('no_peraturan', TRUE),
                'tentang' => $tentang_final,
                'tahun' => $tahun_final,
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'tempat_terbit' => $this->input->post('tempat_terbit', TRUE),
                'tgl_peraturan' => $this->input->post('tgl_peraturan', TRUE),
                'status' => $this->input->post('status', TRUE),
                
                // METADATA BARU
                'tempat_penetapan' => $this->input->post('tempat_penetapan', TRUE),
                'tgl_penetapan' => $this->input->post('tgl_penetapan', TRUE),
                'tgl_pengundangan' => $this->input->post('tgl_pengundangan', TRUE),
                'sumber_ln' => $this->input->post('sumber_ln', TRUE),
                'sumber_tln' => $this->input->post('sumber_tln', TRUE),
                'sumber_bn' => $this->input->post('sumber_bn', TRUE),
                'subjek' => $this->input->post('subjek', TRUE),
                'nomor_putusan' => $this->input->post('nomor_putusan', TRUE),
                'jenis_peradilan' => $this->input->post('jenis_peradilan', TRUE),
                'lembaga_peradilan' => $this->input->post('lembaga_peradilan', TRUE),
                'amar_putusan' => $this->input->post('amar_putusan', TRUE),
                'tgl_putusan' => $this->input->post('tgl_putusan', TRUE),
                'isbn' => $this->input->post('isbn', TRUE),
                'penulis' => $penulis_final,
                'penerbit' => $this->input->post('penerbit', TRUE),
                'klasifikasi' => $this->input->post('klasifikasi', TRUE),
                'nama_jurnal' => $this->input->post('nama_jurnal', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'halaman' => $this->input->post('halaman', TRUE),
            );

            // Handle File Upload Update
            if (!empty($_FILES['file']['name'])) { // Ganti 'imgName' jadi 'file'
                // Hapus file lama
                if($row->file && file_exists("./uploads/produk_hukum/" . $row->file)) {
                    @unlink("./uploads/produk_hukum/" . $row->file);
                }
                
                $this->load->library('upload');
                $namafile = "Produk-Hukum-" . $this->input->post('no_peraturan', TRUE) . "-" . time();
                $config = array(
                    'upload_path' => "./uploads/produk_hukum/",
                    'allowed_types' => "pdf",
                    'overwrite' => TRUE,
                    'max_size' => "50480000",
                    'file_name' => $namafile
                );
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $gambar = $this->upload->data();
                    $data['file'] = $gambar['file_name'];
                }
            }

            // Update DB
            $this->Ta_produk_hukum_model->update($id, $data);

            // Update Status Peraturan (Jika Ada Perubahan)
            // ... (Logic update status peraturan bisa dipertahankan jika masih relevan) ...

            $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible">Berhasil Mengupdate Data.</div>');
            redirect(site_url('ta_produk_hukum'));

        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function delete($id)
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $row = $this->Ta_produk_hukum_model->get_by_id($id);
            if ($row) {
                // Cek relasi status (apakah ini sumber perubahan?)
                $periksa_status = $this->Ta_produk_hukum_det_model->periksa_status($row->id_produk_hukum);
                if ($periksa_status && ($periksa_status->id_status_peraturan == '2' or $periksa_status->id_status_peraturan == '4' || $periksa_status->id_status_peraturan == '6')) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Tidak dapat dihapus karena digunakan sebagai Sumber pada Peraturan lain.</div>');
                    redirect(site_url('ta_produk_hukum'));
                } else {
                    // Hapus file
                    if($row->file && file_exists("./uploads/produk_hukum/" . $row->file)) {
                        @unlink("./uploads/produk_hukum/" . $row->file);
                    }
                    if($row->file_lampiran && file_exists("./uploads/produk_hukum/" . $row->file_lampiran)) {
                        @unlink("./uploads/produk_hukum/" . $row->file_lampiran);
                    }

                    $this->Ta_produk_hukum_model->delete($id);
                    $this->Ta_produk_hukum_det_model->delete($id);
                    // $this->Ta_produk_hukum_katalog_model->delete($id); // Jika ada

                    $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil Menghapus Data.</div>');
                    redirect(site_url('ta_produk_hukum'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Tidak Ditemukan.</div>');
                redirect(site_url('ta_produk_hukum'));
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function _rules()
    {
        // Validasi dasar, bisa dikurangi jika terlalu ketat untuk form dinamis
        $this->form_validation->set_rules('id_produk_hukum', 'id_produk_hukum', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    // ... Fungsi excel(), getSubjectProdukHukum(), dll bisa dibiarkan tetap ada ...
    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "ta_produk_hukum.xls";
        // ... (kode excel lama) ...
    }
}