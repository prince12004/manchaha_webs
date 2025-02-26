<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Ship.php';

class User extends Ship
{

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('Shiprocket');
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
    

    public function profile()
    {   
        $token = $this->session->userdata('userToken');
        $this->load->model('UserModel');
        $data = $this->UserModel->get_user($token);
		$data['addresses'] = $this->UserModel->get_addresses($data['UserID']);
        $cate['CategoryDescription'] = 'Profile';
        $this->load->view('User/header',['cat'=>$cate]);
        $this->load->view('User/user-profile',['data'=>$data]);
    }

    // public function upload_image()
    // {
    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //     $config['max_size'] = 2048;
    //     $config['file_name'] = time() . '_' . $_FILES['image']['name'];

    //     $this->load->library('upload', $config);
    //     if ($this->upload->do_upload('image')) {
    //         $uploadData = $this->upload->data();
    //         $imagePath = 'uploads/' . $uploadData['file_name'];
    //         echo 'Image uploaded successfully: <a href="' . base_url($imagePath) . '">View Image</a>';
    //     } else {
    //         // Show upload error
    //         $error = $this->upload->display_errors();
    //         echo 'Failed to upload image: ' . $error;
    //     }
    // }
    public function editUser()
    {         
        $this->load->library('upload');
        $token = $this->session->userdata('userToken');
        $this->load->model('UserModel');
        $tokenID = $this->UserModel->decodeToken($token);
        $UserID = $tokenID[0]->UserID;

        $config['upload_path'] = FCPATH . 'uploads/'; // 
        $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed types
        $config['max_size'] = 2048; // Max size in KB (2MB)
        $config['file_name'] = time() . '_' . $_FILES['image']['name']; 
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $imagePath = 'uploads/' . $uploadData['file_name'];
        } else {
            $error = $this->upload->display_errors();
            echo 'Failed to upload image: ' . $error;
        }
        $data = array(
            'name'=> $this->input->post('name'),
            'email'=>$this->input->post('email'),
            'birth_date'=>$this->input->post('birth_date'),
            'city'=>$this->input->post('city'),
            'address'=>$this->input->post('address'),
            'gender'=>$this->input->post('gender'),
            'image'=>$imagePath
        );
        $this->db->set($data);
        $this->db->where('UserID', $UserID);
        $this->db->update('users');
        $result = $this->db->affected_rows();
        if($result){
            $this->session->set_userdata('message','Details Saved Successfully');
            return redirect('Web/User/User/profile');
        }
        
    }
    public function cart()
    {
        $token = $this->session->userdata('userToken');
        $this->load->model('UserModel');
        $data = $this->UserModel->getCart($token);
        // echo'<pre>';
        // print_r($data);
        // exit;

        $cate['CategoryDescription'] = 'My Cart';
        $this->load->view('User/header',['cat'=>$cate]);
        $this->load->view('User/myCart',['data'=>$data]);   
    }

    public function wishlist()
    {
        $token = $this->session->userdata('userToken');
        $this->load->model('UserModel');
        $data = $this->UserModel->getWishlist($token);
        // print_r($data);
        // exit;
        $cate['CategoryDescription'] = 'Wishlist';
        $this->load->view('User/header',['cat'=>$cate]);
        $this->load->view('User/wishlist',['data'=>$data]);   
    }

    public function addCart()
    {
        $json = $this->input->post();
        $this->load->model('UserModel');
        $insert_id = $this->UserModel->addToCart($json);
        if($insert_id){
            echo json_encode(['status'=>'success','message'=>'Product Added To Cart']);
        }else echo json_encode(['status'=>'failed','message'=>'Something Went Wrong']);  
    }

    public function addTocart($jwellary_id,$varient_id,$quantity)
    {
    
        $data = [
            'jwellary_id'=>$jwellary_id,
            'varient_id'=>$varient_id,
            'quantity'=>$quantity
        ];
        $id = $this->UserModel->addToCart($data);
        return redirect('Web/User/User/cart');

    }
	
	
	
    public function saveAddress()
    {
        $data =[
        'name'=> $this->input->post('fullName'),
        'phone'=>$this->input->post('phone'),
        'email'=>$this->input->post('email'),
        'city'=>$this->input->post('city'),
        'apartment'=>$this->input->post('apartment'),
        'streetAddress'=>$this->input->post('street'),
        'user_id'=>$this->input->post('user_id'),
        ];
        $res = $this->UserModel->saveAddress($data);
        if($res){
            echo json_encode(['status'=>'success','message'=>'Address Saved SuccessFully']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Something Went Wrong']);
        }
        
    }

    public function paymentpage()
    {
        // Step 1: Retrieve user token and validate session
        $token = $this->session->userdata('userToken');
        if (!$token) {
            show_error('User not authenticated. Please log in again.');
            return;
        }
    
        $userData = $this->UserModel->get_user($token);
        if (!$userData) {
            show_error('User data not found.');
            return;
        }
    
        $cart = $this->session->userdata('cartData');
        if (empty($cart)) {
            show_error('Your cart is empty.');
            return;
        }
    
        $details = [];
        foreach ($cart as $products) {
            $product = $this->UserModel->getCompleteData($products);
            if ($product) {
                $product['quantity'] = $products['quantity'];
                $details[] = $product;
            }
        }
        $addresses = $this->UserModel->get_addresses($userData['UserID']);
        $productDetails['addresses'] = $addresses;
        $productDetails['product'] = $details;
        $this->load->view('User/paymentpage', ['productdetails' => $productDetails]);
    }
    
    

    public function addToWishlist()
    {
        $varient_id = $this->input->post('varient_id');
        $jwellary_id = $this->input->post('jwellary_id');
        $token = $this->session->userdata('userToken');
        $this->load->model('UserModel');
        $data = $this->UserModel->get_user($token);
        $details = array(
            'varient_id' => $varient_id,
            'productID' => $jwellary_id,
            'userID' => $data['UserID']
        );
        $res = $this->UserModel->addToWishlist($details);
        if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Product added to wishlist']);
        } else {
            echo json_encode(['status' => 'failed', 'message' => 'Something went wrong']);
        }
    }
    public function addWishlist($jwellary_id,$varient_id)
    {
        $token = $this->session->userdata('userToken');
        $this->load->model('UserModel');
        $data = $this->UserModel->get_user($token);
        $details = array(
            'varient_id' => $varient_id,
            'productID' => $jwellary_id,
            'userID' => $data['UserID']
        );
        $res = $this->UserModel->addToWishlist($details);
        if ($res) {
            return redirect('Wishlist');
        }
    }



    public function removeWishlist()
    {
        $json = $this->input->post(); // Fetch the POST data
        $res = $this->db->set('is_deleted', 2) // Set 'is_deleted' to 2
                        ->where('varient_id', $json['varient_id']) // Add where clause for variant ID
                        ->update('wishlist'); // Update the 'wishlist' table
    
        if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Removed from wishlist']);
        } else {
            echo json_encode(['status' => 'failed', 'message' => 'Something went wrong']);
        }
    }
    


    public function saveCartData() {
        // Get the cart data from the POST request
        $cartData = $this->input->post('cartData');
        //print_r($cartData);
    
        // Save the cart data in session
        $this->session->set_userdata('cartData', $cartData);
    
        echo json_encode(['status' => 'success']);
    }
    

    public function Address()
    {
        // Step 1: Validate if the user is logged in (if applicable)
        $token = $this->session->userdata('userToken');
        if (!$token) {
            echo json_encode(['message' => 'error', 'error' => 'User not authenticated.']);
            return;
        }
        // Load the UserModel and get user details based on the token
        $this->load->model('UserModel');
        $data = $this->UserModel->get_user($token);
        // print_r($data);
        // exit;
    
        // Step 2: Get the form data from the request
        $addressData = [
            'user_id' => $data['UserID'],  
            'streetAddress' => $this->input->post('streetAddress'),
            'city' => $this->input->post('city'),
            'email' => $this->input->post('email'),
            'pincode' => $this->input->post('pincode'),
            'apartment' => $this->input->post('apartment'),
            'phone' => $this->input->post('phone'),
            'name' => $this->input->post('name'),
            'state'=>$this->input->post('state'),
        ];
        $addressSaved = $this->UserModel->saveUserAddress($addressData);
    
        // Step 4: Respond with a success or failure message
        if ($addressSaved) {
            echo json_encode(['message' => 'success', 'data' => $addressData]);
        } else {
            echo json_encode(['message' => 'error', 'error' => 'Failed to save address.']);
        }
    }

    public function payment()
    {
        // Authenticate user
        $token = $this->session->userdata('userToken');
        if (!$token) {
            echo json_encode(['status' => 'error', 'message' => 'User not authenticated.']);
            return;
        }
    
        $this->load->model('UserModel');
        $customer = $this->UserModel->get_user($token);
        if (!$customer) {
            echo json_encode(['status' => 'error', 'message' => 'User details not found.']);
            return;
        }
    
        // Validate cart and address
        $charges = $this->input->post();
        $cart = $this->session->userdata('cartData');
        if (empty($cart)) {
            echo json_encode(['status' => 'error', 'message' => 'Cart is empty.']);
            return;
        }
    
        $address = $this->db->select('*')->from('address')->where('id', $charges['deliveryAddress'])->where('show_hide', 1)->get()->row_array();
        if (!$address) {
            echo json_encode(['status' => 'error', 'message' => 'Address not found.']);
            return;
        }
    
        // Prepare shipment data
        $details = [];
        $vars = [];
        foreach ($cart as $products) {
            $product = $this->UserModel->getCompleteData($products);
            if ($product) {
                $product['quantity'] = $products['quantity'];
                $details[] = $product;
                $vars[] = $product['varient_id'];
            } else {
                log_message('error', "Product data not found for: " . json_encode($products));
            }
        }
    
        $send = [
            'customer' => $customer,
            'charges' => $charges,
            'details' => $details,
            'address' => $address,
            'channel_id' => '5787388',
        ];
    
        // Process shipment
        $shipmentData = $this->processShip($send);
        if (!$shipmentData) {
            echo json_encode(['status' => 'error', 'message' => 'Shipment creation failed.']);
            return;
        }
    
        // Save orders
        $save = [];
        foreach ($shipmentData as $products) {
            $fiproduct = $this->UserModel->getCompleteData($products);
            if ($fiproduct) {
                $save[] = $this->prepareFinalProductData($products, $fiproduct, $charges, $customer);
                if ($charges['payment_type']=='cod') {
                    $save['cod_charge'] == '40';
                }
            } else {
                log_message('error', "Product data not found for shipment: " . json_encode($products));
            }
        }
    
        if (!empty($save)) {
            $id = $this->UserModel->saveOrder($save);
            if ($id) {
                $this->UserModel->updateCart($vars);
                echo json_encode(['status' => 'success', 'message' => 'Order placed successfully.']);
                return;
            }
        }
    
        echo json_encode(['status' => 'error', 'message' => 'Error saving order details.']);
    }
    
    // Helper method to prepare final product data
    private function prepareFinalProductData($products, $fiproduct, $charges, $customer)
    {
        $finalproduct = [
            'quantity' => $products['quantity'],
            'order_id' => $products['order_id'],
            'shipment_id' => $products['shipment_id'],
            'varient_id' => $products['varientID'],
            'product_id' => $products['productID'],
            'address_id' => $charges['deliveryAddress'],
            'user_id' => $customer['UserID'],
            'amount' => $fiproduct['sale_price'],
            
        ];

        $finalproduct['payment_status'] = ($charges['payment_type'] === 'Prepaid') ? '1' : '2';
        $finalproduct['payment_type'] = ($charges['payment_type'] === 'Prepaid') ? '1' : '2';
        if ($charges['payment_type'] === 'prepaid') {
            $tokenID = $this->UserModel->decodeToken($this->session->userdata('userToken'));
            $user_id = $tokenID[0]->UserID;
            $pay = [
                "user_id" => $user_id,
                "payment_id" => $charges['payment_id'] ?? '',
                "order_id" => $charges['order_id'] ?? '',
                "signature" => $charges['signature'] ?? '',
                "code" => $charges['code'] ?? '',
                "message" => $charges['message'] ?? '',
                "total"=> $charges['total'] ?? '',
            ];
            $pay_id = $this->db->insert('payments', $pay)->insert_id();

            $finalproduct['cod_charge'] = 0;
            $finalproduct['payment'] = $pay_id;
        }else {
            $finalproduct['cod_charge'] = 40;
        }
    
        return $finalproduct;
    }
    
    
    

