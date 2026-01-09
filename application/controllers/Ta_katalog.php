<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_katalog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_katalog_model');
		$this->load->model('Ta_produk_hukum_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			
			if ($q <> '') {
				$config['base_url'] = base_url() . 'ta_katalog?q=' . urlencode($q);
				$config['first_url'] = base_url() . 'ta_katalog?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . 'ta_katalog';
				$config['first_url'] = base_url() . 'ta_katalog';
			}

			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Ta_katalog_model->total_rows($q);
			$ta_katalog = $this->Ta_katalog_model->get_limit_data($config['per_page'], $start, $q);

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'ta_katalog_data' => $ta_katalog,
				'q' => $q,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
			);
			$this->template->load('backend/template','backend/ta_katalog/ta_katalog_list', $data);
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }

    public function read($id) 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{	
			$row = $this->Ta_katalog_model->get_by_id($id);
			if ($row) {
				$data = array(
			'id_katalog' => $row->id_katalog,
			'nama_katalog' => $row->nama_katalog,
			'tahun' => $row->tahun,
			'file' => $row->file,
			);
				
				$this->template->load('backend/template','backend/ta_katalog/ta_katalog_read', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_katalog'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }

    public function create() 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{	
			$data = array(
				'button' => 'Simpan',
				'action' => site_url('ta_katalog/create_action'),
				'id_katalog' => set_value('id_katalog'),
				'nama_katalog' => set_value('nama_katalog'),
				'tahun' => set_value('tahun'),
				'file' => set_value('file'),
			);
			$this->template->load('backend/template','backend/ta_katalog/ta_katalog_form', $data);
		}
		else
		{
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
					//berfungsi saat submit ditekan namun file kosong supaya tidak masuk ke database
				if (empty($_FILES['imgName']['name']))
				{
					$this->form_validation->set_rules('imgName', 'Document', 'required');
					redirect(site_url('ta_katalog'));
				}
				else
				{
					$this->load->library('upload');
					$namafile = "Katalog-".$this->input->post('nama_katalog',TRUE)."-".time();
					//konfigurasi ukuran dan type yang bisa di upload
					$config = array(
						'upload_path' => "./uploads/katalog/", //mengatur lokasi penyimpanan gambar
						'allowed_types' => "pdf", // mengatur type yang boleh disimpan
						'overwrite' => TRUE,
						'max_size' => "5048000",//maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
						'file_name'	=> $namafile //nama file yang akan terimpan nanti 
					);
					$this->upload->initialize($config);
					if($this->upload->do_upload('imgName'))
					{
						$gambar =  $this->upload->data();
						$data = array(
							'nama_katalog' => $this->input->post('nama_katalog',TRUE),
							'tahun' => $this->input->post('tahun',TRUE),
							'file' => $gambar['file_name'],
						);
						$this->Ta_katalog_model->insert($data);
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Berhasil Menambah Data.
						</div>');
						redirect(site_url('ta_katalog'));
					}
				
				}
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }
    
    public function update($id) 
    {
        if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$row = $this->Ta_katalog_model->get_by_id($id);

			if ($row) {
				$data = array(
					'button' => 'Update',
					'action' => site_url('ta_katalog/update_action'),
					'id_katalog' => set_value('id_katalog', $row->id_katalog),
					'nama_katalog' => set_value('nama_katalog', $row->nama_katalog),
					'tahun' => set_value('tahun', $row->tahun),
					'file' => set_value('file', $row->file),
				);
				
				$this->template->load('backend/template','backend/ta_katalog/ta_katalog_form', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_katalog'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }
    
    public function update_action() 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$this->_rules();

			if ($this->form_validation->run() == FALSE) {
				$this->update($this->input->post('id_katalog', TRUE));
			} else {
				if (empty($_FILES['imgName']['name']))
				{
					$data = array(
							'nama_katalog' => $this->input->post('nama_katalog',TRUE),
							'tahun' => $this->input->post('tahun',TRUE),
						);

						$this->Ta_katalog_model->update($this->input->post('id_katalog', TRUE), $data);
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Berhasil Mengupdate Data.
						</div>');
						redirect(site_url('ta_katalog'));
				}
				else
				{
					$id = $this->input->post('id_katalog', TRUE);
					$row = $this->Ta_katalog_model->get_by_id($id);
					@unlink("./uploads/produk_hukum/".$row->file);
					$this->load->library('upload');
					$namafile = "Katalog-".$this->input->post('nama_katalog',TRUE)."-".time();
					//konfigurasi ukuran dan type yang bisa di upload
					$config = array(
						'upload_path' => "./uploads/katalog/", //mengatur lokasi penyimpanan gambar
						'allowed_types' => "pdf", // mengatur type yang boleh disimpan
						'overwrite' => TRUE,
						'max_size' => "5048000",//maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
						'file_name'	=> $namafile //nama file yang akan terimpan nanti 
					);
					$this->upload->initialize($config);
					if($this->upload->do_upload('imgName'))
					{
						$gambar =  $this->upload->data();
						$data = array(
							'nama_katalog' => $this->input->post('nama_katalog',TRUE),
							'tahun' => $this->input->post('tahun',TRUE),
							'file' => $gambar['file_name'],
						);

						$this->Ta_katalog_model->update($this->input->post('id_katalog', TRUE), $data);
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Berhasil Mengupdate Data.
						</div>');
						redirect(site_url('ta_katalog'));
					}
				
				}
				
				
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }
    
    public function delete($id) 
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$row = $this->Ta_katalog_model->get_by_id($id);

			if ($row) {
				 $cek_produk_hukum = $this->db->get_where('ta_produk_hukum', array('id_katalog'=>$id))->row();
				 if($cek_produk_hukum)
				 {
					 $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Tidak dapat dihapus karena Katalog digunakan pada Peraturan yang ada.
					</div>');
					redirect(site_url('ta_katalog'));
				 }
				 else
				 { 
					@unlink("./uploads/katalog/".$row->file);
					$this->Ta_katalog_model->delete($id);
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Berhasil Menghapus Data.
					</div>');
					redirect(site_url('ta_katalog'));
				 }
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_katalog'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_katalog', 'nama katalog', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	

	$this->form_validation->set_rules('id_katalog', 'id_katalog', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ta_katalog.php */
/* Location: ./application/controllers/Ta_katalog.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-20 08:50:51 */
/* http://harviacode.com */