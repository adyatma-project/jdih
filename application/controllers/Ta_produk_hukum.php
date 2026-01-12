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

  public function create()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            // Ambil data referensi
            $kategori = $this->db->query("SELECT * FROM ref_kategori WHERE status=1 ORDER BY id_kategori ASC")->result();
            $status_peraturan = $this->db->query("SELECT * FROM ref_status_peraturan WHERE status=1 ORDER BY id_status_peraturan ASC")->result();
            
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('ta_produk_hukum/create_action'),
                'id_produk_hukum' => set_value('id_produk_hukum'),
                'no_peraturan' => set_value('no_peraturan'),
                'tentang' => set_value('tentang'),
                'tahun' => set_value('tahun'),
                'id_kategori' => set_value('id_kategori'),
                'file' => set_value('file'),
                'status' => set_value('status', '1'),
                
                // Metadata Baru
                'tempat_penetapan' => set_value('tempat_penetapan'),
                'tgl_penetapan' => set_value('tgl_penetapan'),
                'tgl_pengundangan' => set_value('tgl_pengundangan'),
                'tgl_peraturan' => set_value('tgl_peraturan', date('Y-m-d')),
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
                'judul_buku' => set_value('judul_buku'), 
                'judul_artikel' => set_value('judul_artikel'), 
                'penulis_artikel' => set_value('penulis_artikel'), 
                'tahun_terbit' => set_value('tahun_terbit'), 
                
                // --- PERBAIKAN DISINI ---
                'ref_kategori' => $kategori, // Ubah key jadi ref_kategori
                // ------------------------
                
                'status_peraturan' => $status_peraturan,
            );
            $this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_form', $data);
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function create_action()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            // Validasi Sederhana
            if (empty($this->input->post('id_kategori'))) {
                 $this->session->set_flashdata('message', '<div class="alert alert-danger">Kategori wajib dipilih!</div>');
                 redirect('ta_produk_hukum/create');
            }

            // Logic Penanganan Judul/Tentang (Merge Input)
            $tentang_final = $this->input->post('tentang', TRUE);
            if(empty($tentang_final)) $tentang_final = $this->input->post('judul_buku', TRUE);
            if(empty($tentang_final)) $tentang_final = $this->input->post('judul_artikel', TRUE);

            // Logic Penanganan Penulis
            $penulis_final = $this->input->post('penulis', TRUE);
            if(empty($penulis_final)) $penulis_final = $this->input->post('penulis_artikel', TRUE);

            // Logic Upload File
            $this->load->library('upload');
            $namafile = "Dokumen-" . date('YmdHis');
            
            $config = array(
                'upload_path' => "./uploads/produk_hukum/", 
                'allowed_types' => "pdf", 
                'overwrite' => FALSE,
                'max_size' => "50480", // 50MB
                'file_name' => $namafile 
            );

            $gambar_file = "";
            $this->upload->initialize($config);
            
            // Perhatikan: Nama field di view form baru adalah 'file', bukan 'imgName'
            if ($this->upload->do_upload('file')) { 
                $gambar = $this->upload->data();
                $gambar_file = $gambar['file_name'];
            }

            // Susun Data Array
            $data = array(
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'no_peraturan' => $this->input->post('no_peraturan', TRUE),
                'tahun' => $this->input->post('tahun', TRUE),
                'tentang' => $tentang_final,
                'file' => $gambar_file,
                'status' => $this->input->post('status', TRUE),
                'tgl_peraturan' => date('Y-m-d'), // Tgl Upload
                
                // Metadata JDIHN Lengkap
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

            // Set Status Default (Berlaku)
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
                    'no_peraturan' => set_value('no_peraturan', $row->no_peraturan),
                    'tentang' => set_value('tentang', $row->tentang),
                    'tahun' => set_value('tahun', $row->tahun),
                    'id_kategori' => set_value('id_kategori', $row->id_kategori),
                    'file' => set_value('file', $row->file),
                    'status' => set_value('status', $row->status),
                    'tgl_peraturan' => set_value('tgl_peraturan', $row->tgl_peraturan),

                    // Metadata Baru
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
                    'judul_buku' => '', 
                    'judul_artikel' => '',
                    'penulis_artikel' => '',
                    'tahun_terbit' => '',
                    
                    // --- PERBAIKAN DISINI ---
                    'ref_kategori' => $kategori, // Ubah key jadi ref_kategori
                    // ------------------------
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
            
            $id = $this->input->post('id_produk_hukum', TRUE);
            
            // Logic Penanganan Judul (Sama seperti create)
            $tentang_final = $this->input->post('tentang', TRUE);
            if(empty($tentang_final)) $tentang_final = $this->input->post('judul_buku', TRUE);
            if(empty($tentang_final)) $tentang_final = $this->input->post('judul_artikel', TRUE);

            $penulis_final = $this->input->post('penulis', TRUE);
            if(empty($penulis_final)) $penulis_final = $this->input->post('penulis_artikel', TRUE);

            $data = array(
                'id_kategori' => $this->input->post('id_kategori', TRUE),
                'no_peraturan' => $this->input->post('no_peraturan', TRUE),
                'tahun' => $this->input->post('tahun', TRUE),
                'tentang' => $tentang_final,
                'status' => $this->input->post('status', TRUE),
                'tgl_peraturan' => $this->input->post('tgl_peraturan', TRUE),
                
                // Metadata
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

            // Handle Upload Baru (Jika Ada)
            if (!empty($_FILES['file']['name'])) {
                $row = $this->Ta_produk_hukum_model->get_by_id($id);
                // Hapus file lama
                if ($row->file != "" && file_exists("./uploads/produk_hukum/" . $row->file)) {
                    @unlink("./uploads/produk_hukum/" . $row->file);
                }

                $this->load->library('upload');
                $namafile = "Dokumen-" . date('YmdHis');
                $config = array(
                    'upload_path' => "./uploads/produk_hukum/",
                    'allowed_types' => "pdf",
                    'overwrite' => FALSE,
                    'max_size' => "50480",
                    'file_name' => $namafile
                );
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $gambar = $this->upload->data();
                    $data['file'] = $gambar['file_name'];
                }
            }

            $this->Ta_produk_hukum_model->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Update Berhasil</div>');
            redirect(site_url('ta_produk_hukum'));

        } else {
            header('location:' . base_url() . 'backend');
        }
    }
    
    public function delete($id) 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $row = $this->Ta_produk_hukum_model->get_by_id($id);
            if ($row) {
                // Hapus file fisik
                if ($row->file != "" && file_exists("./uploads/produk_hukum/" . $row->file)) {
                    @unlink("./uploads/produk_hukum/" . $row->file);
                }
                
                $this->Ta_produk_hukum_model->delete($id);
                $this->Ta_produk_hukum_det_model->delete($id); // Hapus status juga
                
                $this->session->set_flashdata('message', '<div class="alert alert-success">Hapus Berhasil</div>');
                redirect(site_url('ta_produk_hukum'));
            } else {
                $this->session->set_flashdata('message', 'Data tidak ditemukan');
                redirect(site_url('ta_produk_hukum'));
            }
        }
        else
        {
            header('location:'.base_url().'backend');
        }
    }
    
    // Fungsi excel dan lainnya tetap dipertahankan
    public function excel()
    {
       // ... kode excel Anda (biarkan apa adanya) ...
    }
}