public function processShip($data)
{
    $shippingRes = []; // Change variable name from $shipingRes to $shippingRes for clarity
  
    // Loop through each product in the shipment details
    foreach ($data['details'] as $product) {
        // Prepare shipment payload
        $sendData = $this->prepareShipmentPayload($data, $product);

        // Call the shipment API (shipm is presumably a method for calling Shiprocket API)
        $res = $this->shipm($sendData);

        // Add product-specific details to the response
        $res['product_name'] = $sendData['order_items'][0]['name'];  // Corrected
        $res['price'] = $sendData['order_items'][0]['selling_price'];   // Corrected
        $res['varientID'] = $product['varient_id'];
        $res['productID'] = $product['id'];
        $res['quantity'] = $product['quantity'];

        // Store the response for each product
        $shippingRes[] = $res;
    }

    // Add total charges after the loop
    $total = ['total' => $data['charges']['total']]; // Corrected to match array structure
    
    if($data['charges']['payment_type'] == 'cod'){
        $carge = 40;
    }
    // Call the sendMail method with the updated response data
    $this->sendMail($shippingRes,$total,$carge);  // Ensure that sendMail expects the correct data structure

    return $shippingRes;  // Return the response for the process
}

    // Helper function to prepare shipment payload
    private function prepareShipmentPayload($data, $product)
    {
        $parts = explode('X', $product['dimensions']);

        // Ensure there are exactly three parts (length, width, height)
        if (count($parts) === 3) {
            
                $length =   $parts[0];
                $weidth = $parts[1];
                $height = $parts[2];
     
        }
        return [
            "order_id" => $this->generateInvoiceNumber($data['charges']['payment_type']),
            "order_date" => $this->getCurrentTime(),
            "pickup_location" => "Work",
            "channel_id" => $data['channel_id'],
            "comment" => $data['comment'] ?? "NA",
            "billing_customer_name" => $data['address']['name'],
            "billing_last_name" => $data['address']['last_name'] ?? " ",
            "billing_address" => $data['address']['apartment'] ?? " ",
            "billing_address_2" => $data['address']['streetAddress'] ?? " ",
            "billing_isd_code" => "+91",
            "billing_city" => $data['address']['city'],
            "billing_pincode" => $data['address']['pincode'],
            "billing_state" => $data['address']['state'] ?? "Uttar Pradesh",
            "billing_country" => $data['address']['country'] ?? "India",
            "billing_email" => $data['address']['email'],
            "billing_phone" => $data['address']['phone'],
            "billing_alternate_phone" => $data['address']['alternate_number'] ?? " ",
            "shipping_is_billing" => false,
            "shipping_customer_name" => $data['address']['name'],
            "shipping_last_name" => $data['address']['last_name'] ?? " ",
            "shipping_address" => $data['address']['apartment'] ?? " ",
            "shipping_address_2" => $data['address']['streetAddress'] ?? " ",
            "shipping_city" => $data['address']['city'],
            "shipping_pincode" => $data['address']['pincode'],
            "shipping_country" => $data['address']['country'] ?? "India",
            "shipping_state" => $data['address']['state'] ?? "UTTAR PRADESH",
            "shipping_email" => $data['address']['email'],
            "shipping_phone" => $data['address']['phone'],
            "order_items" => [
                [
                    "name" => $product['jwellary_name'],
                    "sku" => $product['varient_sku'],
                    "units" => $product['quantity'],
                    "selling_price" => ($product['sale_price']+(($product['sale_price']*$product['applicable_tax'])/100)),
                    "discount" => isset($product['discounts']) ? $product['discounts'] : 0,
                    "tax" => isset($product['applicable_tax']) ? $product['applicable_tax'] : 0,
                    "hsn" => $product['hsn'],
                ]
            ],
            "payment_method" => $data['charges']['payment_type'],
            "shipping_charges" => $data['charges']['gst'],
            "giftwrap_charges" => $data['charges']['giftwrap_charges'] ?? "0",
            "transaction_charges" => $data['charges']['transaction_charges'] ?? "0",
            "total_discount" => $data['charges']['total_discount'] ?? "0",
            "sub_total" => ($product['sale_price']+(($product['sale_price']*$product['applicable_tax'])/100))*$product['quantity'],
            "shipping_charges" => ($data['charges']['payment_type'] == 'COD')  ? 40 : 0,
			"total_shipping_charge"=>($data['charges']['payment_type'] == 'COD')  ? 40 : 0,
			"total_order_value"=>((($product['sale_price']+(($product['sale_price']*$product['applicable_tax'])/100))*$product['quantity'])+($data['charges']['payment_type'] == 'COD')  ? 40 : 0),
            "length" => $length ?? "6",
            "breadth" => $weidth ?? "2",
            "height" => $height ?? "8",
            "weight" => $product['weight'] / 1000,
            "ewaybill_no" => $this->generateInvoiceNumber($data['charges']['payment_type']),
            "customer_gstin" => $data['customer_gstin'] ?? "",
            "invoice_number" => $this->generateInvoiceNumber($data['charges']['payment_type']),
            "order_type" => "NON ESSENTIALS",
        ];
    }
    
    

    public function getCurrentTime()
{
    // Set the default timezone
    date_default_timezone_set('Asia/Kolkata'); // Adjust based on your timezone

    // Get current time in the desired format
    $current_time = date('Y-m-d H:i');

    return $current_time;
}

