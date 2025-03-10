<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
{
$banner = $this->db->select('banner.*')
                   ->from('banner')
				   ->where('is_deleted',1)
                   ->get()
                   ->result_array();

    $query = "
        SELECT 
            p.id AS product_id,
            p.ProductName AS ProductName,
            p.Description,
            p.offer_price,
			p.price,
			p.image,
            p.CategoryID,
            d.id AS product_id,
            d.basis,
            d.color,
            d.created_at,
            d.show_hide
        FROM 
            populars d
        JOIN 
            products p ON p.id = d.product_id";

    $data['populars'] = $this->db->query($query)->result_array();
	$dotdquery = "
        SELECT 
            p.id AS product_id,
            p.ProductName AS ProductName,
            p.Description,
            p.offer_price,
			p.price,
			p.image,
            p.CategoryID,
            d.id AS product_id,
            d.till
        FROM 
            dotd d
        JOIN 
            products p ON p.id = d.product_id";

    $data['populars'] = $this->db->query($query)->result_array();
	$data['dotd'] = $this->db->query($dotdquery)->result_array();
		$data['banner'] = $banner;

    $data['category'] = $this->db->select('categories.*')->from('categories')->where('is_deleted',1)->get()->result_array();
    $data['offer'] = $this->db->select('best_value.*')->from('best_value')->get()->result_array();

    $this->load->view('User/index', ['data' => $data]);
}

public function generateApiKey($length = 32) {
     print_r(bin2hex(random_bytes($length)));

}



public function cardlist($categoryID)
{
    
    // Fetch the category details
    $category = $this->db->select('categories.CategoryName, categories.ParentCategoryID')
        ->from('categories')
        ->where('CategoryID', $categoryID)
        ->get()
        ->row_array();
    
    // Load necessary models and libraries
    $this->load->model('CategoryModel');
    $this->load->library('pagination');

    // Pagination configuration
    $perPage = 21;
    $total = $this->CategoryModel->countCategories($categoryID); // Ensure this is counting based on necessary filters
    $currentPage = ($this->uri->segment(4)) ? (int)$this->uri->segment(4) : 1;
    $totalPages = ceil($total / $perPage);
    $offset = ($currentPage - 1) * $perPage;
    $baseUrl = site_url('Welcome/cardlist/' . $categoryID);

    // Fetch products under the category
    $result = $this->CategoryModel->getDataCategories($categoryID, $perPage, $offset);
 

    foreach($result as &$product)
    {
        $product['is_cart']=$this->cart_update($product['varient_id']);

    }
    // Fetch subcategories under this category
    $subcategories = $this->db->select('categories.*')
        ->from('categories')
        ->where(['is_deleted' => 1, 'ParentCategoryID' => $categoryID])
        ->get()
        ->result_array();

    // If no subcategories found, fall back to the parent category's subcategories
    if (empty($subcategories)) {
        $subcategories = $this->db->select('categories.*')
            ->from('categories')
            ->where(['is_deleted' => 1, 'ParentCategoryID' => $category['ParentCategoryID']])
            ->get()
            ->result_array();
    }

    // Create pagination links
    $paginationLinks = $this->createCustomPagination($currentPage, $totalPages, $baseUrl);

    // Prepare the response data
    $res = [
        'tittle' => $category['CategoryName'],
        'subcategories' => $subcategories,
        'products' => $result,
        'pagination' => $paginationLinks,
        'meta' => [
            'total' => $total,
            'total_pages' => $totalPages,
            'current_page' => $currentPage // Correctly set 1-based current page
        ],
    ];

    // Fetch additional category data if needed
    $cat = $this->CategoryModel->getCategoriesById($categoryID);
 
    // Load the views
    $this->load->view('User/header', ['cat' => $cat]);
    $this->load->view('User/card-list', ['result' => $res]);
}

public function cart_update($varient_id)
{

    $user_phone_email = $this->session->userdata('user_mobile');

    $this->db->select('UserID');
    $this->db->from('users');
    $this->db->where('PhoneNumber', $user_phone_email);
    $this->db->or_where('Email', $user_phone_email);
    $query = $this->db->get();
    $user_data = $query->row_array();

 
    $user_id = !empty($user_data) ? $user_data['UserID'] : null;
    if ($user_id) {
        return $this->db->where([
            'user_id'    => $user_id,
            'varient_id' => $varient_id,
            'is_deleted' => 1
        ])->from('cart')->count_all_results();
    } else {
        return 0;
    }
    

}



