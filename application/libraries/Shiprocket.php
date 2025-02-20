<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shiprocket extends \CI_Controller
{
    private $apiUrl = 'https://apiv2.shiprocket.in/v1/external/';
    private $apiEmail = 'manojkachora8@gmail.com'; // Replace with your Shiprocket email
    private $apiPassword = 'Manoj@123';           // Replace with your Shiprocket password
    private $accessToken;

    public function __construct()
    {
        $this->ci =& get_instance(); // CodeIgniter instance
        $this->authenticate();      // Generate access token during initialization
    }

    /**
     * Authenticate with Shiprocket API and generate an access token.
     */
    private function authenticate()
    {
        $url = $this->apiUrl . 'auth/login';
        $payload = json_encode([
            'email' => $this->apiEmail,
            'password' => $this->apiPassword,
        ]);

        $headers = [
            'Content-Type: application/json',
        ];

        $response = $this->makeCurlRequest($url, $headers, $payload, 'POST');

        if (isset($response['token'])) {
            $this->accessToken = $response['token'];
        } else {
            $this->accessToken = null;
            log_message('error', 'Failed to authenticate with Shiprocket API: ' . json_encode($response));
        }
    }

    /**
     * Track a shipment by its ID.
     * 
     * @param string $shipmentId The shipment ID to track.
     * @return array Response from the Shiprocket API.
     */
    public function trackShipment($shipmentId)
    {
        if (!$this->accessToken) {
            return ['error' => 'Access token not available. Authentication failed.'];
        }

        $url = $this->apiUrl . "courier/track/shipment/" . $shipmentId;

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken,
        ];

        return $this->makeCurlRequest($url, $headers);
    }

    /**
     * Make a cURL request.
     * 
     * @param string $url The endpoint URL.
     * @param array $headers The request headers.
     * @param string|null $payload JSON payload for POST/PUT requests.
     * @param string $method HTTP method (GET, POST, PUT, etc.).
     * @return array Decoded JSON response.
     */
    private function makeCurlRequest($url, $headers, $payload = null, $method = 'GET')
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($payload) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            }
        } elseif ($method !== 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            if ($payload) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            }
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => curl_error($ch)];
        }

        curl_close($ch);

        return json_decode($response, true);
    }


public function liveShip($request_data,$api_url)
{


        // Convert the request data into JSON
        $request_data_json = json_encode($request_data);

        // Set up the cURL request
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken
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
public function test()
{
    print_r('hello');
    exit;
    
}




    



}