function generateInvoiceNumber($paymentMode) {
    $timestamp = time();
    $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $invoiceNumber = "{$paymentMode}_{$timestamp}_{$randomNumber}";
    return $invoiceNumber;
}




public function deleteFromCart()
{
    $cart = $this->input->post();
    // print_r($cart);
    // exit;
    $tokenID = $this->UserModel->decodeToken($this->session->userdata('userToken'));
    $user_id = $tokenID[0]->UserID;
    $data['user_id'] = $user_id;
    $data['varient_id'] = $cart['product_id'];
    $res = $this->UserModel->deleteFromCart($data);
    if($res){
        echo json_encode(['status'=>'success','message'=>'product deleted from cart']);
    }else echo json_encode(['status'=>'failed','message'=>'Something Went Wrong']);
}


public function logout()
{
    $this->session->unset_userdata('redirect');
    $this->session->unset_userdata('user_mobile');
    $this->session->unset_userdata('userToken');
    return redirect('welcome/loginpage');
}


public function order_history()
{
    // Get the token from session
    $token = $this->session->userdata('userToken');
    
    // Load necessary models
    $this->load->model('UserModel');
    
    // Decode the token to get UserID
    $tokenID = $this->UserModel->decodeToken($token);
    $UserID = $tokenID[0]->UserID;
    
    // Get order history for the user
    $data = $this->UserModel->getOrderHistory($UserID);

    // Load Shiprocket library
    
    
    // Iterate through each order in the history and fetch tracking details for each shipment
    foreach ($data as &$order) { // Using reference to modify the original array directly
        // Ensure 'shipment_id' is available in the order
        if (isset($order['shipment_id'])) {
            // Track the shipment using Shiprocket's trackShipment method
            $track = $this->shiprocket->trackShipment($order['shipment_id']);
            
            // Add the tracking details to the current order
            $order['track'] = $track;
        }
    }

    // // Output the updated data for debugging
    // echo '<pre>';
    // print_r($data);
    // exit;
    
    // Load the view and pass the order data with shipment tracking details
    $cate['CategoryDescription'] = 'Order History';
    $this->load->view('User/header',['cat'=>$cate]);
    $this->load->view('User/myorder', ['order' => $data]);
}



