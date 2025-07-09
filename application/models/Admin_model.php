<?php
class Admin_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_user($user_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('ID_User', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert_transaction($data) {
        return $this->db->insert('transactions', $data);
    }

    public function get_login_info($user_id) {
        $this->db->select('google_id, Username');
        $this->db->from('user');
        $this->db->where('ID_User', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_members() {
        return $this->db->get('user')->result_array();
    }

    public function get_all_transactions() {
        $this->db->select('transactions.*, products.name AS product_name, products.image AS product_image');
        $this->db->from('transactions');
        $this->db->join('products', 'transactions.product_id = products.product_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_transaction_by_id($id) {
        return $this->db->get_where('transactions', array('transaction_id' => $id))->row_array();
    }

    public function delete_transaction($id) {
        $this->db->delete('transactions', array('transaction_id' => $id));
    }

    public function get_members_with_role($role) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('Role', $role);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all() {
        $ac_mobil = $this->db->get('ac_mobil')->result_array();
        $ganti_oli = $this->db->get('ganti_oli')->result_array();
        $servis_mesin_ringan = $this->db->get('servis_mesin_ringan')->result_array();

        $spareparts = array_merge($ac_mobil, $ganti_oli, $servis_mesin_ringan);

        return $spareparts;
    }

    // New methods
    public function count_all_users() {
        return $this->db->count_all('user');
    }

    public function count_all_transactions() {
        return $this->db->count_all('transactions');
    }

    public function sum_all_points() {
        $this->db->select_sum('points');
        $query = $this->db->get('points');
        return $query->row()->points;
    }

    public function get_recent_transactions($limit = 5) {
        $this->db->select('transactions.*, user.Username');
        $this->db->from('transactions');
        $this->db->join('user', 'transactions.user_id = user.ID_User', 'left');
        $this->db->order_by('date', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_filtered_transactions($filters) {
        $this->db->select('transactions.*, COALESCE(user.Username, "Non Member") AS Username');
        $this->db->from('transactions');
        $this->db->join('user', 'transactions.user_id = user.ID_User', 'left');

        if (!empty($filters['user_id'])) {
            $this->db->where('transactions.user_id', $filters['user_id']);
        }

        if (!empty($filters['date_from'])) {
            $this->db->where('transactions.date >=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $this->db->where('transactions.date <=', $filters['date_to']);
        }

        $this->db->order_by('transactions.date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