private function createCustomPagination($currentPage, $totalPages, $baseUrl)
{
    $output = '<ul class="pagination">';
    
    // "First" button
    if ($currentPage > 1) {
        $output .= '<button><a href="' . $baseUrl . '/1">First</a></button>';
    }

    // Generate first few pages
    for ($i = 1; $i <= 3; $i++) {
        if ($i > $totalPages) break;
        $active = ($i == $currentPage) ? ' class="active"' : '';
        $output .= '<li' . $active . '><a href="' . $baseUrl . '/' . $i . '">' . $i . '</a></li>';
    }

    // Ellipsis for skipped pages
    if ($currentPage > 4) {
        $output .= '<li><span>...</span></li>';
    }

    // Middle pages
    $start = max(4, $currentPage - 1);
    $end = min($totalPages - 3, $currentPage + 1);
    for ($i = $start; $i <= $end; $i++) {
        $active = ($i == $currentPage) ? ' class="active"' : '';
        $output .= '<li' . $active . '><a href="' . $baseUrl . '/' . $i . '">' . $i . '</a></li>';
    }

    // Ellipsis for skipped pages
    if ($currentPage < $totalPages - 3) {
        $output .= '<li><span>...</span></li>';
    }

    // Generate last few pages
    for ($i = $totalPages - 2; $i <= $totalPages; $i++) {
        if ($i < 4) continue;
        $active = ($i == $currentPage) ? ' class="active"' : '';
        $output .= '<li' . $active . '><a href="' . $baseUrl . '/' . $i . '">' . $i . '</a></li>';
    }

    // "Last" button
    if ($currentPage < $totalPages) {
        $output .= '<li><a href="' . $baseUrl . '/' . $totalPages . '">Last</a></li>';
    }

    $output .= '</ul>';
    return $output;
}


	
	
	public function admin_login(){
		if($this->session->userdata('adminLogin') == TRUE){
		    redirect(base_url('Web/Admin/Admin/dashboard'));
	    }
		
		//$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        //$this->form_validation->set_rules('email', 'email', 'required|xss_clean');
        if ($this->input->post('email') == '') {
			
	     
        } else {
			
           $validate = $this->db->select('*')->where('email',$this->input->post('email'))->where('password',md5($this->input->post('password')))->from('admin')->get()->row();
	
            if(!empty($validate)) {
			
				$userdata = array();
				$userdata['user_id'] = $validate->id;
				
				$userdata['name'] = $validate->name;
				$userdata['email'] = $validate->email;
				$userdata['adminLogin'] = TRUE;
				$this->session->set_userdata($userdata);
				$this->session->set_flashdata('success', 'Logged in successfully.');
				redirect('Web/Admin/Admin/dashboard');

			} else {

                $this->session->set_flashdata('message','Please check your username and password and try again.');
                redirect('/admin');
			}
			
		}
		$this->load->view('Admin/adminLogin');
	}
	public function loginpage()
	{
        $this->load->view('User/header');
		$this->load->view('User/login');
	}

	// public function login() 
    // {   $mnumber = $this->input->post('mobile');
    //     $data = array(
    //         'PhoneNumber' => $mnumber
    //     );
    //     $this->session->set_userdata('te_user',$mnumber);
	// 	$this->load->model('UserModel');
    //     $result = $this->UserModel->post_user($data);
    //     if($result){
    //         $login_type = $result[0]['login_type'];
    //     $this->session->set_flashdata('message','OTP sent');
    //     $this->session->set_flashdata('login_type',$login_type);
    //     echo json_encode(['status'=>'success','message'=>'OTP Sent Successfully']);
    //     }else{
    //         //$this->session->set_flashdata('message','something went wrong');
    //         echo json_encode(['status'=>'failure','message'=>'Something Went Wrong']);
    //     }
    // }






    	public function login() 
        {   
        $mnumber = $this->input->post('mobile');
        $data = array(
            'Email' => $mnumber
        );
        $this->session->set_userdata('te_user',$mnumber);
        $this->session->set_userdata('user_mobile',$mnumber);

		$this->load->model('UserModel');
        $result = $this->UserModel->post_user($data);
        // if($result){
        //     $login_type = $result[0]['login_type'];
        // $this->session->set_flashdata('message','OTP sent');
        // $this->session->set_flashdata('login_type',$login_type);
        echo json_encode(['status'=>'success','message'=>'OTP Sent Successfully']);
        // }else{
        //     //$this->session->set_flashdata('message','something went wrong');
        //     echo json_encode(['status'=>'failure','message'=>'Something Went Wrong']);
        // }
    }


    public function mobileLogin()
    {
        $this->load->view('User/header');
        $this->load->view('User/mobileLogin');
    }


    public function sendOtp() 
    {   
    $mnumber = $this->input->post('mobile');
    $data = array(
        'mobile' => $mnumber
    );
    $this->session->set_userdata('te_mobile',$mnumber);
    $this->session->set_userdata('user_mobile',$mnumber);
    $this->load->model('UserModel');
    $result = $this->UserModel->post_mobile($data);
    // if($result){
    //     $login_type = $result[0]['login_type'];
    // $this->session->set_flashdata('message','OTP sent');
    // $this->session->set_flashdata('login_type',$login_type);
    echo json_encode(['status'=>'success','message'=>'OTP Sent Successfully',$result]);
    // }else{
    //     //$this->session->set_flashdata('message','something went wrong');
    //     echo json_encode(['status'=>'failure','message'=>'Something Went Wrong']);
    // }
}











    public function verifyOTP() {
        if ($se_otp = $this->session->userdata('se_otp')) {
            $otp1 = $this->input->post('otp1');
            $otp2 = $this->input->post('otp2');
            $otp3 = $this->input->post('otp3');
            $otp4 = $this->input->post('otp4');
            $otp5 = $this->input->post('otp5');
            $otp6 = $this->input->post('otp6');
            $mobile = $this->input->post('mobile');
            // print_r($mobile);
            // exit;
    
            $in_otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;
    
            if (($in_otp =='123456')&&($mobile == $this->session->userdata('te_user'))) {
                $this->session->unset_userdata('se_otp');
                $te_user = $this->session->userdata('te_user');
                $token = $this->auth($te_user);
                $this->session->set_userdata('userToken', $token);
                $this->session->unset_userdata('te_user');
    
                // Capture the redirect URL if it exists
                $redirectUrl = $this->session->userdata('redirect') ?: base_url('Welcome/index');
    
                echo json_encode([
                    'status' => 'success',
                    'message' => 'OTP verified successfully',
                    'redirect' => $redirectUrl
                ]);
            } else {
                echo json_encode(['status' => 'wrong', 'message' => 'Please enter a valid OTP']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
          
    public function auth($te_user){
        $jwt = new JWT();
        $JwtSecretKey  = 'mysecret';
        $data = $this->db->select('users.UserID')->where('Email',$te_user)->from('users')->get()->result_array();//userid,tokengeneratedtime,expirytime
        $token = $jwt->encode($data,$JwtSecretKey,'HS256');
        return $token;
    }


    public function contact()
    {   

        if($this->form_validation->run()== false){
                $this->load->library('session');
                $full_name = $this->input->post('full_name');
                $phone_number = $this->input->post('phone_number');
                $email = $this->input->post('email');
                $message = $this->input->post('message');

                $this->form_validation->set_rules('full_name', 'Full Name', 'required');
                $this->form_validation->set_rules('phone_number', 'Phone No.', 'required|min_length[10]|max_length[10]');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('message', 'Message', 'required');
        
                if ($this->form_validation->run()== false) {
                    echo json_encode(['status' => 'error', 'message' => 'Please Fill Complete Details']);
                } else {
                    $data = array(
                      'full_name'=>$full_name,
                        'phone_number'=>$phone_number,
                        'email'=>$email,
                        'message'=>$message
                    );
                    $this->db->insert('message_data',$data);
                    $result = $this->db->affected_rows();
                    if($result){
                        echo json_encode(['status' => 'success', 'message' => 'Details Saved Successfully',$result]);
                    }else{
                        echo json_encode(['status' => 'error', 'message' => 'database_error']);
                    }
                    
                }
            }
    }


    public function getCategories()
    {
        // Set CORS headers
        header('Access-Control-Allow-Origin: *'); // Allow all origins (or specify your domain instead of *)
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Allow HTTP methods
        header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allow specific headers
        header('Content-Type: application/json'); // Set the content type to JSON
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit;
        }
        $cat = $this->db->select('categories.*')
                               ->from('categories')
                               ->where(['is_parent' => 1, 'is_deleted' => 1])
                               ->get()
                               ->result_array();
        $categoriesWithSubcategories = [];
        if ($cat) {
            foreach ($cat as $categories) {
                $subcategories = $this->db->select('categories.*')
                                          ->from('categories')
                                          ->where(['ParentCategoryID' => $categories['CategoryID'], 'is_deleted' => 1])
                                          ->get()
                                          ->result_array();
                $categories['subcategories'] = $subcategories;
                $categoriesWithSubcategories[] = $categories;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $categoriesWithSubcategories]);
    }
    


    public function getChildCategories()
    {

        header('Access-Control-Allow-Origin: *'); // Allow all origins (or specify your domain instead of *)
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Allow HTTP methods
        header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Allow specific headers
        header('Content-Type: application/json'); // Set the content type to JSON
    
        // Handle preflight request for CORS (OPTIONS request)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit; // Exit early if this is a preflight request
        }
        $data = $this->input->post();
    
        // Query the database
        $categories = $this->db->select('categories.*')
            ->from('categories')
            ->where(['is_deleted' => 1,'ParentCategoryID'=>$data['parentCategoryID']])
            ->get()
            ->result_array();
    
        // Send JSON response
        echo json_encode(['status' => 'success', 'data' => $categories]);
        
    }
    
    public function contact_us() {

        $cate['CategoryDescription'] = 'Contact Us';
        $this->load->view('User/header',['cat'=>$cate]);
        $this->load->view('User/contact');
    }
    public function addP()
    {
       
        $this->load->view('input');
    }

    public function addProduct() {
        $this->load->library('upload');
        
        // Collect form inputs
        $dimensions = $this->input->post('dimension');
        $colors = $this->input->post('color');
        $weights = $this->input->post('weight');
        $stocks = $this->input->post('stock');
        
        $productData = [];
        
        // Loop through each variant
        foreach ($dimensions as $key => $dimension) {
            $variantData = [
                'dimension' => $dimension,
                'color' => $colors[$key],
                'weight' => $weights[$key],
                'stock' => $stocks[$key],
            ];
            
            $imagePaths = [];
    
            // Handle image upload for each variant
            if (isset($_FILES['images']['name'][$key])) {
                $filesCount = count($_FILES['images']['name'][$key]);
                //print_r($filesCount);
                // Loop through the images uploaded for this variant
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name'] = $_FILES['images']['name'][$key][$i];
                    $_FILES['file']['type'] = $_FILES['images']['type'][$key][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$key][$i];
                    $_FILES['file']['error'] = $_FILES['images']['error'][$key][$i];
                    $_FILES['file']['size'] = $_FILES['images']['size'][$key][$i];
                    //print_r($_FILES['file']['name']);
                    // Set upload configuration
                    $config['upload_path'] = './uploads/products/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = '2048'; // Max size in KB
                    $config['file_name'] = time().'_'.$_FILES['file']['name'];
                    // Initialize upload library with config and upload
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $imagePaths[] = $uploadData['file_name']; // Append uploaded image name
                       // print_r($imagePaths);
                    }
                }
            }
    
            // Store image names in the variantData (as a JSON-encoded array)
            $variantData['images'] = !empty($imagePaths) ? json_encode($imagePaths) : json_encode([]);
    
            // Collect all variant data
            $productData[] = $variantData;
        }
    // print_r($productData);
    // exit;
        // Now insert the product data into the database
        $this->db->insert_batch('products', $productData);
    
        // Redirect to a success page or product listing
        redirect('product/list');
    }
    public function details($product_id)
    {
        $this->load->model('ProductModel');
        $result = $this->ProductModel->productDetails($product_id);
    
        if ($this->session->userdata('userToken')) {
            $token = $this->session->userdata('userToken');
            $this->load->model('UserModel');
            //$cart = $this->UserModel->getCart($token);
            $tokenID = $this->UserModel->decodeToken($token);
            $UserID = $tokenID[0]->UserID;
            // Mark each variant as in cart or not
            foreach ($result['variants'] as &$variant) { // Use reference to modify original
                $this->db->join('jwellary_varient', 'cart.varient_id = jwellary_varient.varient_id', 'inner');
                $this->db->where(['cart.varient_id'=> $variant['varient_id'],'cart.is_deleted'=>1,'user_id'=>$UserID]);
                $count = $this->db->from('cart')->count_all_results();
                if ($count) {
                    $variant['in_cart'] = true;
                }else{
                    $variant['in_cart'] = false;
                }
                 // Default to not in cart
    
            }
            unset($variant); // Unset reference after loop
        }
    
        // Debugging - comment or remove for production
 
    $result['id'] = $product_id;
        // Load the view with updated $result
        // echo '<pre>';
        // print_r($result);
        // exit;
        $cat['CategoryDescription'] = $result['jwellary_description'];
        $this->load->view('User/header',['cat'=>$cat]);
        $this->load->view('User/product-details', ['result' => $result]);
    }
    
    

    public function getDataByVarientID($product_id)
    {
        $this->load->model('ProductModel');
        $result = $this->ProductModel->productDetails($product_id , $varient_id);
        $this->load->view('User/product-details',['result'=>$result]);
    }

    public function getimagesbycolor()
    {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        $this->load->model('ProductModel');
        $newd = $this->ProductModel->getimagebycolor($data);
        echo json_encode(['status' => 'success', 'message' => $newd]);
    }
	    public function privacy()
    {
       
        $this->load->view('User/privacypolicy');
    }
	public function shipping()
    {
        $this->load->view('User/shipping');
    }


    public function homeSearch($homesearch)
    {
        $search = urldecode($homesearch);
        $this->load->model('ProductModel');


        $this->load->library('pagination');
        $perPage = 21;
        $total = $this->ProductModel->getSearchTotal($search);

        $currentPage = ($this->uri->segment(3)) ? (int)$this->uri->segment(3) : 1;
        $totalPages = ceil($total / $perPage);
        $offset = ($currentPage - 1) * $perPage;
        $baseUrl = site_url('Welcome/homeSearch/');
        $result = $this->ProductModel->getSearch($search,$perPage, $offset);
        $subcategories = $this->db->select('categories.*')->from('categories')->where(['is_deleted'=>1])->get()->result_array();
        $paginationLinks = $this->createCustomPagination($currentPage, $totalPages, $baseUrl);
        $res = [
            'subcategories' => $subcategories,
            'products' => $result,
            'pagination' => $paginationLinks,
            'meta' => [
                'total' => $total,
                'total_pages' => $totalPages,
                'current_page' => $currentPage // Correctly set 1-based current page
            ],
        ];
        if ($search) {
           $res['tittle'] = $search;
        }

        //$res['subcatagories'] = $subcatagories;
        // $res['products'] = $data;
        $cat['CategoryDescription'] = $search;
        // echo '<pre>';
        // print_r($res);
        // exit;
        $this->load->view('User/header',['cat'=>$cat]);
		$this->load->view('User/card-list',['result'=>$res]);
        
    }





    // public function test($token)
    // {
    //     $users = $this->db->get_where("users", ["token"=>$post->token])->row();
    //     print_r($users);
    //     exit;
        
    // }

    public function subscribeEmail()
    {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'failed', 'message' => 'Invalid email address']);
            return;
        }
        $email_data = [
            'email' => $data['email']
        ];
        if ($this->db->insert('emails', $email_data)) {
            echo json_encode(['status' => 'success', 'message' => 'You have been subscribed']);
        } else {
            echo json_encode(['status' => 'failed', 'message' => 'Something went wrong']);
        }
    }
    

    public function getStates()
    {

        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        $states = $this->db->select('states.*')
            ->from('states')
            ->where(['is_active' => 1, 'country_id' => $data['id']])
            ->get()
            ->result_array();
        if ($states) {
            echo json_encode(['status' => 'success', 'response' => $states]);
        } else {
            echo json_encode(['status' => 'error', 'response' => 'Something went wrong']);
        }
    }
    



