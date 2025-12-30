<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Antrian_farmasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->helper('date_helper');
        $this->load->model('M_antrian_farmasi');
    }

    public function testing()
    {
        $this->load->view('antrian_farmasi/testing');
    }

    public function testing2()
    {
        $this->load->view('antrian_farmasi/testing2');
    }

    public function testing3()
    {
        $this->load->view('antrian_farmasi/testing3');
    }

    public function index()
    {
        $data = array(
            'view_body' => 'antrian_farmasi/antrian_farmasi.php',
            'js' => 'antrian_farmasi/js.php',
            'data' => array(
                'csrf' => array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                ),
                'lantai' => 3,
                'date_now' => change_format_date(get_date(), 'd-m-Y'),
                'day_name' => ucfirst(strtolower(get_day_name_by_date(get_date())))
            )
        );

        $this->load->view('view', $data);
    }

    public function antrianBelumTerpanggil()
    {
        $antrian = null;
        $tglDipakai = get_date(); 
        // $tglDipakai = '2025/06/16';

        $aNRacik = ["nm_pasien" => "-", "nm_pasien_lbl" => "-", "no_resep" => null, "no_rawat" => null, "no_antri" => "-", "nm_poli" => "-", "panggil" => "-1", "sound_filename" => "-"];
        $aNRacikArr = [0 => ["nm_pasien" => "-", "nm_pasien_lbl" => "-", "no_resep" => null, "no_rawat" => null, "no_antri" => "-", "nm_poli" => "-", "panggil" => "-1", "sound_filename" => "-"]];
        $aRacik = ["nm_pasien" => "-", "nm_pasien_lbl" => "-", "no_resep" => null, "no_rawat" => null, "no_antri" => "-", "nm_poli" => "-", "panggil" => "-1", "sound_filename" => "-"];
        $aRacikArr = [0 => ["nm_pasien" => "-", "nm_pasien_lbl" => "-", "no_resep" => null, "no_rawat" => null, "no_antri" => "-", "nm_poli" => "-", "panggil" => "-1", "sound_filename" => "-"]];


        $antrian_nracik = $this->M_antrian_farmasi->get_antrian_belumterpanggil_nonracik($tglDipakai);

        if (!empty($antrian_nracik)) {
            $namaPasien = str_replace("`", "'", strtolower($antrian_nracik[0]['nm_pasien']));
            $eplNamaPasien = explode(' ', $namaPasien);

            if (count($eplNamaPasien) > 1) {
                $namaDepan = strtoupper($eplNamaPasien[0]);
                unset($eplNamaPasien[0]);
                $namaBelakang = strtoupper(implode(' ', $eplNamaPasien));
                $namaPasienLbl = "<div style='font-size:70px'>$namaDepan</div><div style='font-size:30px'>$namaBelakang</div>";
            } else{
                $namaPasienLbl = "<div style='font-size:100px'>" . strtoupper($namaPasien) . "</div>";
            }

            $antrian_nracik[0]['nm_pasien_lbl'] = $namaPasienLbl;
            $namaPoli = $antrian_nracik[0]['nm_poli'];
            $noAntri = strtolower($antrian_nracik[0]['no_antri']);
            $noResep = strtolower($antrian_nracik[0]['no_resep']);

            if ($antrian_nracik[0]['panggil'] == 0 || ($antrian_nracik[0]['panggil_ulang'] == 'ya')) {
                $this->createAudioNRacik($namaPasien, $namaPoli, $noAntri, $noResep);
                // sleep(2);
                // echo "createAudioNRacik <br>";
            }


            $aNRacik = $antrian_nracik[0];
            $aNRacik['sound_filename'] = "antrianNonRacik$noResep.mp3";
            unset($antrian_nracik[0]);
            $aNRacikTemp = array_values($antrian_nracik);

            if (count($aNRacikTemp) > 0) {
                foreach ($aNRacikTemp as $key => $value) {
                    $eplNamaPasien = explode(' ', $value['nm_pasien']);

                    if (count($eplNamaPasien) > 1) {
                        $namaDepan = strtoupper($eplNamaPasien[0]);
                        unset($eplNamaPasien[0]);
                        $namaBelakang = strtoupper(implode(' ', $eplNamaPasien));
                        $namaPasienLbl = "<span style='font-size:46px'>$namaDepan</span><br><span style='font-size:28px'>$namaBelakang</span>";
                    } else
                        $namaPasienLbl = "<span style='font-size:50px'>" . strtoupper($value['nm_pasien']) . "</span>";

                    $aNRacikTemp[$key]['nm_pasien_lbl'] = $namaPasienLbl;
                }
            }
        }
        $aNRacikArr = empty($aNRacikTemp) ? $aNRacikArr : $aNRacikTemp;
        $antrian_racik = $this->M_antrian_farmasi->get_antrian_belumterpanggil_racik($tglDipakai);

        if (!empty($antrian_racik)) {
            $namaPasien = str_replace("`", "'", strtolower($antrian_racik[0]['nm_pasien']));
            $eplNamaPasien = explode(' ', $namaPasien);

            if (count($eplNamaPasien) > 1) {
                $namaDepan = strtoupper($eplNamaPasien[0]);
                unset($eplNamaPasien[0]);
                $namaBelakang = strtoupper(implode(' ', $eplNamaPasien));
                $namaPasienLbl = "<div style='font-size:90px'>$namaDepan</div><div style='font-size:30px'>$namaBelakang</div>";
            } else
                $namaPasienLbl = "<div style='font-size:130px'>$namaPasien</div>";

            $antrian_racik[0]['nm_pasien_lbl'] = $namaPasienLbl;
            $namaPoli = $antrian_racik[0]['nm_poli'];
            $noAntri = strtolower($antrian_racik[0]['no_antri']);
            $noResep = strtolower($antrian_racik[0]['no_resep']);

            if ($antrian_racik[0]['panggil'] == 0 || ($antrian_racik[0]['panggil_ulang'] == 'ya')) {
                $this->createAudioRacik($namaPasien, $namaPoli, $noAntri, $noResep);
                // sleep(2);
                // echo "createAudioRacik <br>";
            }

            $aRacik = $antrian_racik[0];
            $aRacik['sound_filename'] = "antrianRacik$noResep.mp3";
            unset($antrian_racik[0]);
            $aRacikTemp = array_values($antrian_racik);

            if (count($aRacikTemp) > 0) {
                foreach ($aRacikTemp as $key => $value) {
                    $eplNamaPasien = explode(' ', $value['nm_pasien']);

                    if (count($eplNamaPasien) > 1) {
                        $namaDepan = strtoupper($eplNamaPasien[0]);
                        unset($eplNamaPasien[0]);
                        $namaBelakang = strtoupper(implode(' ', $eplNamaPasien));
                        $namaPasienLbl = "<span style='font-size:46px'>$namaDepan</span><br><span style='font-size:28px'>$namaBelakang</span>";
                    } else
                        $namaPasienLbl = "<span style='font-size:50px'>$value[nm_pasien]</span>";

                    $aRacikTemp[$key]['nm_pasien_lbl'] = $namaPasienLbl;
                }
            }
        }
        $aRacikArr = empty($aRacikTemp) ? $aRacikArr : $aRacikTemp;



        if (isset($antrian_nracik)) {
            $antrian = array(
                'nonracik' => $aNRacik,
                'racik' => $aRacik,
                'nonracikArr' => $aNRacikArr,
                'racikArr' => $aRacikArr
            );
        }
        // prd($antrian);
        if (!isset($antrian)) {

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => 0,
                    'message' => 'data tidak ditemukan'
                ]));
        } else {

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => 1,
                    'message' => 'ok',
                    'data' => $antrian
                ]));
        }
    }

    public function getListResep() {
        $listResep = $this->M_antrian_farmasi->listResep(date('Y-m-d'))->result();
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => 1,
                'message' => 'ok',
                'data' => $listResep
            ]));
    }

    public function singkatan($namaPasien, $poli, $no_antri, $no_resep)
    {
        $singkatan = ['MCU', 'PDP', 'TB', 'THT'];
    }

    public function createAudioNRacik($namaPasien, $poli, $no_antri, $no_resep)
    {
        $namaPasien = str_replace('ny.', 'nyonya', $namaPasien);
        $namaPasien = str_replace('h.', 'haji', $namaPasien);
        $namaPasien = str_replace('hj.', 'hajah', $namaPasien);
        $textToTranslate = "pasien, obat Non Racik, $namaPasien, $poli, ditunggu di farmasi";
        $textToTranslate = htmlspecialchars($textToTranslate);
        $textToTranslate = rawurlencode($textToTranslate);
        file_put_contents("assets/sound/antrianNonRacik$no_resep.mp3", file_get_contents("https://translate.google.com/translate_tts?ie=UTF-8&tl=in&client=tw-ob&q=" . $textToTranslate . ""));
        // file_put_contents("C:\\xampp-php7.4.12\\htdocs\\antrian-farmasi\\assets\\sound\\antrianNonRacik$no_resep.mp3", file_get_contents("https://translate.google.com/translate_tts?ie=UTF-8&tl=in&client=tw-ob&q=" . $textToTranslate . ""));
        // file_put_contents("assets/sound/antrianNonRacik$no_resep.mp3", file_get_contents("https://translate.google.com/translate_tts?ie=UTF-8&tl=in&client=tw-ob&q=" . $textToTranslate . ""));
    }

    public function createAudioRacik($namaPasien, $poli, $no_antri, $no_resep)
    {
        $namaPasien = str_replace('ny.', 'nyonya', $namaPasien);
        $namaPasien = str_replace('h.', 'haji', $namaPasien);
        $namaPasien = str_replace('hj.', 'hajah', $namaPasien);
        $textToTranslate = "pasien, obat Racik, $namaPasien, $poli, ditunggu di farmasi";
        $textToTranslate = htmlspecialchars($textToTranslate);
        $textToTranslate = rawurlencode($textToTranslate);
        file_put_contents("assets/sound/antrianRacik$no_resep.mp3", file_get_contents("https://translate.google.com/translate_tts?ie=UTF-8&tl=in&client=tw-ob&q=" . $textToTranslate . ""));
        // file_put_contents("assets/sound/antrianRacik$no_resep.mp3", file_get_contents("https://translate.google.com/translate_tts?ie=UTF-8&tl=in&client=tw-ob&q=" . $textToTranslate . ""));
    }

    public function put_antrian_terpanggil()
    {

        $noResep = $this->input->post('noResep');
        $panggil_ulang = $this->input->post('panggil_ulang');

        $this->M_antrian_farmasi->upd_antrian_belumterpanggil($noResep, $panggil_ulang);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => 1,
                'message' => 'ok'
            ]));
    }


}
