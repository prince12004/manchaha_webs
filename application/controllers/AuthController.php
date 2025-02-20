<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	public function index()
	{
		echo 'hello';
	}
    public function auth($te_user){
        $jwt = new JWT();
        $JwtSecretKey  = 'mysecret';
        $data = $this->db->select('users.*')->where('PhoneNumber',$te_user)->get()->result-array();
        $token = $jwt->encode($data,$JwtSecretKey,'HS256');
        return $token;
    }
    public function decodeToken()
    {
        $token = $this->uri->segment(3);
        $jwt = new JWT();
        $JwtSecretKey = 'mysecret';
        $decodeToken = $jwt->decode($token,$JwtSecretKey,'HS256');
        $token1 = $jwt->jsonEncode($decodeToken);
        echo $token1;
    }
}