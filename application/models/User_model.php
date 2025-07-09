<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function get_user($user_id) {
        $this->db->select('user.*, points.points, user.google_email, user.google_id');
        $this->db->from('user');
        $this->db->join('points', 'user.ID_User = points.user_id', 'inner');
        $this->db->where('user.ID_User', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_user($user_id, $data) {
        $this->db->where('ID_User', $user_id);
        return $this->db->update('user', $data);
    }

    public function get_points($user_id) {
        $this->db->select('points');
        $this->db->from('points');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->row()->points;
    }

    public function get_transactions($user_id) {
        $this->db->select('transactions.*, products.name AS product_name, products.image AS product_image');
        $this->db->from('transactions');
        $this->db->join('products', 'transactions.product_id = products.product_id', 'left');
        $this->db->where('transactions.user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_transaction($transaction_id) {
        $this->db->select('transactions.*, products.name AS product_name, products.image AS product_image');
        $this->db->from('transactions');
        $this->db->join('products', 'transactions.product_id = products.product_id', 'left');
        $this->db->where('transactions.transaction_id', $transaction_id);
        $query = $this->db->get();
        return $query->row_array();
    }
}
?>
