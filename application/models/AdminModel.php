<?php
class AdminModel extends CI_Model
{
    public function getAllOrders()
    {
        $orders =  $this->db->select('orders.*')
                 ->from('orders')->get()->result_array();
                 return $orders;
    }
    public function getCustomers()
    {
        $customers = $this->db->select('users.*')
                              ->from('users')->get()->row_array();
                 return $customers;
                            
    }
public function getCategories()
{
    $categories = $this->db->select('categories.*')
                           ->from('categories')
                           ->where([
                               'is_deleted' => 1,
                               'is_parent'  => 1
                           ])
                           ->get()
                           ->result_array();
    return $categories;
}



    public function getChildCategories($parentCategoryID)
    {
        $this->db->select('categories.*');
        $this->db->from('categories');
        $this->db->where(['ParentCategoryID'=> $parentCategoryID,'is_deleted'=>1]);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function addJwellery($productData)
    {
        $this->db->insert('jwellaries',$productData);
        return $this->db->insert_id();
    }
    public function addVarient($varient_data)
    {
        $this->db->insert('jwellary_varient',$varient_data);
        $inserted_id = $this->db->insert_id();
        return $inserted_id;
    }
    
    public function addImage($varient_id, $imagePaths)
    {
        $image_data = array();


            foreach ($imagePaths as $image) {
                $image_data[] = array(
                 'varient' => $varient_id,
                 'image' => $image,
                );    
    }
    $this->db->insert_batch('jwellary_images', $image_data);
    return $this->db->affected_rows();
}


public function cancelOrder($shipment_id)
{
    
    $res = $this->db->set('order_status',7)
             ->where('order_id',$shipment_id)
             ->update('orders');
    return $res;
}




public function getOrders($status)
{
    // Fetch all orders with the necessary fields
    $orders = $this->db->select('orders.*, 
                                 address.name as fullname, 
                                 address.phone, 
                                 address.Email,
                                 address.pincode,
                                 users.name as user_name, 
                                 users.Email as user_email, 
                                 users.PhoneNumber as user_phone, 
                                 jwellaries.jwellary_name,
                                 jwellary_varient.varient_id,
                                 jwellary_varient.varient_sku, 
                                 jwellary_varient.weight, 
                                 jwellary_varient.sale_price')
        ->from('orders')
        ->where('orders.order_status',$status)
        ->join('users', 'users.UserID = orders.user_id', 'left') 
        ->join('jwellaries', 'jwellaries.id = orders.product_id', 'left')
        ->join('address', 'address.id = orders.address_id', 'left')
        ->join('jwellary_varient', 'jwellary_varient.varient_id = orders.varient_id', 'left')
        ->order_by('orders.order_date', 'DESC')
        ->get()
        ->result_array();
    $groupedOrders = [];

    foreach ($orders as $order) {
        $shipmentId = $order['shipment_id'];

        // If the shipment_id doesn't exist in groupedOrders, initialize it
        if (!isset($groupedOrders[$shipmentId])) {
            $groupedOrders[$shipmentId] = [
                'shipment_id' => $shipmentId,
                'order_details' => [
                    'id' => $order['id'],
                    'user_id' => $order['user_id'],
                    'product_id' => $order['product_id'],
                    'order_id' => $order['order_id'],
                    'address_id' => $order['address_id'],
                    'pincode'=>$order['pincode'],
                    'quantity' => $order['quantity'],
                    'amount' => $order['amount'],
                    'payment_type' => $order['payment_type'],
                    'payment_status' => $order['payment_status'],
                    'order_date' => $order['order_date'],
                    'delivery_date' => $order['delivery_date'],
                    'order_status' => $order['order_status'],
                    'fullname' => $order['fullname'],
                    'phone' => $order['phone'],
                    'Email' => $order['Email'],
                    'user_name' => $order['user_name'],
                    'user_email' => $order['user_email'],
                    'user_phone' => $order['user_phone'],
                    'jwellary_name' => $order['jwellary_name'],
                ],
                'varient_data' => [] // Initialize an empty array for variant data
            ];
        }

        // Add variant data if not already added for this shipment_id
        if (!in_array($order['varient_id'], array_column($groupedOrders[$shipmentId]['varient_data'], 'varient_id'))) {
            $groupedOrders[$shipmentId]['varient_data'][] = [
                'varient_id' => $order['varient_id'],
                'weight' => $order['weight'],
                'sale_price' => $order['sale_price'],
                'varient_sku'=>$order['varient_sku']
            ];
        }
    }

    // Return the grouped orders as an indexed array
    return array_values($groupedOrders);
}




public function getOrderDetails($shipment_id)
{
    return $this->db->select('orders.*, users.*, address.*,jwellary_varient.weight,jwellary_varient.varient_sku') // Select all columns from relevant tables
                    ->from('orders') // Main table
                    ->where('orders.shipment_id', $shipment_id) // Filter by order ID
                    ->join('address', 'address.id = orders.address_id') // Join address table
                    ->join('users', 'users.UserID = orders.user_id') // Join users table
                    ->join('jwellary_varient','jwellary_varient.varient_id = orders.varient_id')
                    ->get()
                    ->row_array(); // Fetch as an associative array
}


public function getProductDetails($product_id, $varient_id)
{
    return $this->db->select('jwellaries.*, jwellary_varient.*, jwellary_images.image')
                    ->from('jwellaries')
                    ->where('jwellaries.id', $product_id)
                    ->join('jwellary_varient', "jwellary_varient.varient_id = $varient_id")
                    ->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient')
                    ->get()
                    ->row_array();
}


public function getAddressDetails($address_id){
    return $this->db->select('*')
                    ->from('address')
                    ->where('id', $address_id)
                    ->get()
                    ->row_array();
}
    

	
	
	
	public function getallproducts()
{
    // Get all products with base and sale prices, category name, and the first image only
    $products = $this->db->select('
    jwellaries.*, 
    categories.CategoryName,
    jwellary_varient.stock, 
    jwellary_varient.base_price, 
    jwellary_varient.sale_price, 
    jwellary_varient.varient_sku,
    jwellary_varient.varient_id, 
    GROUP_CONCAT(DISTINCT jwellary_images.image ORDER BY jwellary_images.image_id ASC) as images
')
->from('jwellaries')
->join('categories', 'jwellaries.category_id = categories.CategoryID', 'left')
->join('jwellary_varient', 'jwellaries.id = jwellary_varient.jwellary_id', 'left')
->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient', 'left')
->group_by('jwellary_varient.varient_id')
->where('jwellaries.is_deleted', 2)
->get()
->result_array();

    
    // Optional: If you only want the first image for each variant, split the image string
    foreach ($products as &$product) {
        $images = explode(',', $product['images']);
        $product['images'] = $images; // Or $product['image'] = $images[0] for only the first image
    }
    // echo '<pre>';
    // print_r($products);
    // exit;
    return $products;
}




public function getproductsbycat($id)
{
    // Get all products with base and sale prices, category name, and the first image only
    $products = $this->db->select('
    jwellaries.*, 
    categories.CategoryName,
    jwellary_varient.stock, 
    jwellary_varient.base_price, 
    jwellary_varient.sale_price, 
    jwellary_varient.varient_id, 
	jwellary_varient.varient_sku,
    GROUP_CONCAT(DISTINCT jwellary_images.image ORDER BY jwellary_images.image_id ASC) as images
')
->from('jwellaries')
->join('categories', 'jwellaries.category_id = categories.CategoryID', 'left')
->join('jwellary_varient', 'jwellaries.id = jwellary_varient.jwellary_id', 'left')
->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient', 'left')
->group_by('jwellaries.id') // Grouping only by variant ID
->where(['jwellaries.is_deleted'=> 2,'jwellaries.subcategory_id'=>$id])
->get()
->result_array();

    
    // Optional: If you only want the first image for each variant, split the image string
    foreach ($products as &$product) {
        $images = explode(',', $product['images']);
        $product['images'] = $images; // Or $product['image'] = $images[0] for only the first image
    }
    // echo '<pre>';
    // print_r($products);
    // exit;
    return $products;
}




public function deletejwellary($id)
{
    $this->db->where('id', $id);
    return $this->db->update('jwellaries', ['is_deleted' => 1]);
}


public function getProductbyId($id)
{
    $query = $this->db->select('jwellaries.*, categories.CategoryName, jwellary_varient.varient_id, jwellary_varient.dimension, jwellary_varient.color, jwellary_varient.weight, jwellary_varient.varient_sku, jwellary_varient.hsn, jwellary_varient.stock, jwellary_varient.status, jwellary_varient.base_price, jwellary_varient.sale_price, GROUP_CONCAT(jwellary_images.image_id, ":", jwellary_images.image ORDER BY jwellary_images.image_id) as images')
    ->from('jwellaries')
    ->join('categories', 'jwellaries.category_id = categories.CategoryID', 'left')
    ->join('jwellary_varient', 'jwellaries.id = jwellary_varient.jwellary_id', 'left')
    ->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient', 'left')
    ->where(['jwellaries.is_deleted' => 2, 'jwellaries.id' => $id, 'jwellary_varient.is_deleted'=>2,'jwellary_images.is_deleted'=>1])
    ->group_by('jwellary_varient.varient_id')
    ->get()
    ->result_array();


    $product = [];
    foreach ($query as $row) {
        // Prepare variant data with images and image IDs
        $images = [];
        if (!empty($row['images'])) {
            $imagePairs = explode(',', $row['images']);
            foreach ($imagePairs as $pair) {
                list($image_id, $image) = explode(':', $pair);
                $images[] = [
                    'image_id' => $image_id,
                    'image' => $image
                ];
            }
        }

        $variant = [
            'varient_id' => $row['varient_id'],
            'dimension' => $row['dimension'],
            'color' => $row['color'],
            'weight' => $row['weight'],
            'varient_sku'=>$row['varient_sku'],
            'hsn'=>$row['hsn'],
            'stock' => $row['stock'],
            'status' => $row['status'],
            'base_price' => $row['base_price'],
            'sale_price' => $row['sale_price'],
            'images' => $images
        ];

        if (empty($product)) {
            $product = $row;
            $product['variants'] = [];
        }
        $product['variants'][] = $variant; 
    }

    // Remove unnecessary fields from the product array
    unset(
        $product['varient_id'],
        $product['dimension'],
        $product['color'],
        $product['weight'],
        $product['stock'],
        $product['status'],
        $product['base_price'],
        $product['sale_price'],
        $product['images']
    );

    return $product;
}



public function updateVariant($varient_id, $updateData) {
    $this->db->where('varient_id', $varient_id);
    return $this->db->update('jwellary_varient', $updateData); 
}


public function updateProductDetails($jwellaryId, $updateData) {
    $this->db->where('id', $jwellaryId);
    return $this->db->update('jwellaries', $updateData);
}
	
	public function saveBanner($data)
{
    $this->db->insert('banner', $data);
    return $this->db->insert_id(); // Returns the last inserted ID
}
	
	
	
	public function saveVarient($data)
{
    if ($this->db->insert('jwellary_varient', $data)) {
        return $this->db->insert_id();
    } else {
        log_message('error', 'Database insert error: ' . $this->db->error()['message']);
        return false;
    }
}



public function getSubCategories($id)
{
    $data = $this->db->select('categories.*')
             ->from('categories')
             ->where(['categories.is_deleted'=>1,'ParentCategoryId'=>$id]);
    return $data->get()->result_array();
    
}

public function getColors()
{
    $data = $this->db->select('colors.*')
                     ->from('colors')
                     ->where(['colors.is_deleted'=>1]);
    return $data->get()->result_array();
    
}
public function deleteVarient($data)
{
    $this->db->set('is_deleted', 1);
    $this->db->where('varient_id', $data['id']);
    $result = $this->db->update('jwellary_varient'); 
    return $result;
}


public function getUserDetails($id)
{
    $data = $this->db->select('users.*')
                     ->from('users')
                     ->where(['users.UserID'=>$id]);
    return $data->get()->row_array();
    
}

public function updatethumbnail($id,$thumbnail)
{
    $this->db->set('thumbnail', $thumbnail);
    $this->db->where('id', $id);
    $result = $this->db->update('jwellaries'); 
    return $result;
}

public function saveVendorAccount($data)
{
    $this->db->insert('vendor_account', $data);
    $insert = $this->db->insert_id();
    return $insert;
}

public function saveSignature($data)
{
    $this->db->insert('vendor_signature', $data);
    $insert = $this->db->insert_id();
    return $insert;
}

public function vendors()
{
   return $this->db->select('vendors.vendor_image,vendors.vendor_name,vendors.id, vendors.vendor_email, vendors.vendor_phone, vendors.vendor_state, vendors.vendor_city, vendors.verification_date, vendors.application_date, states.name as state_name,vendors.is_verified')
                   ->from('vendors')
                   ->join('states', 'states.id = vendors.vendor_state') // Corrected JOIN syntax
                   ->get()
                   ->result_array();
}

public function getImage($sku)
{
    $result = $this->db->select('jwellary_varient.varient_id, MIN(jwellary_images.image) AS image')
        ->from('jwellary_varient')
        ->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id')
        ->where([
            'jwellary_varient.varient_sku' => $sku,
            'jwellary_varient.is_deleted' => 2
        ])
        ->group_by('jwellary_varient.varient_id')
        ->get()
        ->row_array();
    if (!empty($result) && !empty($result['image'])) {
        $result['image'] = base_url('uploads/products/' . $result['image']);
    }

    return $result;
}







}
?>