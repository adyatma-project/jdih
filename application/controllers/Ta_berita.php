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
    }

    public function index()
    {
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
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
			$this->template->load('backend/template','backend/ta_berita/ta_berita_list', $data);
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
			$row = $this->Ta_berita_model->get_by_id($id);
			if ($row) {
				$data = array(
					'id_berita' => $row->id_berita,
					'judul' => $row->judul,
					'isi' => $row->isi,
					'jenis_berita' => $row->jenis_berita,
					'tgl_insert' => $row->tgl_insert,
					'tgl_update' => $row->tgl_update,
					'user' => $row->user,
					'viewer' => $row->viewer,
					'file' => $row->file,
				);
				$this->template->load('backend/template','backend/ta_berita/ta_berita_read', $data);
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
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$kategori = $this->db->query('SELECT * FROM ref_kategori_berita WHERE status=1')->result();
			$data = array(
				'button' => 'Simpan',
				'action' => site_url('ta_berita/create_action'),
				'id_berita' => set_value('id_berita'),
				'judul' => set_value('judul'),
				'isi' => set_value('isi'),
				'jenis_berita' => set_value('jenis_berita'),
				'file' => set_value('file'),
				'kategori' => $kategori,
			);
			$this->template->load('backend/template','backend/ta_berita/ta_berita_form', $data);
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
			$data ['judul'] = $this->input->post('judul',TRUE);
			$data ['isi'] = $this->input->post('isi',TRUE);
			$data ['jenis_berita'] = $this->input->post('jenis_berita',TRUE);
			$data ['tgl_insert'] = date("Y-m-d H:i:s");
			$data ['user'] = $this->session->userdata('nama');

				if(!empty($_FILES['file']['name']))
					{
						$acak=rand(00000000000,99999999999);
						$bersih=$_FILES['file']['name'];
						$nm=str_replace(" ","_","$bersih");
						$pisah=explode(".",$nm);
						$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1",$pisah[0]);
						$nama_murni=date('Ymd-His');
						$ekstensi_kotor = $pisah[1];
						
						$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
						$file_type_baru = strtolower($file_type);
						
						$ubah=$acak.'-'.$nama_murni; //tanpa ekstensi
						$n_baru = $ubah.'.'.$file_type_baru;
						
						$config['upload_path']	= "./uploads/berita/";
						$config['allowed_types']= 'gif|jpg|png|jpeg';
						$config['file_name'] = $n_baru;
						$config['max_size']     = '2500';
						// $config['max_width']  	= '3000';
						// $config['max_height']  	= '3000';
				 
						$this->load->library('upload', $config);
				 
						if ($this->upload->do_upload("file")) {
							$data_file	 	= $this->upload->data();
				 
							/* PATH */
							$source             = "./uploads/berita/".$data_file['file_name'] ;
							$destination_thumb	= "./uploads/berita/thumb/" ;
							$destination_medium	= "./uploads/berita/medium/" ;
				 
							// Permission Configuration
							chmod($source, 0777) ;
				 
							/* Resizing Processing */
							// Configuration Of Image Manipulation :: Static
							$this->load->library('image_lib') ;
							$img['image_library'] = 'GD2';
							$img['create_thumb']  = TRUE;
							$img['maintain_ratio']= TRUE;
				 
							/// Limit Width Resize
							$limit_medium   = 425 ;
							$limit_thumb    = 220 ;
				 
							// Size Image Limit was using (LIMIT TOP)
							$limit_use  = $data_file['image_width'] > $data_file['image_height'] ? $data_file['image_width'] : $data_file['image_height'] ;
				 
							// Percentase Resize
							if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
								$percent_medium = $limit_medium/$limit_use ;
								$percent_thumb  = $limit_thumb/$limit_use ;
							}
				 
							//// Making THUMBNAIL ///////
							$img['width']  = $limit_use > $limit_thumb ?  $data_file['image_width'] * $percent_thumb : $data_file['image_width'] ;
							$img['height'] = $limit_use > $limit_thumb ?  $data_file['image_height'] * $percent_thumb : $data_file['image_height'] ;
				 
							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%' ;
							$img['source_image'] = $source ;
							$img['new_image']    = $destination_thumb ;
				 
							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear() ;
				 
							////// Making MEDIUM /////////////
							$img['width']   = $limit_use > $limit_medium ?  $data_file['image_width'] * $percent_medium : $data_file['image_width'] ;
							$img['height']  = $limit_use > $limit_medium ?  $data_file['image_height'] * $percent_medium : $data_file['image_height'] ;
				 
							// Configuration Of Image Manipulation :: Dynamic
							$img['thumb_marker'] = '';
							$img['quality']      = '100%' ;
							$img['source_image'] = $source ;
							$img['new_image']    = $destination_medium ;
							
							$data['file'] = $data_file['file_name'];
				 
							// Do Resizing
							$this->image_lib->initialize($img);
							$this->image_lib->resize();
							$this->image_lib->clear() ;
						}
					}

				$this->Ta_berita_model->insert($data);
				$this->session->set_flashdata('message', 'Create Record Success');
				redirect(site_url('ta_berita'));
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
			$row = $this->Ta_berita_model->get_by_id($id);
			if ($row) {
				$kategori = $this->db->query('SELECT * FROM ref_kategori_berita WHERE status=1')->result();
				$data = array(
					'button' => 'Ubah',
					'action' => site_url('ta_berita/update_action'),
					'id_berita' => set_value('id_berita', $row->id_berita),
					'judul' => set_value('judul', $row->judul),
					'isi' => set_value('isi', $row->isi),
					'jenis_berita' => set_value('jenis_berita', $row->jenis_berita),
					'file' => set_value('file', $row->file),
					'kategori' => $kategori,
				);
				$this->template->load('backend/template','backend/ta_berita/ta_berita_form', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_berita'));
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
				$this->update($this->input->post('id_berita', TRUE));
			} else {
				$data = array(
					'judul' => $this->input->post('judul',TRUE),
					'isi' => $this->input->post('isi',TRUE),
					'jenis_berita' => $this->input->post('jenis_berita',TRUE),
					'tgl_update' => date("Y-m-d H:i:s"),
					'user' => $this->session->userdata('nama'),
				);
				$this->Ta_berita_model->update($this->input->post('id_berita', TRUE), $data);
				$this->session->set_flashdata('message', 'Update Record Success');
				redirect(site_url('ta_berita'));
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
			$row = $this->Ta_berita_model->get_by_id($id);
			if ($row) {
				$this->Ta_berita_model->delete($id);
				$this->session->set_flashdata('message', 'Delete Record Success');
				redirect(site_url('ta_berita'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_berita'));
			}
		}
		else
		{
			header('location:'.base_url().'backend');
		}
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	$this->form_validation->set_rules('isi', 'isi', 'trim|required');
	$this->form_validation->set_rules('jenis_berita', 'jenis berita', 'trim|required');

	$this->form_validation->set_rules('id_berita', 'id_berita', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ta_berita.php */
/* Location: ./application/controllers/Ta_berita.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-21 13:22:41 */
/* http://harviacode.com */