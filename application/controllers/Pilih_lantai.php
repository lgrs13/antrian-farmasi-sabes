<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pilih_lantai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('cookie', 'url'));
    }

    public function index()
    {
        $this->input->set_cookie(array(
            'name' => 'selected_lantai',
            'value' => json_encode(array(
                "lantai" => 3
            )),
            'expire' => time() + (60 * 60 * 24 * 365),
            'secure' => false,
            'domain' => 'localhost'
        ));

        redirect('/Antrian_farmasi', 'refresh');
    }

    public function clear_selected_lantai()
    {

        delete_cookie('selected_lantai', 'localhost');
        redirect('/Pilih_lantai', 'refresh');
    }
}
