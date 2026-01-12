<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ubah_password_model extends CI_Model
{
    // Sesuaikan nama tabel user Anda disini
    public $table = 'users'; 
    public $id = 'id';

    function __construct()
    {
        parent::__construct();
    }

    // Cek apakah password lama yang diinput cocok dengan database
    function cek_old_password($id_user, $old_password)
    {
        $this->db->where($this->id, $id_user);
        $this->db->where('password', md5($old_password)); // Menggunakan MD5
        $query = $this->db->get($this->table);
        return $query->row();
    }

    // Simpan password baru
    function update_password($id_user, $new_password)
    {
        $data = array(
            'password' => md5($new_password) // Enkripsi MD5 sebelum simpan
        );
        $this->db->where($this->id, $id_user);
        $this->db->update($this->table, $data);
    }
}