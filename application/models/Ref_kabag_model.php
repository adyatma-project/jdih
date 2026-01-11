<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_kabag_model extends CI_Model
{

    public $table = 'ref_kabag';
    public $id = 'id_kabag';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // Ambil semua data untuk backend
    function get_all()
    {
        $this->db->order_by('urutan', 'ASC');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // Ambil data detail by ID
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // Khusus Frontend: Ambil 1 pejabat yang statusnya Aktif
    function get_active_kabag() {
        $this->db->where('status', '1');
        $this->db->order_by('urutan', 'ASC'); // Prioritas urutan
        $this->db->order_by('id_kabag', 'DESC'); // Lalu yang terbaru
        $this->db->limit(1); // Cukup ambil 1
        return $this->db->get($this->table)->row();
    }

    function total_rows($q = NULL) {
        $this->db->like('id_kabag', $q);
	    $this->db->or_like('nama', $q);
	    $this->db->or_like('nip', $q);
	    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by('urutan', 'ASC');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_kabag', $q);
	    $this->db->or_like('nama', $q);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}