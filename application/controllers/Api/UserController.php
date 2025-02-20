<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';
// use Restserver\Libraries\REST_Controller;
use chriskacerguis\RestServer\RestController;

class UserController extends RestController {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }
    public function user_get() 
    {
        $user = new UserModel();
        $result = $user->get_user();
        $this->response($result,200);
    }
    public function userCheck_post() 
    {   $mnumber = $this->input->get('mnumber');
        $data = array(
            'PhoneNumber' => $mnumber
        );
        $this->session->set_userdata('te_user',$mnumber);
        $user = new UserModel();
        $result = $user->post_user($data);
        if($result){
        $this->session->set_userdata('message','OTP sent');
        echo $this->session->userdata('message');
        }else{
            echo 'something went wrong';
        }
    }
    public function verifyOTP_post()
    {
        if($se_otp = $this->session->userdata('se_otp')){
        $in_otp = $this->input->get('otp_in');
      
        
        if($in_otp == $se_otp){
            $this->session->unset_userdata('se_otp');
            $te_user = $this->session->userdata('te_user');
            $token =  $this->auth($te_user);
            $this->session->set_userdata('userToken',$token);
            $this->session->unset_userdata('te_user');
            
            
        }else{
            echo 'wrong OTP';
        }
    }else
    {
        return $this->response('Enter mobile number first' ,200);
    }
    }        
    public function auth($te_user){
        $jwt = new JWT();
        $JwtSecretKey  = 'mysecret';
        $data = $this->db->select('users.*')->where('PhoneNumber',$te_user)->from('users')->get()->result_array();//userid,tokengeneratedtime,expirytime
        $token = $jwt->encode($data,$JwtSecretKey,'HS256');
        return $token;
    }
}

?>