public function cancelOrder()
{
    $data = $this->input->post();
    // print_r($data);
    // exit;
    $can = $this->cancelShip($data['orderid']);

    //if($can['status_code']===200){
    $res = $this->UserModel->cancelOrder($data['orderid']);

    if($res){

        $orderdta = $this->db->select('orders.*')->from('orders')->where('order_id',$data['orderid'])->get()->row_array();

        $address = $this->db->select('address.email')->from('address')->where('id',$orderdta['address_id'])->get()->row_array();

        $address['orderid'] = $data['orderid'];
        $emaildata['message'] = $this->load->view('emails/cancelorder', $address, true);
        $emaildata['to'] = $address['email'];
        $emaildata['subject'] = 'Order Cancellation';
        send_mail($emaildata);

        echo json_encode(['status'=>'success','message'=>'Order Cancelled Successfully']);
    }else echo json_encode(['status'=>'fail','message'=>'Something Went Wrong']);
//}
    
}




public function deleteAddress()
{
    $input = json_decode(file_get_contents('php://input'), true);
    $response = $this->UserModel->deleteAddress($input['id']);
    if($response){
        echo json_encode(['status'=>'success','message'=>'Address Deleted Successfully']);
    }else{
        echo json_encode(['status'=>'success','message'=>'Something went wrong!']);
    }
}

