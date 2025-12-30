<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

if(!function_exists('curl_post')) {
    /**
     * @return array(http_code, result)
     */
    function curl_post($url, $postfield, $header = null) {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        if($header !== null) curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $postfield);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0); //disable

        $result =  json_decode(curl_exec($curl_handle), true);
        $http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        
        return array(
            "http_code" => $http_code,
            "result" => $result
        );
    }
}

/**
 * @return array
 */
if(!function_exists('curl_get')) {
    function curl_get($url, $header = null) {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        if($header !== null) curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, 0);
        
        $result =  json_decode(curl_exec($curl_handle), true);
        $http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        
        return array(
            "http_code" => $http_code,
            "result" => $result
        );
    }
}

?>