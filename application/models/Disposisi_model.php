<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Disposisi_model extends CI_Model
{

    public $table = 'reg_file';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
	
	function rows_disposisi($q = NULL) {
	$this->db->select('reg_pak');
	
	$or_like ='(reg_pak LIKE "%'.$q.'%" 
				)';
				
	$this->db->from($this->table);
	$this->db->where('jenis_file', 'Disposisi');
	$this->db->where($or_like);	
		return $this->db->count_all_results();
    }
	
	function rows_disposisi_terima($q = NULL) {
	$this->db->select('reg_pak');
	
	$or_like ='(reg_pak LIKE "%'.$q.'%" 
				)';
				
	$this->db->from($this->table);
	$this->db->where('jenis_file', 'Disposisi');
	$this->db->where('jenis_file', 'Disposisi');
	$this->db->where($or_like);	
		return $this->db->count_all_results();
    }
	
	function list_disposisi($limit, $start = 0, $q = NULL) {
	$this->db->select('reg_file.id, reg_file.reg_pak, reg_file.file, reg_file.no_surat, reg_file.jenis_file,
						tbl_master_unit_kerja.nama_unit_kerja,
						reg_user_login.id_user_login
							');
	
	$or_like ='(reg_file.no_surat LIKE "%'.$q.'%" 
				)';
				
	$this->db->join('reg_user_login', 'reg_file.reg_pak =  reg_user_login.id_user_login', 'left');
	$this->db->join('tbl_data_pegawai', 'reg_user_login.id_pegawai = tbl_data_pegawai.id_pegawai', 'left');
	$this->db->join('tbl_master_unit_kerja', 'tbl_data_pegawai.id_unit_kerja =  tbl_master_unit_kerja.id_unit_kerja', 'left');
	$this->db->where('reg_file.jenis_file', 'Disposisi');
	$this->db->where('reg_user_login.stat_dispo', 'belum');
	$this->db->where($or_like);
	
	$this->db->limit($limit, $start);
	return $this->db->get_where($this->table)->result();
    }
	function list_disposisi_terima($limit, $start = 0, $q = NULL) {
	$this->db->select('reg_file.id, reg_file.reg_pak, reg_file.file, reg_file.no_surat, reg_file.jenis_file,
						tbl_master_unit_kerja.nama_unit_kerja,
						reg_user_login.id_user_login
							');
	
	$or_like ='(reg_file.no_surat LIKE "%'.$q.'%" 
				)';
				
	$this->db->join('reg_user_login', 'reg_file.reg_pak =  reg_user_login.id_user_login', 'left');
	$this->db->join('tbl_data_pegawai', 'reg_user_login.id_pegawai = tbl_data_pegawai.id_pegawai', 'left');
	$this->db->join('tbl_master_unit_kerja', 'tbl_data_pegawai.id_unit_kerja =  tbl_master_unit_kerja.id_unit_kerja', 'left');
	$this->db->where('reg_file.jenis_file', 'Disposisi');
	$this->db->where('reg_user_login.stat_dispo', 'sudah');
	$this->db->where($or_like);
	
	$this->db->limit($limit, $start);
	return $this->db->get_where($this->table)->result();
    }
}