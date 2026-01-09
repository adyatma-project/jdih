<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontendprodukhukum extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Ta_produk_hukum_model');
		$this->load->model('Ta_katalog_model');
		$this->load->library('form_validation');
		$this->load->helper('statusperaturan_helper');
		$this->load->helper('tanggal_helper');
	}
	public function index()
	{


		header('location:' . base_url() . '');
	}
	public function produk_hukum_list()
	{
		$q = urldecode($this->input->get('q', TRUE));

		$start = intval($this->input->get('start'));

		$no_peraturan = $this->input->get('no_peraturan');
		$tentang = $this->input->get('tentang');
		$tahun = $this->input->get('tahun');
		$kategori = $this->input->get('ref_kategori');
		$status_peraturan = $this->input->get('ref_status_peraturan');

		if ($tahun <> '' or $no_peraturan <> '' or $tentang <> '' or $kategori <> '' or $status_peraturan <> '') {
			$config['base_url'] = base_url() . 'Frontendprodukhukum/produk_hukum_list?no_peraturan=' . urlencode($no_peraturan) . '&tentang=' . urlencode($tentang) . '&tahun=' . urlencode($tahun) . '&ref_kategori=' . urlencode($kategori) . '&ref_status_peraturan=' . urlencode($status_peraturan);
			$config['first_url'] = base_url() . 'Frontendprodukhukum/produk_hukum_list?no_peraturan=' . urlencode($no_peraturan) . '&tentang=' . urlencode($tentang) . '&tahun=' . urlencode($tahun) . '&ref_kategori=' . urlencode($kategori) . '&ref_status_peraturan=' . urlencode($status_peraturan);
		} else {
			$config['base_url'] = base_url() . 'Frontendprodukhukum/produk_hukum_list';
			$config['first_url'] = base_url() . 'Frontendprodukhukum/produk_hukum_list';
		}



		$config['per_page'] = 10;
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Ta_produk_hukum_model->total_rows_produk_hukum(
			$no_peraturan,
			$tentang,
			$tahun,
			$kategori,
			$status_peraturan
		);
		$ta_produk_hukum = $this->Ta_produk_hukum_model->get_data(
			$config['per_page'],
			$start,
			$q,
			$no_peraturan,
			$tentang,
			$tahun,
			$kategori,
			$status_peraturan
		);

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$ta_produk_hukum_populer = $this->db->query("SELECT * FROM ta_produk_hukum 
				LEFT JOIN ref_kategori ON
				ta_produk_hukum.id_kategori=ref_kategori.id_kategori
				WHERE ref_kategori.id_kategori IN (SELECT id_kategori FROM ref_kategori WHERE status !=0)
				ORDER BY dilihat DESC LIMIT 5")->result();

		$ref_kategori_notperbub = $this->db->get_where('ref_kategori', 'status=1 AND id_kategori<>2')->result();
		$ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
		$ref_status_peraturan = $this->db->query('select * from ref_status_peraturan WHERE status<>1')->result();


		$link_terkait = $this->db->query('SELECT * FROM ta_link_terkait')->result();
		$v_jum = $this->db->query('SELECT * FROM v_jum WHERE id_kategori IN (3,5) ORDER BY id_kategori ')->result();


		$data = array(
			'ta_produk_hukum_data' => $ta_produk_hukum,
			'q' => $q,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'ref_kategori' => $ref_kategori,
			'ref_kategori_notperbub' => $ref_kategori_notperbub,
			'ref_status_peraturan' => $ref_status_peraturan,
			'no_peraturan' => $no_peraturan,
			'tentang' => $tentang,
			'tahun' => $tahun,
			'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
			'kategori' => $kategori,
			'status_peraturan' => $status_peraturan,
			'start' => $start,
			'link_terkait' => $link_terkait,
			'v_jum' => $v_jum
		);
		$this->template->load('frontend/template_public', 'frontend/produk_hukum_list', $data);
	}

	public function produk_hukum_page($id)
	{
		$row = $this->Ta_produk_hukum_model->get_row($id);
		if ($row) {
			$data_perubahan = array(
				'dilihat' => ++$row->dilihat,
			);

			$this->Ta_produk_hukum_model->update_perubahan($id, $data_perubahan);

			$katalog = $this->db->query('SELECT * FROM ta_produk_hukum_katalog where id_produk_hukum=' . $id . '')->row();
			if ($katalog) {

				$ktlglembaran_jenis = $katalog->ktlglembaran_jenis;
				$ktlglembaran_tahun = $katalog->ktlglembaran_tahun;
				$ktlglembaran_no = $katalog->ktlglembaran_no;
				$ktlglembaran_jum_halaman = $katalog->ktlglembaran_jum_halaman;
				$ktlgtambahan_jenis = $katalog->ktlgtambahan_jenis;
				$ktlgtambahan_tahun =  $katalog->ktlgtambahan_tahun;
				$ktlgtambahan_no = $katalog->ktlgtambahan_no;
				$ktlgtambahan_jum_halaman = $katalog->ktlgtambahan_jum_halaman;
				$pemrakarsa = $katalog->pemrakarsa;
				$no_register = $katalog->no_register;
			} else {
				$ktlglembaran_jenis = "";
				$ktlglembaran_tahun = "";
				$ktlglembaran_no = "";
				$ktlglembaran_jum_halaman = "";
				$ktlgtambahan_jenis = "";
				$ktlgtambahan_tahun =  "";
				$ktlgtambahan_no = "";
				$ktlgtambahan_jum_halaman = "";
				$pemrakarsa = "";
				$no_register = "";
			}
			$ta_berita = $this->db->query('SELECT * FROM ta_berita ORDER BY tgl_insert DESC')->result();
			$ta_produk_hukum_populer = $this->db->query("SELECT * FROM ta_produk_hukum 
				LEFT JOIN ref_kategori ON
				ta_produk_hukum.id_kategori=ref_kategori.id_kategori
				ORDER BY dilihat DESC LIMIT 5")->result();

			$ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
			$ref_status_peraturan = $this->db->query('select * from ref_status_peraturan')->result();
			$link_terkait = $this->db->query('SELECT * FROM ta_link_terkait')->result();
			$v_jum = $this->db->query('SELECT * FROM v_jum WHERE id_kategori IN (3,5) ORDER BY id_kategori ')->result();
			$data = array(
				'id_produk_hukum' => $id,
				'no_peraturan' => $row->no_peraturan,
				'judul_peraturan' => $row->judul_peraturan,
				'tentang' => $row->tentang,
				'tahun' => $row->tahun,
				'tgl_peraturan' => $row->tgl_peraturan,
				'tempat_terbit' => $row->tempat_terbit,
				'kategori' => $row->kategori,
				'file' => $row->file,
				'file_lampiran' => $row->file_lampiran,
				'file_katalog' => $row->file_katalog,
				'abstrak' => $row->abstrak,
				'file_abstrak' => $row->file_abstrak,
				'id_katalog' => $row->id_katalog,
				'nama_katalog' => $row->nama_katalog,
				'id_pengarang' => $row->id_pengarang,
				'tgl_peraturan' => $row->tgl_peraturan,
				'dilihat' => $row->dilihat,
				'didownload' => $row->didownload,
				'keterangan_lainnya' => $row->keterangan_lainnya,
				'ktlglembaran_jenis' => set_value('ktlglembaran_jenis', $ktlglembaran_jenis),
				'ktlglembaran_tahun' => set_value('ktlglembaran_tahun', $ktlglembaran_tahun),
				'ktlglembaran_no' => set_value('ktlglembaran_no', $ktlglembaran_no),
				'ktlglembaran_jum_halaman' => set_value('ktlglembaran_jum_halaman', $ktlglembaran_jum_halaman),
				'ktlgtambahan_jenis' => set_value('ktlgtambahan_jenis', $ktlgtambahan_jenis),
				'ktlgtambahan_tahun' => set_value('ktlgtambahan_tahun', $ktlgtambahan_tahun),
				'ktlgtambahan_no' => set_value('ktlgtambahan_no', $ktlgtambahan_no),
				'ktlgtambahan_jum_halaman' => set_value('ktlgtambahan_jum_halaman', $ktlgtambahan_jum_halaman),
				'pemrakarsa' => set_value('pemrakarsa', $pemrakarsa),
				'no_register' => set_value('no_register', $no_register),
				'ta_berita' => $ta_berita,
				'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
				'ref_kategori' => $ref_kategori,
				'ref_status_peraturan' => $ref_status_peraturan,
				'link_terkait' => $link_terkait,
				'v_jum' => $v_jum

			);
			$this->template->load('frontend/template_public', 'frontend/produk_hukum_page', $data);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
			redirect(site_url('frontendprodukhukum'));
		}
	}
	public function download($id)
	{
		$row = $this->Ta_produk_hukum_model->get_row($id);
		if ($row) {
			$data_perubahan = array(
				'didownload' => ++$row->didownload,
			);

			$this->Ta_produk_hukum_model->update_perubahan($id, $data_perubahan);
			redirect(site_url("uploads/produk_hukum/$row->file"));
		}
	}
	public function katalog($id, $id_produk_hukum)
	{
		$row = $this->Ta_katalog_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id_katalog' => $row->id_katalog,
				'nama_katalog' => $row->nama_katalog,
				'tahun' => $row->tahun,
				'file' => $row->file,
				'id_produk_hukum' => $id_produk_hukum,
			);

			$this->template->load('frontend/template_public', 'frontend/katalog_read', $data);
		}
	}
}