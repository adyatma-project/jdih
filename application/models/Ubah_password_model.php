<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ubah_password_model extends CI_Model
{
    // --- PENYESUAIAN NAMA TABEL & ID ---
    // Sesuai dengan controller Manage_user.php sebelumnya
    public $table = 'tbl_user_login'; 
    public $id = 'id_user_login';

    function __construct()
    {
        parent::__construct();
    }

    // Cek apakah password lama yang diinput cocok
    function cek_old_password($id_user, $old_password)
    {
        // Gunakan Rumus MD5 + Salt yang SAMA PERSIS
        $password_encrypted = md5($old_password . 'jdihlutra@xxxaseww21%^&^$#');

        $this->db->where($this->id, $id_user);
        $this->db->where('password', $password_encrypted); 
        $query = $this->db->get($this->table);
        
        return $query->row();
    }

    // Simpan password baru
    function update_password($id_user, $new_password)
    {
        // Enkripsi Password Baru dengan Rumus yang SAMA
        $password_encrypted = md5($new_password . 'jdihlutra@xxxaseww21%^&^$#');

        $data = array(
            'password' => $password_encrypted
        );

        $this->db->where($this->id, $id_user);
        $this->db->update($this->table, $data);
    }
}