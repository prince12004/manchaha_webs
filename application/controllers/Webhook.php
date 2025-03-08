<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Webhook_model');
    }

    /**
     * Handle webhook data from Shiprocket and update order status.
     */
    public function update_status()
    {
        // Get the raw POST data
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);

        // Log the received data for debugging
        log_message('debug', 'Received webhook data: ' . print_r($data, true));

        print_r($data);
        exit;
        // Update order status in the database
        if ($data && isset($data['order_id']) && isset($data['status'])) {
            $this->Webhook_model->update_order_status($data['order_id'], $data['status']);
            echo json_encode(['status' => 'success', 'message' => 'Order status updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid webhook data']);
        }


    }

}
?>