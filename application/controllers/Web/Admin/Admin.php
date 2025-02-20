<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Ship.php';

class Admin extends Ship
{
    public function __construct()
    {
        parent:: __construct();
		$this->load->model('AdminModel');

        if(!$this->session->userdata('adminLogin'))
        {
            return redirect('admin-login');
        }
    }
    public function dashboard()
    {
        $this->load->model('AdminModel');
        $data = $this->AdminModel->getCategories();
        $this->load->view('Admin/addproductjwellary',['data'=>$data]);
    }
    public function getChildCategories($parentCategoryID) {
        $this->load->model('AdminModel');
        $childCategories = $this->AdminModel->getChildCategories($parentCategoryID);
        echo json_encode($childCategories);
    }


    public function filteredlist($id)
    {
        $categories = $this->AdminModel->getCategories();
        $result =$this->AdminModel->getproductsbycat($id);
        $data['result'] = $result;
        $data['categories'] = $categories;
        // echo '<pre>';
        // print_r($data);
        // exit;
        
        $this->load->view('Admin/productlist',['products'=>$data]);        
    }


    public function addJwellery()
    {
        //$this->load->library('upload');
        //$path = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR;


		
        // Gather product information
        $product_id = $this->input->post('product_id');
        $productData = array(
            'category_id' => $this->input->post('category'),
            'subcategory_id' => $this->input->post('sub-category-1'),
            'jwellary_name' => $this->input->post('product_name'),
            'jwellary_description' => $this->input->post('product_description'),
            'jwellary_id' => $product_id,
            'applicable_tax'=>$this->input->post('tax'),
            'visibility' => $this->input->post('visibility'),
            'sku_code' => $this->input->post('sku'),
            'discount' => $this->input->post('discount'),
            'tags' => $this->input->post('tag'),
            'publish_at' => $this->input->post('publish_date'),
            'material_type' => $this->input->post('material_type'),
            'metal_type' => $this->input->post('metal_type'),
            'gem_type' => $this->input->post('gem_type'),
            'occation_type' => $this->input->post('occation_type'),
            'ideal_for' => $this->input->post('ideal_for'),
            'sizing' => $this->input->post('sizing'),
            'finish' => $this->input->post('product_finish'),
            'generic_name' => $this->input->post('generic_name'),
            'policy' => $this->input->post('policy_type'),
            'policy_time' => $this->input->post('policy_time'),
        );
        
        if (!empty($_FILES['thumbnail']['tmp_name'])) {
            $uploadDir = FCPATH . '/uploads/products';
            $config['upload_path'] = $uploadDir;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . rand(100, 999);
            $this->load->library('upload');
            $this->upload->initialize($config);
            if ($this->upload->do_upload('thumbnail')) {
                $uploadData = $this->upload->data();
                $productData['thumbnail'] = $uploadData['file_name'];
                echo "File uploaded successfully!";
            } else {
                $error = $this->upload->display_errors();
                echo "File upload error: " . $error;
                echo "Upload Path: " . $config['upload_path'];
                exit;
            }
        } else {
            $productData['thumbnail'] = null;
        }
        $this->load->model('AdminModel');
        $jwellary_id = $this->AdminModel->addJwellery($productData);
    
        


        if ($jwellary_id) {
            // Gather variant information
            $dimensions = $this->input->post('dimension');
            $color = $this->input->post('color');
			$varient_sku = $this->input->post('var_sku');
            $hsn = $this->input->post('hsn');
            $weight = $this->input->post('weight');
            $stock = $this->input->post('stock');
            $base_price = $this->input->post('base_price');
            $sale_price = $this->input->post('sale_price');
            $status = $this->input->post('status');


    
            // Process each variant
            foreach ($dimensions as $key => $dimension) {
                $variantData = [
                    'dimension' => $dimension,
                    'color' => $color[$key],
					'varient_sku'=>$varient_sku[$key],
                    'hsn'=>$hsn[$key],
                    'weight' => $weight[$key],
                    'stock' => $stock[$key],
                    'base_price' => $base_price[$key],
                    'sale_price' => $sale_price[$key],
                    'status' => $status[$key],
                    'jwellary_id' => $jwellary_id
                ];
                $imagePaths = [];
                if (!empty($_FILES['images']['name'][$key])) {
                    $filesCount = count($_FILES['images']['name'][$key]); 
                    for ($i = 0; $i < $filesCount; $i++) {
                        $_FILES['file']['name'] = $_FILES['images']['name'][$key][$i];
                        $_FILES['file']['type'] = $_FILES['images']['type'][$key][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$key][$i];
                        $_FILES['file']['error'] = $_FILES['images']['error'][$key][$i];
                        $_FILES['file']['size'] = $_FILES['images']['size'][$key][$i];   
                        $config['upload_path'] = $uploadDir;
                        $config['allowed_types'] = '*';
                        $config['max_size'] = 20480; // Max size in KB
                        $config['file_name'] = time().'_'.rand(100,999);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('file')) {
                            $uploadData = $this->upload->data();
                            $imagePaths[] = $uploadData['file_name'];
        
                         
                        } else {
                            // Handle file upload error
                            $this->session->set_flashdata('message', 'Error uploading image: ' . $this->upload->display_errors());
                            redirect('Web/Admin/Admin/dashboard');
                            return;
                        }
                    }    
                } else {
                    $this->session->set_flashdata('message', 'No images selected for variant ' . ($key + 1));
                    redirect('Web/Admin/Admin/dashboard');
                    return;
                }
                $varient_id = $this->AdminModel->addVarient($variantData);
                if (!empty($imagePaths)) {
                    $data = $this->addProductToShip($productData,$variantData,$imagePaths);
                    if ($varient_id) { 
                       $this->AdminModel->addImage($varient_id, $imagePaths);    
                    }else{
                        $this->session->set_flashdata('message', json_encode());
                        redirect('Web/Admin/Admin/dashboard');
                    }
                }
            }
            $this->session->set_flashdata('message', 'Product and variants added successfully.');
            redirect('Web/Admin/Admin/dashboard');
        } else {
            $this->session->set_flashdata('message', 'Error adding product.');
            redirect('Web/Admin/Admin/dashboard');
        }
    }

    


    // public function orderHistory()
    // {
    //     $this->load->model('AdminModel','am');
    //     $orders = $this->am->getOrders(1);

    //     echo'<pre>';
    //     print_r($orders);
    //     exit;

    //     $this->load->view('Admin/orderhistory',['orders'=>$orders]);
    // }


    public function orderHistory($page = 1)
        {
            $orders = $this->getShiprocketOrders($page,1);
            // echo'<pre>';
            // print_r($orders);
            // exit;
            $this->load->view('Admin/orderhistory',['orders'=>$orders]);
        }




    public function cancel_order()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['shipmentID']) || empty($input['shipmentID'])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input. Please provide a valid shipment ID.']);
            return;
        }
        $shipmentIds = $input['shipmentID'];
        //         print_r($shipmentIds);
        // exit;
        $response = $this->cancelShiprocketOrders($shipmentIds);
        if (isset($response['status_code'])) {
            if ($response['status_code'] === 200) {
                $res = $this->AdminModel->cancelOrder($shipmentIds);
                if($res){
                echo json_encode(['status' => 'success', 'message' => 'Orders canceled successfully.', 'data' => $response]);
                }else{
                    echo json_encode(['status' => 'success', 'message' => 'Orders canceled successfully.', 'data' => $res]);
                }
            } elseif ($response['status_code'] === 400) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid shipment ID. Please check and try again.']);
            } elseif ($response['status_code'] === 500) {
                echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Please try again later.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Unexpected error occurred.', 'data' => $response]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to cancel orders. No valid response from Shiprocket API.']);
        }
    }
    
    


    public function OrderDetails($shipment_id)
    {
        $this->load->model('AdminModel');
        $order = $this->AdminModel->getOrderDetails($shipment_id);
        $status = $this->trackShipment($shipment_id);


        $details = [
            'order'=>$order,
            'status'=>$status
        ];
            // echo '<pre>';
            // print_r($details);
            // exit;
        $this->load->view('Admin/orderdetails',['data'=>$details]);
    }
    public function showCategory()
    {
        $categories = $this->AdminModel->getCategories();
        // print_r($categories);
        // exit;
        $this->load->view('Admin/category',['categories'=>$categories]);
    }
    public function subCategory()
    {
        $this->load->view('Admin/subcategory');    
    }
    public function allCustomers()
    {
        $this->load->view('Admin/allcustomers');
    }
    public function addproductothers()
    {
        $this->load->view('Admin/addproductother');
    }
    public function productList()
    {
        $categories = $this->AdminModel->getCategories();
        $result = $this->AdminModel->getallproducts();
        $data['result'] = $result;
        $data['categories'] = $categories;
        // echo '<pre>';
        // print_r($data);
        // exit;
        
        $this->load->view('Admin/productlist',['products'=>$data]);
    }
	
	    public function deletejwellary()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $result = $this->AdminModel->deletejwellary($id);
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Jewelry deleted successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete jewelry'
            ]);
        }
        
    }

