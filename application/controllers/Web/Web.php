<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    public function page(){
        $page = $this->uri->segment(4);
        $this->db->select('page.*',['page_name'=>$page])->from('page');
        $data = $this->db->get();
        $result = $data->result_array();

        
        $this->load->view('Web/pagetemplate',['result'=> $result]);
    }
	

    public function userProfile()
    {
        $this->load->view('User/user-profile');
    }
    
}
?>