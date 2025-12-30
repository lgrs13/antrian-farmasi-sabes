<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_data extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_master_data');
    }

    /**
     * @desscription untuk mengelola data lokasi lantai dari masing2 klinik dan dokter
     */
    public function klinik_lantai() {

        // ambil data
        $list = $this->M_master_data->get_list_poliklinik_lantai();

        $data = array(
            'view_body' => 'master_data/poliklinik_lantai.php',
            'js' => 'master_data/js.php',
            'data' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
                'list_data' => $list
            )
        );
        $this->load->view('view', $data);
    }

    public function klinik_lantai_edit() {

        $kd_poli = $this->input->get('kd_poli');
        $nm_poli = $this->M_master_data->get_detail_poliklinik($kd_poli);
        $kd_dokter = $this->input->get('kd_dokter');
        $nm_dokter = $this->M_master_data->get_detail_dokter($kd_dokter);
        $lantai = $this->input->get('lantai');
        
        if(!isset($nm_poli)) {

            echo "Nama Poli tidak valid";
        } else if(!isset($nm_dokter)) {

            echo "Nama Dokter tidak valid";
        } else if(!isset($lantai)) {

            echo "Lantai tidak valid";
        } else {

            $data = array(
                'view_body' => 'master_data/poliklinik_lantai_edit.php',
                'js' => 'master_data/js.php',
                'data' => array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash(),
                    'kd_poli' => $kd_poli,
                    'nm_poli' => $nm_poli->nm_poli,
                    'kd_dokter' => $kd_dokter,
                    'nm_dokter' => $nm_dokter->nm_dokter,
                    'lantai' => $lantai
                )
            );
            $this->load->view('view', $data);
        }
    }

    public function poliklinik_lantai_tambah() {
        
        $list_lantai = array(
            array(
                'key' => 1,
                'value' => '1',
            ),
            array(
                'key' => 3,
                'value' => '3',
            ),
            array(
                'key' => 4,
                'value' => '4',
            )
        );

        $data = array(
            'view_body' => 'master_data/poliklinik_lantai_tambah.php',
            'js' => 'master_data/js.php',
            'data' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
                'list_poli' => $this->M_master_data->get_list_poliklinik(),
                'list_dokter' => $this->M_master_data->get_list_dokter(),
                'list_lantai' => $list_lantai
            )
        );
        $this->load->view('view', $data);
    }

    

    public function tambah_klinik_lantai() {
        
        $kd_poli = $this->input->post('kd_poli');
        $kd_dokter = $this->input->post('kd_dokter');
        $lantai = $this->input->post('lantai');

        if(!isset($kd_poli)) {
            echo "kd_poli tidak valid";
        } else if(!isset($kd_dokter)) {

            echo "kd_dokter tidak valid";
        } else if(!isset($lantai)) {

            echo "lantai tidak valid";
        } else {

            // cek apakah datanya sudah ada. kalau sudah ada, tolak
            $id = $this->M_master_data->get_poliklinik_lantai_by_kdpoli_kddokter($kd_poli, $kd_dokter);

            if(isset($id)) {
                
                echo "Data Poliklinik lantai telah terdaftar !";
            } else {

                $this->M_master_data->post_poliklinik_lantai(
                    array(
                        'kd_poli' => $kd_poli,
                        'kd_dokter' => $kd_dokter,
                        'poli_lantai' => $lantai
                    ),
                );
        
                redirect(base_url()."Master_data/klinik_lantai");
            }
        }

    }

    public function edit_klinik_lantai() {

        $kd_poli = $this->input->post('kd_poli');
        $kd_dokter = $this->input->post('kd_dokter');
        $lantai = $this->input->post('lantai');

        if(!isset($kd_poli)) {
            echo "kd_poli tidak valid";
        } else if(!isset($kd_dokter)) {

            echo "kd_dokter tidak valid";
        } else if(!isset($lantai)) {

            echo "lantai tidak valid";
        } else {

            $this->M_master_data->update_poliklinik_lantai(
                array(
                    'poli_lantai' => $lantai
                ),
                $kd_poli,
                $kd_dokter
            );
    
            redirect(base_url()."Master_data/klinik_lantai");
        }
    }

    public function delete_klinik_lantai() {

        $kd_poli = $this->input->get('kd_poli');
        $kd_dokter = $this->input->get('kd_dokter');
        $lantai = $this->input->get('lantai');

        if(!isset($kd_poli)) {
            echo "kd_poli tidak valid";
        } else if(!isset($kd_dokter)) {

            echo "kd_dokter tidak valid";
        } else if(!isset($lantai)) {

            echo "lantai tidak valid";
        } else {

            $this->M_master_data->delete_poliklinik_lantai(
                $kd_poli,
                $kd_dokter,
                $lantai
            );
    
            redirect(base_url()."Master_data/klinik_lantai");
        }
    }
}
?>