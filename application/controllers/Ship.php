<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ship extends CI_Controller
{


    
    private $apiBaseUrl = 'https://apiv2.shiprocket.in/v1/external/';
    private $apiEmail = 'info@mnnchaha.com';
    private $apiPassword = 'Shri@sai01';

    public function __construct() {
        parent::__construct();
        $this->load->library('session'); // Ensure session library is loaded
        $this->load->helper('url');     // Load helpers if needed
    }

    /**
     * Dynamic token management to ensure validity.
     */
    private function getAuthToken()
    {
        if ($this->session->userdata('shiprocket_token') && $this->session->userdata('shiprocket_token_expiry') > time()) {
            return $this->session->userdata('shiprocket_token');
        }

        // Request new token
        $url = $this->apiBaseUrl . 'auth/login';
        $credentials = [
            'email' => $this->apiEmail,
            'password' => $this->apiPassword
        ];

        $response = $this->makeApiRequest('POST', $url, $credentials, false);
        if ($response && isset($response['token'])) {
            // Save token and expiry in session
            $this->session->set_userdata('shiprocket_token', $response['token']);
            $this->session->set_userdata('shiprocket_token_expiry', time() + 3600); // Assuming 1-hour validity
            return $response['token'];
        }

        log_message('error', 'Failed to fetch Shiprocket token');
        return null;
    }

    /**
     * Utility function to make API requests.
     */
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
                return null; // Authentication failed
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
	
	public function cancelShip($id)
{

    $api_url = 'https://apiv2.shiprocket.in/v1/external/orders/cancel';
    $api_key = $this->getAuthToken(); 
    $id = json_encode(['ids' => [$id]]);
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $id);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return false;
    }
    curl_close($ch);
    $response_data = json_decode($response, true);
    return $response_data;
    
}


    public function trackShipment($shipmentId)
    {
        $url = "https://apiv2.shiprocket.in/v1/external/courier/track/shipment/{$shipmentId}";
        $api_key = $this->getAuthToken(); 
        // Initialize cURL
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                "Authorization: Bearer {$api_key}",
            ],
        ]);
    
        // Execute the request
        $response = curl_exec($curl);
    
        // Check for errors
        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            return ['error' => $error];
        }
    
        // Close the cURL session
        curl_close($curl);
    
        // Decode the JSON response
        return json_decode($response, true);
    }


    public function trackorder($shipmentId)
    {
        $url = "https://apiv2.shiprocket.in/v1/external/orders/show/{$shipmentId}";
        $api_key = $this->getAuthToken(); 
        // Initialize cURL
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                "Authorization: Bearer {$api_key}",
            ],
        ]);
    
        // Execute the request
        $response = curl_exec($curl);
    
        // Check for errors
        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            return ['error' => $error];
        }
    
        // Close the cURL session
        curl_close($curl);
    
        // Decode the JSON response
        return json_decode($response, true);
    }


    public function trackingdata($order)
    {
        $url = "https://apiv2.shiprocket.in/v1/external/courier/track?order_id={$order}";
        $api_key = $this->getAuthToken(); 
        // Initialize cURL
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                "Authorization: Bearer {$api_key}",
            ],
        ]);
    
        // Execute the request
        $response = curl_exec($curl);
    
        // Check for errors
        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            return ['error' => $error];
        }
    
        // Close the cURL session
        curl_close($curl);
    
        // Decode the JSON response
        return json_decode($response, true);
    }  
    
    



    /**
     * Check delivery serviceability.
     */
    public function checkDelivery()
    {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        // Validate input
        if (empty($data['delivery_postcode']) || empty($data['pickup_postcode']) || empty($data['weight'])) {
            echo json_encode(['status' => 'fail', 'message' => 'Invalid input']);
            return;
        }

        $checkdata = [
            'delivery_postcode' => $data['delivery_postcode'],
            'pickup_postcode' => $data['pickup_postcode'],
            'weight' => $data['weight']/1000,
            'cod' => !empty($data['cod']) && $data['cod'] === 1
        ];

        $response = $this->delivery($checkdata);

        if ($response && isset($response['data']['available_courier_companies'])) {
            if (count($response['data']['available_courier_companies']) > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Delivery by '.$response['data']['available_courier_companies'][0]['etd']]);
            } else {
                echo json_encode(['status' => 'fail', 'message' => 'Your pincode is not serviceable']);
            }
        } else {
            echo json_encode($response);
            //echo json_encode(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    /**
     * Call delivery serviceability API.
     */
    private function delivery($data)
    {
        $url = $this->apiBaseUrl . 'courier/serviceability/';
        return $this->makeApiRequest('GET', $url, $data);
    }

    /**
     * Generate AWB for shipment.
     */
    public function generateAWB($data)
    {
        //return $data;
        $url = $this->apiBaseUrl . 'courier/assign/awb';
        return $this->makeApiRequest('POST', $url, $data);
    }
    public function SchedulePickup()
    {

        $request_data_json = file_get_contents('php://input');
        $data = json_decode($request_data_json, true);
                // if (!isset($data) || !is_array($data)) {
                //     echo json_encode([
                //         'status' => 'failed',
                //         'message' => 'Invalid shipment_id. It must be an array.'
                //     ]);
                //     return;
                // }
    
        // API URL
        $apiUrl = 'https://apiv2.shiprocket.in/v1/external/courier/generate/pickup';
    
        $api_payload = [
            'shipment_id' => $data // Passing the whole array of shipment IDs
        ];
        $ch = curl_init();
    
        $bearer = $this->getAuthToken(); 
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Use POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_payload)); // JSON encode the payload
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $bearer // Replace with your Shiprocket API token
        ]);
    
        // Execute cURL request
        $response = curl_exec($ch);
    
        // Check for cURL errors
        if (curl_errno($ch)) {
            echo json_encode([
                'status' => 'failed',
                'message' => 'cURL Error: ' . curl_error($ch)
            ]);
            curl_close($ch);
            return;
        }
    
        // Close cURL
        curl_close($ch);
    
        // Decode JSON response
        $responseData = json_decode($response, true);
        if (isset($responseData['pickup_status']) && $responseData['pickup_status'] == 1) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Pickup scheduled successfully',
                'data' => $responseData
            ]);
        } else {
            echo json_encode([
                'status' => 'failed',
                'message' => $responseData['message'] ?? 'Something went wrong',
                'data' => $responseData
            ]);
        }
    }



    function getShiprocketOrders($page,$type,$andType = '',$andType1 = '',$andType2 = '',$andType3 = '',$andType4 = '') {
        // API URL
        $url = 'https://apiv2.shiprocket.in/v1/external/orders?filter_by=status&filter=' . urlencode($type) . ',' . urlencode($andType) . ',' . urlencode($andType1) . ',' . urlencode($andType2) . ',' . urlencode($andType3). ',' . urlencode($andType4).'?sort_by=updated_at&sort=DESC'.'&page='.urlencode($page);
        $ch = curl_init($url);
        $apiToken = $this->getAuthToken();
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiToken
        ];
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        if ($error = curl_error($ch)) {
            echo 'cURL Error: ' . $error;
        }
        curl_close($ch);
        return json_decode($response, true);
    }


    function getShiprocketreturns($page) {
        // API URL
        $url = 'https://apiv2.shiprocket.in/v1/external/orders/processing/return?page='.$page;
        $ch = curl_init($url);
        $apiToken = $this->getAuthToken();
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiToken
        ];
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        if ($error = curl_error($ch)) {
            echo 'cURL Error: ' . $error;
        }
        curl_close($ch);
        return json_decode($response, true);
    }





 public function cancelShiprocketOrders($orderIds)
{
    $url = 'https://apiv2.shiprocket.in/v1/external/orders/cancel';
    $bearerToken = $this->getAuthToken();
    $data = [
        "ids" => [$orderIds]
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
    return json_decode($response, true);
}

    

    /**
     * Generate label and AWB for a shipment.
     */
    public function assignAWB()
    {
        // Get and decode request data
        $request_data_json = file_get_contents('php://input');
        $data = json_decode($request_data_json, true);
    
        // Validate input data
        if (!$data || !isset($data['pincode'], $data['shipment_id'], $data['totalWeight'])) {
            echo json_encode(['error' => 'Invalid input data']);
            return;
        }
    
        // Determine COD status
        $cod = ($data['payment_status'] == 1) ? 0 : 1;
    
        // Prepare partner data for courier check
        $checkPartnerdata = [
            'delivery_postcode' => $data['pincode'],
            'pickup_postcode' => 401305, // Assuming a static pickup postcode
            'weight' => $data['totalWeight'] / 1000, // Convert weight to kg
            'cod' => $cod,
        ];
    
        // Check available couriers
        $resd = $this->delivery($checkPartnerdata);
        if (!isset($resd['data']['available_courier_companies']) || empty($resd['data']['available_courier_companies'])) {
            echo json_encode(['error' => 'No couriers available for the specified route.']);
            return;
        }
    
        // Process available couriers
        $available_couriers = $resd['data']['available_courier_companies'];
        $awb = null;
    
        foreach ($available_couriers as $courier) {
            // Check if the courier supports the shipment weight
            $minWeight = $courier['min_weight'];
            $shipmentWeight = max(0.5, $data['totalWeight'] / 1000); // Minimum weight is 0.5kg
    
            if ($minWeight <= $shipmentWeight) {
                $manifest = [
                    'shipment_id' => $data['shipment_id'],
                    'courier_id' => $courier['courier_company_id'],
                ];
    
                // Attempt AWB generation
                $awb = $this->generateAWB($manifest);
   
                if (isset($awb['awb_assign_status'])&&$awb['awb_assign_status']==1) {
                    $this->db->set('order_status', 8)
                             ->where('shipment_id', $manifest['shipment_id'])
                             ->update('orders');
                    break;
                }
            }
        }
    
        // Return the response
        if ($awb && isset($awb['response']['data']['awb_code'])) {
            echo json_encode(['status' => 'success', 'message' => $awb['response']['data']['awb_code']]);
        } else {
            log_message('error', "AWB generation failed for shipment: " . json_encode($data));
            echo json_encode(['error' => 'AWB generation failed']);
        }
    }
    


    public function generateLabel()
    {
        $request_data_json = file_get_contents('php://input');
        $data = json_decode($request_data_json, true);
        // print_r($data);
        // exit;
        // if (!$data || !isset($data['shipmentIDs']) || !is_array($data['shipmentIDs'])) {
        //     http_response_code(400);
        //     echo json_encode(['status' => 'fail', 'message' => 'Invalid input data. Shipment ID must be provided as an array.']);
        //     return;
        // }
        $shipment_ids = $data;
    
        // If you're modifying the data for the API call, you can do it here
        $api_payload = [
            'shipment_id' => $shipment_ids // Passing the whole array of shipment IDs
        ];
    
        $url = $this->apiBaseUrl . 'courier/generate/label';  
        $api_key = $this->getAuthToken();  
    
        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        
        // Set headers
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        // Send the payload to the API
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_payload));
    
        // Execute the request
        $response = curl_exec($ch);
    
        // Check for cURL errors
        if (curl_errno($ch)) {
            log_message('error', 'cURL error: ' . curl_error($ch));
            http_response_code(500);
            echo json_encode(['status' => 'fail', 'message' => 'Failed to send request to Shiprocket API.']);
            curl_close($ch);
            return;
        }
    
        // Close cURL connection
        curl_close($ch);
    
        // Decode the response
        $response_data = json_decode($response, true);
    
        // Check if the response is valid
        if ($response_data) {
            echo json_encode($response_data, JSON_PRETTY_PRINT);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'fail', 'message' => 'Failed to decode Shiprocket API response.']);
        }
    }
	
	
	
	    public function generateInvoice()
    {
        $request_data_json = file_get_contents('php://input');
        $data = json_decode($request_data_json, true);
        $shipment_ids = $data;

        $api_payload = [
            'ids' => $shipment_ids
        ];

    
        $url = $this->apiBaseUrl . 'orders/print/invoice';  
        $api_key = $this->getAuthToken();  
    
        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        
        // Set headers
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_payload));
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            log_message('error', 'cURL error: ' . curl_error($ch));
            http_response_code(500);
            echo json_encode(['status' => 'fail', 'message' => 'Failed to send request to Shiprocket API.']);
            curl_close($ch);
            return;
        }
    
        // Close cURL connection
        curl_close($ch);
    
        // Decode the response
        $response_data = json_decode($response, true);
    
        // Check if the response is valid
        if ($response_data) {
            echo json_encode($response_data, JSON_PRETTY_PRINT);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'fail', 'message' => 'Failed to decode Shiprocket API response.']);
        }
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


public function addProductToShip($productData,$variantData,$imagePaths)
{
    $api_key = $this->getAuthToken();
    $processData = [
        'name'=>$productData['jwellary_name'],
        'category_code'=>'default',
        'type'=>'Single',
        'qty'=>$variantData['stock'],
        "price" => $variantData['base_price'],
        'sku'=>$variantData['varient_sku'],
        'qc_details'=>[
            'product_image'=>$productData['thumbnail'],
            'brand'=>'MNNCHAHA',
            'color'=>$variantData['color'],
            'size' => isset($variantData['size']) ? $variantData['size'] : 'free size',
            'serial_no'=>$productData['jwellary_id'],
            'check_damaged_product'=>true,
        ]

        ];
            $url = 'https://apiv2.shiprocket.in/v1/external/products';
            
            $payload = json_encode($processData);
        
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $api_key
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        
            $response = curl_exec($ch);
        
            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
                curl_close($ch);
                return [
                    'status' => false,
                    'message' => $error_msg
                ];
            }
        
            curl_close($ch);
        
            return json_decode($response, true);


    
}



    
    
    
}
?>
