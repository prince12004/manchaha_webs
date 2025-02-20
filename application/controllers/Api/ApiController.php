<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ApiController extends RestController {


    public function __construct()
	{
		// header('Access-Control-Allow-Origin: *');
		// header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $header = getallheaders();
	    $Authorization = !empty($header['Authorization']) ? $header['Authorization'] : ''; 
		// manchaha   manchaha@4321
		//if( $Authorization!="Basic bWFuY2hhaGE6bWFuY2hhaGFANDMyMQ=="){
		//     $res = ['status' => 401,'message' => 'Please provide authkey !!', 'data' => null];
        //   $this->response($res, RestController::HTTP_OK);   
		//}

	}

   
    // Login API 

    public function login_post()
    {  
          $json = file_get_contents('php://input');
          $post = json_decode($json);
           if(!isset($post->mobile)){
               $res = ['status' => false,'message' => 'Please provide mobile !!', 'data' => null];
               $this->response($res, RestController::HTTP_OK);   
           }elseif(!isset($post->type)){
               $res = ['status' => false,'message' => 'Please provide user type !!', 'data' => null];
               $this->response($res, RestController::HTTP_OK);   
          }else{

            if ($post->mobile == '9876987698') {
                $mobile = $post->mobile;
                $otp = '111111';
            }else {
                $mobile = $post->mobile;
               
                $otp = '123456';  
            }

               
               $sql = $this->db->get_where("users", ["PhoneNumber"=>$mobile])->num_rows();
               if($sql > 0){
                  
                    $this->db->where(["PhoneNumber"=>$mobile])->update("users", ["otp"=>$otp,"token"=>md5($mobile)]);     
               }else{
                   $this->db->insert("users", ["PhoneNumber"=>$mobile, "otp"=>$otp,"token"=>md5($mobile)]);
               }
    
    
                $sms = "Welcome to Manachaha Your OTP for verification is $otp Keep it confidential.";
                $sms = urlencode($sms);
               //  $rsponse = file_get_contents("http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=$mobile&message=$sms&sender=VKCABS&route=2&country=91&DLT_TE_ID=1707171057080567628");
           
    		   $res = ['status' => true,'message' => 'OTP Sent Successfully !!', 'data' => 'Your  is '.$otp.' FA+9qCX9VSu' ];
               $this->response($res, RestController::HTTP_OK);  
    		
               
           }
    }


     // Otp Verify api 
     public function verifyotp_post()
     {
        $json = file_get_contents('php://input');
        $post = json_decode($json);
        if(!isset($post->mobile)){
            $res = ['status' => false,'message' => 'Please provide mobile !!', 'data' => null];
            $this->response($res, RestController::HTTP_OK);   
        }
        elseif(!isset($post->otp)){
            $res = ['status' => false,'message' => 'Please provide OTP !!', 'data' => null];
            $this->response($res, RestController::HTTP_OK);   
        }
        else{
            $mobile = $post->mobile;
            $otp = $post->otp;
            $sql = $this->db->get_where("users", ["PhoneNumber"=>$mobile, "otp"=>$otp]);
          
            
         if ($sql->num_rows() == 0) {
           $res = ['status' => false,'message' => 'Invalid OTP !!', 'data' => null];
            $this->response($res, RestController::HTTP_OK);   
            
             
         } else {
               $res=   $sql->row();
              //   $doc = $this->db->get_where("documents", ["user_id"=>$res->user_id])->row();
              $add = $this->db->get_where("address",["user_id"=>$res->UserID,"show_hide"=>1])->result_array();
            $rerult=array(
                
                     "name"=>$res->name ,
                     "mobile"=> $res->PhoneNumber,
                     "email"=> $res->Email,
                     "gender"=>$res->gender,
                     "birth_date"=>$res->birth_date,
                     "address"=>$add,
                     "city"=> $res->city,
                     "token"=> $res->token,
					"profile_picture"=>$res->image ? base_url($res->image) : null
                     
                );
             
           $res = ['status' => true,'message' => 'success', 'data' => $rerult];
            $this->response($res, RestController::HTTP_OK);  
         }
            
        }
     }





     public function loginemail_post()
     {  
           $json = file_get_contents('php://input');
           $post = json_decode($json);
            if(!isset($post->email)){
                $res = ['status' => false,'message' => 'Please provide email !!', 'data' => null];
                $this->response($res, RestController::HTTP_OK);   
            }elseif(!isset($post->type)){
                $res = ['status' => false,'message' => 'Please provide user type !!', 'data' => null];
                $this->response($res, RestController::HTTP_OK);   
           }else{
                $email = $post->email;
                if ($email == 'manoj.dixit@bannotechnologies.com') {
                    $otp = 111111;
                }else{
                
                $otp = rand(100000,999999);
                }
                
                $sql = $this->db->get_where("users", ["Email"=>$email])->num_rows();
                if($sql > 0){
                   
                     $this->db->where(["Email"=>$email])->update("users", ["otp"=>$otp,"token"=>md5($email)]);     
                }else{
                    $this->db->insert("users", ["Email"=>$email, "otp"=>$otp,"token"=>md5($email)]);
                }
     
                $this->sendOtpEmail($email,$otp);
                 $sms = "Welcome to Manachaha Your OTP for verification is $otp Keep it confidential.";
                 $sms = urlencode($sms);
                //  $rsponse = file_get_contents("http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=$mobile&message=$sms&sender=VKCABS&route=2&country=91&DLT_TE_ID=1707171057080567628");
            
                $res = ['status' => true,'message' => 'OTP Sent Successfully !!', 'data' => 'Your  is '.$otp.' FA+9qCX9VSu' ];
                $this->response($res, RestController::HTTP_OK);  
             
                
            }
     }
 
 
      // Otp Verify api 
      public function verifyemail_post()
      {
         $json = file_get_contents('php://input');
         $post = json_decode($json);
         if(!isset($post->email)){
             $res = ['status' => false,'message' => 'Please provide email !!', 'data' => null];
             $this->response($res, RestController::HTTP_OK);   
         }
         elseif(!isset($post->otp)){
             $res = ['status' => false,'message' => 'Please provide OTP !!', 'data' => null];
             $this->response($res, RestController::HTTP_OK);   
         }
         else{
             $email = $post->email;
             $otp = $post->otp;
             $sql = $this->db->get_where("users", ["Email"=>$email, "otp"=>$otp]);
           
             
          if ($sql->num_rows() == 0) {
            $res = ['status' => false,'message' => 'Invalid OTP !!', 'data' => null];
             $this->response($res, RestController::HTTP_OK);   
             
              
          } else {
                $res=   $sql->row();
               //   $doc = $this->db->get_where("documents", ["user_id"=>$res->user_id])->row();
			  $add = $this->db->get_where("address",["user_id"=>$res->UserID])->result_array();
               
             $rerult=array(
                 
                      "name"=>$res->name ,
                      "mobile"=> $res->PhoneNumber,
                      "email"=> $res->Email,
                      "gender"=>$res->gender,
                      "birth_date"=>$res->birth_date,
                      "address"=>$add,
                      "city"=> $res->city,
                      "token"=> $res->token,
				 	  "profile_picture"=>$res->image ? base_url($res->image) : null
                      
                 );
              
            $res = ['status' => true,'message' => 'success', 'data' => $rerult];
             $this->response($res, RestController::HTTP_OK);  
          }
             
         }
      }

    private function sendOtpEmail($email,$otp)
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
    $this->email->to($email);
    $this->email->subject('Email Verification');
    $this->email->message($email_content);
    $this->email->send();
    return;
        
    }
        // Dashbaord API for home page 
      
