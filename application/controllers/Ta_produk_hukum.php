<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ta_produk_hukum extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Ta_produk_hukum_model', 'Ta_katalog_model', 'Ta_produk_hukum_det_model', 'Ta_produk_hukum_katalog_model'));
		$this->load->library('form_validation');
		$this->load->helper('statusperaturan_helper');
		$this->load->helper('tanggal_helper');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$q = urldecode($this->input->get('q', TRUE));
			$start = intval($this->input->get('start'));

			if ($q <> '') {
				$config['base_url'] = base_url() . 'ta_produk_hukum?q=' . urlencode($q);
				$config['first_url'] = base_url() . 'ta_produk_hukum?q=' . urlencode($q);
			} else {
				$config['base_url'] = base_url() . 'ta_produk_hukum';
				$config['first_url'] = base_url() . 'ta_produk_hukum';
			}

			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->Ta_produk_hukum_model->total_rows($q);
			$ta_produk_hukum = $this->Ta_produk_hukum_model->get_limit_data($config['per_page'], $start, $q);

			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$data = array(
				'ta_produk_hukum_data' => $ta_produk_hukum,
				'q' => $q,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
			);
			$this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_list', $data);
		} else {
			header('location:' . base_url() . 'backend');
		}
	}

	public function read($id)
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$row = $this->Ta_produk_hukum_model->get_row($id);
			if ($row) {
				$data = array(
					'id_produk_hukum' => $row->id_produk_hukum,
					'no_peraturan' => $row->no_peraturan,
					'tentang' => $row->tentang,
					'tahun' => $row->tahun,
					'id_pengarang' => $row->id_pengarang,
					'id_kategori' => $row->kategori,
					'id_status_peraturan' => "",
					'file' => $row->file,
					'abstrak' => $row->abstrak,
					'id_katalog' => $row->id_katalog,
					'tempat_terbit' => $row->tempat_terbit,
					'tgl_peraturan' => $row->tgl_peraturan,
					'dilihat' => $row->dilihat,
					'didownload' => $row->didownload,
				);

				$this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_read', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_produk_hukum'));
			}
		} else {
			header('location:' . base_url() . 'backend');
		}
	}

	public function create()
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$kategori = $this->db->query("SELECT * FROM ref_kategori WHERE status=1 ORDER BY id_kategori ASC")->result();
			$katalog = $this->db->query("SELECT * FROM ta_katalog ORDER BY id_katalog ASC")->result();
			$list_produk_hukum = $this->db->query("SELECT * FROM ta_produk_hukum LEFT JOIN ta_produk_hukum_det ON ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum where (ta_produk_hukum_det.id_status_peraturan=0) OR  (ta_produk_hukum_det.id_status_peraturan=1) OR (ta_produk_hukum_det.id_status_peraturan=3) OR (ta_produk_hukum_det.id_status_peraturan=4) OR (ta_produk_hukum_det.id_status_peraturan=5)  ORDER BY no_peraturan ASC")->result();
			$status_peraturan = $this->db->query("SELECT * FROM ref_status_peraturan WHERE status=1 ORDER BY id_status_peraturan ASC")->result();
			$pengarang = $this->db->query("SELECT * FROM ref_pengarang WHERE status=1")->result();
			$data = array(
				'button' => 'Simpan',
				'action' => site_url('ta_produk_hukum/create_action'),
				'id_produk_hukum' => set_value('id_produk_hukum'),
				'judul_peraturan' => "Peraturan Daerah",
				'no_peraturan' => set_value('no_peraturan'),
				'tentang' => set_value('tentang'),
				'tahun' => set_value('tahun'),
				'pengarang' => $pengarang,
				'id_kategori' => set_value('id_kategori'),
				'id_status_peraturan' => "-",
				'file' => set_value('file'),
				'file_lampiran' => set_value('file_lampiran'),
				'abstrak' => set_value('abstrak'),
				'file_abstrak' => set_value('file_abstrak'),
				'id_katalog' => set_value('id_katalog'),
				'tempat_terbit' => set_value('tempat_terbit'),
				'tgl_peraturan' => set_value('tgl_peraturan'),
				'dilihat' => set_value('dilihat'),
				'didownload' => set_value('didownload'),
				'kategori' => $kategori,
				'katalog' => $katalog,
				'status_peraturan' => $status_peraturan,
				'list_produk_hukum' => $list_produk_hukum,
				'disabled' => "",
				'keterangan_lainnya' => set_value('keterangan_lainnya'),
				'ktlglembaran_jenis' => set_value('ktlglembaran_jenis'),
				'ktlglembaran_tahun' => set_value('ktlglembaran_tahun'),
				'ktlglembaran_no' => set_value('ktlglembaran_no'),
				'ktlglembaran_jum_halaman' => set_value('ktlglembaran_jum_halaman'),
				'ktlgtambahan_jenis' => set_value('ktlgtambahan_jenis'),
				'ktlgtambahan_tahun' => set_value('ktlgtambahan_tahun'),
				'ktlgtambahan_no' => set_value('ktlgtambahan_no'),
				'ktlgtambahan_jum_halaman' => set_value('ktlgtambahan_jum_halaman'),
				'pemrakarsa' => set_value('pemrakarsa'),
				'no_register' => set_value('no_register'),
			);
			$this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_form', $data);
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

				//berfungsi saat submit ditekan namun file kosong supaya tidak masuk ke database

				$this->load->library('upload');
				$namafile = "Produk-Hukum-" . $this->input->post('no_peraturan', TRUE) . "-" . time();
				$namafile_bastrak = "Abstrak" . $this->input->post('no_peraturan', TRUE) . "-" . time();
				$namafile_lampiran = "Lampiran" . $this->input->post('no_peraturan', TRUE) . "-" . time();
				//konfigurasi ukuran dan type yang bisa di upload
				$config = array(
					'upload_path' => "./uploads/produk_hukum/", //mengatur lokasi penyimpanan gambar
					'allowed_types' => "pdf", // mengatur type yang boleh disimpan
					'overwrite' => TRUE,
					'max_size' => "50480000000000", //maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
					'file_name'	=> $namafile //nama file yang akan terimpan nanti 
				);
				$config_lampiran = array(
					'upload_path' => "./uploads/produk_hukum/", //mengatur lokasi penyimpanan gambar
					'allowed_types' => "pdf", // mengatur type yang boleh disimpan
					'overwrite' => TRUE,
					'max_size' => "50480000000000", //maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
					'file_name'	=> $namafile_lampiran //nama file yang akan terimpan nanti 
				);

				// $config_abstrak = array(
				// 	'upload_path' => "./uploads/abstrak/", //mengatur lokasi penyimpanan gambar
				// 	'allowed_types' => "pdf", // mengatur type yang boleh disimpan
				// 	'overwrite' => TRUE,
				// 	'max_size' => "50480000000000", //maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
				// 	'file_name'	=> $namafile_bastrak //nama file yang akan terimpan nanti 
				// );
				// $this->upload->initialize($config_abstrak);
				// if ($this->upload->do_upload('file_abstrak')) {
				// 	$data_abstrak =  $this->upload->data();
				// }

				$this->upload->initialize($config_lampiran);
				if ($this->upload->do_upload('file_lampiran')) {
					$data_lampiran =  $this->upload->data();
				}

				$this->upload->initialize($config);
				if ($this->upload->do_upload('imgName')) {
					$gambar =  $this->upload->data();
					$data = array(
						'no_peraturan' => $this->input->post('no_peraturan', TRUE),
						'judul_peraturan' => $this->input->post('judul_peraturan', TRUE),
						'tentang' => $this->input->post('tentang', TRUE),
						'tahun' => $this->input->post('tahun', TRUE),
						'id_pengarang' => $this->input->post('id_pengarang', TRUE),
						'id_kategori' => $this->input->post('id_kategori', TRUE),
						'file' => $gambar['file_name'],
						'file_lampiran' => $data_lampiran['file_name'],
						//'abstrak' => $this->input->post('abstrak', TRUE),
						'file_abstrak' => $data_abstrak['file_name'],
						'tempat_terbit' => $this->input->post('tempat_terbit', TRUE),
						'tgl_peraturan' => $this->input->post('tgl_peraturan', TRUE),
						'keterangan_lainnya' => $this->input->post('keterangan_lainnya', TRUE),
						'dilihat' => "0",
						'didownload' => "0",
					);


					$this->Ta_produk_hukum_model->insert($data);
					$insert_id = $this->db->insert_id();
					if ($this->input->post('id_status_peraturan', TRUE) == 0) {
						$data_perubahan = array(
							'id_produk_hukum' => $insert_id,
							'id_sumber_perubahan' => 0,
							'id_status_peraturan' => 0,
						);
						$this->Ta_produk_hukum_det_model->insert($data_perubahan);
					} else if ($this->input->post('id_status_peraturan', TRUE) == 7) {
						$data_perubahan = array(
							'id_produk_hukum' => $insert_id,
							'id_sumber_perubahan' => 0,
							'id_status_peraturan' => 7,
						);
						$this->Ta_produk_hukum_det_model->insert($data_perubahan);
					} else {
						$data_perubahan = array(
							'id_produk_hukum' => $insert_id,
							'id_sumber_perubahan' => 0,
							'id_status_peraturan' => 0,
						);
						$this->Ta_produk_hukum_det_model->insert($data_perubahan);

						$i = 0;
						$id_status_peraturan = $this->input->post('id_status_peraturan', TRUE);


						$data_subject_produk = explode("=>", $this->input->post('subject_produk'));
						$data_subject_status = explode("=>", $this->input->post('subject_status'));

						// $jml_data = count($data_cheklist);
						foreach ($data_subject_produk as $value) {
							$id_produk_hukum_subject = $value;
							$id_status_peraturan_subject = $data_subject_status[$i];
							$id_ubah = getubahstatus($id_status_peraturan_subject);
							$periksa = $this->Ta_produk_hukum_det_model->get_by_id($id_produk_hukum_subject);
							if ($periksa) {
								$data_perubahan = array(
									'id_sumber_perubahan' => $insert_id,
									'id_status_peraturan' => $id_ubah,
								);
								$this->Ta_produk_hukum_det_model->update_perubahan($id_produk_hukum_subject, $data_perubahan);
							} else {
								$data_perubahan = array(
									'id_produk_hukum' => $id_produk_hukum_subject,
									'id_sumber_perubahan' => $insert_id,
									'id_status_peraturan' => $id_ubah,
								);
								$this->Ta_produk_hukum_det_model->insert($data_perubahan);
							}

							$i++;
						}
					}

					$periksa_katalog = $this->Ta_produk_hukum_katalog_model->get_by_id($insert_id);
					if ($periksa_katalog) {
						$data = array(
							'ktlglembaran_jenis' => $this->input->post('ktlglembaran_jenis'),
							'ktlglembaran_tahun' => $this->input->post('ktlglembaran_tahun'),
							'ktlglembaran_no' => $this->input->post('ktlglembaran_no'),
							'ktlglembaran_jum_halaman' => $this->input->post('ktlglembaran_jum_halaman'),
							'ktlgtambahan_jenis' => $this->input->post('ktlgtambahan_jenis'),
							'ktlgtambahan_tahun' => $this->input->post('ktlgtambahan_tahun'),
							'ktlgtambahan_no' => $this->input->post('ktlgtambahan_no'),
							'ktlgtambahan_jum_halaman' => $this->input->post('ktlgtambahan_jum_halaman'),
							'pemrakarsa' => $this->input->post('pemrakarsa'),
							'no_register' => $this->input->post('no_register'),
						);

						$this->Ta_produk_hukum_katalog_model->update($insert_id, $data);
					} else {
						$data = array(
							'id_produk_hukum' => $insert_id,
							'ktlglembaran_jenis' => $this->input->post('ktlglembaran_jenis'),
							'ktlglembaran_tahun' => $this->input->post('ktlglembaran_tahun'),
							'ktlglembaran_no' => $this->input->post('ktlglembaran_no'),
							'ktlglembaran_jum_halaman' => $this->input->post('ktlglembaran_jum_halaman'),
							'ktlgtambahan_jenis' => $this->input->post('ktlgtambahan_jenis'),
							'ktlgtambahan_tahun' => $this->input->post('ktlgtambahan_tahun'),
							'ktlgtambahan_no' => $this->input->post('ktlgtambahan_no'),
							'ktlgtambahan_jum_halaman' => $this->input->post('ktlgtambahan_jum_halaman'),
							'pemrakarsa' => $this->input->post('pemrakarsa'),
							'no_register' => $this->input->post('no_register'),
						);

						$this->Ta_produk_hukum_katalog_model->insert($data);
					}



					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Berhasil Menambah Data
						</div>');
					redirect(site_url('ta_produk_hukum'));
				}
			}
		} else {
			header('location:' . base_url() . 'backend');
		}
	}

	public function update($id)
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$row = $this->Ta_produk_hukum_model->get_by_id($id);
			$kategori = $this->db->query("SELECT * FROM ref_kategori WHERE status=1 ORDER BY id_kategori ASC")->result();
			$katalog = $this->db->query("SELECT * FROM ta_katalog ORDER BY id_katalog ASC")->result();
			$list_produk_hukum = $this->db->query("SELECT * FROM ta_produk_hukum WHERE id_produk_hukum<>$id ORDER BY no_peraturan ASC")->result();
			$status_peraturan = $this->db->query("SELECT * FROM ref_status_peraturan ORDER BY nama_status_peraturan ASC")->result();
			$pengarang = $this->db->query("SELECT * FROM ref_pengarang WHERE status=1")->result();

			if ($row) {
				$id_produk_hukum_katalog = $row->id_produk_hukum;
				$katalog = $this->db->query('SELECT * FROM ta_produk_hukum_katalog where id_produk_hukum=' . $id_produk_hukum_katalog . '')->row();
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

				$data = array(
					'button' => 'Ubah',
					'action' => site_url('ta_produk_hukum/update_action'),
					'id_produk_hukum' => set_value('id_produk_hukum', $row->id_produk_hukum),
					'no_peraturan' => set_value('no_peraturan', $row->no_peraturan),
					'judul_peraturan' => set_value('judul_peraturan', "Peraturan Daerah"),
					'tentang' => set_value('tentang', $row->tentang),
					'tahun' => set_value('tahun', $row->tahun),
					'pengarang' => $pengarang,
					'id_pengarang' => set_value('id_pengarang', $row->id_pengarang),
					'id_kategori' => set_value('id_kategori', $row->id_kategori),
					'id_status_peraturan' => set_value('id_status_peraturan', $row->id_status_peraturan),
					'id_sumber_perubahan' => set_value('id_sumber_perubahan', $row->id_sumber_perubahan),
					'file' => set_value('file', $row->file),
					'file_lampiran' => set_value('file_lampiran', $row->file_lampiran),
					'abstrak' => set_value('abstrak', $row->abstrak),
					'file_abstrak' => set_value('file_abstrak', $row->file_abstrak),
					'id_katalog' => set_value('id_katalog', $row->id_katalog),
					'tempat_terbit' => set_value('tempat_terbit', $row->tempat_terbit),
					'tgl_peraturan' => set_value('tgl_peraturan', $row->tgl_peraturan),
					'disabled' => "disabled",
					'kategori' => $kategori,
					'katalog' => $katalog,
					'status_peraturan' => $status_peraturan,
					'list_produk_hukum' => $list_produk_hukum,
					'keterangan_lainnya' => set_value('keterangan_lainnya', $row->keterangan_lainnya),
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


				);
				$this->template->load('backend/template', 'backend/ta_produk_hukum/ta_produk_hukum_form', $data);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_produk_hukum'));
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
				$this->update($this->input->post('id_produk_hukum', TRUE));
			} else {
				$id = $this->input->post('id_produk_hukum', TRUE);
				$row = $this->Ta_produk_hukum_model->get_by_id($id);
				if (empty($_FILES['imgName']['name'])) {
					$data['no_peraturan'] = $this->input->post('no_peraturan', TRUE);
					$data['judul_peraturan'] = $this->input->post('judul_peraturan', TRUE);
					$data['tentang'] = $this->input->post('tentang', TRUE);
					$data['tahun'] = $this->input->post('tahun', TRUE);
					$data['id_kategori'] = $this->input->post('id_kategori', TRUE);
					$data['id_pengarang'] = $this->input->post('id_pengarang', TRUE);
					$data['abstrak'] = $this->input->post('abstrak', TRUE);
					$data['id_katalog'] = $this->input->post('id_katalog', TRUE);
					$data['tempat_terbit'] = $this->input->post('tempat_terbit', TRUE);
					$data['tgl_peraturan'] = $this->input->post('tgl_peraturan', TRUE);
					$data['keterangan_lainnya'] = $this->input->post('keterangan_lainnya', TRUE);

					if (!empty($_FILES['file_lampiran']['name'])) {
						@unlink("./uploads/produk_hukum/" . $row->file_lampiran);
						$this->load->library('upload');
						$namafile_lampiran = "Lampiran" . $this->input->post('no_peraturan', TRUE) . "-" . time();
						//konfigurasi ukuran dan type yang bisa di upload
						$config_lampiran = array(
							'upload_path' => "./uploads/produk_hukum/", //mengatur lokasi penyimpanan gambar
							'allowed_types' => "pdf", // mengatur type yang boleh disimpan
							'overwrite' => TRUE,
							'max_size' => "5048000", //maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
							'file_name'	=> $namafile_lampiran //nama file yang akan terimpan nanti 
						);
						$this->upload->initialize($config_lampiran);
						if ($this->upload->do_upload('file_lampiran')) {
							$data_lampiran =  $this->upload->data();
							$data['file_lampiran'] = $data_lampiran['file_name'];
						}
					}
					if (!empty($_FILES['file_abstrak']['name'])) {
						@unlink("./uploads/abstrak/" . $row->file_abstrak);
						$this->load->library('upload');
						$namafile_bastrak = "Abstrak-" . $this->input->post('no_peraturan', TRUE) . "-" . time();
						//konfigurasi ukuran dan type yang bisa di upload
						$config_abstrak = array(
							'upload_path' => "./uploads/abstrak/", //mengatur lokasi penyimpanan gambar
							'allowed_types' => "pdf", // mengatur type yang boleh disimpan
							'overwrite' => TRUE,
							'max_size' => "5048000", //maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
							'file_name'	=> $namafile_bastrak //nama file yang akan terimpan nanti 
						);
						$this->upload->initialize($config_abstrak);
						if ($this->upload->do_upload('file_abstrak')) {
							$data_abstrak =  $this->upload->data();
							$data['file_abstrak'] = $data_abstrak['file_name'];
						}
					}
					$this->Ta_produk_hukum_model->update($this->input->post('id_produk_hukum', TRUE), $data);

					$id_status_peraturan = $this->input->post('id_status_peraturan', TRUE);
					$id_ubah = getubahstatus($id_status_peraturan);

					$data_perubahan = array(
						'id_status_peraturan' => $id_ubah,
						'id_sumber_perubahan' => $this->db->insert_id(),
					);
					$this->Ta_produk_hukum_model->update_perubahan($this->input->post('id_sumber_perubahan', TRUE), $data_perubahan);

					$periksa_katalog = $this->Ta_produk_hukum_katalog_model->get_by_id($id);
					if ($periksa_katalog) {
						$data_katalog = array(
							'ktlglembaran_jenis' => $this->input->post('ktlglembaran_jenis'),
							'ktlglembaran_tahun' => $this->input->post('ktlglembaran_tahun'),
							'ktlglembaran_no' => $this->input->post('ktlglembaran_no'),
							'ktlglembaran_jum_halaman' => $this->input->post('ktlglembaran_jum_halaman'),
							'ktlgtambahan_jenis' => $this->input->post('ktlgtambahan_jenis'),
							'ktlgtambahan_tahun' => $this->input->post('ktlgtambahan_tahun'),
							'ktlgtambahan_no' => $this->input->post('ktlgtambahan_no'),
							'ktlgtambahan_jum_halaman' => $this->input->post('ktlgtambahan_jum_halaman'),
							'pemrakarsa' => $this->input->post('pemrakarsa'),
							'no_register' => $this->input->post('no_register'),
						);

						$this->Ta_produk_hukum_katalog_model->update($id, $data_katalog);
					} else {
						$data_katalog = array(
							'id_produk_hukum' => $id,
							'ktlglembaran_jenis' => $this->input->post('ktlglembaran_jenis'),
							'ktlglembaran_tahun' => $this->input->post('ktlglembaran_tahun'),
							'ktlglembaran_no' => $this->input->post('ktlglembaran_no'),
							'ktlglembaran_jum_halaman' => $this->input->post('ktlglembaran_jum_halaman'),
							'ktlgtambahan_jenis' => $this->input->post('ktlgtambahan_jenis'),
							'ktlgtambahan_tahun' => $this->input->post('ktlgtambahan_tahun'),
							'ktlgtambahan_no' => $this->input->post('ktlgtambahan_no'),
							'ktlgtambahan_jum_halaman' => $this->input->post('ktlgtambahan_jum_halaman'),
							'pemrakarsa' => $this->input->post('pemrakarsa'),
							'no_register' => $this->input->post('no_register'),
						);

						$this->Ta_produk_hukum_katalog_model->insert($data_katalog);
					}


					$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								Berhasil Mengupdate Data.
							</div>');
					redirect(site_url('ta_produk_hukum'));
				} else {

					@unlink("./uploads/produk_hukum/" . $row->file);
					$this->load->library('upload');
					$namafile = "Produk-Hukum-" . $this->input->post('no_peraturan', TRUE) . "-" . time();
					//konfigurasi ukuran dan type yang bisa di upload
					$config = array(
						'upload_path' => "./uploads/produk_hukum/", //mengatur lokasi penyimpanan gambar
						'allowed_types' => "pdf", // mengatur type yang boleh disimpan
						'overwrite' => TRUE,
						'max_size' => "5048000", //maksimal ukuran file yang bisa diupload, disini menggunankan 2MB
						'file_name'	=> $namafile //nama file yang akan terimpan nanti 
					);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('imgName')) {
						$gambar =  $this->upload->data();
						$data['no_peraturan'] = $this->input->post('no_peraturan', TRUE);
						$data['tentang'] = $this->input->post('tentang', TRUE);
						$data['tahun'] = $this->input->post('tahun', TRUE);
						$data['id_kategori'] = $this->input->post('id_kategori', TRUE);
						$data['file'] = $gambar['file_name'];
						$data['file_lampiran'] = $this->input->post('file_lampiran');
						$data['abstrak'] = $this->input->post('abstrak', TRUE);
						$data['id_katalog'] = $this->input->post('id_katalog', TRUE);
						$data['tempat_terbit'] = $this->input->post('tempat_terbit', TRUE);
						$data['tgl_peraturan'] = $this->input->post('tgl_peraturan', TRUE);

						$id_status_peraturan = $this->input->post('id_status_peraturan', TRUE);
						$id_ubah = getubahstatus($id_status_peraturan);

						$data_perubahan = array(
							'id_status_peraturan' => $id_ubah,
							'id_sumber_perubahan' => $this->db->insert_id(),
						);
						$this->Ta_produk_hukum_model->update_perubahan($this->input->post('id_sumber_perubahan', TRUE), $data_perubahan);


						$periksa_katalog = $this->Ta_produk_hukum_katalog_model->get_by_id($id);
						if ($periksa_katalog) {
							$data_katalog = array(
								'ktlglembaran_jenis' => $this->input->post('ktlglembaran_jenis'),
								'ktlglembaran_tahun' => $this->input->post('ktlglembaran_tahun'),
								'ktlglembaran_no' => $this->input->post('ktlglembaran_no'),
								'ktlglembaran_jum_halaman' => $this->input->post('ktlglembaran_jum_halaman'),
								'ktlgtambahan_jenis' => $this->input->post('ktlgtambahan_jenis'),
								'ktlgtambahan_tahun' => $this->input->post('ktlgtambahan_tahun'),
								'ktlgtambahan_no' => $this->input->post('ktlgtambahan_no'),
								'ktlgtambahan_jum_halaman' => $this->input->post('ktlgtambahan_jum_halaman'),
								'pemrakarsa' => $this->input->post('pemrakarsa'),
								'no_register' => $this->input->post('no_register'),
							);

							$this->Ta_produk_hukum_katalog_model->update($id, $data_katalog);
						} else {
							$data_katalog = array(
								'id_produk_hukum' => $insert_id,
								'ktlglembaran_jenis' => $this->input->post('ktlglembaran_jenis'),
								'ktlglembaran_tahun' => $this->input->post('ktlglembaran_tahun'),
								'ktlglembaran_no' => $this->input->post('ktlglembaran_no'),
								'ktlglembaran_jum_halaman' => $this->input->post('ktlglembaran_jum_halaman'),
								'ktlgtambahan_jenis' => $this->input->post('ktlgtambahan_jenis'),
								'ktlgtambahan_tahun' => $this->input->post('ktlgtambahan_tahun'),
								'ktlgtambahan_no' => $this->input->post('ktlgtambahan_no'),
								'ktlgtambahan_jum_halaman' => $this->input->post('ktlgtambahan_jum_halaman'),
								'pemrakarsa' => $this->input->post('pemrakarsa'),
								'no_register' => $this->input->post('no_register'),
							);

							$this->Ta_produk_hukum_katalog_model->insert($data_katalog);
						}
						$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								Berhasil Mengupdate Data.
							</div>');
						redirect(site_url('ta_produk_hukum'));
					}
				}
			}
		} else {
			header('location:' . base_url() . 'backend');
		}
	}

	public function delete1($id)
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$row = $this->Ta_produk_hukum_model->get_by_id($id);

			if ($row) {

				$cek_produk_hukum = $this->db->get_where('ta_produk_hukum', array('id_sumber_perubahan' => $id))->row();
				if ($cek_produk_hukum) {
					if ($cek_produk_hukum->id_status_peraturan == "1" || $cek_produk_hukum->id_status_peraturan == "3" || $cek_produk_hukum->id_status_peraturan == "5") {
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Tidak dapat dihapus karena digunakan sebagai Sumber pada Peraturan yang lain.
						</div>');
						redirect(site_url('ta_produk_hukum'));
					} else {
						if ($row->id_status_peraturan == "1" || $row->id_status_peraturan == "3" || $row->id_status_peraturan == "5") {
							$data_perubahan = array('id_status_peraturan' => "0");
							$this->Ta_produk_hukum_model->update_perubahan($row->id_sumber_perubahan, $data_perubahan);
						}

						@unlink("./uploads/produk_hukum/" . $row->file);
						$this->Ta_produk_hukum_model->delete($id);
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Berhasil Menghapus Data.
						</div>');
						redirect(site_url('ta_produk_hukum'));
					}
				} else {
					if ($row->id_status_peraturan == "1" || $row->id_status_peraturan == "3" || $row->id_status_peraturan == "5") {
						$data_perubahan = array('id_status_peraturan' => "0");
						$this->Ta_produk_hukum_model->update_perubahan($row->id_sumber_perubahan, $data_perubahan);
					}

					@unlink("./uploads/produk_hukum/" . $row->file);
					$this->Ta_produk_hukum_model->delete($id);
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Berhasil Menghapus Data.
						</div>');
					redirect(site_url('ta_produk_hukum'));
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_produk_hukum'));
			}
		} else {
			header('location:' . base_url() . 'backend');
		}
	}
	public function delete($id)
	{
		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('stts') == "administrator") {
			$row = $this->Ta_produk_hukum_model->get_by_id($id);
			if ($row) {

				$periksa_status = $this->Ta_produk_hukum_det_model->periksa_status($row->id_produk_hukum);
				if ($periksa_status->id_status_peraturan == '2' or $periksa_status->id_status_peraturan == '4' || $periksa_status->id_status_peraturan == '6') {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Tidak dapat dihapus karena digunakan sebagai Sumber pada Peraturan yang lain.
							</div>');
					redirect(site_url('ta_produk_hukum'));
				} else {
					@unlink("./uploads/produk_hukum/" . $row->file);
					$this->Ta_produk_hukum_model->delete($id);
					$this->Ta_produk_hukum_det_model->delete($id);

					$get_sumber = $this->db->query('SELECT * FROM ta_produk_hukum_det WHERE id_sumber_perubahan=' . $id . '')->result();
					foreach ($get_sumber as $value) {
						$id_produk_hukum = $value->id_produk_hukum;

						$data_perubahan = array(
							'id_sumber_perubahan' => 0,
							'id_status_peraturan' => 0,
						);
						$this->Ta_produk_hukum_det_model->update_perubahan($id_produk_hukum, $data_perubahan);
					}

					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Berhasil Menghapus Data.
						</div>');
					redirect(site_url('ta_produk_hukum'));
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Data Tidak Ditemukan.
				</div>');
				redirect(site_url('ta_produk_hukum'));
			}
		} else {
			header('location:' . base_url() . 'backend');
		}
	}

	public function getKatalog($id)
	{
		$katalog = $this->Ta_katalog_model->get_by_id($id);
		$url_file = base_url() . "Ta_katalog/read/" . $katalog->id_katalog;
		echo "
    	<table class='table table-bordered'>
    		<tr>
    			<td width='100px'>Nama Katalog</td>
				<td width='5px' align='center'>:</td>
    			<td>$katalog->nama_katalog</td
    		</tr>
    		<tr>
    			<td>Tahun</td>
    			<td width='5px' align='center'>:</td>
    			<td>$katalog->tahun</td
    		</tr>
    		<tr>
    			<td>File PDF</td>
    			<td width='5px' align='center'>:</td>
    			<td><a href='$url_file' target='_blank'> Lihat</a></td
    		</tr>
    	</table>

    	";
	}

	public function getSubjectProdukHukum1()
	{
		$id_sumber_perubahan = $_POST['id_sumber_perubahan'];
		$status_peraturan = $_POST['id_status_peraturan'];
		$subject_produk = $this->Ta_produk_hukum_model->get_by_id($id_sumber_perubahan);
		$status_peraturan = getstatusperubahan($status_peraturan);
		$exp_status_peraturan = (explode(".", $status_peraturan));
		if ($subject_produk) {
			echo "
    		<tr>
				<td><button type='button' class='btn btn-danger btn-xs' id='rem'
                onclick='
                
                var subject_produk1=$('#subject_produk').val();


                
                $(this).parent().parent().remove();


                '<i></i><i class='fa fa-trash'></i></button></td>
				<td>Nomor $subject_produk->no_peraturan Tahun $subject_produk->tahun $subject_produk->tentang</td>
    			<td>$exp_status_peraturan[1]</td>
    		</tr>

    	";
		} else {
			echo "
    		<tr>
				<td>Test</td>
    			<td>Test</td
    		</tr>
    	";
		}
	}

	public function getSubjectProdukHukum()
	{
		$id_sumber_perubahan = $_POST['id_sumber_perubahan'];
		$status_peraturan = $_POST['id_status_peraturan'];
		$subject_produk = $this->Ta_produk_hukum_model->get_by_id($id_sumber_perubahan);
		$status_peraturan = getstatusperubahan($status_peraturan);
		$exp_status_peraturan = (explode(".", $status_peraturan));
		if ($subject_produk) {
			$data = array(
				'peraturan' => 'Nomor ' . $subject_produk->no_peraturan . ' Tahun ' . $subject_produk->tahun . ' ' . $subject_produk->tentang,
				'exp_status_peraturan' => $exp_status_peraturan[1],
				'id_produk_hukum' => $id_sumber_perubahan,
			);
			$this->load->view('backend/ta_produk_hukum/subject_produk_hukum', $data);
		} else {
			echo "
    		<tr>
				<td>Test</td>
    			<td>Test</td
    		</tr>
    	";
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('no_peraturan', 'no peraturan', 'trim|required');
		$this->form_validation->set_rules('tentang', 'tentang', 'trim|required');
		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
		//$this->form_validation->set_rules('id_status_peraturan', 'id status peraturan', 'trim|required');
		//$this->form_validation->set_rules('id_sumber_perubahan', 'id sumber perubahan', 'trim|required');
		if (
			$this->input->post('id_status_peraturan') == "1"
			|| $this->input->post('id_status_peraturan') == "3" || $this->input->post('id_status_peraturan') == "4" || $this->input->post('id_status_peraturan') == "5"
		) {
			$this->form_validation->set_rules('id_sumber_perubahan', 'id sumber perubahan', 'trim|required');
		}
		// if (empty($_FILES['imgName']['name']))
		// {
		// 	$this->form_validation->set_rules('imgName', 'Document Produk Hukum', 'required');
		// }
		// if (empty($_FILES['file_abstrak']['name']))
		// {
		// 	$this->form_validation->set_rules('file_abstrak', 'Document Abstrak', 'required');
		// }

		$this->form_validation->set_rules('abstrak', 'abstrak', 'trim|required');
		$this->form_validation->set_rules('tempat_terbit', 'tempat_terbit', 'trim|required');
		$this->form_validation->set_rules('tgl_peraturan', 'tgl peraturan', 'trim|required');

		$this->form_validation->set_rules('id_produk_hukum', 'id_produk_hukum', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "ta_produk_hukum.xls";
		$judul = "ta_produk_hukum";
		$tablehead = 0;
		$tablebody = 1;
		$nourut = 1;
		//penulisan header
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=" . $namaFile . "");
		header("Content-Transfer-Encoding: binary ");

		xlsBOF();

		$kolomhead = 0;
		xlsWriteLabel($tablehead, $kolomhead++, "No");
		xlsWriteLabel($tablehead, $kolomhead++, "No Peraturan");
		xlsWriteLabel($tablehead, $kolomhead++, "Tentang");
		xlsWriteLabel($tablehead, $kolomhead++, "Tahun");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Kategori");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Status Peraturan");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Sumber Perubahan");
		xlsWriteLabel($tablehead, $kolomhead++, "File");
		xlsWriteLabel($tablehead, $kolomhead++, "Abstrak");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Katalog");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Uji Material");
		xlsWriteLabel($tablehead, $kolomhead++, "Tgl Peraturan");
		xlsWriteLabel($tablehead, $kolomhead++, "Dilihat");
		xlsWriteLabel($tablehead, $kolomhead++, "Didownload");

		foreach ($this->Ta_produk_hukum_model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_peraturan);
			xlsWriteLabel($tablebody, $kolombody++, $data->tentang);
			xlsWriteNumber($tablebody, $kolombody++, $data->tahun);
			xlsWriteNumber($tablebody, $kolombody++, $data->id_kategori);
			xlsWriteNumber($tablebody, $kolombody++, $data->id_status_peraturan);
			xlsWriteNumber($tablebody, $kolombody++, $data->id_sumber_perubahan);
			xlsWriteLabel($tablebody, $kolombody++, $data->file);
			xlsWriteLabel($tablebody, $kolombody++, $data->abstrak);
			xlsWriteNumber($tablebody, $kolombody++, $data->id_katalog);
			xlsWriteNumber($tablebody, $kolombody++, $data->tempat_terbit);
			xlsWriteLabel($tablebody, $kolombody++, $data->tgl_peraturan);
			xlsWriteNumber($tablebody, $kolombody++, $data->dilihat);
			xlsWriteNumber($tablebody, $kolombody++, $data->didownload);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}
}

/* End of file Ta_produk_hukum.php */
/* Location: ./application/controllers/Ta_produk_hukum.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-19 19:31:44 */
/* http://harviacode.com */