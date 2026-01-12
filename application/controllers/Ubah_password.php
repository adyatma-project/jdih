<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ubah_password extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ubah_password_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            $data = array(
                'action' => site_url('ubah_password/update_action'),
                'password_lama' => set_value('password_lama'),
                'password_baru' => set_value('password_baru'),
                'konfirmasi_password' => set_value('konfirmasi_password'),
            );
            $this->template->load('backend/template', 'backend/ubah_password/form_ubah_password', $data);
        } else {
            header('location:' . base_url() . 'backend');
        }
    }

    public function update_action()
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
            
            // Aturan Validasi
            $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
            $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[5]|matches[konfirmasi_password]');
            $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|trim');

            $this->form_validation->set_message('required', '{field} wajib diisi');
            $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
            $this->form_validation->set_message('matches', '{field} tidak sama dengan Password Baru');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $id_user = $this->session->userdata('id'); // Pastikan id_user tersimpan di session saat login
                $password_lama = $this->input->post('password_lama', TRUE);
                $password_baru = $this->input->post('password_baru', TRUE);

                // 1. Cek Password Lama
                $cek = $this->Ubah_password_model->cek_old_password($id_user, $password_lama);

                if ($cek) {
                    // 2. Jika Benar, Update Password
                    $this->Ubah_password_model->update_password($id_user, $password_baru);
                    
                    // Logout paksa agar login ulang (Opsional, lebih aman)
                    // $this->session->sess_destroy();
                    // redirect('backend');

                    $this->session->set_flashdata('message', '<div class="alert alert-success">Password Berhasil Diubah!</div>');
                    redirect(site_url('ubah_password'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Password Lama Salah!</div>');
                    redirect(site_url('ubah_password'));
                }
            }
        } else {
            header('location:' . base_url() . 'backend');
        }
    }
}