public function home_get()
{
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    if (!isset($post->token)) {
        $res = ['status' => false, 'message' => 'Please provide token !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    $users = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$users) {
        $res = ['status' => false, 'message' => 'Invalid token!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    $userID = $users->UserID;
    $base_url = "https://www.mnnchaha.com/uploads/";

    // Function to append the base URL to images
    $add_base_url_to_images = function ($items) use ($base_url, $userID) {
        foreach ($items as &$item) {
            if (isset($item['image'])) {
                $item['image'] = $base_url . 'products/' . $item['image'];
                $item['is_wishlist'] = $this->checkWishlist($item['varient_id'], $userID);
            }
if (isset($item['base_price'], $item['sale_price']) && $item['base_price'] > 0) {
    $item['discount'] = round((($item['base_price'] - $item['sale_price']) * 100) / $item['base_price'],2);
}
			
            if (isset($item['thumbnail']) && !empty($item['thumbnail'])) {
                $item['thumbnail'] = $base_url . 'products/' . $item['thumbnail'];
            } else {
                $item['thumbnail'] = $item['image'];
            }
        }
        return $items;
    };

    // Top jewelry
    $topjwellaries = $this->db->select('jwellaries.*, MIN(jwellary_images.image) as image, jwellary_varient.*')
        ->from('jwellaries')
        ->join('jwellary_varient', 'jwellaries.id = jwellary_varient.jwellary_id AND jwellary_varient.is_deleted = 2')
        ->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient', 'left')
        ->where(['jwellaries.is_deleted' => 2, 'jwellaries.visibility' => 'Published'])
        ->group_by('jwellaries.id')
        ->having('COUNT(jwellary_varient.varient_id) > 0')
        ->order_by('jwellaries.created_at', 'DESC')
        ->limit(10)
        ->get()->result_array();
    $data['top_jwellaries'] = $add_base_url_to_images($topjwellaries);

    // Categories
    $categories = $this->db->select("*")
        ->where(["IsActive" => 1, 'is_parent' => 1,'is_deleted'=>1])
        ->get('categories')->result_array();
    foreach ($categories as &$item) {
        if (isset($item['categoryImage'])) {
            $item['categoryImage'] = $base_url . $item['categoryImage'];
        }
if (isset($item['base_price'], $item['sale_price']) && $item['base_price'] > 0) {
    $item['discount'] = round((($item['base_price'] - $item['sale_price']) * 100) / $item['base_price'],2);
}

        if (isset($item['thumbnail']) && !empty($item['thumbnail'])) {
            $item['thumbnail'] = $base_url . $item['thumbnail'];
        } else {
            $item['thumbnail'] = $item['categoryImage'];
        }
    }
    $data['categories'] = $categories;

    // Deals of the day
    $dotdquery = $this->db->select('dotd.*, jwellaries.*, MIN(jwellary_images.image) as image, jwellary_varient.*')
        ->from('dotd')
        ->join('jwellaries', 'dotd.product_id = jwellaries.id')
        ->join('jwellary_varient', 'jwellaries.id = jwellary_varient.jwellary_id AND jwellary_varient.is_deleted = 2')
        ->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient', 'left')
        ->where(['jwellaries.is_deleted' => 2, 'jwellaries.visibility' => 'Published'])
        ->group_by('jwellaries.id')
        ->having('COUNT(jwellary_varient.varient_id) > 0')
        ->order_by('jwellaries.created_at', 'DESC')
        ->get()->result_array();
    $data['deal_of_day'] = $add_base_url_to_images($dotdquery);

    // Hot sell (populars)
    $query = $this->db->select('populars.*, jwellaries.*, MIN(jwellary_images.image) as image, jwellary_varient.*')
        ->from('populars')
        ->join('jwellaries', 'populars.product_id = jwellaries.id')
        ->join('jwellary_varient', 'jwellaries.id = jwellary_varient.jwellary_id AND jwellary_varient.is_deleted = 2')
        ->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient', 'left')
        ->where(['jwellaries.is_deleted' => 2, 'jwellaries.visibility' => 'Published'])
        ->group_by('jwellaries.id')
        ->having('COUNT(jwellary_varient.varient_id) > 0')
        ->order_by('jwellaries.created_at', 'DESC')
        ->get()->result_array();
    $data['hot_sell'] = $add_base_url_to_images($query);

    // New offers
    $new_offers = $this->db->select("*")->get('best_value')->result_array();
    foreach ($new_offers as &$item) {
        if (isset($item['image'])) {
            $item['image'] = $base_url . $item['image'];
        }
        if (isset($item['thumbnail']) && !empty($item['thumbnail'])) {
            $item['thumbnail'] = $base_url . $item['thumbnail'];
        } else {
            $item['thumbnail'] = $item['image'];
        }
    }
    $data["new_offers"] = $new_offers;

    $res = ['status' => true, 'message' => 'success', 'data' => $data];
    $this->response($res, RestController::HTTP_OK);
}

        
        
        

        
public function categories_get()
{  
    // Define base URL for images
    $baseUrl = 'https://www.mnnchaha.com/uploads/'; // Adjust this to your actual image directory

    // Fetch parent categories
    $parentCategories = $this->db->select("*")
                                 ->where(["IsActive" => 1, "is_parent" => 1,"is_deleted"=>1])
                                 ->get('categories')
                                 ->result_array();

    $categoriesWithSub = [];

    // Loop through each parent category to fetch its subcategories
    foreach ($parentCategories as $category) {
        // Append full URL to the image
        $category['categoryImage'] = !empty($category['categoryImage']) ? $baseUrl . $category['categoryImage'] : '';

        $subCategories = $this->db->select("*")
                                  ->where(["IsActive" => 1, 'ParentCategoryID' => $category['CategoryID'],'is_deleted'=>1])
                                  ->get('categories')
                                  ->result_array();

        // Add full URL for subcategory images
        foreach ($subCategories as &$subCategory) {
            $subCategory['categoryImage'] = !empty($subCategory['categoryImage']) ? $baseUrl . $subCategory['categoryImage'] : '';
        }

        $category['subCategories'] = $subCategories;
        $categoriesWithSub[] = $category;
    }

    $res = [
        'status' => true,
        'message' => 'success',
        'data' => $categoriesWithSub
    ];

    // Send the response with HTTP status 200
    $this->response($res, RestController::HTTP_OK);
}


private function getListTotal($data)
{
    $this->db->select("jwellaries.id");
    $this->db->where(["jwellaries.is_deleted" => 2]);

    // Search key
    if (!empty($data->search_key)) {
        $this->db->like('jwellaries.ProductName', $data->search_key);
    }

    // Category or subcategory filter
    if (!empty($data->category_id)) {
        $this->db->group_start();
        $this->db->where('jwellaries.category_id', $data->category_id);
        $this->db->or_where('jwellaries.subcategory_id', $data->category_id);
        $this->db->group_end();
    }

    // Additional filters
    if (!empty($data->filter)) {
        // Filter by color
        if (!empty($data->filter->color)) {
            $this->db->where_in('jwellary_varient.color', $data->filter->color);
        }

        // Filter by price range
        if (!empty($data->filter->price)) {
            $this->db->where('jwellary_varient.base_price >=', $data->filter->price->min);
            $this->db->where('jwellary_varient.base_price <=', $data->filter->price->max);
        }

        // Filter by categories
        if (!empty($data->filter->categories)) {
            $this->db->where_in('jwellaries.category_id', $data->filter->categories);
        }

        // Filter by size
        if (!empty($data->filter->size)) {
            $this->db->where_in('jwellaries.sizing', $data->filter->size);
        }

        // Filter by discount
        if (!empty($data->filter->discount)) {
            $this->db->group_start();
            foreach ($data->filter->discount as $discount) {
                $this->db->or_where('((jwellary_varient.base_price - jwellary_varient.sale_price) / jwellary_varient.base_price) * 100 >=', $discount);
            }
            $this->db->group_end();
        }

        // Filter by gender
        if (!empty($data->filter->gender)) {
            $this->db->where_in('jwellaries.ideal_for', $data->filter->gender);
        }
    }

    // Join tables
    $this->db->join('jwellary_varient', 'jwellary_varient.jwellary_id = jwellaries.id');
    $this->db->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id');

    // Group by to avoid duplicate rows
    $this->db->group_by('jwellaries.id');

    // Specify the table
    $this->db->from('jwellaries');

    // Return the count of grouped rows
    return $this->db->count_all_results();
}


	
private function checkwish($product,$user)
{
    $result = $this->db->select('*')
        ->from('wishlist')
        ->where(['productID' => $product,'userID'=>$user, 'is_deleted' => 1])
        ->get()
        ->num_rows();
    return $result >= 1;
}

public function productlist_post()
{
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    // Validate token
    if (!isset($post->token) || empty($post->token)) {
        $res = ['status' => false, 'message' => 'Please provide token !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Get user details
    $users = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$users) {
        $res = ['status' => false, 'message' => 'Invalid token or user not found!', 'data' => null];
        $this->response($res, RestController::HTTP_UNAUTHORIZED);
        return;
    }

    // Pagination setup
    $limit = 20;
    $total = $this->getListTotal($post); // Ensure this function includes filters
    $currentPage = max(1, isset($post->page) ? (int)$post->page : 1);
    $totalPages = ceil($total / $limit);
    $offset = ($currentPage - 1) * $limit;

    // Base query
    $this->db->select("jwellaries.*, jwellary_varient.*, jwellary_images.image AS first_image")
        ->from('jwellaries')
        ->where(["jwellaries.is_deleted" => 2]);

    // Apply search key
    if (!empty($post->search_key)) {
        $this->db->like('jwellaries.ProductName', $post->search_key);
    }

    // Apply category or subcategory filter
    if (!empty($post->category_id)) {
        $this->db->group_start()
            ->where('jwellaries.category_id', $post->category_id)
            ->or_where('jwellaries.subcategory_id', $post->category_id)
            ->group_end();
    }

    // Apply additional filters
    if (!empty($post->filter)) {
        // Filter by color
        if (!empty($post->filter->color)) {
            $this->db->where_in('jwellary_varient.color', $post->filter->color);
        }

        // Filter by price range
        if (!empty($post->filter->price)) {
            $this->db->where('jwellary_varient.base_price >=', $post->filter->price->min);
            $this->db->where('jwellary_varient.base_price <=', $post->filter->price->max);
        }

        // Filter by categories
        if (!empty($post->filter->categories)) {
            $this->db->where_in('jwellaries.category_id', $post->filter->categories);
        }

        // Filter by size
        if (!empty($post->filter->size)) {
            $this->db->where_in('jwellaries.sizing', $post->filter->size);
        }

        // Filter by discount
        if (!empty($post->filter->discount)) {
            $this->db->group_start();
            foreach ($post->filter->discount as $discount) {
                $this->db->or_where('((jwellary_varient.base_price - jwellary_varient.sale_price) / jwellary_varient.base_price) * 100 >=', $discount);
            }
            $this->db->group_end();
        }

        // Filter by gender
        if (!empty($post->filter->gender)) {
            $this->db->where_in('jwellaries.ideal_for', $post->filter->gender);
        }
    }

    // Sorting logic
    if (!empty($post->sort_by)) {
        if ($post->sort_by === "Price - High to Low") {
            $this->db->order_by('jwellary_varient.sale_price', 'DESC');
        } elseif ($post->sort_by === "Price - Low to High") {
            $this->db->order_by('jwellary_varient.sale_price', 'ASC');
        } elseif ($post->sort_by === "Discount") {
        $this->db->order_by('((jwellary_varient.base_price - jwellary_varient.sale_price) / jwellary_varient.base_price) * 100', 'DESC');
    	} else{
			
		}
    }

    // Join tables and group results
    $this->db->join('jwellary_varient', 'jwellary_varient.jwellary_id = jwellaries.id');
    $this->db->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id');
    $this->db->group_by('jwellaries.id');
    $this->db->limit($limit, $offset);

    // Execute query
    $query = $this->db->get();
    $data = $query->result_array();

    // Post-processing for images and discounts
    $base_url = base_url('uploads/products/');
    foreach ($data as $key => $value) {
        $data[$key]['first_image'] = $base_url . $value['first_image'];

        $base_price = intval($value['base_price']);
        $sale_price = intval($value['sale_price']);
        $data[$key]['discount_percent'] = ($base_price > 0 && $sale_price > 0)
            ? round((($base_price - $sale_price) / $base_price) * 100, 2)
            : 0;

        $data[$key]['review_count'] = 0; // Placeholder
        $data[$key]['reviews'] = [];    // Placeholder
        $data[$key]['rating'] = round(mt_rand(400, 480) / 100, 1); // Random rating
        $data[$key]['is_wishlist'] = $this->checkwish($value['id'], $users->UserID);
    }

    // Return response
    $res = [
        'status' => true,
        'message' => 'Success',
        'data' => $data,
        'total' => $total,
        'current_page' => $currentPage,
        'total_pages' => $totalPages
    ];

    $this->response($res, RestController::HTTP_OK);
}





private function calculateDiscount($base_price, $sale_price)
{
    if ($base_price > 0 && $sale_price > 0) {
        return round((($base_price - $sale_price) / $base_price) * 100);
    }
    return 0;
}


private function checkCart($variant,$user)
{
    $result = $this->db->select('*')
        ->from('cart')
        ->where(['varient_id' => $variant,'user_id'=>$user, 'is_deleted' => 1])
        ->get()
        ->num_rows();
    return $result >= 1;
}
	private function checkWishlist($variant,$user)
{
    $result = $this->db->select('*')
        ->from('wishlist')
        ->where(['varient_id' => $variant,'userID'=>$user, 'is_deleted' => 1])
        ->get()
        ->num_rows();
    return $result>=1;
}

public function productdetails_post()
{
    $base_url = 'https://www.mnnchaha.com/uploads/products/';
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    if (!isset($post->product_id) || empty($post->product_id)) {
        $this->response(
            ['status' => false, 'message' => 'Please provide a product ID!', 'data' => null],
            RestController::HTTP_OK
        );
        return;
    }

    // Fetch Product Details
    $productData = $this->db->select('jwellaries.*')
        ->from('jwellaries')
        ->where('jwellaries.id', $post->product_id)
        ->get()
        ->row_array();

    if (!$productData) {
        $this->response(
            ['status' => false, 'message' => 'Invalid product ID!', 'data' => null],
            RestController::HTTP_OK
        );
        return;
    }

    // Add thumbnail URL
    if (!empty($productData['thumbnail'])) {
        $productData['thumbnail'] = $base_url . $productData['thumbnail'];
    }
if (!empty($productData['applicable_tax'])) {
        $productData['applicable_tax'] = intval($productData['applicable_tax']);
    }

    // Fetch Variants
    $variants = $this->db->select('jwellary_varient.*')
        ->from('jwellary_varient')
        ->where([
            'jwellary_varient.jwellary_id' => $post->product_id,
            'jwellary_varient.is_deleted' => 2
        ])
        ->get()
        ->result_array();

    // Fetch Images if Variants Exist
    $images = [];
    if (!empty($variants)) {
        $variantIds = array_column($variants, 'varient_id');
        $images = $this->db->select('jwellary_images.varient, jwellary_images.image')
            ->from('jwellary_images')
            ->where_in('jwellary_images.varient', $variantIds)
            ->get()
            ->result_array();
    }

    // Process Variants and Collect Colors
    $colors = [];
    foreach ($variants as &$variant) {
        if (!empty($post->token)) {
            $users = $this->db->get_where("users", ["token" => $post->token])->row();

            $variant['is_cart'] = $this->checkCart($variant['varient_id'], $users->UserID);
            $variant['is_wishlist'] = $this->checkWishlist($variant['varient_id'], $users->UserID);
            $variant['tax'] = ($variant['sale_price'] * $productData['applicable_tax']) / 100;
			$variant['discount'] = round((($variant['base_price'] - $variant['sale_price']) * 100) / $variant['base_price'],2);
        }

        // Add images for each variant
        $variant['images'] = array_map(
            function ($img) use ($base_url) {
                return $base_url . $img;
            },
            array_column(
                array_filter($images, function ($img) use ($variant) {
                    return $img['varient'] == $variant['varient_id'];
                }),
                'image'
            )
        );

        // Collect unique colors
        if (!in_array($variant['color'], $colors)) {
            $colors[] = $variant['color'];
        }
    }

    $query = $this->db->query("
    SELECT AVG(rating) AS average_rating, COUNT(id) AS review_count 
    FROM reviews 
    WHERE product_id = ?", [$post->product_id]);

	$result = $query->row();
    $productData['colors'] = $colors;
    $productData['variants'] = $variants;
    $productData['rating'] = round($result->average_rating,2) ?? 0; // Default rating
    $productData['review_count'] = isset($result->review_count) ? (int) $result->review_count : 0; // Default review count

    $this->response(
        ['status' => true, 'message' => 'Success', 'data' => $productData],
        RestController::HTTP_OK
    );
}


    public function productRating_post()
	{  
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->product_id) && $post->product_id =='' ){
           $res = ['status' => false,'message' => 'Please product id !!', 'data' => null];
           $this->response($res, RestController::HTTP_OK);   
       }
$reviews = $this->db->select('reviews.id, reviews.rating, reviews.review, users.name as user_name, 
                              GROUP_CONCAT(review_images.image_url) as images')
                    ->from('reviews')
                    ->join('users', 'reviews.user_id = users.UserID', 'left')
                    ->join('review_images', 'review_images.review_id = reviews.id', 'left')
                    ->where('reviews.product_id', $post->product_id)
                    ->group_by('reviews.id')
                    ->get()
                    ->result_array();

		// Fetch average rating and total review count
		$ratingData = $this->db->select('AVG(rating) AS average_rating, COUNT(id) AS total_reviews')
							   ->from('reviews')
							   ->where('product_id', $post->product_id)
							   ->get()
							   ->row_array();
		
        // $this->db->select("*");
        // $this->db->where('product_id',$post->product_id);
        // $query = $this->db->get('products');
	
  $data = [
    'reviews' => $reviews,
    'average_rating' => round($ratingData['average_rating'],2) ?? 0,
    'total_reviews' => round($ratingData['total_reviews'],2) ?? 0
];

if (!empty($data['reviews'])) { // Check if there are reviews
    $res = ['status' => true, 'message' => 'success', 'data' => $data];
} else {
    $res = ['status' => false, 'message' => 'No reviews!!', 'data' => null];
}

$this->response($res, RestController::HTTP_OK);

    
      
	}

public function addReview_post()
{
    // Validate required fields
    if (!$this->input->post('token')) {
        $this->response(['status' => false, 'message' => 'Please provide token !!', 'data' => null], RestController::HTTP_OK);
    }
	
    if (!$this->input->post('product_id')) {
        $this->response(['status' => false, 'message' => 'Please add product id !!', 'data' => null], RestController::HTTP_OK);
    }
    if (!$this->input->post('rating')) {
        $this->response(['status' => false, 'message' => 'Please add rating !!', 'data' => null], RestController::HTTP_OK);
    }
    if (!$this->input->post('varient_id')) {
        $this->response(['status' => false, 'message' => 'Please add variant id !!', 'data' => null], RestController::HTTP_OK);
    }
    if (!$this->input->post('review')) {
        $this->response(['status' => false, 'message' => 'Please add review !!', 'data' => null], RestController::HTTP_OK);
    }

    // Extract user details from the token
    $userId = $this->verifyToken($this->input->post('token')); 
	
    if (!$userId) {
        $this->response(['status' => false, 'message' => 'Invalid token !!', 'data' => null], RestController::HTTP_OK);
    }
	

    $variantId = $this->input->post('varient_id');
    $productId = $this->input->post('product_id');
    $rating = $this->input->post('rating');
    $reviewText = $this->input->post('review');

    // Check if the user has already reviewed this product variant
    $existingReview = $this->db->select('*')
        ->from('reviews')
        ->where(['user_id' => $userId, 'varient_id' => $variantId])
        ->get()
        ->row_array();

    if ($existingReview) {
        // Update existing review
        $updateData = [
            'rating' => $rating,
            'review' => $reviewText,
        ];
        $this->db->where('id', $existingReview['id']);
        $this->db->update('reviews', $updateData);
        $review_id = $existingReview['id'];

        // Remove old images if new images are uploaded
        if (!empty($_FILES['images']['name'][0])) {
            $this->db->where('review_id', $review_id);
            $this->db->delete('review_images');
            $this->uploadReviewImages($review_id);
        }

        $this->response(['status' => 'success', 'message' => 'Review Updated Successfully'], RestController::HTTP_OK);
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
            $this->response(['status' => 'failed', 'message' => 'Failed to add review'], RestController::HTTP_OK);
        }

        // Upload images for new review
        if (!empty($_FILES['images']['name'][0])) {
            $this->uploadReviewImages($review_id);
        }

        $this->response(['status' => 'success', 'message' => 'Review Added Successfully'], RestController::HTTP_OK);
    }
}


/**
 * Function to upload review images
 */
private function uploadReviewImages($review_id)
{
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
        $config['file_name'] = time() . '_' . rand(1000, 9999);

        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            $imageData = [
                'review_id' => $review_id,
                'image_url' => $this->upload->data('file_name'),
            ];
            $this->db->insert('review_images', $imageData);
        }
    }
}

/**
 * Mock function to verify token (Replace with actual implementation)
 */
private function verifyToken($token)
{
	
	$users = $this->db->get_where("users", ["token"=>$post->token])->row();
  
    return $users->UserID;
}


    public function userAddress_post()
	{  
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
         $res = ['status' => false,'message' => 'Please provide token !!', 'data' => null];
         $this->response($res, RestController::HTTP_OK);   
       }
        $users = $this->db->get_where("users", ["token"=>$post->token])->row();

        $this->db->select("*")->where(['user_id'=>$users->UserID,'show_hide'=>1]);
        $query = $this->db->get('address');
        $data = $query->result_array();
        
        if(!empty($data )){
            $res = ['status' => true,'message' => 'success', 'data' => $data];
        }else{
            $res = ['status' => false,'message' => 'No address !!', 'data' => null];
        }
      
        $this->response($res, RestController::HTTP_OK);
	}

    public function addAddress_post()
	{  
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
        $res = ['status' => false,'message' => 'Please provide token !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
    }
       if(!isset($post->name) && $post->name =='' ){
           $res = ['status' => false,'message' => 'Please add name !!', 'data' => null];
           $this->response($res, RestController::HTTP_OK);   
       }
		 if(!isset($post->email) && $post->email =='' ){
           $res = ['status' => false,'message' => 'Please add email !!', 'data' => null];
           $this->response($res, RestController::HTTP_OK);   
       }
       if(!isset($post->phone) ){
        $res = ['status' => false,'message' => 'Please add phone !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }
       if(!isset($post->landmark) ){
        $res = ['status' => false,'message' => 'Please add landmark !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }
       if(!isset($post->apartment) ){
        $res = ['status' => false,'message' => 'Please add apartment !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }
       if(!isset($post->street) ){
        $res = ['status' => false,'message' => 'Please add street !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }
        
       if(!isset($post->city) ){
        $res = ['status' => false,'message' => 'Please add city !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }
       if(!isset($post->state) ){
        $res = ['status' => false,'message' => 'Please add state !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }

       if(!isset($post->pincode) ){
        $res = ['status' => false,'message' => 'Please add pincode !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }
       $users = $this->db->get_where("users", ["token"=>$post->token])->row();

       $addresses = $this->db->get_where('address', ['user_id' => $users->UserID]);

       if ($addresses->num_rows() <= 0) {
           $post->is_default = 1;
       }
       

       $rerult=array(
            "name"=>$post->name ,
		   	"email"=>$post->email,
            "phone"=> $post->phone,
            "landmark"=> $post->landmark,
            "apartment"=>$post->apartment,
            "streetAddress"=>$post->street,
            "state"=>$post->state,
            "city"=>$post->city,
            "pincode"=> $post->pincode,
            "user_id"=> $users->UserID,
		    "is_default"=>isset($post->is_default) ? $post->is_default : 0
       );
		

        $this->db->insert("address",  $rerult);
      
       
        $this->db->select("*")->where('user_id',$users->UserID);
        $query = $this->db->get('address');
        $data = $query->result_array();
		
        
        $res = ['status' => true,'message' => 'success ', 'data' => $data];
        $this->response($res, RestController::HTTP_OK);
    
	}
	
	
public function updateAddress_post()
{
    // Retrieve JSON input
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    // Check if token is provided
    if (!isset($post->token)) {
        $res = ['status' => false, 'message' => 'Please provide token!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Check if address_id is provided
    if (!isset($post->address_id)) {
        $res = ['status' => false, 'message' => 'Please provide address ID!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Retrieve user based on the token
    $users = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$users) {
        $res = ['status' => false, 'message' => 'Invalid token!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }
    // Prepare the data to update
    $result = [];
    if (isset($post->name) && !empty($post->name)) {
        $result['name'] = $post->name;
    }
	if (isset($post->email) && !empty($post->email)) {
        $result['email'] = $post->email;
    }
    if (isset($post->phone) && !empty($post->phone)) {
        $result['phone'] = $post->phone;
    }
    if (isset($post->apartment) && !empty($post->apartment)) {
        $result['apartment'] = $post->apartment;
    }
	if (isset($post->landmark) && !empty($post->landmark)) {
        $result['apartment'] = $post->landmark;
    }
    if (isset($post->city) && !empty($post->city)) {
        $result['city'] = $post->city;
    }
    if (isset($post->state) && !empty($post->state)) {
        $result['state'] = $post->state;
    }
    if (isset($post->pincode) && !empty($post->pincode)) {
        $result['pincode'] = $post->pincode;
    }
    if (isset($post->is_default)) {
		if($post->is_default ==1){
        $this->db->set('is_default',0)->where('user_id',$users->UserID)->update('address');
		}
        $result['is_default'] = $post->is_default; // Allow 0 as valid
    }

    $resp = $this->db->set($result)->where(['id'=> $post->address_id])->update('address');

    // Prepare the response
    if ($resp) {
        $res = ['status' => true, 'message' => 'Address updated successfully!'];
    } else {
        $res = ['status' => false, 'message' => 'Failed to update the address.'];
    }

    // Send the response
    $this->response($res, RestController::HTTP_OK);
}

	
	
	public function deleteAddress_post()
	{
		
	$json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
        $res = ['status' => false,'message' => 'Please provide token !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
    	}
	   if(!isset($post->address_id)){
        $res = ['status' => false,'message' => 'Please provide address Id !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
    	}
		
		$users = $this->db->get_where("users", ["token"=>$post->token])->row();
		
		$resp = $this->db->set('show_hide',2)->where(['user_id'=>$users->UserID,'id'=>$post->address_id])->update('address');
		if($resp){
			$res = ['status' => true,'message' => 'success '];
		}else{
			$res = ['status' => false,'message' => 'something went wrong '];
		}
		 $this->response($res, RestController::HTTP_OK);
		
	}
	
    
    


    // Otp Verify api 
public function updateProfile_post()
{
	$this->load->library('upload');
    // Get input data
    $token      = $this->input->post('token');
    $name       = $this->input->post('name');
    //$mobile     = $this->input->post('mobile');
    $email      = $this->input->post('email');
    $birth_date = $this->input->post('birth_date');
    $address    = $this->input->post('address');
    $city       = $this->input->post('city');
    $gender     = $this->input->post('gender');

    // Validate required fields
    if (empty($token)) {
        $this->response(['status' => false, 'message' => 'Please provide token !!', 'data' => null], RestController::HTTP_OK);
    }

    if (empty($name)) {
        $this->response(['status' => false, 'message' => 'Please provide name !!', 'data' => null], RestController::HTTP_OK);
    }

    if (empty($email)) {
        $this->response(['status' => false, 'message' => 'Please provide email !!', 'data' => null], RestController::HTTP_OK);
    }

    // Check if user exists
    $user = $this->db->get_where('users', ['token' => $token])->row();
    if (!$user) {
        $this->response(['status' => false, 'message' => 'User not found !!', 'data' => null], RestController::HTTP_OK);
    }

    // Image Upload Handling
    $uploadPath = './uploads/';
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $profile_image = $user->profile_image; // Keep existing image if not updated
    if (!empty($_FILES['profile_image']['name'])) {
        $config['upload_path']   = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name']     = 'profile_' . time();
        $config['max_size']      = 2048; // 2MB limit

        $this->upload->initialize($config);

        if ($this->upload->do_upload('profile_image')) {
            $uploadData = $this->upload->data();
            $profile_image = 'uploads/' . $uploadData['file_name'];
        }
    }

    // Update user details
	if($name && $name!=''){
		$updateData['name'] = $name;
	}
	if($email && $email!=''){
		$updateData['Email'] = $email;
	}
		if($city && $city!=''){
		$updateData['city'] = $city;
	}
		if($address && $address!=''){
		$updateData['address'] = $address;
	}
		if($birth_date && $birth_date!=''){
		$updateData['birth_date'] = $birth_date;
	}
			if($profile_image && $profile_image!=''){
		$updateData['image'] = $profile_image;
	}
			if($gender && $gender!=''){
		$updateData['gender'] = $gender;
	}
    
    
    $this->db->where('token', $token)->update('users', $updateData);

    // Fetch updated details
    $updatedUser = $this->db->get_where('users', ['token' => $token])->row();

    // Prepare response
    $result = [
        'name'        => $updatedUser->name,
        //'mobile'      => $updatedUser->mobile,
        'email'       => $updatedUser->Email,
        'gender'      => $updatedUser->gender,
        'birth_date'  => $updatedUser->birth_date,
        'address'     => $updatedUser->address,
        'city'        => $updatedUser->city,
        'image'       => $updatedUser->image ? base_url($updatedUser->image) : null,
    ];

    $this->response(['status' => true, 'message' => 'Profile updated successfully', 'data' => $result], RestController::HTTP_OK);
}



    public function getSearchTotal($post)
    {
        $this->db->select('COUNT(*) AS numrows')
                 ->from('jwellaries j')
                 ->join('jwellary_varient v', 'v.jwellary_id = j.id', 'left')
                 ->join('categories c', 'c.CategoryID = j.category_id', 'left')
                 ->where('j.is_deleted', 2);
    
        // Search term filter
        if (!empty($post['searchTerm'])) {
            $this->db->group_start()
                     ->like('j.jwellary_name', $post['searchTerm'])
                     ->or_like('j.jwellary_description', $post['searchTerm'])
                     ->or_like('c.CategoryName', $post['searchTerm'])
                     ->group_end();
        }
    
        // Color filter
        if (!empty($post['filter']['color'])) {
            $this->db->where_in('v.color', $post['filter']['color']);
        }
    
        // Price filter
        if (!empty($post['filter']['price'])) {
            $price = $post['filter']['price'];
            if (!empty($price['min'])) {
                $this->db->where('v.base_price >=', $price['min']);
            }
            if (!empty($price['max'])) {
                $this->db->where('v.base_price <=', $price['max']);
            }
        }
    
        // Categories filter
        if (!empty($post['filter']['categories'])) {
            $this->db->where_in('j.category_id', $post['filter']['categories']);
        }
    
        // Size filter
        if (!empty($post['filter']['size'])) {
            $this->db->where_in('j.sizing', $post['filter']['size']);
        }
    
        // Discount filter
        if (!empty($post['filter']['discount'])) {
            $this->db->group_start();
            foreach ($post['filter']['discount'] as $discount) {
                $this->db->or_where('((v.base_price - v.sale_price) / v.base_price) * 100 >=', $discount);
            }
            $this->db->group_end();
        }
    
        // Gender filter
        if (!empty($post['filter']['gender'])) {
            $this->db->where_in('j.ideal_for', $post['filter']['gender']);
        }
    
        $query = $this->db->get();
        $result = $query->row();
        return $result->numrows;
    }
        
    public function search_post()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
    
        $limit = 20;
        $total = $this->getSearchTotal($post);
        $currentPage = max(1, isset($post['page']) ? (int)$post['page'] : 1);
        $totalPages = ceil($total / $limit);
        $offset = ($currentPage - 1) * $limit;
    
        $this->db->select('j.*, v.*, i.image AS image, c.CategoryName')
                 ->from('jwellaries j')
                 ->join('jwellary_varient v', 'v.jwellary_id = j.id', 'left')
                 ->join('jwellary_images i', 'i.varient = v.varient_id', 'left')
                 ->join('categories c', 'c.CategoryID = j.category_id', 'left')
                 ->where('j.is_deleted', 2);
    
        // Search term filter
        if (!empty($post['searchTerm'])) {
            $this->db->group_start()
                     ->like('j.jwellary_name', $post['searchTerm'])
                     ->or_like('j.jwellary_description', $post['searchTerm'])
                     ->or_like('c.CategoryName', $post['searchTerm'])
                     ->group_end();
        }
    
        // Color filter
        if (!empty($post['filter']['color'])) {
            $this->db->where_in('v.color', $post['filter']['color']);
        }
    
        // Price filter
        if (!empty($post['filter']['price'])) {
            $price = $post['filter']['price'];
            if (!empty($price['min'])) {
                $this->db->where('v.base_price >=', $price['min']);
            }
            if (!empty($price['max'])) {
                $this->db->where('v.base_price <=', $price['max']);
            }
        }
    
        // Categories filter
        if (!empty($post['filter']['categories'])) {
            $this->db->where_in('j.category_id', $post['filter']['categories']);
        }
    
        // Size filter
        if (!empty($post['filter']['size'])) {
            $this->db->where_in('j.sizing', $post['filter']['size']);
        }
    
        // Discount filter
        if (!empty($post['filter']['discount'])) {
            $this->db->group_start();
            foreach ($post['filter']['discount'] as $discount) {
                $this->db->or_where('((v.base_price - v.sale_price) / v.base_price) * 100 >=', $discount);
            }
            $this->db->group_end();
        }
    
        // Gender filter
        if (!empty($post['filter']['gender'])) {
            $this->db->where_in('j.ideal_for', $post['filter']['gender']);
        }
    
        // Sorting
        if (!empty($post['sort'])) {
            if ($post['sort'] === 'price--Low to High') {
                $this->db->order_by('v.base_price', 'ASC');
            } elseif ($post['sort'] === 'price--High to Low') {
                $this->db->order_by('v.base_price', 'DESC');
            }
        }
    
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $data = $query->result_array();
    
        // Prepare response data
        $base_url = 'https://www.mnnchaha.com/uploads/products/';
        $default_image = 'default.png';
        $products = [];
        foreach ($data as $product) {
            $base = $product['base_price'];
            $sale = $product['sale_price'];
            $discount = $this->calculateDiscount($base, $sale);
            $product['image'] = !empty($product['image']) ? $base_url . $product['image'] : $base_url . $default_image;
            $product['discount'] = $discount;
            $products[] = $product;
        }
    
        $res = [
            'status' => true,
            'message' => 'success',
            'data' => $products,
            'pagination' => [
                'total' => $total,
                'current_page' => $currentPage,
                'total_pages' => $totalPages,
                'per_page' => $limit
            ]
        ];
        $this->response($res, RestController::HTTP_OK);
    }
    
	
	
	    public function wishlist_get()
	{  
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
         $res = ['status' => false,'message' => 'Please provide token !!', 'data' => null];
         $this->response($res, RestController::HTTP_OK);   
       }
        $users = $this->db->get_where("users", ["token"=>$post->token])->row();

        $query = $this->db->select('wishlist.*, jwellaries.*, jwellary_varient.*, jwellary_images.image AS varient_image')
        ->from('wishlist')
        ->join('jwellaries', 'jwellaries.id = wishlist.productID')  
        ->join('jwellary_varient', 'jwellary_varient.varient_id = wishlist.varient_id')  
        ->join(
            '(SELECT varient, MIN(image) as image FROM jwellary_images GROUP BY varient) as jwellary_images',
            'jwellary_images.varient = jwellary_varient.varient_id'
        )
        ->where(['wishlist.userID'=>$users->UserID,'wishlist.is_deleted'=>1])
    
        ->get();
    
                $data =  $query->result_array();
            $base_url = 'https://www.mnnchaha.com/uploads/products/';
        foreach ($data as &$wishlist) {
			   if (isset($wishlist['thumbnail']) && !empty($wishlist['thumbnail'])) {
                $wishlist['thumbnail'] = $base_url.$wishlist['thumbnail'];
            } else {
                $wishlist['thumbnail'] = $base_url.$wishlist['varient_image'];
            }
            $wishlist['varient_image'] = $base_url.$wishlist['varient_image'];

            
            
        }

        // $this->db->select("wishlist.*,")
        //          ->where('userID',$users->UserID);
        // $query = $this->db->get('wishlist');
        // $data = $query->result_array();
        
        if(!empty($data )){
            $res = ['status' => true,'message' => 'success', 'data' => $data];
        }else{
            $res = ['status' => false,'message' => 'Wishlist is Empty!!', 'data' => null];
        }
      
        $this->response($res, RestController::HTTP_OK);
	}
	
	
	
		public function cart_get()
	{  
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
         $res = ['status' => false,'message' => 'Please provide token !!', 'data' => null];
         $this->response($res, RestController::HTTP_OK);   
       }
        $users = $this->db->get_where("users", ["token"=>$post->token])->row();

        $response = $this->db->select('c.*, j.*, v.*, i.image')
                     ->from('cart c')
                     ->join('jwellaries j', 'c.product_id = j.id')
                     ->join('jwellary_varient v', 'v.varient_id = c.varient_id')
                     ->join('jwellary_images i', 'v.varient_id = i.varient')
                     ->where(['c.user_id'=>$users->UserID,'c.is_deleted'=>1])
                     ->group_by('v.varient_id')
                     ->get();
    
        $data =  $response->result_array();
            $base_url = 'https://www.mnnchaha.com/uploads/products/';
       foreach ($data as  &$wishlist) {
		   		$wishlist['applicable_tax'] = intval($wishlist['applicable_tax']);
		       if (isset($wishlist['applicable_tax']) && !empty($wishlist['applicable_tax'])) {
                $wishlist['tax'] = round(($wishlist['sale_price']*$wishlist['applicable_tax']/100),2);
            } else {
                $wishlist['thumbnail'] = $base_url.$wishlist['image'];
            }
            $wishlist['image'] = $base_url.$wishlist['image'];
		       if (isset($wishlist['thumbnail']) && !empty($wishlist['thumbnail'])) {
                $wishlist['thumbnail'] = $base_url.$wishlist['thumbnail'];
            } else {
                $wishlist['thumbnail'] = $base_url.$wishlist['image'];
            }
            $wishlist['discount'] = ($wishlist['base_price'] > 0 && $wishlist['sale_price'] > 0)
            ? round((($wishlist['base_price'] - $wishlist['sale_price']) / $wishlist['base_price']) * 100, 2)
            : 0;
		   

        }
        
        if(!empty($data )){
            $res = ['status' => true,'message' => 'success', 'data' => $data];
        }else{
            $res = ['status' => false,'message' => 'Cart is Empty!!', 'data' => null];
        }
      
        $this->response($res, RestController::HTTP_OK);
	}
    
	
	
	   public function addCart_post()
	{  
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
        $res = ['status' => false,'message' => 'Please provide token !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
    }
       if(!isset($post->product_id) || $post->product_id =='' ){
           $res = ['status' => false,'message' => 'Please provide product ID !!', 'data' => null];
           $this->response($res, RestController::HTTP_OK);   
       }
       if(!isset($post->varient_id) || $post->varient_id =='' ){
        $res = ['status' => false,'message' => 'Please provide varient ID !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }
       if(!isset($post->quantity) || $post->quantity =='' ){
        $res = ['status' => false,'message' => 'Please provide varient ID !!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
       }
       $users = $this->db->get_where("users", ["token"=>$post->token])->row();


       $result=array(
            "product_id"=>$post->product_id ,
            "varient_id"=> $post->varient_id,
            "quantity"=> $post->quantity,
            "user_id"=> $users->UserID
       );
		   
		$cart = $this->db->select('*')
        ->from('cart')
        ->where([
            'varient_id' => $result['varient_id'],
            'user_id' => $result['user_id'],
        ])
        ->get()
        ->num_rows();
if($cart){
	$this->db->set(['is_deleted'=>1,'quantity'=>$result['quantity']])
			 ->where(['user_id'=>$result['user_id'],'varient_id'=>$result['varient_id']])
			->update('cart');
	$res = ['status' => true, 'message' => 'success '];
}else{
       $this->db->insert("cart", $result);

        $id = $this->db->insert_id();
       if ($id) {
        $res = ['status' => true,'message' => 'success '];
        
        }else{
            $res = ['status' => false,'message' => 'Something Went Wrong'];
        }
	}
        $this->response($res, RestController::HTTP_OK);
    
	}
    
	
public function addWishlist_post()
{
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    // Validate token
    if (!isset($post->token) || trim($post->token) == '') {
        $res = ['status' => false, 'message' => 'Please provide token!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Validate product_id
    if (!isset($post->product_id) || trim($post->product_id) == '') {
        $res = ['status' => false, 'message' => 'Please provide product ID!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Validate varient_id
    if (!isset($post->varient_id) || trim($post->varient_id) == '') {
        $res = ['status' => false, 'message' => 'Please provide variant ID!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Fetch user by token
    $users = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$users) {
        $res = ['status' => false, 'message' => 'Invalid token! User not found.', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Prepare the data for the wishlist
    $result = [
        "productID" => $post->product_id,
        "varient_id" => $post->varient_id,
        "userID" => $users->UserID,
        "is_deleted" => 1 // Default to active in the wishlist
    ];

    // Check if the item already exists in the wishlist
    $wish = $this->db->select('*')
        ->from('wishlist')
        ->where([
            'varient_id' => $result['varient_id'],
            'userID' => $result['userID'],
        ])
        ->get()
        ->num_rows();

    if ($wish) {
        $this->db->set('is_deleted', 1)
            ->where([
                'varient_id' => $result['varient_id'],
                'userID' => $result['userID']
            ])
            ->update('wishlist');

        $res = ['status' => true, 'message' => 'Item added to wishlist!'];
    } else {
        // Otherwise, add the item to the wishlist
        $this->db->insert("wishlist", $result);
        $id = $this->db->insert_id();

        if ($id) {
            $res = ['status' => true, 'message' => 'Item added to wishlist!'];
        } else {
            $res = ['status' => false, 'message' => 'Something went wrong while adding to wishlist.'];
        }
    }

    $this->response($res, RestController::HTTP_OK);
}

	
	public function removeCart_post()
{  
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    if (!isset($post->token) || trim($post->token) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid token!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
        return;
    }
    if (!isset($post->varient_id) || trim($post->varient_id) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid variant ID!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
        return;
    }

    $user = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$user) {
        $res = ['status' => false, 'message' => 'Invalid token! User not found.', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }
    $update = $this->db->set("is_deleted", 2)
                       ->where(['varient_id' => $post->varient_id, 'user_id' => $user->UserID])
                       ->update('cart');
    if ($update) {
        $res = ['status' => true, 'message' => 'Item removed from cart successfully!'];
    } else {
        $res = ['status' => false, 'message' => 'Failed to remove item from cart. Please try again.'];
    }
    $this->response($res, RestController::HTTP_OK);
}
	
	
	public function removeWishlist_post()
{  
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    if (!isset($post->token) || trim($post->token) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid token!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
        return;
    }
    if (!isset($post->varient_id) || trim($post->varient_id) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid variant ID!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
        return;
    }

    $user = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$user) {
        $res = ['status' => false, 'message' => 'Invalid token! User not found.', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }
    $update = $this->db->set("is_deleted", 2)
                       ->where(['varient_id' => $post->varient_id, 'userID' => $user->UserID])
                       ->update('wishlist');
    if ($update) {
        $res = ['status' => true, 'message' => 'Item removed from wishlist successfully!'];
    } else {
        $res = ['status' => false, 'message' => 'Failed to remove item from wishlist. Please try again.'];
    }
    $this->response($res, RestController::HTTP_OK);
}
	
	
	
	
public function createorder_post()
{
    $json = file_get_contents('php://input');
    $post = json_decode($json, true);
    $requiredFields = ['token', 'products', 'order_id', 'address_id', 'total', 'payment_type', 'payment_status'];
    foreach ($requiredFields as $field) {
        if (empty($post[$field])) {
            $res = ['status' => false, 'message' => "Please provide {$field} !!", 'data' => null];
            $this->response($res, RestController::HTTP_OK);
            return;
        }
    }
    $users = $this->db->get_where("users", ["token" => $post['token']])->row();
    if (!$users) {
        $res = ['status' => false, 'message' => 'Invalid token. User not found.', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }
    $payment_data = 0;
    if ($post['payment_type'] == 'prepaid' && $post['payment_status'] == 'success') {
        $payment = [
            "user_id" => $users->UserID,
            "payment_id" => $post['payment_id'] ?? '',
            "order_id" => $post['order_id'] ?? '',
            "signature" => $post['signature'] ?? '',
            "code" => $post['code'] ?? '',
            "message" => $post['message'] ?? '',
            "total"=> $post['total'] ?? '',
        ];
        $this->db->insert('payments', $payment);
        $payment_data = $this->db->insert_id();
        $cod_charge = 0;
    }else{
        $cod_charge = 40; 
    }
    $this->load->model('UserModel');
    $details = [];
    $variant_ids = [];

    foreach ($post['products'] as $product) {
        $data = [
            'productID' => $product['product_id'],
            'varientID' => $product['varient_id'],
        ];
        $prod = $this->UserModel->getCompleteData($data);
        if ($prod) {
            $prod['quantity'] = $product['quantity'];
            $details[] = $prod;
            $variant_ids[] = $product['varient_id'];
        } else {
            $res = ['status' => false, 'message' => "No product found for ID: {$product['product_id']}", 'data' => null];
            $this->response($res, RestController::HTTP_OK);
            return;
        }
    }


    // Validate address
    $address = $this->db->select('*')->from('address')
        ->where('id', $post['address_id'])
        ->where('show_hide', 1)
        ->get()
        ->row_array();

    if (!$address) {
        $res = ['status' => false, 'message' => 'Address not found.', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }
	
    // Prepare shipment data
    $shipmentPayload = [
        'details' => $details,
        'address' => $address,
        'channel_id' => '5787388',
        'payment' => $payment ?? [],
        'payment_type' => $post['payment_type'],
        'total' => $post['total'],
        'cod_charge'=>$cod_charge
    ];

    $shipmentData = $this->processShip($shipmentPayload);
	
    if (!$shipmentData) {
        $res = ['status' => false, 'message' => 'Shipment creation failed.', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Save order details
    $save = [];
    foreach ($shipmentData as $shipment) {
        $productData = $this->UserModel->getCompleteData($shipment);
		
        if ($productData) {
      $save[] = $this->prepareFinalProductData($shipment, $productData, $post['address_id'], $payment_data, $post['payment_type'], $users,$cod_charge);
			
        } else {
            log_message('error', "Product data not found for shipment: " . json_encode($shipment));
        }
		
    }

    // Save the order
    if (!empty($save)) {
        $order_id = $this->UserModel->saveOrder($save);
        if ($order_id) {
            $this->UserModel->updateCart($variant_ids);
            $res = ['status' => true, 'message' => 'Order created successfully.', 'data' => ['order_id' => $order_id]];
        } else {
            $res = ['status' => false, 'message' => 'Failed to save order.', 'data' => null];
        }
    } else {
        $res = ['status' => false, 'message' => 'No products saved for the order.', 'data' => null];
    }

    $this->response($res, RestController::HTTP_OK);
}



private function prepareFinalProductData($products, $fiproduct, $address, $payment, $payment_type, $customer,$cod_charge)
{

	
    $finalproduct = [
        'quantity' => $products['quantity'],
        'order_id' => $products['order_id'],
        'shipment_id' => $products['shipment_id'],
        'varient_id' => $products['varientID'],
        'product_id' => $products['productID'],
        'address_id' => $address,
        'user_id' => $customer->UserID,
        'amount' => $fiproduct['sale_price'],
        'taxes'=>($fiproduct['sale_price']*$fiproduct['applicable_tax']*$products['quantity'])/100,
        'cod_charge'=>$cod_charge,
        'payment'=>$payment,
        'payment_type'=>$payment_type
        
    ];
	

    return $finalproduct;
}




public function processShip($data)
{
    $shipingRes = [];
    
    foreach ($data['details'] as $product) {
        $sendData = $this->prepareShipmentPayload($data, $product);

        // Call the shipment API
        $res = $this->shipm($sendData);
		
        //$this->sendMail($res);

        // Add product-specific details to the response
        $res['varientID'] = $product['varient_id'];
        $res['productID'] = $product['id'];
        $res['quantity'] = $product['quantity'];

        // Store the response
        $shipingRes[] = $res;
    }


    return $shipingRes;
}




private function prepareShipmentPayload($data, $product)
{
    return [
        "order_id" => $this->generateInvoiceNumber($data['payment_type']),
        "order_date" => $this->getCurrentTime(),
        "pickup_location" => "Work",
        "channel_id" => $data['channel_id'],
        "comment" => $data['comment'] ?? "NA",
        "billing_customer_name" => $data['address']['name'],
        "billing_last_name" => $data['address']['last_name'] ?? " ",
        "billing_address" => $data['address']['streetAddress'],
        "billing_address_2" => $data['address']['address2'] ?? " ",
        "billing_isd_code" => "+91",
        "billing_city" => $data['address']['city'],
        "billing_pincode" => $data['address']['pincode'],
        "billing_state" => $data['address']['state'] ?? "UTTAR PRADESH",
        "billing_country" => $data['address']['country'] ?? "India",
        "billing_email" => $data['address']['email'],
        "billing_phone" => $data['address']['phone'],
        "billing_alternate_phone" => $data['address']['alternate_number'] ?? " ",
        "shipping_is_billing" => false,
        "shipping_customer_name" => $data['address']['name'],
        "shipping_last_name" => $data['address']['last_name'] ?? " ",
        "shipping_address" => $data['address']['streetAddress'],
        "shipping_address_2" => $data['address']['address2'] ?? " ",
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
                "tax" => $product['applicable_tax'],
                "hsn" => $product['hsn'],
            ]
        ],
        "payment_method" => $data['payment_type'],
        "shipping_charges" => $data['gst'] ?? "0",
        "giftwrap_charges" => $data['giftwrap_charges'] ?? "0",
        "transaction_charges" => $data['transaction_charges'] ?? "0",
        "total_discount" => $data['total_discount'] ?? "0",
        "sub_total" => ($product['sale_price']+(($product['sale_price']*$product['applicable_tax'])/100))*$product['quantity'],
		"shipping_charges" => ($data['payment_type'] == 'cod')  ? 40 : 0,
		"total_shipping_charge"=>($data['payment_type'] == 'cod')  ? 40 : 0,
		"total_order_value"=>(($product['sale_price']+(($product['sale_price']*$product['applicable_tax'])/100))+($data['payment_type'] == 'cod')  ? 40 : 0),
        "length" => $product['dimensions']['length'] ?? "6",
        "breadth" => $product['dimensions']['breadth'] ?? "2",
        "height" => $product['dimensions']['height'] ?? "8",
        "weight" => $product['weight'] / 1000,
        "ewaybill_no" => $this->generateInvoiceNumber($data['payment_type']),
        "customer_gstin" => $data['customer_gstin'] ?? "",
        "invoice_number" => $this->generateInvoiceNumber($data['payment_type']),
        "order_type" => "NON ESSENTIALS",
    ];
}




public function getCurrentTime()
{
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d H:i');

    return $current_time;
}

function generateInvoiceNumber($paymentMode) {
    $timestamp = time();
    $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $invoiceNumber = "{$paymentMode}_{$timestamp}_{$randomNumber}";
    return $invoiceNumber;
}


    public function shipm($data)
{
    
    // Shiprocket API credentials
    $api_url = 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc';
    $api_key = $this->getAuthToken();
		
    $request_data_json = json_encode($data);
    // print_r($request_data_json);
    // exit;

    // Set up the cURL request
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data_json);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return false;
    }
    curl_close($ch);
    
    $response_data = json_decode($response, true);
   
    return $response_data;
}


private function getAuthToken()
{
    // Check if the session already has a valid token
    //if ($this->session->userdata('shiprocket_token') && $this->session->userdata('shiprocket_token_expiry') > time()) {
      if ($this->session->userdata('shiprocket_token')) {  
		return $this->session->userdata('shiprocket_token');
    }

    // Request a new token from Shiprocket
    $url = 'https://apiv2.shiprocket.in/v1/external/auth/login';
    $credentials = [
        'email' => 'info@mnnchaha.com',
        'password' => 'Shri@sai01'
    ];

    // Make the API request
    $response = $this->makeApiRequest('POST', $url, $credentials, false);

    // Check if the response contains a token
    if ($response && isset($response['token'])) {
        // Save token and expiry in session
        $this->session->set_userdata('shiprocket_token', $response['token']);
        //$this->session->set_userdata('shiprocket_token_expiry', time() + 3600); // Token expires in 1 hour
        return $response['token'];
    }

    // Log error if token fetching fails
    log_message('error', 'Failed to fetch Shiprocket token. Response: ' . print_r($response, true));
    
    return null; // Return null if token could not be fetched
}


private function makeApiRequest($method, $url, $data = [], $useAuth = true)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    $headers = ['Content-Type: application/json'];
    if ($useAuth) {
        $token = $this->getAuthToken();
        if (!$token) {
            return null;
        }
        $headers[] = 'Authorization: Bearer ' . $token;
    }
	

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
	
    if (curl_errno($ch)) {
        log_message('error', 'cURL error: ' . curl_error($ch));
        return null;
    }
    curl_close($ch);

    return json_decode($response, true);
}
	
	
	
public function myOrders_post()
{
    // Get the input data
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    // Validate token
    if (!isset($post->token) || trim($post->token) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid token!', 'data' => null];
        $this->response($res, RestController::HTTP_OK);   
        return;
    }

    // Fetch user by token
    $user = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$user) {
        $res = ['status' => false, 'message' => 'Invalid token! User not found.', 'data' => null];
        $this->response($res, RestController::HTTP_OK);
        return;
    }

    // Fetch orders and join necessary tables
    $orders = $this->db->select('orders.*, jwellaries.jwellary_name,jwellaries.sizing, jwellary_varient.dimension, jwellary_varient.varient_sku, jwellary_varient.base_price, jwellary_varient.sale_price, jwellary_varient.color, MIN(jwellary_images.image) AS image')
        ->from('orders')
        ->join('jwellaries', 'orders.product_id = jwellaries.id', 'inner')
        ->join('jwellary_varient', 'jwellary_varient.varient_id = orders.varient_id', 'inner')
        ->join('jwellary_images', 'jwellary_images.varient = orders.varient_id', 'inner')
        ->where('orders.user_id', $user->UserID)
        ->where('jwellary_images.is_deleted', 1)
        ->group_by('orders.id') // Group by order ID to use MIN() properly
        ->get()
        ->result_array();

    // Map order statuses
    $statusMapping = [
        1 => 'pending',
        2 => 'confirmed',
        3 => 'picked up',
        8 => 'in transit',
        4 => 'delivered',
        5 => 'cancelled',
        6 => 'returned',
		7 => 'cancelled by admin',
    ];

    // Process orders
    foreach ($orders as &$order) {
        // Map order status
        $order['order_status'] = $statusMapping[$order['order_status']] ?? 'unknown';

        // Set image URL or placeholder
        if (!empty($order['image'])) {
            $order['image'] = 'https://www.mnnchaha.com/uploads/products/' . $order['image'];
        } else {
            $order['image'] = 'https://www.mnnchaha.com/uploads/products/default-placeholder.png';
        }
    }

    // Prepare response
    if (!empty($orders)) {
        $res = ['status' => true, 'message' => 'success', 'data' => $orders];
    } else {
        $res = ['status' => false, 'message' => 'No orders found!', 'data' => null];
    }

    $this->response($res, RestController::HTTP_OK);
}


public function trackorder_post()
{
    // Read JSON input
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    // Validate token
    if (!isset($post->token) || trim($post->token) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid token!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);   
        return;
    }

    // Validate shipment ID
    if (!isset($post->shipment) || trim($post->shipment) == '') {
        $res = ['status' => false, 'message' => 'Please provide a shipment ID!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);   
        return;
    }

    // Fetch user by token
    $user = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$user) {
        $res = ['status' => false, 'message' => 'Invalid token or user not found!', 'data' => null];
        $this->response($res, RestController::HTTP_UNAUTHORIZED);
        return;
    }

    // Call Shiprocket API
    $url = 'https://apiv2.shiprocket.in/v1/external/courier/track/shipment/' . trim($post->shipment);
    $track = $this->makeApiRequest('GET', $url);

    // Handle API response
    if ($track !== false && !empty($track)) {
        $res = ['status' => true, 'message' => 'Success', 'data' => $track];
    } else {
        $res = ['status' => false, 'message' => 'Failed to fetch tracking data or no orders found!', 'data' => null];
    }

    $this->response($res, RestController::HTTP_OK);
}
	

	public function cancelorder_post()
{

    $json = file_get_contents('php://input');
    $post = json_decode($json);

    // Validate token
    if (!isset($post->token) || trim($post->token) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid token!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);   
        return;
    }

    // Validate order IDs
    if (!isset($post->orderid)) {
        $res = ['status' => false, 'message' => 'Please provide valid order IDs in an array!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);   
        return;
    }
    $user = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$user) {
        $res = ['status' => false, 'message' => 'Invalid token or user not found!', 'data' => null];
        $this->response($res, RestController::HTTP_UNAUTHORIZED);
        return;
    }

    $url = 'https://apiv2.shiprocket.in/v1/external/orders/cancel';
    $bearerToken = $this->getAuthToken();
		
    $data = [
        "ids" => [$post->orderid]
    ];
		
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $bearerToken
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
		
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'status' => 'error',
            'message' => $error
        ];
    }
    curl_close($ch);
		$response = json_decode($response, true);
    if ($response !== false && isset($response['status_code']) && $response['status_code'] == 200) {
        $this->db->set('order_status',5)->where(['order_id'=>$post->orderid,'user_id'=>$user->UserID])->update('orders');
        $res = [
            'status' => true,
            'message' => 'Order(s) cancelled successfully!',
            'data' => $response // Include Shiprocket response data
            
        ];
    }else{
        $res = [
            'status' => false,
            'message' => $response['message'] ?? 'Failed to cancel the order(s)!',
            'data' => null
        ];
    }
    $this->response($res, RestController::HTTP_OK);
}
	
	
	public function returnorder_post()
{
    // Load the file upload library
    $this->load->library('upload');

    // Validate token
    $token = $this->input->post('token');
    if (!$token || trim($token) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid token!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Validate order ID
    $orderid = $this->input->post('orderid');
    if (!$orderid) {
        $res = ['status' => false, 'message' => 'Please provide a valid order ID!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Validate return reason
    $return_reason = $this->input->post('return_reason');
    if (!$return_reason) {
        $res = ['status' => false, 'message' => 'Please provide a valid return reason!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Validate comments
    $comments = $this->input->post('comments');
    if (!$comments) {
        $res = ['status' => false, 'message' => 'Please provide valid comments!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Fetch user by token
    $user = $this->db->get_where("users", ["token" => $token])->row();
    if (!$user) {
        $res = ['status' => false, 'message' => 'Invalid token or user not found!', 'data' => null];
        $this->response($res, RestController::HTTP_UNAUTHORIZED);
        return;
    }

    // Handle file upload
    $uploaded_images = [];
    if (!empty($_FILES['image']['name'])) {
        $config['upload_path'] = './uploads/returnimages/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = true; // Rename file to avoid conflicts

        $this->upload->initialize($config);

        foreach ($_FILES['image']['name'] as $key => $image) {
            $_FILES['file']['name'] = $_FILES['image']['name'][$key];
            $_FILES['file']['type'] = $_FILES['image']['type'][$key];
            $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$key];
            $_FILES['file']['error'] = $_FILES['image']['error'][$key];
            $_FILES['file']['size'] = $_FILES['image']['size'][$key];

            if ($this->upload->do_upload('file')) {
                $uploaded_images[] = base_url('uploads/returnimages/' . $this->upload->data('file_name'));
            } else {
                $res = ['status' => false, 'message' => 'Image upload failed: ' . $this->upload->display_errors()];
                $this->response($res, RestController::HTTP_BAD_REQUEST);
                return;
            }
        }
    }

    // Prepare data for database
    $data = [
        'user_id' => $user->UserID,
        'order_id' => $orderid,
        'return_reason' => $return_reason,
        'image' => json_encode($uploaded_images), // Store image paths as JSON
        'comments' => $comments,
    ];

    // Insert return request into the database
    $insert_id = $this->db->insert('order_returns', $data);
    if ($insert_id) {
        $res = ['status' => true, 'message' => 'Return Requested. Please wait for approval.'];
    } else {
        $res = ['status' => false, 'message' => 'Failed to create return request.'];
    }

    $this->response($res, RestController::HTTP_OK);
}




public function exchangeorder_post()
{
    // Load the file upload library
    $this->load->library('upload');

    // Validate token
    $token = $this->input->post('token');
    if (!$token || trim($token) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid token!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Validate order ID
    $orderid = $this->input->post('orderid');
    if (!$orderid) {
        $res = ['status' => false, 'message' => 'Please provide a valid order ID!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Validate return reason
    $return_reason = $this->input->post('return_reason');
    if (!$return_reason) {
        $res = ['status' => false, 'message' => 'Please provide a valid return reason!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

        // Validate return reason
        $type = $this->input->post('type');
        if (!$type) {
            $res = ['status' => false, 'message' => 'Please provide a policy type!', 'data' => null];
            $this->response($res, RestController::HTTP_BAD_REQUEST);
            return;
        }
    // Validate comments
    $comments = $this->input->post('comments');
    if (!$comments) {
        $res = ['status' => false, 'message' => 'Please provide valid comments!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Fetch user by token
    $user = $this->db->get_where("users", ["token" => $token])->row();
    if (!$user) {
        $res = ['status' => false, 'message' => 'Invalid token or user not found!', 'data' => null];
        $this->response($res, RestController::HTTP_UNAUTHORIZED);
        return;
    }

    // Handle file upload
    $uploaded_images = [];
    if (!empty($_FILES['image']['name'])) {
        $config['upload_path'] = './uploads/returnimages/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = true; // Rename file to avoid conflicts

        $this->upload->initialize($config);

        foreach ($_FILES['image']['name'] as $key => $image) {
            $_FILES['file']['name'] = $_FILES['image']['name'][$key];
            $_FILES['file']['type'] = $_FILES['image']['type'][$key];
            $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$key];
            $_FILES['file']['error'] = $_FILES['image']['error'][$key];
            $_FILES['file']['size'] = $_FILES['image']['size'][$key];

            if ($this->upload->do_upload('file')) {
                $uploaded_images[] = base_url('uploads/returnimages/' . $this->upload->data('file_name'));
            } else {
                $res = ['status' => false, 'message' => 'Image upload failed: ' . $this->upload->display_errors()];
                $this->response($res, RestController::HTTP_BAD_REQUEST);
                return;
            }
        }
    }

    if($type == 'return'){
        $return_type = 1;
    }elseif ($type == 'exchange') {
        $return_type = 2;
    }else{
        $return_type = 0;
    }
    // Prepare data for database
    $data = [
        'user_id' => $user->UserID,
        'order_id' => $orderid,
        'return_reason' => $return_reason,
        'image' => json_encode($uploaded_images), // Store image paths as JSON
        'comments' => $comments,
        'return_type'=>$return_type
    ];

    // Insert return request into the database
    $insert_id = $this->db->insert('order_returns', $data);
    if ($insert_id) {
        $res = ['status' => true, 'message' => 'Return Requested. Please wait for approval.'];
    } else {
        $res = ['status' => false, 'message' => 'Failed to create return request.'];
    }

    $this->response($res, RestController::HTTP_OK);
}
	

public function orderdetails_post()
{
    // Read JSON input
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    // Validate token
    if (!isset($post->token) || trim($post->token) == '') {
        $res = ['status' => false, 'message' => 'Please provide a valid token!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Validate order ID
    if (!isset($post->order_id) || trim($post->order_id) == '') {
        $res = ['status' => false, 'message' => 'Please provide an order ID!', 'data' => null];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Fetch user by token
    $user = $this->db->get_where("users", ["token" => $post->token])->row();
    if (!$user) {
        $res = ['status' => false, 'message' => 'Invalid token or user not found!', 'data' => null];
        $this->response($res, RestController::HTTP_UNAUTHORIZED);
        return;
    }

    // Call Shiprocket API
    $orderdata = $this->db->select('orders.*, jwellaries.*, jwellary_varient.*, MIN(jwellary_images.image) AS image, address.*')
        ->from('orders')
        ->where('orders.order_id', $post->order_id)
        ->join('jwellaries', 'jwellaries.id = orders.product_id')
        ->join('jwellary_varient', 'jwellary_varient.varient_id = orders.varient_id')
        ->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id', 'left')
        ->join('address', 'address.id = orders.address_id')
        ->group_by('orders.order_id') // Group by order_id to get a single record
        ->get()
        ->row_array();

    // Check if order data is found
    if ($orderdata) {
        // Modify image URLs and calculate discount percentage
        if (isset($orderdata['thumbnail']) && !empty($orderdata['thumbnail'])) {
            $orderdata['thumbnail'] = base_url('/uploads/products/') . $orderdata['thumbnail'];
        } else {
            $orderdata['thumbnail'] = base_url('/uploads/products/') . $orderdata['image'];
        }
		if (isset($orderdata['state']) && !empty($orderdata['state'])) {
			if($orderdata['state'] == 'maharastra'){
				$orderdata['CGST'] =  round($orderdata['taxes']/2,2);
				$orderdata['SGST'] = round($orderdata['taxes']/2,2);
				
			}else{
				$orderdata['IGST'] = round($orderdata['taxes'],2);
			}
            //$orderdata['thumbnail'] = base_url('/uploads/products/') . $orderdata['thumbnail'];
        } else {
            $orderdata['thumbnail'] = base_url('/uploads/products/') . $orderdata['image'];
        }

		 $orderdata['discount'] = round((($orderdata['base_price'] - $orderdata['sale_price']) * 100) / $orderdata['base_price'],2);
        if (isset($orderdata['image']) && !empty($orderdata['image'])) {
            $orderdata['image'] = base_url('/uploads/products/') . $orderdata['image'];
        }
        if (isset($orderdata['order_status']) && !empty($orderdata['order_status'])) {
            if ($orderdata['order_status']==1) {
                $current_status = 'pending';
            } elseif ($orderdata['order_status'] == 2) {
                $current_status = 'confirmed';
            } elseif ($orderdata['order_status']==3) {
                $current_status = 'picked up';
            } elseif ($orderdata['order_status']==4) {
                $current_status = 'delivered';
            } elseif ($orderdata['order_status']==5) {
                $current_status = 'cancelled';
            } elseif ($orderdata['order_status']==6) {
                $current_status = 'returned';
            } elseif ($orderdata['order_status']==7) {
                $current_status = 'cancelled by admin';
            } elseif ($orderdata['order_status']==8) {
                $current_status = 'in transit';
            }
            
            $orderdata['current_status'] = $current_status;
            $orderdata['invoice_url'] = base_url();
        }

        // Calculate discount percentage
        $orderdata['discountPercent'] = ($orderdata['base_price'] > 0 && $orderdata['sale_price'] > 0)
            ? round((($orderdata['base_price'] - $orderdata['sale_price']) / $orderdata['base_price']) * 100, 2)
            : 0;
            $recommended = $this->db->select('jwellaries.*, jwellary_varient.*, MIN(jwellary_images.image) as image')
                                    ->from('jwellaries')
                                    ->where([
                                        'jwellaries.category_id' => $orderdata['category_id'], 
                                        'jwellaries.is_deleted' => 2
                                    ])
                                    ->join('jwellary_varient', 'jwellary_varient.jwellary_id = jwellaries.id')
                                    ->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id', 'left')
                                    ->group_by('jwellaries.id') // Group by jewelry ID
                                    ->limit(5) // Limit to 5 results
                                    ->get()
                                    ->result_array();
            foreach ($recommended as &$recommend) {
                if (isset($recommend['thumbnail']) && !empty($recommend['thumbnail'])) {
                    $recommend['thumbnail'] = base_url('/uploads/products/') . $recommend['thumbnail'];
                } else {
                    $recommend['thumbnail'] = base_url('/uploads/products/') . $recommend['image'];
                }
        
                if (isset($recommend['image']) && !empty($recommend['image'])) {
                    $recommend['image'] = base_url('/uploads/products/') . $recommend['image'];
                }
				
				 $recommend['discount'] = round((($recommend['base_price'] - $recommend['sale_price']) * 100) / $recommend['base_price'],2);
				
				
            }
        
            $offers = $this->db->select('best_value.*')
                                ->from('best_value')
								->get()
                                ->result_array();
            foreach ($offers as &$offer) {
                if (isset($offer['thumbnail']) && !empty($offer['thumbnail'])) {
                    $offer['thumbnail'] = base_url('/uploads/') . $offer['thumbnail'];
                } else {
                    $offer['thumbnail'] = base_url('/uploads/') . $offer['image'];
                }
        
                if (isset($offer['image']) && !empty($offer['image'])) {
                    $offer['image'] = base_url('/uploads/') . $offer['image'];
                }
            }

        $data['orderdata'] = $orderdata;
        $data['recommended'] = $recommended;
        $data['offers'] = $offers;
        $res = [
            'status' => true,
            'message' => 'Order details fetched successfully!',
            'data' => $data
        ];
    } else {
        // If no order is found
        $res = [
            'status' => false,
            'message' => 'Order not found!',
            'data' => null
        ];
    }

    // Return the response
    $this->response($res, RestController::HTTP_OK);
}
	
	public function filterlist_get()
    {
				$categories = $this->db->select("*")
					->where(["is_deleted" => 1])
					->get('categories')
					->result_array();

				$cate = []; // Initialize an empty array
				foreach ($categories as $item) {
					$cate[] = $item['CategoryName']; // Add CategoryName to the array
				}

				
			$filters = [
				"Brand" => ["MNNCHAHA"],
				"Size" => ["adjustable", "free size"],
				"Categories" => $cate, 
				"price" => [
					["min"=>100,"max"=>200],
					["min"=>200,"max"=>300],
					["min"=>300,"max"=>400],
					["min"=>500,"max"=>600]
				],
				"discount" => [10,20, 30, 40, 50, 60, 70, 80],
				"ideal_for" => ["men", "woman", "child"]
			];

    // Insert return request into the database

    if ($filters) {
        $res = ['status' => true, 'data'=>$filters];
    } else {
        $res = ['status' => false, 'message' => 'Failed to create return request.'];
    }

    $this->response($res, RestController::HTTP_OK);
}
	
	
	
	
	
	
	
public function Invoice_get()
{
    // Get JSON input
    $json = file_get_contents('php://input');
    $post = json_decode($json);

    // Validate order_id
    if (!isset($post->order_id) || trim($post->order_id) == '') {
        $res = ['status' => false, 'message' => 'Please provide order id!'];
        $this->response($res, RestController::HTTP_BAD_REQUEST);
        return;
    }

    // Prepare API payload
    $api_payload = [
        'ids' => [$post->order_id]  // Pass order_id in an array
    ];

    // Shiprocket API URL
    $url = 'https://apiv2.shiprocket.in/v1/external/orders/print/invoice';

    // Get authorization token
    $api_key = $this->getAuthToken();

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_payload));

    // Set headers
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        log_message('error', 'cURL error: ' . curl_error($ch));
        http_response_code(500);
        $res = json_encode(['status' => 'fail', 'message' => 'Failed to send request to Shiprocket API.']);
        curl_close($ch);
        return;
    }

    // Close cURL
    curl_close($ch);

    // Decode the response
    $response_data = json_decode($response, true);

    // Check if response is valid
    if ($response_data) {
		//es = json_encode(['status' => 'true',$response_data]);
		$this->response($response_data,RestController::HTTP_OK);
      //this esponse($response_data, RestController::HTTP_OK);
    } else {
        http_response_code(500);
        $res = json_encode(['status' => 'fail', 'message' => 'Failed to decode Shiprocket API response.']);
    }
	     
        $this->response($res, RestController::HTTP_OK);
        return;
}

    
    
	
  
}

