<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_info_hukum_model extends CI_Model
{

    public $table = 'ta_info_hukum';
    public $id = 'id_info_hukum';
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
    function total_rows($q = NULL) {
     	$this->db->select('	ta_info_hukum.id_info_hukum, ta_info_hukum.no, ta_info_hukum.judul, ta_info_hukum.id_kategori_info, ta_info_hukum.deskripsi,
							ta_info_hukum.tgl, ta_info_hukum.tahun, ta_info_hukum.file, ta_info_hukum.dilihat, ta_info_hukum.didownload,
							ref_kategori_info.kategori
					');
		 $or_like ='(ta_info_hukum.tahun LIKE "%'.$q.'%"
					OR ref_kategori_info.kategori LIKE "%'.$q.'%"
					OR ta_info_hukum.no LIKE "%'.$q.'%"
					OR ta_info_hukum.judul LIKE "%'.$q.'%"
					OR ta_info_hukum.deskripsi LIKE "%'.$q.'%"
					)';
		$this->db->join('ref_kategori_info', 'ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori', 'left');
		$this->db->where($or_like);
		$this->db->from($this->table);
     return $this->db->count_all_results();
    }
	
	function total_rows_info_hukum($nomor = NULL, $tahun = NULL, $id_kategori_info = NULL, $tentang=NULL) {

        $this->db->select('ta_info_hukum.id_info_hukum, ta_info_hukum.no, ta_info_hukum.judul, ta_info_hukum.id_kategori_info,
							ta_info_hukum.tgl, ta_info_hukum.tahun, ta_info_hukum.file, ta_info_hukum.dilihat, ta_info_hukum.didownload,
							ref_kategori_info.kategori
					');

        $or_like ='(ta_info_hukum.judul LIKE "%'.$tentang.'%"
					AND ta_info_hukum.tahun LIKE "%'.$tahun.'%"
					AND ta_info_hukum.id_kategori_info LIKE "%'.$id_kategori_info.'%"
					AND ta_info_hukum.no LIKE "%'.$nomor.'%"
					)';
		$this->db->join('ref_kategori_info', 'ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori', 'left');
	$this->db->where($or_like);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
    	$this->db->select('	ta_info_hukum.id_info_hukum, ta_info_hukum.no, ta_info_hukum.judul, ta_info_hukum.id_kategori_info, ta_info_hukum.deskripsi,
							ta_info_hukum.tgl, ta_info_hukum.tahun, ta_info_hukum.file, ta_info_hukum.dilihat, ta_info_hukum.didownload,
							ref_kategori_info.kategori
					');
		 $or_like ='(ta_info_hukum.tahun LIKE "%'.$q.'%"
					OR ref_kategori_info.kategori LIKE "%'.$q.'%"
					OR ta_info_hukum.no LIKE "%'.$q.'%"
					OR ta_info_hukum.judul LIKE "%'.$q.'%"
					OR ta_info_hukum.deskripsi LIKE "%'.$q.'%"
					)';
		$this->db->join('ref_kategori_info', 'ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori', 'left');
		$this->db->where($or_like);
		$this->db->limit($limit, $start);
		return $this->db->get($this->table)->result();
    }
	
	function get_data($limit, $start = 0, $nomor=NULL, $tahun=NULL, $id_kategori_info=NULL, $tentang=NULL) {
		$this->db->select('ta_info_hukum.id_info_hukum, ta_info_hukum.no, ta_info_hukum.judul, ta_info_hukum.id_kategori_info,
							ta_info_hukum.tgl, ta_info_hukum.tahun, ta_info_hukum.file, ta_info_hukum.dilihat, ta_info_hukum.didownload,
							ref_kategori_info.kategori
					');

		$or_like ='(ta_info_hukum.judul LIKE "%'.$tentang.'%"
					AND ta_info_hukum.tahun LIKE "%'.$tahun.'%"
					AND ta_info_hukum.id_kategori_info LIKE "%'.$id_kategori_info.'%"
					AND ta_info_hukum.no LIKE "%'.$nomor.'%"
					)';

		$this->db->join('ref_kategori_info', 'ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori', 'left');
		$this->db->where($or_like);
		$this->db->limit($limit, $start);
		$this->db->order_by("ta_info_hukum.tgl DESC, ta_info_hukum.no DESC");
		return $this->db->get($this->table)->result();
    }
	function get_row($id) {
		$this->db->select('	ta_info_hukum.id_info_hukum, ta_info_hukum.no, ta_info_hukum.judul, ta_info_hukum.id_kategori_info,ta_info_hukum.deskripsi,
							ta_info_hukum.tgl, ta_info_hukum.tahun, ta_info_hukum.file, ta_info_hukum.dilihat, ta_info_hukum.didownload,
							ref_kategori_info.kategori
					');

		$this->db->join('ref_kategori_info', 'ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori', 'left');
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
    }
	
	function get_data_intruksi($limit, $start = 0) {
        $this->db->select(' ta_info_hukum.id_info_hukum, ta_info_hukum.no, ta_info_hukum.judul, 
							ta_info_hukum.id_kategori_info, ta_info_hukum.tgl, ta_info_hukum.tahun, 
							ta_info_hukum.file, ta_info_hukum.dilihat, ta_info_hukum.didownload,
							ref_kategori_info.kategori
							');
		$this->db->join('ref_kategori_info', 'ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori', 'left');
		$this->db->where('id_kategori_info', "1");
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
	
	function get_data_mou($limit, $start = 0) {
        $this->db->select(' ta_info_hukum.id_info_hukum, ta_info_hukum.no, ta_info_hukum.judul, 
							ta_info_hukum.id_kategori_info, ta_info_hukum.tgl, ta_info_hukum.tahun, 
							ta_info_hukum.file, ta_info_hukum.dilihat, ta_info_hukum.didownload,
							ref_kategori_info.kategori
							');
		$this->db->join('ref_kategori_info', 'ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori', 'left');
		$this->db->where('id_kategori_info', "2");
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
	function get_data_edaran($limit, $start = 0) {
        $this->db->select(' ta_info_hukum.id_info_hukum, ta_info_hukum.no, ta_info_hukum.judul, 
							ta_info_hukum.id_kategori_info, ta_info_hukum.tgl, ta_info_hukum.tahun, 
							ta_info_hukum.file, ta_info_hukum.dilihat, ta_info_hukum.didownload,
							ref_kategori_info.kategori
							');
		$this->db->join('ref_kategori_info', 'ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori', 'left');
		$this->db->where('id_kategori_info', "3");
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

/* End of file Ta_info_hukum_model.php */
/* Location: ./application/models/Ta_info_hukum_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-21 15:20:22 */
/* http://harviacode.com */