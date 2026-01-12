<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_link_eksternal_model extends CI_Model
{
    public $table = 'ta_link_eksternal'; // Nama tabel baru
    public $id = 'id_link';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // Ambil semua untuk admin
    function get_all()
    {
        $this->db->order_by('urutan', 'ASC');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // Ambil yang aktif untuk frontend
    function get_active_links1()
    {
        $this->db->where('status', '1');
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get($this->table)->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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