<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ta_produk_hukum_katalog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_produk_hukum_katalog_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'ta_produk_hukum_katalog/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ta_produk_hukum_katalog/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ta_produk_hukum_katalog/index.html';
            $config['first_url'] = base_url() . 'ta_produk_hukum_katalog/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ta_produk_hukum_katalog_model->total_rows($q);
        $ta_produk_hukum_katalog = $this->Ta_produk_hukum_katalog_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ta_produk_hukum_katalog_data' => $ta_produk_hukum_katalog,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('ta_produk_hukum_katalog/ta_produk_hukum_katalog_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Ta_produk_hukum_katalog_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_produk_hukum' => $row->id_produk_hukum,
		'ktlglembaran_jenis' => $row->ktlglembaran_jenis,
		'ktlglembaran_tahun' => $row->ktlglembaran_tahun,
		'ktlglembaran_no' => $row->ktlglembaran_no,
		'ktlglembaran_jum_halaman' => $row->ktlglembaran_jum_halaman,
		'ktlgtambahan_jenis' => $row->ktlgtambahan_jenis,
		'ktlgtambahan_tahun' => $row->ktlgtambahan_tahun,
		'ktlgtambahan_no' => $row->ktlgtambahan_no,
		'ktlgtambahan_jum_halaman' => $row->ktlgtambahan_jum_halaman,
		'pemrakarsa' => $row->pemrakarsa,
		'no_register' => $row->no_register,
	    );
            $this->load->view('ta_produk_hukum_katalog/ta_produk_hukum_katalog_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ta_produk_hukum_katalog'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ta_produk_hukum_katalog/create_action'),
	    'id_produk_hukum' => set_value('id_produk_hukum'),
	    'ktlglembaran_jenis' => set_value('ktlglembaran_jenis'),
	    'ktlglembaran_tahun' => set_value('ktlglembaran_tahun'),
	    'ktlglembaran_no' => set_value('ktlglembaran_no'),
	    'ktlglembaran_jum_halaman' => set_value('ktlglembaran_jum_halaman'),
	    'ktlgtambahan_jenis' => set_value('ktlgtambahan_jenis'),
	    'ktlgtambahan_tahun' => set_value('ktlgtambahan_tahun'),
	    'ktlgtambahan_no' => set_value('ktlgtambahan_no'),
	    'ktlgtambahan_jum_halaman' => set_value('ktlgtambahan_jum_halaman'),
	    'pemrakarsa' => set_value('pemrakarsa'),
	    'no_register' => set_value('no_register'),
	);
        $this->load->view('ta_produk_hukum_katalog/ta_produk_hukum_katalog_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ktlglembaran_jenis' => $this->input->post('ktlglembaran_jenis',TRUE),
		'ktlglembaran_tahun' => $this->input->post('ktlglembaran_tahun',TRUE),
		'ktlglembaran_no' => $this->input->post('ktlglembaran_no',TRUE),
		'ktlglembaran_jum_halaman' => $this->input->post('ktlglembaran_jum_halaman',TRUE),
		'ktlgtambahan_jenis' => $this->input->post('ktlgtambahan_jenis',TRUE),
		'ktlgtambahan_tahun' => $this->input->post('ktlgtambahan_tahun',TRUE),
		'ktlgtambahan_no' => $this->input->post('ktlgtambahan_no',TRUE),
		'ktlgtambahan_jum_halaman' => $this->input->post('ktlgtambahan_jum_halaman',TRUE),
		'pemrakarsa' => $this->input->post('pemrakarsa',TRUE),
		'no_register' => $this->input->post('no_register',TRUE),
	    );

            $this->Ta_produk_hukum_katalog_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ta_produk_hukum_katalog'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Ta_produk_hukum_katalog_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ta_produk_hukum_katalog/update_action'),
		'id_produk_hukum' => set_value('id_produk_hukum', $row->id_produk_hukum),
		'ktlglembaran_jenis' => set_value('ktlglembaran_jenis', $row->ktlglembaran_jenis),
		'ktlglembaran_tahun' => set_value('ktlglembaran_tahun', $row->ktlglembaran_tahun),
		'ktlglembaran_no' => set_value('ktlglembaran_no', $row->ktlglembaran_no),
		'ktlglembaran_jum_halaman' => set_value('ktlglembaran_jum_halaman', $row->ktlglembaran_jum_halaman),
		'ktlgtambahan_jenis' => set_value('ktlgtambahan_jenis', $row->ktlgtambahan_jenis),
		'ktlgtambahan_tahun' => set_value('ktlgtambahan_tahun', $row->ktlgtambahan_tahun),
		'ktlgtambahan_no' => set_value('ktlgtambahan_no', $row->ktlgtambahan_no),
		'ktlgtambahan_jum_halaman' => set_value('ktlgtambahan_jum_halaman', $row->ktlgtambahan_jum_halaman),
		'pemrakarsa' => set_value('pemrakarsa', $row->pemrakarsa),
		'no_register' => set_value('no_register', $row->no_register),
	    );
            $this->load->view('ta_produk_hukum_katalog/ta_produk_hukum_katalog_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ta_produk_hukum_katalog'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk_hukum', TRUE));
        } else {
            $data = array(
		'ktlglembaran_jenis' => $this->input->post('ktlglembaran_jenis',TRUE),
		'ktlglembaran_tahun' => $this->input->post('ktlglembaran_tahun',TRUE),
		'ktlglembaran_no' => $this->input->post('ktlglembaran_no',TRUE),
		'ktlglembaran_jum_halaman' => $this->input->post('ktlglembaran_jum_halaman',TRUE),
		'ktlgtambahan_jenis' => $this->input->post('ktlgtambahan_jenis',TRUE),
		'ktlgtambahan_tahun' => $this->input->post('ktlgtambahan_tahun',TRUE),
		'ktlgtambahan_no' => $this->input->post('ktlgtambahan_no',TRUE),
		'ktlgtambahan_jum_halaman' => $this->input->post('ktlgtambahan_jum_halaman',TRUE),
		'pemrakarsa' => $this->input->post('pemrakarsa',TRUE),
		'no_register' => $this->input->post('no_register',TRUE),
	    );

            $this->Ta_produk_hukum_katalog_model->update($this->input->post('id_produk_hukum', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ta_produk_hukum_katalog'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ta_produk_hukum_katalog_model->get_by_id($id);

        if ($row) {
            $this->Ta_produk_hukum_katalog_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ta_produk_hukum_katalog'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ta_produk_hukum_katalog'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ktlglembaran_jenis', 'ktlglembaran jenis', 'trim|required');
	$this->form_validation->set_rules('ktlglembaran_tahun', 'ktlglembaran tahun', 'trim|required');
	$this->form_validation->set_rules('ktlglembaran_no', 'ktlglembaran no', 'trim|required');
	$this->form_validation->set_rules('ktlglembaran_jum_halaman', 'ktlglembaran jum halaman', 'trim|required');
	$this->form_validation->set_rules('ktlgtambahan_jenis', 'ktlgtambahan jenis', 'trim|required');
	$this->form_validation->set_rules('ktlgtambahan_tahun', 'ktlgtambahan tahun', 'trim|required');
	$this->form_validation->set_rules('ktlgtambahan_no', 'ktlgtambahan no', 'trim|required');
	$this->form_validation->set_rules('ktlgtambahan_jum_halaman', 'ktlgtambahan jum halaman', 'trim|required');
	$this->form_validation->set_rules('pemrakarsa', 'pemrakarsa', 'trim|required');
	$this->form_validation->set_rules('no_register', 'no register', 'trim|required');

	$this->form_validation->set_rules('id_produk_hukum', 'id_produk_hukum', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ta_produk_hukum_katalog.php */
/* Location: ./application/controllers/Ta_produk_hukum_katalog.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-25 17:36:24 */
/* http://harviacode.com */