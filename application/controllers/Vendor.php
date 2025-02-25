<?php

class Vendor extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        if (!$this->session->userdata('userToken')) {
            $currentUrl = current_url();
            $queryString = $_SERVER['QUERY_STRING'];
            if (!empty($queryString)) {
                $currentUrl .= '?' . $queryString;
            }
            $redirectUrl = urlencode($currentUrl);
            $this->session->set_userdata('redirect', $redirectUrl);
            redirect('Welcome/loginpage');
        }

    }

    public function seller()
    {
        $data['category'] = $this->db->select('categories.*')->from('categories')->where(['is_deleted'=>1,'is_parent'=>1])->get()->result_array();
        $data['countries'] = $this->db->select('countries.*')->from('countries')->where(['is_active'=>1])->get()->result_array();
        // echo'<pre>';
        // print_r($data);
        // exit;
        $this->load->view('User/becomevendor',['data'=>$data]);
    }



    public function save_vendor()
    {
        $token = $this->session->userdata('userToken');
        $this->load->model('UserModel');
        $userd = $this->UserModel->get_user($token);
        $user_id = $userd['UserID'];
        $data = $this->input->post();
        $this->load->library('upload');
        $uploaded_file = null;
        if (isset($_FILES['vendor_image']) && $_FILES['vendor_image']['error'] == 0) {
            $config['upload_path']   = './uploads/vendorimages/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';        
            $config['max_size']      = 2048;
            $config['file_name']     = time() . '_' . rand(100,999);
            
            $this->upload->initialize($config);
            if ($this->upload->do_upload('vendor_image')) {
                // On success, get file data
                $uploaded_file = $this->upload->data();
                $vendor_image = $uploaded_file['file_name']; // Save file name to data array
            } else {
                // On failure, capture the error message
                $upload_error = $this->upload->display_errors();
                echo "File upload failed: " . $upload_error;
                exit; // Stop execution if file upload fails
            }
        }
        $formatedData = [
            'vendor_name'=>$data['vendor_name'],
            'vendor_company'=>$data['vendor_company'],
            'vendor_email'=>$data['vendor_email'],
            'vendor_phone'=>$data['vendor_phone'],
            'vendor_gst'=>$data['vendor_gst'],
            'vendor_pan_number'=>$data['vendor_pan_card'],
            'vendor_country'=>$data['vendor_country'],
            'vendor_city'=>$data['vendor_city'],
            'vendor_state'=>$data['vendor_state'],
            'vendor_postcode'=>$data['vendor_postcode'],
            'vendor_address'=>$data['vendor_address'],
            'vendor_about'=>$data['vendor_about'],
            'user_id'=>$user_id,
        ];
        if($vendor_image){
            $formatedData['vendor_image']= $vendor_image;
        }

            $this->db->insert('vendors', $formatedData); 
            $id = $this->db->insert_id();

            $this->session->set_userdata('vendor_app_id',$id);
            $this->session->set_userdata('vendor_exp',time()+300);
            if ($id) {
                $categories = [];
                foreach ($data['categories'] as $cat) {
                    $categories['vendor_id'] = $id;
                    $categories['category_id'] = $cat;
                }
                $this->db->insert('vendor_categories', $categories); 
                $cid = $this->db->insert_id();
                if ($cid) {
                    echo json_encode(['status'=>'success','message'=>'details saved successfully','id'=>$id]);
                }else echo json_encode(['status'=>'failed','message'=>'something went wrong']);
            }




    
    }

    public function saveBank()
    {
        $data = $this->input->post();
        // print_r($data);
        // exit;

        $data['vendor_id'] = $this->session->userdata('vendor_app_id');
        //print_r($data);
        if(isset($data['vendor_id'])&&!empty($data['vendor_id'])){
            $this->load->model('AdminModel');
        $res = $this->AdminModel->saveVendorAccount($data);
        if($res){
            echo json_encode(['status'=>'success','message'=>$res]);
        }else{
            echo json_encode(['status'=>'failed','message'=>'something went wrong']);
        }
        // print_r($data);
        // exit;
    }
}



public function saveSignature()
{

    $uploaded_file = null;
    if (isset($_FILES['signature_document']) && $_FILES['signature_document']['error'] == 0) {
        $config['upload_path']   = './uploads/signature/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';        
        $config['max_size']      = 2048;
        $config['file_name']     = time() . '_' . rand(100,999);
        
        $this->upload->initialize($config);
        if ($this->upload->do_upload('signature_document')) {
            // On success, get file data
            $uploaded_file = $this->upload->data();
            $signature_document = $uploaded_file['file_name']; // Save file name to data array
        } else {
            // On failure, capture the error message
            $upload_error = $this->upload->display_errors();
            echo "File upload failed: " . $upload_error;
            exit; // Stop execution if file upload fails
        }
    }
    $data = $this->input->post();
    // print_r($data);
    // exit;
    $data['signature_document'] = $signature_document;
    $data['vendor_id'] = $this->session->userdata('vendor_app_id');
    if(isset($data['vendor_id'])&&!empty($data['vendor_id'])){
        $this->load->model('AdminModel');
        // print_r($data);
        // exit;
    $res = $this->AdminModel->saveSignature($data);
    if($res){
        echo json_encode(['status'=>'success','message'=>$res]);
    }else{
        echo json_encode(['status'=>'failed','message'=>'something went wrong']);
    }
    
}
}






}


?>