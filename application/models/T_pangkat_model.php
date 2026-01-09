<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_pangkat_model extends CI_Model
{

    public $table = 'reg_user_login';
    public $id = 'id_user_login';
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
      
		
		
		$this->db->select('reg_user_login.id_pegawai, reg_user_login.id_user_login, reg_user_login.ket, reg_user_login.no_telpn, reg_user_login.username,
						tbl_data_pegawai.nip, tbl_data_pegawai.nama_pegawai, tbl_data_pegawai.jenis_kelamin, tbl_data_pegawai.foto, tbl_data_pegawai.alamat,
						tbl_master_golongan.uraian as pangkat_awal,
						reg_master_golongan.uraian as pangkat_usulan,
						tbl_master_jabatan.nama_jabatan AS jabatan,
						tbl_master_status_jabatan.nama_jabatan AS status,
						tbl_master_status_pegawai.nama_status,
						tbl_master_unit_kerja.nama_unit_kerja AS unit_kerja,
						tbl_master_lokasi_kerja.lokasi_kerja
						
							');
	
		$this->db->join('tbl_data_pegawai', 'tbl_data_pegawai.id_pegawai = reg_user_login.id_pegawai', 'left');
		$this->db->join('tbl_master_golongan', 'tbl_master_golongan.id_golongan = tbl_data_pegawai.id_golongan', 'left');
		$this->db->join('tbl_master_jabatan', 'tbl_master_jabatan.id_jabatan = tbl_data_pegawai.id_jabatan', 'left');
		$this->db->join('tbl_master_status_jabatan', 'tbl_master_status_jabatan.id_status_jabatan = tbl_data_pegawai.id_status_jabatan', 'left');
		$this->db->join('tbl_master_status_pegawai', 'tbl_master_status_pegawai.id_status_pegawai = tbl_data_pegawai.status_pegawai', 'left');
		$this->db->join('reg_master_golongan', 'reg_master_golongan.id_golongan = reg_user_login.id_golongan', 'left');
		$this->db->join('tbl_master_unit_kerja', 'tbl_master_unit_kerja.id_unit_kerja = tbl_data_pegawai.id_unit_kerja', 'left');
		$this->db->join('tbl_master_lokasi_kerja', 'tbl_master_lokasi_kerja.id_lokasi_kerja = tbl_data_pegawai.lokasi_kerja', 'left');
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
    }
	
	function get_by_id_pegawai($id)
    {
      
		
		
		$this->db->select('reg_user_login.id_pegawai, reg_user_login.id_user_login, reg_user_login.ket, reg_user_login.no_telpn, reg_user_login.username,
						tbl_data_pegawai.nip, tbl_data_pegawai.nama_pegawai, tbl_data_pegawai.jenis_kelamin, tbl_data_pegawai.foto, tbl_data_pegawai.alamat,
						tbl_master_golongan.uraian as pangkat_awal,
						reg_master_golongan.uraian as pangkat_usulan,
						tbl_master_jabatan.nama_jabatan AS jabatan,
						tbl_master_status_jabatan.nama_jabatan AS status,
						tbl_master_status_pegawai.nama_status,
						tbl_master_unit_kerja.nama_unit_kerja AS unit_kerja,
						tbl_master_lokasi_kerja.lokasi_kerja
						
							');
	
		$this->db->join('tbl_data_pegawai', 'tbl_data_pegawai.id_pegawai = reg_user_login.id_pegawai', 'left');
		$this->db->join('tbl_master_golongan', 'tbl_master_golongan.id_golongan = tbl_data_pegawai.id_golongan', 'left');
		$this->db->join('tbl_master_jabatan', 'tbl_master_jabatan.id_jabatan = tbl_data_pegawai.id_jabatan', 'left');
		$this->db->join('tbl_master_status_jabatan', 'tbl_master_status_jabatan.id_status_jabatan = tbl_data_pegawai.id_status_jabatan', 'left');
		$this->db->join('tbl_master_status_pegawai', 'tbl_master_status_pegawai.id_status_pegawai = tbl_data_pegawai.status_pegawai', 'left');
		$this->db->join('reg_master_golongan', 'reg_master_golongan.id_golongan = reg_user_login.id_golongan', 'left');
		$this->db->join('tbl_master_unit_kerja', 'tbl_master_unit_kerja.id_unit_kerja = tbl_data_pegawai.id_unit_kerja', 'left');
		$this->db->join('tbl_master_lokasi_kerja', 'tbl_master_lokasi_kerja.id_lokasi_kerja = tbl_data_pegawai.lokasi_kerja', 'left');
		$this->db->where('reg_user_login.id_pegawai', $id);
		return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function rows_usulan($q = NULL, $instansi) {
	$this->db->select('id_pegawai, id_golongan');
	
	$or_like ='(id_golongan LIKE "%'.$q.'%" 
				OR id_pegawai LIKE "%'.$q.'%" 
				)';
				
	$this->db->from($this->table);
	$this->db->where('status', 'diusulkan');
	$this->db->where('kode_instansi', $instansi);
	$this->db->where($or_like);	
		return $this->db->count_all_results();
    }
	
	
    // get data with limit and search
    function list_usulan($limit, $start = 0, $q = NULL, $instansi) {
	$this->db->select('reg_user_login.id_pegawai, reg_user_login.id_user_login, reg_user_login.ket,
						tbl_data_pegawai.nip, tbl_data_pegawai.nama_pegawai,
						tbl_master_golongan.uraian as pangkat_awal,
						reg_master_golongan.uraian as pangkat_usulan,
						tbl_master_jabatan.nama_jabatan
						
							');
	
	$or_like ='(tbl_data_pegawai.id_golongan LIKE "%'.$q.'%" 
				OR tbl_data_pegawai.id_pegawai LIKE "%'.$q.'%" 
				)';
				
	$this->db->join('tbl_data_pegawai', 'tbl_data_pegawai.id_pegawai = reg_user_login.id_pegawai', 'left');
	$this->db->join('tbl_master_golongan', 'tbl_master_golongan.id_golongan = tbl_data_pegawai.id_golongan', 'left');
	$this->db->join('tbl_master_jabatan', 'tbl_master_jabatan.id_jabatan = tbl_data_pegawai.id_jabatan', 'left');
	$this->db->join('reg_master_golongan', 'reg_master_golongan.id_golongan = reg_user_login.id_golongan', 'left');
	$this->db->where('status', 'diusulkan');
	$this->db->where('kode_instansi', $instansi);
	$this->db->where($or_like);
	
	$this->db->limit($limit, $start);
	return $this->db->get_where($this->table)->result();
    }
	
	function tot_usulan_diterima_instansi($q = NULL, $instansi) {
	$this->db->select('id_pegawai, id_golongan');
	
	$or_like ='(id_golongan LIKE "%'.$q.'%" 
				OR id_pegawai LIKE "%'.$q.'%" 
				)';
				
	$this->db->from($this->table);
	$this->db->where('status', 'diterima_instansi');
	$this->db->where('kode_instansi', $instansi);
	$this->db->where($or_like);	
		return $this->db->count_all_results();
    }
	
	
    // get data with limit and search
    function list_usulan_diterima_instansi($limit, $start = 0, $q = NULL, $instansi) {
	$this->db->select('reg_user_login.id_pegawai, reg_user_login.id_user_login,
						tbl_data_pegawai.nip, tbl_data_pegawai.nama_pegawai,
						tbl_master_golongan.uraian as pangkat_awal,
						reg_master_golongan.uraian as pangkat_usulan,
						tbl_master_jabatan.nama_jabatan
						
							');
	
	$or_like ='(tbl_data_pegawai.id_golongan LIKE "%'.$q.'%" 
				OR tbl_data_pegawai.id_pegawai LIKE "%'.$q.'%" 
				)';
				
	$this->db->join('tbl_data_pegawai', 'tbl_data_pegawai.id_pegawai = reg_user_login.id_pegawai', 'left');
	$this->db->join('tbl_master_golongan', 'tbl_master_golongan.id_golongan = tbl_data_pegawai.id_golongan', 'left');
	$this->db->join('tbl_master_jabatan', 'tbl_master_jabatan.id_jabatan = tbl_data_pegawai.id_jabatan', 'left');
	$this->db->join('reg_master_golongan', 'reg_master_golongan.id_golongan = reg_user_login.id_golongan', 'left');
	$this->db->where('status', 'diterima_instansi');
	$this->db->where('kode_instansi', $instansi);
	$this->db->where($or_like);
	
	$this->db->limit($limit, $start);
	return $this->db->get_where($this->table)->result();
    }
	

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
	
	function insert_file($data_file)
    {
        $this->db->insert('t_file', $data_file);
    }

    // update data
    function aksi($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
	
	function update_disposisi($id_user, $data_user)
    {
        $this->db->where('id_user_login', $id_user);
        $this->db->update($this->table, $data_user);
    }
	
	function update($id, $data)
    {
        $this->db->where('id_user_login', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file T_penggunaan_model.php */
/* Location: ./application/models/T_penggunaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-07 01:10:32 */
/* http://harviacode.com */