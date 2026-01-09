<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_info_hukum extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_info_hukum_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			
			if ($q <> '') {
				$config['base_url'] = base_url() . 'ta_info_hukum?q=' . urlencode($q);
				$config['first_url'] = base_url() . 'ta_info_hukum?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . 'ta_info_hukum';
				$config['first_url'] = base_url() . 'ta_info_hukum';
			}

			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Ta_info_hukum_model->total_rows($q);
			$ta_info_hukum = $this->Ta_info_hukum_model->get_limit_data($config['per_page'], $start, $q);

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'ta_info_hukum_data' => $ta_info_hukum,
				'q' => $q,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
			);
			$this->template->load('backend/template','backend/ta_info_hukum/ta_info_hukum_list', $data);
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
			$row = $this->Ta_info_hukum_model->get_by_id($id);
			if ($row) {
				$data = array(
					'id_info_hukum' => $row->id_info_hukum,
					'no' => $row->no,
					'judul' => $row->judul,
					'id_kategori_info' => $row->id_kategori_info,
					'tgl' => $row->tgl,
					'tahun' => $row->tahun,
					'file' => $row->file,
					'dilihat' => $row->dilihat,
					'didownload' => $row->didownload,
				);
				$this->template->load('backend/template','backend/ta_info_hukum/ta_info_hukum_read', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_info_hukum'));
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
			$kategori=$this->db->query('SELECT * FROM ref_kategori_info where status=1 ')->result();
			$data = array(
				'button' => 'Create',
				'action' => site_url('ta_info_hukum/create_action'),
				'id_info_hukum' => set_value('id_info_hukum'),
				'no' => set_value('no'),
				'judul' => set_value('judul'),
				'deskripsi' => set_value('deskripsi'),
				'id_kategori_info' => set_value('id_kategori_info'),
				'tgl' => set_value('tgl'),
				'tahun' => set_value('tahun'),
				'file' => set_value('file'),
				'kategori' => $kategori,
				
			);
			$this->template->load('backend/template','backend/ta_info_hukum/ta_info_hukum_form', $data);
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
				$this->load->library('upload');
				$namafile = "Info-Hukum-".$this->input->post('id_kategori',TRUE)."-".time();

				$config = array(
						'upload_path' => "./uploads/info_hukum/", //mengatur lokasi penyimpanan gambar
						'allowed_types' => "pdf", // mengatur type yang boleh disimpan
						'overwrite' => TRUE,
						'max_size' => "5048000",//maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
						'file_name'	=> $namafile //nama file yang akan terimpan nanti 
					);
				$this->upload->initialize($config);
					if($this->upload->do_upload('file'))
					{
						$data_file =  $this->upload->data();
						$data['no']=$this->input->post('no',TRUE);
						$data['judul']=$this->input->post('judul',TRUE);
						$data['id_kategori_info']=$this->input->post('id_kategori_info',TRUE);
						$data['tgl']=$this->input->post('tgl',TRUE);
						$data['tahun']=$this->input->post('tahun',TRUE);
						$data['deskripsi']=$this->input->post('deskripsi',TRUE);
						$data['file'] = $data_file['file_name'];


						$this->Ta_info_hukum_model->insert($data);
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Berhasil Menambah Data.
						</div>');
						redirect(site_url('ta_info_hukum'));
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
			$row = $this->Ta_info_hukum_model->get_by_id($id);
			if ($row) {

					$kategori=$this->db->query('SELECT * FROM ref_kategori_info where status=1 ')->result();
					$data = array(
						'button' => 'Simpan',
						'action' => site_url('ta_info_hukum/update_action'),
						'id_info_hukum' => set_value('id_info_hukum', $row->id_info_hukum),
						'no' => set_value('no', $row->no),
						'judul' => set_value('judul', $row->judul),
						'deskripsi' => set_value('deskripsi', $row->deskripsi),
						'id_kategori_info' => set_value('id_kategori_info',$row->id_kategori_info),
						'tgl' => set_value('tgl',$row->tgl),
						'tahun' => set_value('tahun',$row->tahun),
						'file' => set_value('file',$row->file),
						'kategori' => $kategori,
				);
				$this->template->load('backend/template','backend/ta_info_hukum/ta_info_hukum_form', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_info_hukum'));
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
				$this->update($this->input->post('id_info_hukum', TRUE));
			} else {
				$id = $this->input->post('id_info_hukum', TRUE);
				$row = $this->Ta_info_hukum_model->get_by_id($id);
				if ($row){
					$data['no'] = $this->input->post('no',TRUE);
					$data['judul'] = $this->input->post('judul',TRUE);
					$data['id_kategori_info'] = $this->input->post('id_kategori_info',TRUE);
					$data['tgl'] = $this->input->post('tgl',TRUE);
					$data['tahun'] = $this->input->post('tahun',TRUE);
					$data['deskripsi'] = $this->input->post('deskripsi',TRUE);

					if (!empty($_FILES['file']['name']))
					{
						@unlink("./uploads/info_hukum/".$row->file);
						$this->load->library('upload');
						$namafile = "Info-Hukum-".$this->input->post('id_kategori',TRUE)."-".time();

						$config = array(
							'upload_path' => "./uploads/info_hukum/", //mengatur lokasi penyimpanan gambar
							'allowed_types' => "pdf", // mengatur type yang boleh disimpan
							'overwrite' => TRUE,
							'max_size' => "5048000",//maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
							'file_name'	=> $namafile //nama file yang akan terimpan nanti 
						);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file'))
						{
							$data_file =  $this->upload->data();
							$data['file'] = $data_file['file_name'];	
						}
					}					
				}

				$this->Ta_info_hukum_model->update($this->input->post('id_info_hukum', TRUE), $data);
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Berhasil Mengupdate Data.
				</div>');
				redirect(site_url('ta_info_hukum'));
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
			$row = $this->Ta_info_hukum_model->get_by_id($id);
			if ($row) {
				@unlink("./uploads/info_hukum/".$row->file);
				$this->Ta_info_hukum_model->delete($id);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Berhasil Menghapus Data.
					</div>');
				redirect(site_url('ta_info_hukum'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
					</div>');
				redirect(site_url('ta_info_hukum'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no', 'no', 'trim|required');
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	$this->form_validation->set_rules('id_kategori_info', 'kategori', 'trim|required');
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');

	$this->form_validation->set_rules('id_info_hukum', 'id_info_hukum', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ta_info_hukum.php */
/* Location: ./application/controllers/Ta_info_hukum.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-21 15:20:22 */
/* http://harviacode.com */