public function checkPhone()
{ 
    $data = json_decode(file_get_contents("php://input"), true);
    print_r($data);
    exit;
    
}
    
public function status()
{
   
    $this->load->view('User/order-status');
}
public function returnpolicy()
{
   
    $this->load->view('User/returnpolicy');
}

public function getProductsByCategory()
{
    $data = file_get_contents('php://input');
    $id = json_decode($data, true); // Decodes JSON input into an associative array
    $this->load->model('AdminModel');
    $products = $this->AdminModel->getproductsbycat($id['subCategoryId']);

    // Corrected JSON response
    echo json_encode([
        'status' => 'success',
        'message' => $products
    ]);
}



public function support()
{
   
    $this->load->view('User/support');
}
public function freedelivery()
{
   
    $this->load->view('User/freedelivery');
}
public function securepayment()
{
   
    $this->load->view('User/securepayment');
}

public function deleteaccount(){
    $this->load->view('User/deleteaccount');
}

public function allreview($id)
{
    // Fetch reviews with user and address details
    $reviews = $this->db->select('
            reviews.*, 
            users.name AS username, 
            address.name AS addressname
        ')
        ->from('reviews')
        ->join('users', 'users.UserID = reviews.user_id', 'left') // Corrected JOIN syntax
        ->join('address', 'address.user_id = reviews.user_id', 'left') // Prevents multiple addresses issue
        ->where('reviews.product_id', $id)
        ->group_by('reviews.id') // Prevents duplicate reviews due to multiple addresses
        ->get()
        ->result_array();

    // Check if there are any reviews before fetching images
    $review_ids = array_column($reviews, 'id');
    $images_by_review = [];

    if (!empty($review_ids)) {
        // Fetch all images for existing review IDs
        $review_images = $this->db->select('review_id, image_url') 
            ->from('review_images')
            ->where_in('review_id', $review_ids) 
            ->get()
            ->result_array();

        // Group images under their corresponding review_id
        foreach ($review_images as $img) {
            $images_by_review[$img['review_id']][] = $img['image_url'];
        }
    }

    // Attach images to their corresponding reviews
    foreach ($reviews as &$review) {
        $review['images'] = $images_by_review[$review['id']] ?? []; // Attach images or empty array if none
    }

    // Get total review & rating count
    $total_counts = $this->db->select('COUNT(id) as total_reviews, COUNT(rating) as total_ratings, AVG(rating) as avg_rating')
        ->from('reviews')
        ->where('product_id', $id)
        ->get()
        ->row_array();

    // Prepare final response
    $response = [
        'reviews' => $reviews,
        'total_reviews' => $total_counts['total_reviews'],
        'total_ratings' => $total_counts['total_ratings'],
        'average_rating' => round($total_counts['avg_rating'], 2) // Round to 2 decimal places
    ];

    // Load views
    $this->load->view('User/header');
    $this->load->view('User/allreview', ['reviews' => $response]);
    $this->load->view('User/footer');
}

public function orderbulk()
{
    $this->load->model('CategoryModel');   
    $categories = $this->CategoryModel->getallcategories();
    $data['categories'] = $categories;
    $this->load->view('User/header');
    $this->load->view('orderbulk', $data);
    $this->load->view('User/footer');
    
    
}

public function bulk_query()
{
    $data = $this->input->post();

    // Insert into database and check for success
    if ($this->db->insert('bulk_order', $data)) {
        // Load email template correctly
       	$emaildata['message'] = $this->load->view('emails/bulk', ['data' => $data], true);
        $emaildata['to'] = 'tsd412@gmail.com';
        $emaildata['subject'] = 'Bulk Order Query';

        // Send Email
        if (send_mail($emaildata)) {
            echo json_encode(['status' => 'success', 'message' => 'Bulk order submitted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Bulk order saved, but email failed to send']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save bulk order']);
    }
}

}