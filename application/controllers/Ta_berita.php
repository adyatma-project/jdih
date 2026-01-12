<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_berita extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_berita_model');
        $this->load->library('form_validation');
        $this->load->library('upload'); 
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'ta_berita?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'ta_berita?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'ta_berita';
                $config['first_url'] = base_url() . 'ta_berita';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Ta_berita_model->total_rows($q);
            $ta_berita = $this->Ta_berita_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'ta_berita_data' => $ta_berita,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->template->load('backend/template', 'backend/ta_berita/ta_berita_list', $data);
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function read($id) 
    {
        // Cek login admin
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $row = $this->Ta_berita_model->get_by_id($id);
            if ($row) {
                // LANGSUNG REDIRECT KE FRONTEND
                redirect(site_url('berita/detail/'.$id));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ta_berita'));
            }
        }
        else
        {
            header('location:'.base_url().'backend');
        }
    }
	
    public function create()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            // Ambil data referensi kategori (pastikan tabel ref_kategori_berita ada isinya)
          $kategori = $this->db->query("SELECT * FROM ref_kategori_berita WHERE status='1' ORDER BY id_kategori DESC")->result();
            
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('ta_berita/create_action'),
                'id_berita' => set_value('id_berita'),
                'judul' => set_value('judul'),
                'konten' => set_value('konten'), 
                // Kita tetap pakai nama 'id_kategori' untuk view agar dropdown terbaca
                'id_kategori' => set_value('id_kategori'), 
                'file' => set_value('file'),
               
                'ref_kategori_berita' => $kategori,
            );
            $this->template->load('backend/template', 'backend/ta_berita/ta_berita_form', $data);
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

  public function create_action()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            $this->_rules(); 

            if ($this->form_validation->run() == FALSE) {
                $this->create(); 
            } else {
                
                // Ambil konten (FALSE agar HTML tidak hilang)
                $isi_konten = $this->input->post('konten', FALSE);
                
                // --- LOGIKA AMAN EKSTRAK GAMBAR ---
                $thumb_image = ''; // Default kosong
                
                // Cek apakah konten tidak kosong
                if (!empty($isi_konten)) {
                    // Gunakan Regex untuk mencari src gambar
                    // Menggunakan @ di depan preg_match untuk menahan warning jika string terlalu panjang
                    if (@preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $isi_konten, $image)) {
                        // Pastikan index 'src' benar-benar ada
                        if (isset($image['src'])) {
                            // Ambil hanya nama filenya (hilangkan path folder/url)
                            $thumb_image = basename($image['src']);
                        }
                    }
                }
                // ----------------------------------

                $data = array(
                    'judul' => $this->input->post('judul', TRUE),
                    'isi' => $isi_konten, 
                    'jenis_berita' => $this->input->post('id_kategori', TRUE),
                    'status' => '1',
                    'tgl_insert' => date("Y-m-d H:i:s"),
                    'user' => $this->session->userdata('nama'),
                    'dilihat' => 0,
                    'file' => $thumb_image // Simpan nama file (atau kosong jika tidak ada gambar)
                );

                // Debugging Jika Masih Error 500 (Hapus nanti)
                // echo "<pre>"; print_r($data); die();

                $this->Ta_berita_model->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Berita Berhasil Disimpan</div>');
                redirect(site_url('ta_berita'));
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function update_action()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_berita', TRUE));
            } else {
                
                $isi_konten = $this->input->post('konten', FALSE);

                // --- LOGIKA AMAN EKSTRAK GAMBAR ---
                $thumb_image = '';
                if (!empty($isi_konten)) {
                    if (@preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $isi_konten, $image)) {
                        if (isset($image['src'])) {
                            $thumb_image = basename($image['src']);
                        }
                    }
                }
                // ----------------------------------

                $data = array(
                    'judul' => $this->input->post('judul', TRUE),
                    'isi' => $isi_konten,
                    'jenis_berita' => $this->input->post('id_kategori', TRUE),
                    'status' => '1', 
                    'tgl_update' => date("Y-m-d H:i:s"),
                    'user' => $this->session->userdata('nama'),
                );

                // Hanya update kolom file jika ada gambar ditemukan di editor
                if ($thumb_image != '') {
                    $data['file'] = $thumb_image;
                }

                $this->Ta_berita_model->update($this->input->post('id_berita', TRUE), $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Berita Berhasil Diupdate</div>');
                redirect(site_url('ta_berita'));
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }
    public function update($id)
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $row = $this->Ta_berita_model->get_by_id($id);

            if ($row) {
               $kategori = $this->db->query("SELECT * FROM ref_kategori_berita WHERE status='1' ORDER BY id_kategori DESC")->result();
                $data = array(
                    'button' => 'Ubah',
                    'action' => site_url('ta_berita/update_action'),
                    'id_berita' => set_value('id_berita', $row->id_berita),
                    'judul' => set_value('judul', $row->judul),
                    'konten' => set_value('konten', $row->isi), 
                    
                    // PERBAIKAN DISINI: Ambil dari kolom 'jenis_berita'
                    'id_kategori' => set_value('id_kategori', $row->jenis_berita), 
                    
                    'file' => set_value('file', $row->file),
                   
                    'ref_kategori_berita' => $kategori,
                );
                $this->template->load('backend/template', 'backend/ta_berita/ta_berita_form', $data);
            } else {
                $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
                redirect(site_url('ta_berita'));
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

   

    public function delete($id)
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            $row = $this->Ta_berita_model->get_by_id($id);

            if ($row) {
                if ($row->file != "" && file_exists('./uploads/berita/' . $row->file)) {
                    unlink('./uploads/berita/' . $row->file);
                }

                $this->Ta_berita_model->delete($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Dihapus</div>');
                redirect(site_url('ta_berita'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('ta_berita'));
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('judul', 'Judul Berita', 'trim|required');
        $this->form_validation->set_rules('konten', 'Konten Berita', 'trim|required');
        // Rules tetap 'id_kategori' karena itu nama input di form
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'trim|required');
       

        $this->form_validation->set_rules('id_berita', 'id_berita', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

  public function upload_image()
    {
        // 1. Matikan Profiler & Aktifkan Error Reporting (Agar error muncul di response)
        // $this->output->enable_profiler(FALSE); // Uncomment jika perlu
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // 2. Pastikan Path Folder Benar (Gunakan FCPATH)
        $path_folder = FCPATH . 'uploads/berita_konten/';
        
        // Buat folder jika belum ada (Keamanan ganda)
        if (!is_dir($path_folder)) {
            mkdir($path_folder, 0777, TRUE);
        }

        // 3. Konfigurasi Upload
        $config['upload_path'] = $path_folder;
        $config['allowed_types'] = '*'; // Bebaskan dulu tipe file untuk tes
        $config['max_size'] = 5048; // 5MB
        $config['encrypt_name'] = TRUE; 

        // 4. PENTING: Gunakan initialize karena library sudah di-load di construct
        $this->upload->initialize($config);

        // 5. Proses Upload
        if ($this->upload->do_upload('file')) {
            $data = $this->upload->data();
            
            // Format Balikan JSON untuk TinyMCE
            $output = array(
                'location' => base_url() . 'uploads/berita_konten/' . $data['file_name']
            );
            
            header('Content-Type: application/json');
            echo json_encode($output);
        } else {
            // 6. Jika Gagal, Kirim Pesan Error Spesifik ke Browser
            header("HTTP/1.1 500 Server Error");
            
            // Ambil pesan error dari CI
            $error_msg = $this->upload->display_errors('', '');
            
            // Jika error kosong, cek permission manual
            if(empty($error_msg)){
                $error_msg = "Gagal upload. Cek Permission Folder: " . substr(sprintf('%o', fileperms($path_folder)), -4);
            }
            
            echo json_encode(array('error' => $error_msg));
        }
    }
}