<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	public function index()
	{
		$ref_kategori = $this->db->query('select * from ref_kategori')->result();
		$ref_status_peraturan = $this->db->query('select * from ref_status_peraturan')->result();
		if ($this->session->userdata('logged_in')!="" && $this->session->userdata('stts')=="administrator")
		{
			$data = array(
				'ref_kategori' => $ref_kategori,
				'ref_status_peraturan' => $ref_status_peraturan,
				);
			$this->template->load('backend/template','backend/beranda', $data);
		}
		else
		{
			header('location:'.base_url().'backend');
		}
	}
}