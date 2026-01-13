<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_halaman extends CI_Model {
    
    // Ambil data berdasarkan slug
    public function get_by_slug($slug) {
        return $this->db->get_where('tbl_halaman', ['slug' => $slug])->row();
    }

    // Update konten
    public function update_konten($slug, $data) {
        $this->db->where('slug', $slug);
        return $this->db->update('tbl_halaman', $data);
    }
}