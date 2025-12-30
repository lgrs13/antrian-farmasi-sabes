<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_day_name_by_date')) {
    function get_day_name_by_date($date) {

        $day = date('D', strtotime($date));
        $day_list = array(
            "Mon" => "SENIN",
            "Tue" => "SELASA",
            "Wed" => "RABU",
            "Thu" => "KAMIS",
            "Fri" => "JUMAT",
            "Sat" => "SABTU",
            "Sun" => "MINGGU"
        );
        return $day_list[$day];
    }
}

if(!function_exists('get_month_name_by_date')) {
    function get_month_name_by_date($date) {

        $month = date('n', strtotime($date)) - 1;
        $list_nm_bulan = array(
            array(
                'k' => 1,
                'v' => 'JANUARI'
            ),
            array(
                'k' => 2,
                'v' => 'FEBRUARI'
            ),
            array(
                'k' => 3,
                'v' => 'MARET'
            ),
            array(
                'k' => 4,
                'v' => 'APRIL'
            ),
            array(
                'k' => 5,
                'v' => 'MEI'
            ),
            array(
                'k' => 6,
                'v' => 'JUNI'
            ),
            array(
                'k' => 7,
                'v' => 'JULI'
            ),
            array(
                'k' => 8,
                'v' => 'AGUSTUS'
            ),
            array(
                'k' => 9,
                'v' => 'SEPTEMBER'
            ),
            array(
                'k' => 10,
                'v' => 'OKTOBER'
            ),
            array(
                'k' => 11,
                'v' => 'NOVEMBER'
            ),
            array(
                'k' => 12,
                'v' => 'DESEMBER'
            )
        );
        return $list_nm_bulan[$month]['v'];
    }
}

if(!function_exists('change_format_date')) {
    function change_format_date($date, $format) {

        return date($format, strtotime($date));
    }
}

if(!function_exists('get_date')) {
    function get_date($format = 'Y-m-d') {
        date_default_timezone_set("Asia/Jakarta");
        return date($format);
    }
}

if(!function_exists('get_time')) {
    function get_time($format = 'H:i:s') {
        date_default_timezone_set("Asia/Jakarta");
        return date($format);
    }
}

if(!function_exists('get_cur_datetime')) {
    function get_cur_datetime($format = 'Y-m-d H:i:s') {
        date_default_timezone_set("Asia/Jakarta");
        return date($format);
    }
}

if(!function_exists('to_timestamp')) {
    function to_timestamp($datetime) {
        date_default_timezone_set("Asia/Jakarta");
        return (new DateTime($datetime))->getTimestamp();
    }
}

if(!function_exists('to_datetime')) {
    function to_datetime($timestamp) {
        date_default_timezone_set("Asia/Jakarta");
        $datetime =  new DateTime();
        $datetime->setTimestamp($timestamp);
        return $datetime->format('Y-m-d H:i:s');
    }
}

if(!function_exists('validangka')) {
    function validangka($angka){
        if (isset($angka)) {
            if(!is_numeric($angka)) {
                return 0;
            }else{
                return $angka;
            }
        }else{
            return 0;
        }
    }
}

/**
 * @return array(year, month, day)
 */
if(!function_exists('get_ages_from_date')) {
    function get_ages_from_date($from, $to) {
        $from = new DateTime($from);
        $to = new DateTime($to);
        $interval = $to->diff($from);
        return array(
            "year" => $interval->y,
            "month" => $interval->m,
            "day" => $interval->d
        );
    }
}

if(!function_exists('get_days_by_two_dates')) {
    function get_days_by_two_dates($from, $to) {
        $from = new DateTime($from);
        $to = new DateTime($to);
        $interval = $to->diff($from);
        return $interval->days;
    }
}
?>