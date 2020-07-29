<?php

/* --cara menggunakan --
1. pada class REST anda harus me require :
    require APPPATH . '/libraries/REST_Controller.php';
    require_once APPPATH . '/libraries/JWT.php';
2. include class TokenManager di bawah requred library sehingga menjadi :
    require APPPATH . '/libraries/REST_Controller.php';
    require_once APPPATH . '/libraries/JWT.php';
    include 'TokenManager.php';
3. sekarang anda dapat membuat object dari class TokenManager, misal :
    $tokenManager = new TokenManager();
    $this->tokenValidation = $tokenManager->validateToken($this->token);
4. anda bisa lihat contoh pada class REST Profile.php
5. selesai */

class TokenManager {
    
    public function __construct() {
        error_reporting(E_ERROR);
    }
    
    public function validateToken($token) {
        /*   --- validasi token ---
        apabila token KOSONG atau EXPIRE maka request akan BERHENTI disini 
        alias gak akan lanjut ke method2 yang akan diakses
        alur eksekusinya seperti ini :
        request client -> constructor -> function/method 
        */
        
        # 1 cek token apakah kosong atau gak
        if(!$token) {
            $data = array(
    			"status" => false,
    			"pesan" => "token tidak boleh kosong",
    			"data" => null
    		);
            $responseType = REST_Controller::HTTP_NOT_FOUND;
        }
        
        # 2 cek token expire/valid atau gak
        $date = new DateTime();
        try {
            $cek = JWT::decode($token, "trivia");
            if ($date->getTimestamp() > $cek->exp) {
                $data = array(
                    "status" => false,
                    "pesan" => "Expired token",
                    "data" => null);
                $responseType = REST_Controller::HTTP_UNAUTHORIZED;
            } else {
                $data = array(
                    "status" => true,
                    "pesan" => "token valid",
                    "data" => null);
                $responseType = "";
            }
        } catch (Exception $e) {
            $data = array(
                "status" => false,
                "pesan" => "Invalid Tokensssss",
                "data" => null);
            $responseType = REST_Controller::HTTP_BAD_REQUEST;
        }
        
        $value = array(
            'data' => $data,
            'code' => $responseType
            );
            
        return $value;
    }
}
?>