public function editAddress()
{
    $input = json_decode(file_get_contents('php://input'), true);
    $data = $this->UserModel->getAddress($input['id']);
    if($data){
        echo json_encode(['status'=>'success','message'=>$data]);
    }else echo json_encode(['status'=>'failed','message'=>'something went wrong']);
}

public function updateAddress()
{
    $input = $this->input->post();
    $upData = [
        'name'=>$input['name'],
        'phone'=>$input['phone'],
        'email'=>$input['email'],
        'city'=>$input['city'],
        'apartment'=>$input['apartment'],
        'pincode'=>$input['pincode'],
        'state'=>$input['state'],
        'streetAddress'=>$input['streetAddress'],

    ];
    $data = $this->UserModel->updateAddress($upData,$input['addid']);
    if($data){
        echo json_encode(['status'=>'success','message'=>'Address Updated']);
    }else echo json_encode(['status'=>'failed','message'=>'something went wrong']);
    
}



public function orderstatus($id)
{

    
    
    $order = $this->UserModel->getOrder($id);
    $track = $this->trackorder($order['order_id']);
    $tracking = $this->trackingdata($order['order_id']);
    $track = $this->trackorder($order['order_id']);
    $tracking = $this->trackingdata($order['order_id']);

        $data['trackingdata'] = $tracking;
        $data['order'] = $order;
        $data['track'] = $track;
        // echo "<pre>";
        // print_r($data);
        // exit;
        $cate['CategoryDescription'] = 'Order Status';
    $this->load->view('User/header',['cat'=>$cate]);
    $this->load->view('User/orderstatus',['trackdata'=>$data]);

    
}



