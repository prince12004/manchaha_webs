<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Include Razorpay Library
require_once APPPATH . 'libraries/razorpay-php/Razorpay.php';

use Razorpay\Api\Api;

class Razorpay extends CI_Controller {
    
    private $api;

    public function __construct() {
        parent::__construct();
        
        // Initialize Razorpay API with your test keys
        $this->api = new Api('rzp_test_otuyHTV0XFkyFg', 'YQ1AC9RmtcOs1kvVgKk9IaJS');
    }

    /**
     * Create a new Razorpay order.
     */
    public function create_order() {
        $amount = $this->input->post('amount');
        $this->load->model('UserModel');
        $tokenID = $this->UserModel->decodeToken($this->session->userdata('userToken'));
        $user_id = $tokenID[0]->UserID;
        $orderData = [
            'receipt'         => $this->session->userdata('order_id'),
            'amount'          => intval($amount), // Amount in paise (100 INR)
            'currency'        => 'INR',
            'payment_capture' => 1, // Auto capture
            'notes'           => [
                'user_id' => $user_id,
            ],
        ];

        // print_r($this->session->userdata('order_id'));
        // exit;
        try {
            // Create an order
            $res = $this->api->order->create($orderData);

            echo json_encode($res->toArray());

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function payment_status()
    {
        $payment_id = $this->input->post('payment_id');
        $payment = $this->api->payment->fetch($payment_id);
        $orderData = $payment->toArray();
        if ($orderData['status'] == 'captured') {
            $porderData = [
                'payment_id' => $orderData['id'],
                'order_id' => $orderData['order_id'],
                'total' => $orderData['amount']/100,
                'user_id' => $orderData['notes']['user_id'],
            ];
            $this->db->insert('payments', $porderData);
            $orderData['pid'] = $this->db->insert_id();
            echo json_encode(['status' => 'success', 'data' => $orderData]);
        }else {
            echo json_encode(['status' => 'failed', 'data' => $orderData]);
        }
        
    }


    public function initiateRefund()
    {
        $order_id = $this->input->post('order_id');
        $user_id = $this->input->post('user_id');
        $pid = $this->input->post('payment');
    
        $odata = $this->db->select('(amount + taxes) as total')
                          ->from('orders')
                          ->where(['order_id' => $order_id, 'user_id' => $user_id])
                          ->get()
                          ->row();
    
        if (!$odata) {
            echo json_encode(['error' => 'Order not found']);
            return;
        }
    
        // Fetch payment ID
        $payment = $this->db->select('payment_id')->from('payments')->where('id', $pid)->get()->row();
        if (!$payment) {
            echo json_encode(['error' => 'Payment record not found']);
            return;
        }
    
        $refundData = [
            'amount' => intval($odata->total * 100), // Convert to paise
            'speed' => 'optimum',
            'notes' => ['reason' => 'Refund for order #' . $order_id],
        ];
    
        try {
            // Ensure Razorpay API is initialized in constructor
            $res = $this->api->payment->fetch($payment->payment_id)->refund($refundData);
            $data = $res->toArray();

            $this->db->set('payment_status',4)->where(['order_id'=>$order_id,'user_id'=>$user_id])->update('orders');
            $this->db->insert('refunds', [
                'payment_id' => $payment->payment_id,
                'refund_id' => $data['id'],
                'amount' => $data['amount'] / 100,
                'status' => $data['status'],
                'order_id' => $order_id,
            ]);
            echo json_encode(['status' => 'success', 'data' => $data]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }



public function razorpay_refund()
{
    $input = file_get_contents("php://input");
    $eventData = json_decode($input, true);

    if (isset($eventData['event']) && $eventData['event'] === 'payment.refund.processed') {
        $refund_id = $eventData['payload']['refund']['entity']['id'];
        $status = $eventData['payload']['refund']['entity']['status'];

        // Update refund status in database
        $this->db->where('refund_id', $refund_id)->update('refunds', ['status' => $status]);

        echo json_encode(['success' => 'Refund status updated']);
    } else {
        echo json_encode(['error' => 'Invalid webhook event']);
    }
}


public function refundCod()
{
    $order_id = $this->input->post('order_id');
    $user_id = $this->input->post('user_id');
    $amount = $this->input->post('amount');

    $odata = $this->db->select('(amount + taxes) as total')
                      ->from('orders')
                      ->where(['order_id' => $order_id, 'user_id' => $user_id])
                      ->get()
                      ->row();

    if (!$odata) {
        echo json_encode(['error' => 'Order not found']);
        return;
    }

    // Fetch payment ID
    $payment = $this->db->select('payment_id')->from('payments')->where('order_id', $order_id)->get()->row();
    if (!$payment) {
        echo json_encode(['error' => 'Payment record not found']);
        return;
    }

    $refundData = [
        'amount' => intval($amount * 100), // Convert to paise
        'speed' => 'optimum',
        'notes' => ['reason' => 'Refund for order #' . $order_id],
    ];

    try {
        // Ensure Razorpay API is initialized in constructor
        $res = $this->api->payment->fetch($payment->payment_id)->refund($refundData);
        $data = $res->toArray();

        $this->db->set('payment_status', 4)->where(['order_id' => $order_id, 'user_id' => $user_id])->update('orders');
        $this->db->insert('refunds', [
            'payment_id' => $payment->payment_id,
            'refund_id' => $data['id'],
            'amount' => $data['amount'] / 100,
            'status' => $data['status'],
            'order_id' => $order_id,
        ]);
        echo json_encode(['status' => 'success', 'data' => $data]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
    
}




    
}
