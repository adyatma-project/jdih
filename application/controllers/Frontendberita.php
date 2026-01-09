<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontendberita extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
		$this->load->model('Ta_berita_model');
        $this->load->library('form_validation');
        $this->load->helper('berita_helper');
    }
	public function index()
	{
		
		
		header('location:'.base_url().'');
	}
	public function berita_list()
	{
		$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));
			
			if ($q <> '') {
				$config['base_url'] = base_url() . 'frontendberita/berita_list?q=' . urlencode($q);
				$config['first_url'] = base_url() . 'frontendberita/berita_list?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . 'frontendberita/berita_list';
				$config['first_url'] = base_url() . 'frontendberita/berita_list';
			}

			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Ta_berita_model->total_rows($q);
			$ta_berita = $this->Ta_berita_model->get_limit_data($config['per_page'], $start, $q);

	        $ta_produk_hukum_populer = $this->db->query("SELECT * FROM ta_produk_hukum 
				LEFT JOIN ref_kategori ON
				ta_produk_hukum.id_kategori=ref_kategori.id_kategori
				ORDER BY dilihat DESC LIMIT 5")->result();

			$ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
	        $ref_status_peraturan = $this->db->query('select * from ref_status_peraturan')->result();
	        $link_terkait = $this->db->query('SELECT * FROM ta_link_terkait')->result();

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'ta_berita_data' => $ta_berita,
				'q' => $q,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
				'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
				'ref_kategori' => $ref_kategori,
				'ref_status_peraturan' => $ref_status_peraturan,
				'link_terkait'=> $link_terkait,
			);
		$this->template->load('frontend/template_public','frontend/berita_list', $data);
	}
	
	public function produk_hukum_page($id)
	{	
		$row = $this->Ta_produk_hukum_model->get_row($id);
		if ($row)
		{
			$data_perubahan = array(
						'dilihat' => ++$row->dilihat,
						);
						
			$this->Ta_produk_hukum_model->update_perubahan($id, $data_perubahan);
			$data = array(
				'id_produk_hukum' => $id,
				'no_peraturan' =>$row->no_peraturan,
				'tentang' => $row->tentang,
				'tahun' => $row->tahun,
				'kategori' => $row->kategori,
				'id_status_peraturan' => $row->id_status_peraturan,
				'nama_status_peraturan' => $row->nama_status_peraturan,
				'id_sumber_perubahan' => $row->id_sumber_perubahan,
				'file' => $row->file,
				'file_katalog' => $row->file_katalog,
				'abstrak' => $row->abstrak,
				'id_katalog' => $row->id_katalog,
				'nama_katalog' => $row->nama_katalog,
				'pengarang' => $row->pengarang,
				'tgl_peraturan' => $row->tgl_peraturan,
				'dilihat' => $row->dilihat,
				'didownload' => $row->didownload,
					);
			$this->template->load('frontend/template_public','frontend/produk_hukum_page', $data);
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
			redirect(site_url('Frontendberita'));
		}
	}
	public function download($id)
	{
		$row = $this->Ta_produk_hukum_model->get_row($id);
		if ($row)
		{
			$data_perubahan = array(
						'didownload' => ++$row->didownload,
						);
						
			$this->Ta_produk_hukum_model->update_perubahan($id, $data_perubahan);
			redirect(site_url("uploads/produk_hukum/$row->file"));
		}
	}
}