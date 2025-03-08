<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Update the order status in the database.
     */
    public function update_order_status($order_id, $status)
    {
        $this->db->where('order_id', $order_id);
        $this->db->update('orders', ['status' => $status]);
    }

    public function get_webhook()
    {
        // ...existing code...
    }

    public function add_webhook()
    {
        // ...existing code...
    }

    public function update_webhook()
    {
        // ...existing code...
    }

    public function delete_webhook()
    {
        // ...existing code...
    }

}
?>