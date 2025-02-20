<?php

class UserModel extends CI_Model{
    public function get_user($token){
        $result = $this->decodeToken($token);
        $UserID = $result[0]->UserID;
        $this->db->where('UserID', $UserID);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function getCart($token)
    {
        $result = $this->decodeToken($token);
        $UserID = $result[0]->UserID;
        $response = $this->db->select('c.*, j.*, v.*, i.image')
                     ->from('cart c')
                     ->join('jwellaries j', 'c.product_id = j.id')
                     ->join('jwellary_varient v', 'v.varient_id = c.varient_id')
                     ->join('jwellary_images i', 'v.varient_id = i.varient')
                     ->where(['c.user_id'=>$UserID,'c.is_deleted'=>1])
                     ->group_by('v.varient_id')
                     ->get()
                     ->result_array();
        
        return $response;
        
    }
    
    public function getWishlist($token)
    {
        // Decode the token to retrieve the UserID
        $result = $this->decodeToken($token);
        $UserID = $result[0]->UserID; // Assuming the decoded result contains the UserID
        
        // Query to fetch the wishlist with the relevant joins and grouping logic
        $query = $this->db->select('wishlist.*, jwellaries.*, jwellary_varient.*, jwellary_images.image AS varient_image')
            ->from('wishlist')
            ->join('jwellaries', 'jwellaries.id = wishlist.productID')  
            ->join('jwellary_varient', 'jwellary_varient.varient_id = wishlist.varient_id')  
            ->join(
                '(SELECT varient, MIN(image) as image FROM jwellary_images GROUP BY varient) as jwellary_images',
                'jwellary_images.varient = jwellary_varient.varient_id'
            )
            ->where(['wishlist.userID'=>$UserID,'wishlist.is_deleted'=>1])
        
            ->get();
        
        return $query->result_array();
    }
    
    

    public function addToCart($json)
    {
        // print_r($json);
        // die;
        $token = $this->session->userdata('userToken');
        $result = $this->decodeToken($token);
        $UserID = $result[0]->UserID;
        $existing = $this->db->get_where('cart', [
            'user_id' => $UserID,
            'varient_id' => $json['varient_id']
        ])->row_array();

        if ($existing) {

            if($existing['is_deleted']=='3')
            {
                    $this->db->set('quantity',$json['quantity'])
                    ->set('is_deleted', '1')
                    ->where('user_id', $UserID)
                    ->where('varient_id', $json['varient_id'])
                    ->update('cart');

            }
            else{
                $this->db->set('quantity', 'quantity + ' . $json['quantity'], false)
                ->set('is_deleted', '1')
                ->where('user_id', $UserID)
                ->where('varient_id', $json['varient_id'])
                ->update('cart');
            }
            // $this->db->set('quantity', 'quantity + ' . $json['quantity'], false)
            //          ->set('is_deleted', '1')
            //          ->where('user_id', $UserID)
            //          ->where('varient_id', $json['varient_id'])
            //          ->update('cart');
    
            return ['status' => 'updated', 'message' => 'Quantity updated successfully'];
        } else {
            $data = array(
                'user_id' => $UserID,
                'product_id' => $json['jwellary_id'],
                'varient_id' => $json['varient_id'],
                'quantity' => $json['quantity']
            );
            $this->db->insert('cart', $data);
            $insert_id = $this->db->insert_id();
    
            if ($insert_id) {
                return ['status' => 'success', 'message' => 'Added to cart successfully'];
            } else {
                return ['status' => 'failed', 'message' => 'Failed to add to cart'];
            }
        }
    }
    

    public function post_mobile($data)
    {
        $otp = '123456';
        $mobile = $data['mobile'];
        $apiKey = 'Njk1MzUzNmE2MzczNjk2Yzc0NDUzNTQ1NTc1MzUyNzY=';
        $sender = 'MNCHCH';
        $message = rawurlencode('Hello! To verify your account on Mnnchaha.com, please use the code below:'
.$otp.
'This code is valid for the next 5 minutes. Please do not share it with anyone. ' );
        $LastOTPGenerationDate = round(microtime(true) * 1000);
        $OTPExpiryDate = round((microtime(true) + 300) * 1000);
        $result = $this->db->select('users.*')
                           ->from('users')
                           ->where(['PhoneNumber' => $mobile])
                           ->get()
                           ->result_array();
        $numbers = '91' . $mobile;
        $smsData = [
            'apikey' => $apiKey,
            'numbers' => $numbers,
            'sender' => $sender,
            'message' => $message
        ];
    
        if ($result) {
            $this->db->set([
                'otp' => $otp,
                'LastOTPGenerationDate' => $LastOTPGenerationDate,
                'OTPExpiryDate' => $OTPExpiryDate
            ])->where('UserID', $result[0]['UserID'])->update('users');
            $send = $this->sendSms($smsData);
    
            if ($send) {
                $this->session->set_userdata('se_otp', $otp);
                return $send;
            } else {
                return $send;
            }
        } else {
            $this->db->insert('users', [
                'PhoneNumber' => $mobile,
                'otp' => $otp,
                'LastOTPGenerationDate' => $LastOTPGenerationDate,
                'OTPExpiryDate' => $OTPExpiryDate
            ]);
    
            if ($this->db->affected_rows() > 0) {
                $send = $this->sendSms($smsData);
                if ($send) {
                    $this->session->set_userdata('se_otp', $otp);
                    return $send;
                } else {
                    return false;
                }
            }
        }
        return false;
    }
    
    /**
     * Function to send SMS using TextLocal
     */
    private function sendSms($smsData)
    {
        $url = "https://api.textlocal.in/send/"; // Correct API endpoint
        $data = http_build_query($smsData); // Encode data properly
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        // Decode and check response
        $result = json_decode($response, true);
        if (isset($result['status']) && $result['status'] === 'success') {
            return true;
        } else {
            log_message('error', 'TextLocal Error: ' . $response);
            return $response;
        }
    }
    



public function post_user($data)
{
    $otp = rand(111111,999999);
    $result = $this->db->select('users.*')
                       ->from('users')
                       ->where($data)
                       ->get()
                       ->result_array();

    if ($result) {
        $this->session->set_userdata('se_otp', $otp);
        $send = $this->send_mail($data,$otp);
        if ($send) {
            return true;
        }else return false;
        
    } else {
        $this->db->insert('users', $data);
        if ($this->db->affected_rows()) {
            $this->session->set_userdata('se_otp', $otp);
            $send = $this->send_mail($data,$otp);
            if($send){
                return true;
            }else return false;
        }
    }
    return [];
}


    public function decodeToken($token)
    {

        $jwt = new JWT();
        $JwtSecretKey = 'mysecret';
        $decodeToken = $jwt->decode($token,$JwtSecretKey,'HS256');
        $token1 = $jwt->jsonEncode($decodeToken);
        return json_decode($token1);
    }
	
	
	
	   public function saveAddress($data)
    {
        $this->db->insert('address', $data);
        $id = $this->db->insert_id();
        return $id;
    }
	
	    public function get_addresses($id)
    {
        // Query using an associative array for where conditions
        $address = $this->db->select('address.*')
                            ->from('address')
                            ->where([
                                'user_id' => $id,
                                'show_hide' => 1
                            ])
                            ->get()
                            ->result_array();
    
        return $address;
    }
	
	
	    public function addToWishlist($data)
    {
        if (empty($data)) {
            return false; 
        }
        $insert = $this->db->insert('wishlist', $data);
        
        if ($insert) {
            $res = $this->db->insert_id();
            return $res;
        } else {
            return false;
        }
    }

    public function getCompleteData($data)
    {
        $productID = $data['productID'];
        $varientID = $data['varientID'];
    
        $this->db->select('jwellaries.*, jwellary_varient.*, jwellary_images.image')
                 ->from('jwellaries')
                 ->join('jwellary_varient', 'jwellary_varient.jwellary_id = jwellaries.id')
                 ->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id')
                 ->where('jwellaries.id', $productID)
                 ->where('jwellary_varient.varient_id', $varientID)
                 ->group_by('jwellary_varient.varient_id'); // Group by variant to avoid duplicates
    
        $query = $this->db->get();
    
        return $query->row_array(); // Return single product details
    }


    public function saveUserAddress($addressData)
    {
        $insert = $this->db->insert('address', $addressData);
        
        if ($insert) {
            $res = $this->db->insert_id();
            return $res;
        } else {
            return false;
        }
        
    }


    public function saveOrder($save)
    {
        $ids = [];   
        foreach ($save as $order) {
            $this->db->trans_start();
            $this->db->insert('orders', $order);
            $order_id = $this->db->insert_id();
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            $ids[] = $order_id;
        }
        return $ids;
    }
    
	



    public function send_mail($data,$otp)
        {
            $email_content = "<html>
            <head>
                <title>Your OTP to Login to Mnnchaha</title>
            </head>
            <body>
                <p>Dear Customer,</p>
                <p>Your OTP: $otp</p>
                <p>Please enter this OTP on the login screen of Mnnchaha website or app to access your account.</p>
                <br>
                <p>Important Notes:</p>
                <p>This OTP is valid for next 5 Minute</p>
                <p>If you didn’t request this OTP, please disregard this email. Your account remains secure.</p>
                <p>If you have any questions or need assistance, feel free to contact our support team at Enquiry@mnnchaha.com or visit our Help Center on the website.</p>
                <p>Thank you for choosing Mnnchaha! We're excited to have you as part of our community. To access your account and start exploring the exciting features of our marketplace, please use the One-Time Password (OTP) yo login.</p>
                <p>Thank you for being a valued member of the Mnnchaha.</p>

                <p>Warm regards,</p>
				<p>The Mnnchaha Team</p>
                <p><a href='https://www.mnnchaha.com/'>Mnnchaha.com</a></p>
                <p>Enquiry@mnnchaha.com</p>
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
            $this->email->to($data['Email']);
            $this->email->subject('Your OTP to Login to Mnnchaha');
            $this->email->message($email_content);

            // Attempt to send the email
            if ($this->email->send()) {
                $this->session->set_flashdata('message', 'Please check your email for the OTP.');
				$this->session->set_userdata('otp_sent', 'Please check your email for the OTP.');
                return true;
            } else {
              return false;
            }
        }






        public function deleteFromCart($data)
        {
            return $this->db->delete('cart', $data);
        }

        public function getOrder($id)
        {
            $data = $this->db->select('
                            orders.*, 
                            jwellaries.jwellary_name, 
                            jwellaries.jwellary_description, 
                            jwellary_varient.dimension, 
                            jwellary_varient.color, 
                            jwellary_varient.weight, 
                            MIN(jwellary_images.image) as image')
        ->from('orders')
        ->where(['orders.shipment_id' => $id])
        ->join('jwellaries', 'jwellaries.id = orders.product_id', 'left')
        ->join('jwellary_varient', 'jwellary_varient.varient_id = orders.varient_id', 'left')
        ->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id', 'left')
        ->group_by('orders.id') // Group by orders to prevent duplication
        ->order_by('order_date', 'DESC')
        ->get()
        ->row_array();
                    $baseurl = base_url('uploads/products/');
            foreach ($data as &$record) {
                if (!empty($record['image'])) {
                    $record['image'] = $baseurl . $record['image'];
                }
            }
        
            return $data;
            
        }


        public function getOrderHistory($id)
        {
            // Fetch order history with related product, specific variant, and image details
            $data = $this->db->select('
                    orders.*, 
                    jwellaries.jwellary_name, 
                    jwellaries.applicable_tax, 
                    jwellaries.jwellary_description, 
                    jwellary_varient.dimension, 
                    jwellary_varient.color, 
                    jwellary_varient.weight, 
                    MIN(jwellary_images.image) as image')
                ->from('orders')
                ->where(['orders.user_id' => $id])
                ->join('jwellaries', 'jwellaries.id = orders.product_id', 'left')
                ->join('jwellary_varient', 'jwellary_varient.varient_id = orders.varient_id', 'left')
                ->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id', 'left')
                ->group_by('orders.id') // Group by orders to prevent duplication
                ->order_by('order_date', 'DESC')
                ->get()
                ->result_array();
        
            // Prepend base URL to image paths
            $baseurl = base_url('uploads/products/');
            foreach ($data as &$record) {
                if (!empty($record['image'])) {
                    $record['image'] = $baseurl . $record['image'];
                }
            }
        
            return $data;
        }
        


        public function cancelOrder($data)
        {
        
            $this->db->where('order_id', $data);
            $res = $this->db->update('orders', ['order_status' => 5]);
            return $res;
        }
        
        public function deleteAddress($id)
        {
            $this->db->set('show_hide', 2);
            $this->db->where('id', $id);
            $resp = $this->db->update('address');
            if($resp){
                return true;
            }else return false;
            
        }

        public function updateCart($data)
        {
            foreach($data as $varientID){
            $this->db->set('is_deleted', 3);
            $this->db->where('varient_id', $varientID);
            $resp = $this->db->update('cart');
            }
            return true;
        }
        public function getAddress($id)
        {
            $data = $this->db->select('*')
                             ->from('address')
                             ->where('id',$id)->get()->row_array();
            return $data;            
        }
        public function updateAddress($updata,$data)
        {
            $this->db->set($updata);
            $this->db->where('id', $data);
            $resp = $this->db->update('address');
            if($resp){
                return true;
            }else return false;
            
        }
        
        
    }
	

?>