public function makereturn()
{
    $data = $this->input->post();
   $this->session->set_userdata('return_order_id',$data['order_id']);
   $this->session->set_userdata('return_user_id',$data['user_id']);
    return;
}


public function generate_invoice($id) {
    require_once FCPATH . 'vendor/autoload.php';
    $order = $this->UserModel->getOrder($id);
    $track = $this->trackorder($order['order_id']);
    $tracking = $this->trackingdata($order['order_id']);
    $data['trackingdata'] = $tracking;
    $data['order'] = $order;
    $data['track'] = $track;
    $data['trackdata'] = $data;
    $html = $this->load->view('User/invoice', $data, true);
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_top' => 10,
        'margin_bottom' => 10,
        'margin_left' => 10,
        'margin_right' => 10
    ]);
    $mpdf->SetTitle("Invoice #" . $id);
    $mpdf->SetAuthor("Mnnchaha");
    $html = str_replace('src="assets/', 'src="'.base_url().'assets/', $html);
    $mpdf->WriteHTML($html);
    $mpdf->Output('invoice_'.$id.'.pdf', 'D');
}

	
public function sendMail($data,$total,$ptypr)
{
    // Get user details
    $token = $this->session->userdata('userToken');
    $user = $this->UserModel->get_user($token);
    
    // Extract user data
    $name = $user['name'];
    $email = $user['Email'];
    $order_date = date('d/m/Y h:i A');

    // Prepare email content
    $email_content = "
    <html>
    <head>
        <title>Order Confirmation - Mnnchaha</title>
    </head>
    <body>
        <p>Dear $name,</p>
        
        <p>Thank you for your purchase from Mnnchaha! We are happy to confirm your order.</p>
        
        <p><strong>Order Confirmation:</strong></p>
        <p>Date: <strong>$order_date</strong></p>

        <p><strong>Order Details:</strong></p>
        <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>";
            
            // Loop through each product and add it to the table
            foreach ($data as $product) {
                $email_content .= "
                <tr>
                    <td>{$product['product_name']}</td>
                    <td>{$product['quantity']}</td>
                    <td>₹{$product['price']}</td>
                </tr>";
            }

            $email_content .= "
            </tbody>
        </table>
        <p><strong>Shipping Charge:</strong> ₹{$ptypr}</p>
        <p><strong>Total Price:</strong> ₹{$total['total']}</p>
        <p>If you have any questions or need assistance, please feel free to contact our customer support team at <a href='mailto:support@mnnchaha.com'>support@mnnchaha.com</a>.</p>

        <p>We hope you enjoy your shopping experience with Mnnchaha. Thank you for choosing us!</p>
        
        <p>Warm regards,</p>
        <p>The Mnnchaha Team</p>
        <p><a href='https://www.mnnchaha.com/'>Mnnchaha.com</a></p>
        <p>support@mnnchaha.com</p>
    </body>
    </html>";

    // Configure email settings
    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => 'mnnchaha.com',
        'smtp_port' => 465, 
        'smtp_user' => 'Info@mnnchaha.com', 
        'smtp_pass' => 'Shri@sai01', 
        'smtp_crypto' => 'ssl', 
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'wordwrap' => TRUE,
    );

    // Load the email library with the configuration
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->set_header('Content-Type', 'text/html; charset=utf-8');
    
    // Set email parameters
    $this->email->from('info@mnnchaha.com');
    $this->email->to($email);
    $this->email->subject('Order Confirmation');
    $this->email->message($email_content);
    $this->email->send();
    return;
}
	
	
	public function addReview()
{
    $product = $this->input->post('product');
    $varient = $this->input->post('varient');

    $this->session->set_userdata('reviewProduct', $product);
    $this->session->set_userdata('reviewVarient', $varient);

    echo json_encode(['status' => 'success']); 
}


