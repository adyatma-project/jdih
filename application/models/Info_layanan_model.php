<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reg_pak_model extends CI_Model
{

    public $table = 'reg_pak';
    public $id = 'reg_pak';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function pangkat_automatis()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }