<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ta_produk_hukum_model extends CI_Model
{

	public $table = 'ta_produk_hukum';
	public $id = 'id_produk_hukum';
	public $order = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	// get all
	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result();
	}

	// get data by id
	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	// get total rows
	function total_rows($q = NULL)
	{
		$this->db->like('id_produk_hukum', $q);
		$this->db->or_like('no_peraturan', $q);
		$this->db->or_like('tentang', $q);
		$this->db->or_like('tahun', $q);
		$this->db->or_like('id_kategori', $q);
		$this->db->or_like('file', $q);
		$this->db->or_like('abstrak', $q);
		$this->db->or_like('id_katalog', $q);
		$this->db->or_like('tempat_terbit', $q);
		$this->db->or_like('tgl_peraturan', $q);
		$this->db->or_like('dilihat', $q);
		$this->db->or_like('didownload', $q);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	function total_rows_produk_hukum(
		$no_peraturan = NULL,
		$tentang = NULL,
		$tahun = NULL,
		$kategori = NULL,
		$status_peraturan = NULL
	) {
		$this->db->select('ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ta_produk_hukum.tentang, 
							ta_produk_hukum.tahun, ta_produk_hukum.id_kategori, ta_produk_hukum_det.id_status_peraturan, 
							ta_produk_hukum_det.id_sumber_perubahan, ta_produk_hukum.file, ta_produk_hukum.abstrak, 
							ta_produk_hukum.id_katalog, ta_produk_hukum.tempat_terbit, ta_produk_hukum.tgl_peraturan, 
							ta_produk_hukum.dilihat, ta_produk_hukum.didownload,
							ref_kategori.kategori,
							ref_status_peraturan.nama_status_peraturan
					');


		$this->db->join('ta_produk_hukum_det', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum', 'left');
		$this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
		$this->db->join('ref_status_peraturan', 'ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan', 'left');
		if ($no_peraturan == '' or $no_peraturan == NULL) {
			$no_peraturan = "%%";
			//$this->db->where('ta_produk_hukum.no_peraturan', (int) $no_peraturan);
		}
		if ($tahun == '' or $tahun == NULL) {
			//$this->db->where('ta_produk_hukum.tahun', $tahun);
			$tahun = "%";
		}

		if ($kategori == '' or $kategori == NULL) {
			$kategori = "%%";
			//$this->db->where('ta_produk_hukum.id_kategori', $kategori);
		}




		// if ($tentang == '' or $tentang == NULL) {
		// 	$tentang = "%%";
		// 	//$this->db->where('ta_produk_hukum.tentang LIKE "%' . $tentang . '%"');
		// 	// $this->db->like('ta_produk_hukum.tentang', $tentang);
		// 	// $this->db->or_like('ta_produk_hukum.tentang', $tentang, 'before');
		// 	// $this->db->or_like('ta_produk_hukum.tentang', $tentang, 'after');
		// }

		switch ($status_peraturan) {
			case '0':
				$this->db->where('
				ta_produk_hukum.id_produk_hukum IN
					(
						SELECT id_produk_hukum FROM ta_produk_hukum_det
						WHERE id_status_peraturan = 0 
							AND (id_produk_hukum NOT IN 
							(
								SELECT id_produk_hukum
								FROM ta_produk_hukum_det WHERE id_status_peraturan IN (1,2,3,4,5,6)
							))
						GROUP BY id_produk_hukum
					)
				');
				break;

			case '2':

				$this->db->where('
				ta_produk_hukum.id_produk_hukum IN
					(
						SELECT id_produk_hukum FROM ta_produk_hukum_det
						WHERE id_status_peraturan = 2 
						GROUP BY id_produk_hukum
					)
				');

				break;

			case '4':

				$this->db->where('
				ta_produk_hukum.id_produk_hukum IN
					(
						SELECT id_produk_hukum FROM ta_produk_hukum_det
						WHERE id_status_peraturan = 4 
							AND (id_produk_hukum NOT IN 
							(
								SELECT id_produk_hukum
								FROM ta_produk_hukum_det WHERE id_status_peraturan IN (0,1,2,3,5,6)
							))
						GROUP BY id_produk_hukum
					)
				');
				break;

			case '6':

				$this->db->where('
				ta_produk_hukum.id_produk_hukum IN
					(
						SELECT id_produk_hukum FROM ta_produk_hukum_det
						WHERE id_status_peraturan = 6 
						GROUP BY id_produk_hukum
					)
				');

				break;
		}

		$where_tentang = "";

		//membuat variabel $kata_kunci_split untuk memecah kata kunci setiap ada spasi
		$kata_kunci_split = preg_split('/[\s]+/', $tentang);
		//menghitung jumlah kata kunci dari split di atas
		$total_kata_kunci = count($kata_kunci_split);

		//melakukan perulangan sebanyak kata kunci yang di masukkan
		foreach ($kata_kunci_split as $key => $kunci) {
			//set variabel $where untuk query nanti
			$where_tentang .= "ta_produk_hukum.tentang LIKE '%$kunci%'";
			//jika kata kunci lebih dari 1 (2 dan seterusnya) maka di tambahkan OR di perulangannya
			if ($key != ($total_kata_kunci - 1)) {
				$where_tentang .= " OR ";
			}
		}

		$this->db->where('(ta_produk_hukum.id_kategori LIKE "' . $kategori . '")
		AND (ta_produk_hukum.tahun LIKE "' . $tahun . '") 
		AND (ta_produk_hukum.no_peraturan LIKE "' . $no_peraturan . '")
		AND (' . $where_tentang . ')
		');

		//$this->db->where($or_like);
		$this->db->from($this->table);
		$this->db->group_by('ta_produk_hukum_det.id_produk_hukum');
		return $this->db->count_all_results();
	}

	// get data with limit and search
	function get_limit_data($limit, $start = 0, $q = NULL)
	{
		$this->db->select('ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ta_produk_hukum.tentang, 
							ta_produk_hukum.tahun, ta_produk_hukum.id_kategori,
							ta_produk_hukum.file, ta_produk_hukum.abstrak, 
							ta_produk_hukum.id_katalog, ta_produk_hukum.tempat_terbit, ta_produk_hukum.tgl_peraturan, 
							ta_produk_hukum.dilihat, ta_produk_hukum.didownload,
							ref_kategori.kategori,
							
					');
		$where = '(ta_produk_hukum.tentang LIKE "%' . $q . '%"
					AND ta_produk_hukum.id_kategori IN(SELECT id_kategori FROM ref_kategori WHERE status !=0)
					)';
		$this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
		$this->db->where($where);
		//$this->db->where('ta_produk_hukum.id_kategori IN(SELECT id_kategori FROM ref_kategori WHERE status !=0)');
		$this->db->limit($limit, $start);
		// $this->db->order_by('ta_produk_hukum.tgl_peraturan', "DESC");
		$this->db->order_by("ta_produk_hukum.tgl_peraturan DESC, ta_produk_hukum.no_peraturan DESC");
		return $this->db->get($this->table)->result();
	}

	function get_data(
		$limit,
		$start = 0,
		$q = NULL,
		$no_peraturan = NULL,
		$tentang = NULL,
		$tahun = NULL,
		$kategori = NULL,
		$status_peraturan = NULL
	) {
		$this->db->select('ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ta_produk_hukum.tentang, 
							ta_produk_hukum.tahun, ta_produk_hukum.id_kategori, ta_produk_hukum_katalog.pemrakarsa,
							ta_produk_hukum_katalog.no_register, ta_produk_hukum.file, ta_produk_hukum.abstrak, 
							ta_produk_hukum.id_katalog, ta_produk_hukum.tempat_terbit, ta_produk_hukum.tgl_peraturan, 
							ta_produk_hukum.dilihat, ta_produk_hukum.didownload,
							ref_kategori.kategori,
							ref_status_peraturan.nama_status_peraturan, keterangan_lainnya,
							COUNT(ta_produk_hukum.id_produk_hukum) AS Jum
							 
					');

		$this->db->join('ta_produk_hukum_det', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum', 'left');
		$this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');
		$this->db->join('ta_produk_hukum_katalog', 'ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum', 'left');
		$this->db->join('ref_status_peraturan', 'ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan', 'left');
		if ($no_peraturan == '' or $no_peraturan == NULL) {
			$no_peraturan = "%%";
			//$this->db->where('ta_produk_hukum.no_peraturan', (int) $no_peraturan);
		}
		if ($tahun == '' or $tahun == NULL) {
			//$this->db->where('ta_produk_hukum.tahun', $tahun);
			$tahun = "%%";
		}

		if ($kategori == '' or $kategori == NULL) {
			$kategori = "%%";
			//$this->db->where('ta_produk_hukum.id_kategori', $kategori);
		}



		switch ($status_peraturan) {
			case '0':
				$this->db->where('
				ta_produk_hukum.id_produk_hukum IN
					(
						SELECT id_produk_hukum FROM ta_produk_hukum_det
						WHERE id_status_peraturan = 0 
							AND (id_produk_hukum NOT IN 
							(
								SELECT id_produk_hukum
								FROM ta_produk_hukum_det WHERE id_status_peraturan IN (1,2,3,4,5,6)
							))
						GROUP BY id_produk_hukum
					)
				');
				break;

			case '2':

				$this->db->where('
				ta_produk_hukum.id_produk_hukum IN
					(
						SELECT id_produk_hukum FROM ta_produk_hukum_det
						WHERE id_status_peraturan = 2 
						GROUP BY id_produk_hukum
					)
				');

				break;

			case '4':

				$this->db->where('
				ta_produk_hukum.id_produk_hukum IN
					(
						SELECT id_produk_hukum FROM ta_produk_hukum_det
						WHERE id_status_peraturan = 4 
							AND (id_produk_hukum NOT IN 
							(
								SELECT id_produk_hukum
								FROM ta_produk_hukum_det WHERE id_status_peraturan IN (0,1,2,3,5,6)
							))
						GROUP BY id_produk_hukum
					)
				');
				break;

			case '6':

				$this->db->where('
				ta_produk_hukum.id_produk_hukum IN
					(
						SELECT id_produk_hukum FROM ta_produk_hukum_det
						WHERE id_status_peraturan = 6 
						GROUP BY id_produk_hukum
					)
				');

				break;
		}

		$where_tentang = "";
		$where_tentang_and = "";

		//membuat variabel $kata_kunci_split untuk memecah kata kunci setiap ada spasi
		$kata_kunci_split = preg_split('/[\s]+/', $tentang);
		//menghitung jumlah kata kunci dari split di atas
		$total_kata_kunci = count($kata_kunci_split);

		//melakukan perulangan sebanyak kata kunci yang di masukkan
		foreach ($kata_kunci_split as $key => $kunci) {
			//set variabel $where untuk query nanti
			$where_tentang .= "ta_produk_hukum.tentang LIKE '%$kunci%'";
			$where_tentang_and .= "ta_produk_hukum.tentang LIKE '%$kunci%'";
			//jika kata kunci lebih dari 1 (2 dan seterusnya) maka di tambahkan OR di perulangannya
			if ($key != ($total_kata_kunci - 1)) {
				$where_tentang .= " OR ";
				$where_tentang_and .= " AND ";
			}
		}

		$this->db->where('(ta_produk_hukum.id_kategori LIKE "' . $kategori . '")
		AND (ta_produk_hukum.tahun LIKE "' . $tahun . '") 
		AND (ta_produk_hukum.no_peraturan LIKE "' . $no_peraturan . '")
		AND (' . $where_tentang . ')
		');

		$this->db->limit($limit, $start);
		//$this->db->order_by('ta_produk_hukum.tgl_peraturan', "DESC");
		$this->db->group_by('ta_produk_hukum_det.id_produk_hukum');
		if ($total_kata_kunci > 1) {
			$this->db->order_by("Jum DESC, ta_produk_hukum.tgl_peraturan DESC");
			return $this->db->get('(
				SELECT * FROM ta_produk_hukum ta_produk_hukum
				WHERE (' . $where_tentang . ')
				UNION ALL 
				SELECT * FROM ta_produk_hukum ta_produk_hukum
				WHERE (' . $where_tentang_and . ')
				UNION ALL
				SELECT * FROM ta_produk_hukum ta_produk_hukum
				WHERE ( tentang LIKE  "%' . $tentang . '%")
				UNION ALL
				SELECT * FROM ta_produk_hukum ta_produk_hukum
				WHERE ( tentang = "' . $tentang . '")
			) ta_produk_hukum')->result();
		} else {
			$this->db->order_by("ta_produk_hukum.tgl_peraturan DESC");
			return $this->db->get('(
				SELECT * FROM ta_produk_hukum ta_produk_hukum
			) ta_produk_hukum')->result();
		}
	}

	function get_row($id = NULL)
	{
		$this->db->select('ta_produk_hukum.id_produk_hukum, ta_produk_hukum.judul_peraturan, ta_produk_hukum.no_peraturan, ta_produk_hukum.tentang, ta_produk_hukum.tgl_peraturan, ta_produk_hukum.tempat_terbit, ta_produk_hukum.keterangan_lainnya,
							ta_produk_hukum.tahun, ta_produk_hukum.id_kategori, ta_produk_hukum.id_pengarang, ta_produk_hukum.file, ta_produk_hukum.file_lampiran, ta_produk_hukum.abstrak, 
							ta_produk_hukum.file_abstrak, ta_produk_hukum.id_katalog, ta_produk_hukum.tempat_terbit, ta_produk_hukum.tgl_peraturan, 
							ta_produk_hukum.dilihat, ta_produk_hukum.didownload,
							ref_kategori.kategori,
							
							ta_katalog.nama_katalog, ta_katalog.file as file_katalog
					');

		$this->db->join('ref_kategori', 'ta_produk_hukum.id_kategori=ref_kategori.id_kategori', 'left');


		$this->db->join('ta_katalog', 'ta_produk_hukum.id_katalog=ta_katalog.id_katalog', 'left');
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	// insert data
	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}

	function update_perubahan($id, $data_perubahan)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data_perubahan);
	}

	// delete data
	function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}
}

/* End of file Ta_produk_hukum_model.php */
/* Location: ./application/models/Ta_produk_hukum_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-19 19:31:44 */
/* http://harviacode.com */