public function reviewPage()
{
    $product = $this->session->userdata('reviewProduct');
    $varient = $this->session->userdata('reviewVarient');
    $revdata = [
        'product_id'=>$product,
        'varient_id'=>$varient
    ];

    $this->load->view('User/header');
    $this->load->view('User/review',['revdata'=>$revdata]);
    $this->load->view('User/footer');
}

public function saveReview()
{
    $rating = $this->input->post('rating');
    $reviewText = $this->input->post('review');
    $token = $this->session->userdata('userToken');

    $this->load->model('UserModel');
    $userData = $this->UserModel->get_user($token);
    $userId = $userData['UserID'];
    $variantId = $this->session->userdata('reviewVarient');
    $productId = $this->session->userdata('reviewProduct');

    // Check if user already has a review for this variant
    $query = $this->db->select('*')
        ->from('reviews')
        ->where([
            'user_id' => $userId,
            'varient_id' => $variantId
        ])
        ->get();

    $existingReview = $query->row_array();

    if (!$rating || !$reviewText) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
        return;
    }

    if ($existingReview) {
        // Update existing review
        $updateData = [
            'rating' => $rating,
            'review' => $reviewText
        ];
        $this->db->where('id', $existingReview['id']);
        $this->db->update('reviews', $updateData);
        $review_id = $existingReview['id'];

        // Handle new image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $uploadPath = './uploads/reviews/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Delete old images if new ones are uploaded
            $this->db->where('review_id', $review_id);
            $this->db->delete('review_images');

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $name) {
                $_FILES['file']['name'] = $_FILES['images']['name'][$key];
                $_FILES['file']['type'] = $_FILES['images']['type'][$key];
                $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$key];
                $_FILES['file']['error'] = $_FILES['images']['error'][$key];
                $_FILES['file']['size'] = $_FILES['images']['size'][$key];

                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = time() . '_' . rand(11111, 99999);

                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $image_data = [
                        'review_id' => $review_id,
                        'image_url' => $this->upload->data('file_name'),
                    ];
                    $this->db->insert('review_images', $image_data);
                }
            }
        }

        echo json_encode(['status' => 'success', 'message' => 'Review Updated Successfully']);
    } else {
        // Insert new review
        $data = [
            'user_id' => $userId,
            'rating' => $rating,
            'review' => $reviewText,
            'product_id' => $productId,
            'varient_id' => $variantId,
        ];
        $this->db->insert('reviews', $data);
        $review_id = $this->db->insert_id();

        if (!$review_id) {
            echo json_encode(['status' => 'failed', 'message' => 'Failed to add review']);
            return;
        }

        // Handle image uploads for new review
        if (!empty($_FILES['images']['name'][0])) {
            $uploadPath = './uploads/reviews/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $this->load->library('upload');
            foreach ($_FILES['images']['name'] as $key => $name) {
                $_FILES['file']['name'] = $_FILES['images']['name'][$key];
                $_FILES['file']['type'] = $_FILES['images']['type'][$key];
                $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$key];
                $_FILES['file']['error'] = $_FILES['images']['error'][$key];
                $_FILES['file']['size'] = $_FILES['images']['size'][$key];

                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = time() . '_' . rand(11111, 99999);

                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $image_data = [
                        'review_id' => $review_id,
                        'image_url' => $this->upload->data('file_name'),
                    ];
                    $this->db->insert('review_images', $image_data);
                }
            }
        }

        echo json_encode(['status' => 'success', 'message' => 'Review Added Successfully']);
    }
}

public function return()
{
    $this->load->view('User/header');
    $this->load->view('User/return_order');
    $this->load->view('User/footer');
}


public function submitreturn() {
    $this->load->library('upload');
    $returndata = $this->input->post();
    if (!empty($_FILES['returnimage']['name'])) {
        $config['upload_path']   = './uploads/returns'; 
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; 
        $config['file_name']     = time() . '_' . rand(1111,9999); 

        $this->upload->initialize($config);

        if ($this->upload->do_upload('returnimage')) {
            $uploadData = $this->upload->data();
            $returndata['image'] = $uploadData['file_name'];
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
            return;
        }
    }
    $returndata['order_id'] = $this->session->userdata('return_order_id');
    $returndata['user_id'] = $this->session->userdata('return_user_id');
    $returndata['return_type'] = 1;
    $this->db->insert('order_returns', $returndata);
    echo json_encode(['status' => 'success', 'message' => 'Return request submitted!', 'data' => $returndata]);
}

public function replace(){
    $this->load->view('User/header');
    $this->load->view('User/replace_order');
    $this->load->view('User/footer');
}

}
?>