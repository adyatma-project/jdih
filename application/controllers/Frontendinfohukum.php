<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontendinfohukum extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
		$this->load->model('Ta_info_hukum_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		
		
		header('location:'.base_url().'');
	}
	public function info_hukum_list()
	{
		$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));

			$nomor = $this->input->get('nomor');
			$tahun=$this->input->get('tahun');
			$tentang=$this->input->get('tentang');
			$id_kategori_info=$this->input->get('id_kategori_info');
			
			
			if ($nomor <> '' OR $tahun<>'' OR $tentang<>'' OR $id_kategori_info<>'') {
				$config['base_url'] = base_url() . 'Frontendprodukhukum/produk_hukum_list?nomor=' . urldecode($nomor).'&tahun='.urldecode($tahun).'&tentang='.urldecode($tentang).'&id_kategori_info='.urldecode($id_kategori_info);
				$config['first_url'] = base_url() . 'Frontendprodukhukum/produk_hukum_list?nomor=' . urldecode($nomor).'&tahun='.urldecode($tahun).'&tentang='.urldecode($tentang).'&id_kategori_info='.urldecode($id_kategori_info);
			} else {
				$config['base_url'] = base_url() . 'Frontendinfohukum/info_hukum_list';
				$config['first_url'] = base_url() . 'Frontendinfohukum/info_hukum_list';
			}
			
			

			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Ta_info_hukum_model->total_rows_info_hukum($nomor,
			$tahun, $tentang, $id_kategori_info);
			$ta_info_hukum = $this->Ta_info_hukum_model->get_data($config['per_page'], $start, $nomor, $tahun, $tentang, $id_kategori_info);

			$this->load->library('pagination');
			$this->pagination->initialize($config);
			
			$ref_kategori = $this->db->get_where('ref_kategori_info', 'status=1')->result();
			$data = array(
				'ta_info_hukum_data' => $ta_info_hukum,
				'q' => $q,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'ref_kategori' => $ref_kategori,
				'nomor' => $nomor,
				'tentang' => $tentang,
				'tahun' => $tahun,
				'id_kategori_info' => $id_kategori_info,
				'start' => $start,
			);
		$this->template->load('frontend/template_public','frontend/info_hukum_list', $data);
	}
	
	public function info_hukum_page($id)
	{	
		$row = $this->Ta_info_hukum_model->get_row($id);
		if ($row)
		{
			$data_perubahan = array(
						'dilihat' => ++$row->dilihat,
						);
						
			$this->Ta_info_hukum_model->update_perubahan($id, $data_perubahan);
			$ta_berita = $this->db->query('SELECT * FROM ta_berita ORDER BY tgl_insert DESC')->result();
	        $ta_produk_hukum_populer = $this->db->query("SELECT * FROM ta_produk_hukum 
				LEFT JOIN ref_kategori ON
				ta_produk_hukum.id_kategori=ref_kategori.id_kategori
				ORDER BY dilihat DESC LIMIT 5")->result();

			$ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
	        $ref_status_peraturan = $this->db->query('select * from ref_status_peraturan')->result();
	        $link_terkait = $this->db->query('SELECT * FROM ta_link_terkait')->result();
			$data = array(
				'id_info_hukum' => $id,
				'no' =>$row->no,
				'judul' => $row->judul,
				'deskripsi' => $row->deskripsi,
				'tahun' => $row->tahun,
				'kategori' => $row->kategori,
				'file' => $row->file,
				'tgl' => $row->tgl,
				'dilihat' => $row->dilihat,
				'didownload' => $row->didownload,
				'ta_berita' => $ta_berita,
				'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
				'ref_kategori' => $ref_kategori,
				'ref_status_peraturan' => $ref_status_peraturan,
				'link_terkait'=> $link_terkait,
			);
			$this->template->load('frontend/template_public','frontend/info_hukum_page', $data);
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
			redirect(site_url('Frontendinfohukum'));
		}
	}
	public function download($id)
	{
		$row = $this->Ta_info_hukum_model->get_row($id);
		if ($row)
		{
			$data_perubahan = array(
						'didownload' => ++$row->didownload,
						);
						
			$this->Ta_info_hukum_model->update_perubahan($id, $data_perubahan);
			redirect(site_url("uploads/info_hukum/$row->file"));
		}
	}
}