public function editJwellary($id)
{
    // $input = json_decode(file_get_contents('php://input'), true);
    // $id = $input['id'];
    
    $product = $this->AdminModel->getProductbyId($id);
    $product['categories'] = $this->AdminModel->getCategories();
    $product['subcategories'] = $this->AdminModel->getSubCategories($product['category_id']);
    // echo'<pre>';
    // print_r($product);
    // exit;

    $this->load->view('Admin/editJwellary',['product'=>$product]);

    
}

public function updateProductDetails() {
    // Load JSON input data
    $data = json_decode($this->input->raw_input_stream, true);

    // Validate and sanitize data as necessary
    $jwellaryId = $data['id'];
    $updateData = [
        'category_id' => $data['category'],
        'subcategory_id' => $data['sub_category_1'],
        //'sub_category_2' => $data['sub_category_2'],
        //'sub_category_3' => $data['sub_category_3'],
        'jwellary_id' => $data['product_id'],
        'visibility' => $data['visibility'],
        'sku_code' => $data['sku'],
        'discount' => $data['discount'],
        'tags' => $data['tag'],
        'publish_at' => $data['publish_date'],
        'jwellary_name' => $data['product_name'],
        'jwellary_description' => $data['product_description'],
        'material_type' => $data['material_type'],
        'metal_type' => $data['metal_type'],
        'gem_type' => $data['gem_type'],
        'occation_type' => $data['occation_type'],
        'ideal_for' => $data['ideal_for'],
        'sizing' => $data['sizing'],
        'finish' => $data['product_finish'],
        'generic_name' => $data['generic_name'],
        'policy' => $data['policy'],
        'policy_time' => $data['policy_time']
    ];


    // Update database with new product details
    $this->load->model('ProductModel');
    $updateResult = $this->AdminModel->updateProductDetails($jwellaryId, $updateData);

    if ($updateResult) {
        echo json_encode(['status' => 'success', 'message' => 'Product updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update product.']);
    }
}



    public function maindashboard()
    {
        $this->load->view('Admin/dashboard');    
    }

    public function adminlogout()
    {
        $this->session->unset_userdata('adminLogin');
        return redirect('admin-login');    
    }
	
	
	    public function updateImage()
    {
        // Load the upload library if needed
        $this->load->library('upload');
    
        $imageId = $this->input->post('image_id');
        
        // Set upload configuration
        $config['upload_path'] = './uploads/products/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // Limit to 2 MB
    
        $this->upload->initialize($config);
    
        if (!$this->upload->do_upload('image')) {
            // Upload failed, return error
            echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
            return;
        }
    
        // Get uploaded file data
        $uploadData = $this->upload->data();
        $newImageName = $uploadData['file_name'];
    
        // Update the image in the database
        $this->db->where('image_id', $imageId);
        $this->db->update('jwellary_images', ['image' => $newImageName]);
    
        if ($this->db->affected_rows() > 0) {
            // Success response
            echo json_encode(['success' => true, 'message' => 'Image updated successfully']);
        } else {
            // Failure response
            echo json_encode(['success' => false, 'message' => 'Database update failed']);
        }
    }
	
	
	
	    public function updateVarient() {
        $inputData = json_decode($this->input->raw_input_stream, true);
        if (empty($inputData['varient_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Variant ID is missing.']);
            return;
        }
        $updateData = [
            'dimension'   => $inputData['dimension'] ?? null,
            'color'       => $inputData['color'] ?? null,
            'weight'      => $inputData['weight'] ?? null,
            'varient_sku' => $inputData['varient_sku'] ?? null,
            'hsn'         => $inputData['hsn'] ?? null,
            'stock'       => $inputData['stock'] ?? null,
            'base_price'  => $inputData['base_price'] ?? null,
            'sale_price'  => $inputData['sale_price'] ?? null,
            'status'      => $inputData['status'] ?? 1 
        ];
        // print_r($updateData);
        // exit;
        $this->load->model('AdminModel');
        $updateResult = $this->AdminModel->updateVariant($inputData['varient_id'], $updateData);
        if ($updateResult) {
            echo json_encode(['status' => 'success', 'message' => 'Variant updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update the variant.']);
        }
    }
	
	
	
	
	
	    public function savecategory()
    {
        $categoryName = $this->input->post('categoryname');
        $subcategoryID = $this->input->post('subcategoryid');
        $categoryStatus = $this->input->post('categorystatus');
        $categoryDescription = $this->input->post('categorydescription');
        if (!empty($_FILES['categoryimage']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time().'_'.rand(100,999);
            
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('categoryimage')) {
                $fileData = $this->upload->data();
                $categoryImage = $fileData['file_name'];
            } else {
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
                return;
            }
        }
    
        $saveData = [
            'category_name' => $categoryName,
            'subcategory_id' => $subcategoryID,
            'category_status' => $categoryStatus,
            'category_description' => $categoryDescription,
            'category_image' => isset($categoryImage) ? base_url('/uploads/').$categoryImage : null
        ];
        $this->load->model('CategoryModel');
        $result = $this->CategoryModel->saveCategory($saveData); // Adjust according to your model
    
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Category saved successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save category']);
        }
    }

    public function deletecategory()
{
    $id = $this->input->post('id');
    // print_r($id);
    // exit;
    $this->load->model('CategoryModel');
    if ($id && $this->CategoryModel->deleteCategoryById($id)) {
        echo json_encode(['status' => 'success', 'message' => 'Category deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete category']);
    }
}
	
	
	
	
	public function saveBanner()
{
    $tittle = $this->input->post('tittle');
    $description = $this->input->post('description');
    if (!empty($_FILES['image']['name'])) {
        $uploadPath = './uploads/';
        $fileName = time().'_'.rand(100,999);
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $fileName;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $error = $this->upload->display_errors();
            echo json_encode(['status' => 'error', 'message' => $error]);
            return;
        } else {
            $uploadData = $this->upload->data();
            $imagePath = $uploadData['file_name'];
        }
        $data = [
            'tittle' => $tittle,
            'description'=> $description,
            'image' => $imagePath,
        ];

        $insertId = $this->AdminModel->saveBanner($data);

        if ($insertId) {
            echo json_encode(['status' => 'success', 'message' => 'Banner saved successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save banner.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No image uploaded.']);
    }
}
	
	 public function addNewImage()
    {
        $this->load->library('upload');
        $varient_id = $this->input->post('varient_id');
        if (empty($_FILES['image']['name'])) {
            echo json_encode(['success' => false, 'message' => 'No image selected.']);
            return;
        }
        $config['upload_path'] = './uploads/products/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // Limit to 2 MB
    
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            // Upload failed, return error message
            echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
            return;
        }
    
        // Get uploaded file data
        $uploadData = $this->upload->data();
        $newImageName = $uploadData['file_name'];
    
        // Insert the new image record into the database
        $data = [
            'image' => $newImageName,
            'varient' => $varient_id
        ];
        $this->db->insert('jwellary_images', $data);
    
        // Check if the insert was successful
        if ($this->db->insert_id()) {
            // Success response
            echo json_encode(['success' => true, 'message' => 'Image updated successfully']);
        } else {
            // Failure response
            echo json_encode(['success' => false, 'message' => 'Database update failed']);
        }
    }
	
	
	public function addNewVarient()
{
    $formData = $this->input->post();

    $sendData = [
        'dimension' => $formData['dimension'],
        'color' => $formData['color'],
        'varient_sku' => $formData['var_sku'],
        'hsn' => $formData['hsn'],
        'weight' => $formData['weight'],
        'stock' => $formData['stock'],
        'base_price' => $formData['base_price'],
        'sale_price' => $formData['sale_price'],
        'status' => $formData['status'],
        'jwellary_id' => $formData['jwellary_id']
    ];

    $varient = $this->AdminModel->saveVarient($sendData);

    if ($varient) {
        $uploadPath = './uploads/products/';
        $filesCount = count($_FILES['images']['name']);

        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file'] = [
                'name' => $_FILES['images']['name'][$i],
                'type' => $_FILES['images']['type'][$i],
                'tmp_name' => $_FILES['images']['tmp_name'][$i],
                'error' => $_FILES['images']['error'][$i],
                'size' => $_FILES['images']['size'][$i]
            ];

            if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $uniqueFileName = time() . '_' . rand(100, 999) . '_' . $_FILES['file']['name'];
                $uploadFilePath = $uploadPath . $uniqueFileName;

                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
                    $sendImage = [
                        'varient' => $varient,
                        'image' => $uniqueFileName
                    ];

                    if ($this->db->insert('jwellary_images', $sendImage)) {
                        echo json_encode(['status' => 'success', 'message' => $this->db->insert_id()]);
                    }else{
                       exit;                    }
                } else {
                    echo "Failed to upload file: " . $_FILES['file']['name'] . "<br>";
                }

            } else {
                echo "Error uploading file: " . $_FILES['file']['name'] . " (Error Code: " . $_FILES['file']['error'] . ")<br>";
            }
        }
        echo json_encode(['status' => 'success', 'message' => $this->db->insert_id()]); 
    }
}
	
	

    public function vender()
    {
        $this->load->view('Admin/vendor');    
    }
    public function bannerHeroSection()
    {
        $this->load->view('Admin/bannerHeroSection');    
    }
    public function addvender()
    {
        $this->load->view('Admin/addVendor');    
    }
    public function editvender()
    {
        $this->load->view('Admin/editVendor');    
    }
    public function venderDetails()
    {
        $this->load->view('Admin/venderDetails');    
    }
    public function transition()
    {
        $this->load->view('Admin/transition');    
    }

    public function deleteVarient()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $data = $this->AdminModel->deleteVarient($input);
        if($data){
            echo json_encode(['status'=>'success','message'=>'Varient Deleted SuccessFully']);
        }else echo json_encode(['status'=>'failed','message'=>'Please try again']);


    }

    public function updatethumbnail()
    {
        $productId = $this->input->post('id');
        if (!empty($_FILES['thumbnail']['name'])) {
            $config['upload_path'] = './uploads/products/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time() . '_' . rand(100, 999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('thumbnail')) {
                $fileData = $this->upload->data();
                $thumbnailPath = $fileData['file_name'];
                $this->load->model('AdminModel');
                $data = $this->AdminModel->updatethumbnail($productId,$thumbnailPath);
                if ($data) {
                    echo json_encode(['status' => 'success', 'message' => 'Thumbnail updated successfully']);
                } else {
                    echo json_encode(['status' => 'failed', 'message' => 'Database update failed. Please try again.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No file uploaded']);
        }
    }
    
    public function readytoship($page = 1)
    {
        $orders = $this->getShiprocketOrders($page, 3, 4,35,34);
        foreach ($orders['data'] as &$product) {  
            if (isset($product['products']) && is_array($product['products'])) {
                foreach ($product['products'] as &$varient) {
                    $varient['image'] = $this->AdminModel->getImage($varient['channel_sku']);
                }
            }
        }
        $this->load->view('Admin/readytoship', ['orders' => $orders]);
    }
    
	

    public function shipped($page = 1){
        //$orders = $this->getShiprocketOrders($page,6,13,17,18,22,21);
        $orders = $this->getShiprocketOrders($page,6,7,13,17,18,22,21);
        foreach ($orders['data'] as &$product) {  
            if (isset($product['products']) && is_array($product['products'])) {
                foreach ($product['products'] as &$varient) {
                    $varient['image'] = $this->AdminModel->getImage($varient['channel_sku']);
                }
            }
        }




        $this->load->view('Admin/shipped',['orders'=>$orders]);    
    }
    public function cancelled($page = 1){
        // if (!$page || $page<=1) {
        //     $page = 1;
        // }
        $orders = $this->getShiprocketOrders($page,5);
        foreach ($orders['data'] as &$product) {  
            if (isset($product['products']) && is_array($product['products'])) {
                foreach ($product['products'] as &$varient) {
                    $varient['image'] = $this->AdminModel->getImage($varient['channel_sku']);
                }
            }
        }


        $this->load->view('Admin/cancelled',['orders'=>$orders]);
    }
    public function returnorder()
    {
        $this->load->view('Admin/returnorder');    
    }
    public function returntracking($page = 1)
    {
        $orders = $this->getShiprocketreturns($page);
        foreach ($orders['data'] as &$product) {  
            if (isset($product['products']) && is_array($product['products'])) {
                foreach ($product['products'] as &$varient) {
                    $varient['image'] = $this->AdminModel->getImage($varient['channel_sku']);
                }
            }
        }
        //                 echo '<pre>';
        // print_r($orders);
        // exit;
        $this->load->view('Admin/returntracking',['orders'=>$orders]);
    }



    public function deletVarientImage()
    {
        $id =json_decode(file_get_contents('php://input'), true);
        $this->db->where('image_id', $id['id'])->delete('jwellary_images');
        echo json_encode(['status'=>'success','message'=>'Image Deleted SuccessFully']);
    }
}