<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_kabag extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_kabag_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            
            if ($q <> '') {
                $config['base_url'] = base_url() . 'ref_kabag?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'ref_kabag?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'ref_kabag';
                $config['first_url'] = base_url() . 'ref_kabag';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Ref_kabag_model->total_rows($q);
            $ref_kabag = $this->Ref_kabag_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
                'ref_kabag_data' => $ref_kabag,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
            );
            $this->template->load('backend/template','backend/ref_kabag/ref_kabag_list', $data);
        } else {
            header('location:'.base_url().'backend');
        }
    }

    public function create() 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('ref_kabag/create_action'),
                'id_kabag' => set_value('id_kabag'),
                'nama' => set_value('nama'),
                'nip' => set_value('nip'),
                'jabatan' => set_value('jabatan', 'Kepala Bagian Hukum'),
                'foto' => set_value('foto'),
                'status' => set_value('status', '1'),
                'urutan' => set_value('urutan', '0'),
            );
            $this->template->load('backend/template','backend/ref_kabag/ref_kabag_form', $data);
        } else {
            header('location:'.base_url().'backend');
        }
    }
    
    public function create_action() 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
                    'nama' => $this->input->post('nama',TRUE),
                    'nip' => $this->input->post('nip',TRUE),
                    'jabatan' => $this->input->post('jabatan',TRUE),
                    'status' => $this->input->post('status',TRUE),
                    'urutan' => $this->input->post('urutan',TRUE),
                    'tgl_input' => date('Y-m-d H:i:s'),
                );

                // Cek apakah ada file yang diupload
                if(!empty($_FILES['foto']['name'])) {
                    $nm = str_replace(" ","_",$_FILES['foto']['name']);
                    $n_baru = "Pejabat-".date('YmdHis')."-".$nm;
                    
                    // MENGGUNAKAN PATH ABSOLUT (FCPATH)
                    // Pastikan folder 'uploads/pejabat' SUDAH DIBUAT MANUAL
                    $config['upload_path']   = FCPATH . 'uploads/pejabat/'; 
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name']     = $n_baru;
                    $config['max_size']      = '5000'; // 5MB
             
                    $this->upload->initialize($config);
             
                    if ($this->upload->do_upload("foto")) {
                        $data_file = $this->upload->data();
                        $data['foto'] = $data_file['file_name'];
                        
                        $this->Ref_kabag_model->insert($data);
                        
                        // Set Flashdata untuk SweetAlert (SUKSES)
                        $this->session->set_flashdata('swal_icon', 'success');
                        $this->session->set_flashdata('swal_title', 'Berhasil!');
                        $this->session->set_flashdata('swal_text', 'Data Pejabat Berhasil Disimpan.');
                        
                        redirect(site_url('ref_kabag'));
                    } else {
                        // Gagal Upload
                        $error = $this->upload->display_errors();
                        
                        // Set Flashdata untuk SweetAlert (GAGAL)
                        $this->session->set_flashdata('swal_icon', 'error');
                        $this->session->set_flashdata('swal_title', 'Gagal Upload');
                        $this->session->set_flashdata('swal_text', strip_tags($error)); // strip_tags agar tag p hilang
                        
                        $this->create();
                    }
                } else {
                     // Jika foto kosong
                     $this->session->set_flashdata('swal_icon', 'warning');
                     $this->session->set_flashdata('swal_title', 'Perhatian');
                     $this->session->set_flashdata('swal_text', 'Foto wajib diupload!');
                     $this->create();
                }
            }
        } else {
            header('location:'.base_url().'backend');
        }
    }
    
    public function update($id) 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $row = $this->Ref_kabag_model->get_by_id($id);
            if ($row) {
                $data = array(
                    'button' => 'Ubah',
                    'action' => site_url('ref_kabag/update_action'),
                    'id_kabag' => set_value('id_kabag', $row->id_kabag),
                    'nama' => set_value('nama', $row->nama),
                    'nip' => set_value('nip', $row->nip),
                    'jabatan' => set_value('jabatan', $row->jabatan),
                    'foto' => set_value('foto', $row->foto),
                    'status' => set_value('status', $row->status),
                    'urutan' => set_value('urutan', $row->urutan),
                );
                $this->template->load('backend/template','backend/ref_kabag/ref_kabag_form', $data);
            } else {
                $this->session->set_flashdata('swal_icon', 'error');
                $this->session->set_flashdata('swal_title', 'Oops...');
                $this->session->set_flashdata('swal_text', 'Data tidak ditemukan');
                redirect(site_url('ref_kabag'));
            }
        } else {
            header('location:'.base_url().'backend');
        }
    }
    
    public function update_action() 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_kabag', TRUE));
            } else {
                $id = $this->input->post('id_kabag', TRUE);
                $data = array(
                    'nama' => $this->input->post('nama',TRUE),
                    'nip' => $this->input->post('nip',TRUE),
                    'jabatan' => $this->input->post('jabatan',TRUE),
                    'status' => $this->input->post('status',TRUE),
                    'urutan' => $this->input->post('urutan',TRUE),
                );

                if(!empty($_FILES['foto']['name']))
                {
                    $row = $this->Ref_kabag_model->get_by_id($id);
                    $config['upload_path']   = FCPATH . 'uploads/pejabat/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name']     = "Pejabat-".date('YmdHis')."-".str_replace(" ","_",$_FILES['foto']['name']);
                    $config['max_size']      = '5000';
             
                    $this->upload->initialize($config);
             
                    if ($this->upload->do_upload("foto")) {
                        // Hapus foto lama
                        if ($row->foto != "" && file_exists(FCPATH . 'uploads/pejabat/' . $row->foto)) {
                            @unlink(FCPATH . 'uploads/pejabat/' . $row->foto);
                        }

                        $data_file = $this->upload->data();
                        $data['foto'] = $data_file['file_name'];
                        
                        $this->Ref_kabag_model->update($id, $data);
                        $this->session->set_flashdata('swal_icon', 'success');
                        $this->session->set_flashdata('swal_title', 'Berhasil');
                        $this->session->set_flashdata('swal_text', 'Data Berhasil Diupdate');
                        redirect(site_url('ref_kabag'));
                    } else {
                        // Error upload saat update
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('swal_icon', 'error');
                        $this->session->set_flashdata('swal_title', 'Gagal Upload');
                        $this->session->set_flashdata('swal_text', strip_tags($error));
                        redirect(site_url('ref_kabag/update/'.$id));
                    }
                } else {
                    // Update tanpa ganti foto
                    $this->Ref_kabag_model->update($id, $data);
                    $this->session->set_flashdata('swal_icon', 'success');
                    $this->session->set_flashdata('swal_title', 'Berhasil');
                    $this->session->set_flashdata('swal_text', 'Data Berhasil Diupdate');
                    redirect(site_url('ref_kabag'));
                }
            }
        } else {
            header('location:'.base_url().'backend');
        }
    }
    
    public function delete($id) 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
        {
            $row = $this->Ref_kabag_model->get_by_id($id);
            if ($row) {
                if ($row->foto != "" && file_exists(FCPATH . 'uploads/pejabat/' . $row->foto)) {
                    @unlink(FCPATH . 'uploads/pejabat/' . $row->foto);
                }
                
                $this->Ref_kabag_model->delete($id);
                $this->session->set_flashdata('swal_icon', 'success');
                $this->session->set_flashdata('swal_title', 'Terhapus');
                $this->session->set_flashdata('swal_text', 'Data berhasil dihapus');
                redirect(site_url('ref_kabag'));
            } else {
                $this->session->set_flashdata('swal_icon', 'error');
                $this->session->set_flashdata('swal_title', 'Gagal');
                $this->session->set_flashdata('swal_text', 'Data tidak ditemukan');
                redirect(site_url('ref_kabag'));
            }
        } else {
            header('location:'.base_url().'backend');
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('id_kabag', 'id_kabag', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}