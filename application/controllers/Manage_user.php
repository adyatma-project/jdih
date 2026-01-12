<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_user extends CI_Controller {

    // Tambahkan Construct agar library diload di awal dan tidak error
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session', 'form_validation', 'pagination'));
        $this->load->helper(array('url', 'form'));

        // Cek Login di Construct agar lebih aman & ringkas
        if ($this->session->userdata('logged_in') == "" || $this->session->userdata('stts') != "administrator") {
            redirect('backend');
        }
    }

    public function index()
    {
        $d['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
        $d['judul_pendek']  = $this->config->item('nama_aplikasi_pendek');
        $d['instansi']      = $this->config->item('nama_instansi');
        $d['credit']        = $this->config->item('credit_aplikasi');
        $d['alamat']        = $this->config->item('alamat_instansi');
        
        $page = $this->uri->segment(3);
        $limit = $this->config->item('limit_data');
        
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        
        $d['tot'] = $offset;
        $tot_hal = $this->db->get("tbl_user_login");
        
        // Config Pagination
        $config['base_url'] = base_url() . 'manage_user/index/';
        $config['total_rows'] = $tot_hal->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        
        // Styling Pagination Bootstrap (Opsional biar rapi)
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $d["paginator"] = $this->pagination->create_links();
        
        $d['status_pegawai'] = $this->db->get("tbl_user_login", $limit, $offset);
        
        $this->template->load('backend/template', 'backend/user/list_user', $d);
    }

    public function edit()
    {
        $id['id_user_login'] = $this->uri->segment(3);
        $q = $this->db->get_where("tbl_user_login", $id);
        $d = array();
        
        foreach($q->result() as $dt) {
            $d['id_param'] = $dt->id_user_login;
            $d['username'] = $dt->username; 
            $d['password'] = $dt->password;
            $d['stts']     = $dt->stts; 
            $d['nama_lengkap'] = $dt->nama_lengkap; 
        }
        $d['st'] = "edit";
        
        $this->template->load('backend/template', 'backend/user/input', $d);
    }

    public function tambah()
    {
        $d['id_param'] = "";
        $d['username'] = ""; 
        $d['password'] = ""; 
        $d['nama_lengkap'] = ""; 
        $d['stts'] = ""; 
        $d['st'] = "tambah";
        
        $this->template->load('backend/template', 'backend/user/input', $d);
    }
    
    public function hapus()
    {
        $id['id_user_login'] = $this->uri->segment(3);
        $this->db->delete("tbl_user_login", $id);
        
        // Gunakan redirect(), bukan header()
        redirect('manage_user');
    }

    public function simpan()
    {
        // 1. Set Rules Validasi
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
        
        $st = $this->input->post('st');
        $id_param = $this->input->post("id_param");

        // Validasi Password hanya jika Tambah User atau Field Password diisi saat Edit
        if($st == "tambah" || $this->input->post('password') != "") {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('re_password', 'Ulangi Password', 'trim|required|matches[password]');
        }

        // 2. Cek Validasi
        if ($this->form_validation->run() == FALSE)
        {
            $d['id_param'] = $id_param;
            $d['username'] = $this->input->post("username"); 
            $d['password'] = ""; 
            $d['nama_lengkap'] = $this->input->post("nama_lengkap");
            $d['st'] = $st;
            $d['stts'] = 'administrator';

            $this->template->load('backend/template', 'backend/user/input', $d);
        }
        else
        {
            // 3. Siapkan Data
            $data_simpan = array(
                'username'      => $this->input->post("username"),
                'nama_lengkap'  => $this->input->post("nama_lengkap"),
                'stts'          => 'administrator'
            );

            // Cek Password (menggunakan Salt yang sama dengan sistem lama Anda)
            if($this->input->post("password") != "") {
                $data_simpan['password'] = md5($this->input->post("password").'jdihlutra@xxxaseww21%^&^$#');
            }

            // 4. Proses Simpan ke DB
            if($st == "edit")
            {
                $this->db->where('id_user_login', $id_param);
                $this->db->update("tbl_user_login", $data_simpan);
            }
            else if($st == "tambah")
            {
                // Cek duplikat username
                $cek = $this->db->get_where('tbl_user_login', array('username' => $this->input->post("username")));
                if($cek->num_rows() > 0) {
                    $this->session->set_flashdata('pass', '<div class="alert alert-danger">Username sudah digunakan!</div>');
                    redirect('manage_user/tambah'); // Redirect agar form bersih
                    return; // Stop eksekusi
                } else {
                    $this->db->insert("tbl_user_login", $data_simpan);
                }
            }

            // 5. PENTING: Gunakan redirect() CodeIgniter
            // Ini mencegah data POST terkirim ulang ke halaman login jika session drop
            redirect('manage_user');
        }
    }
}