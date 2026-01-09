<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_info_hukum_model');
        $this->load->model('Ta_berita_model');
        $this->load->model('Ta_produk_hukum_model');
        $this->load->library('form_validation');
        $this->load->helper('tanggal_helper');
    }
    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
$sliders = $this->db->where('status', '1')
                        ->order_by('urutan', 'ASC')
                        ->order_by('id_slider', 'DESC')
                        ->get('ta_slider')
                        ->result();
        if ($q <> '') {
            $config['base_url'] = base_url() . 'ta_produk_hukum?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ta_produk_hukum?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ta_produk_hukum';
            $config['first_url'] = base_url() . 'ta_produk_hukum';
        }

        $config['per_page'] = 4;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ta_produk_hukum_model->total_rows($q);
        $ta_produk_hukum = $this->Ta_produk_hukum_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        //$ta_berita = $this->Ta_berita_model->get_limit_data($config['per_page'], $start, $q);

        $ta_info_hukum = $this->db->query("SELECT * FROM ta_info_hukum 
			LEFT JOIN ref_kategori_info ON
			ta_info_hukum.id_kategori_info=ref_kategori_info.id_kategori
            
			ORDER BY tgl DESC LIMIT 4")->result();
        // $ta_info_hukum_mou = $this->Ta_info_hukum_model->get_data_mou($config['per_page'], $start);
        // $ta_info_hukum_edaran = $this->Ta_info_hukum_model->get_data_edaran($config['per_page'], $start);

        $ta_berita = $this->db->query('SELECT * FROM ta_berita ORDER BY tgl_insert DESC')->result();
        $ta_produk_hukum_populer = $this->db->query("SELECT * FROM ta_produk_hukum 
			LEFT JOIN ref_kategori ON
			ta_produk_hukum.id_kategori=ref_kategori.id_kategori
            WHERE ref_kategori.id_kategori IN (SELECT id_kategori FROM ref_kategori WHERE status !=0)
			ORDER BY dilihat DESC LIMIT 5")->result();

        $ref_kategori_notperbub = $this->db->get_where('ref_kategori', 'status=1 AND id_kategori<>2')->result();
        $ref_kategori = $this->db->get_where('ref_kategori', 'status=1')->result();
        $ref_kategori_statistik = $this->db->query('SELECT * FROM ref_kategori WHERE id_kategori IN(2,3,5)')->result();
        //$ref_status_peraturan = $this->db->query('select * from ref_status_peraturan WHERE status<>1')->result();
        $link_terkait = $this->db->query('SELECT * FROM ta_link_terkait')->result();

        $v_jum = $this->db->query('SELECT * FROM v_jum WHERE id_kategori IN (3,5) ORDER BY id_kategori ')->result();

        $data = array(
            'ta_produk_hukum_data' => $ta_produk_hukum,
            'q' => $q,
            'sliders' => $sliders,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'ta_berita' => $ta_berita,
            'start' => $start,
            'ta_info_hukum' => $ta_info_hukum,
            'ref_kategori' => $ref_kategori,
            'ref_kategori_statistik' => $ref_kategori_statistik,
            'ref_kategori_notperbub' => $ref_kategori_notperbub,
            //'ref_status_peraturan' => $ref_status_peraturan,
            'ta_produk_hukum_populer' => $ta_produk_hukum_populer,
            'link_terkait' => $link_terkait,
            'v_jum' => $v_jum
        );

        $this->template->load('frontend/template_public', 'frontend/beranda', $data);
    }

    public function visimisi()
    {
        $visimisi = $this->db->query('SELECT * FROM ref_visimisi')->result();
        $data = array(
            'visimisi' => $visimisi,
        );
        $this->template->load('frontend/template_public', 'frontend/visimisi', $data);
    }

    public function statistik()
    {
        $this->template->load('frontend/template_grafik', 'frontend/statistik_produk_hukum');
    }
    public function grafik()
    {
        $this->template->load('frontend/template_grafik', 'frontend/grafik_produk_hukum');
    }
}