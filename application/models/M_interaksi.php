<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_interaksi extends CI_Model {

    // Ambil link berdasarkan jenis (pengaduan/survei)
    public function get_link($jenis) {
        $this->db->where('jenis', $jenis);
        $query = $this->db->get('tbl_interaksi');
        if ($query->num_rows() > 0) {
            return $query->row()->link_url;
        }
        return "#"; // Default jika kosong
    }

    // Update link dari Admin
    public function update_link($jenis, $link) {
        $this->db->where('jenis', $jenis);
        return $this->db->update('tbl_interaksi', ['link_url' => $link]);
    }
}