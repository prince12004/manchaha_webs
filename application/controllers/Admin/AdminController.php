<?php
require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class AdminController extends RestController
{
    public function __construct()
    {
        parent::__construct();
        if($token = $this->session->userdata('user'))
        {
            $jwt = new JWT();
            $JwtSecretKey = 'mysecret';
            $decodeToken = $jwt->decode($token,$JwtSecretKey,'HS256');
            foreach($decodeToken as $decode){
            if(!$decode->user == 2){
                return 'Unauthorised User';
            }
        }
        }
    }
    public function Orders_get()
    {
        $this->load->model('AdminModel','am');
        $orders = $this->am->getAllOrders();
        print_r($orders);
    }
    public function Customers_get()
    {
        $this->load->model('AdminModel','am');
        $customers = $this->am->getCustomers();
        print_r($customers);
    }

}

?>