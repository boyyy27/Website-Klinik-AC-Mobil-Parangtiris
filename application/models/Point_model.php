<?php
class Point_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function add_points($user_id, $points) {
        $this->db->set('points', 'points + ' . (int) $points, FALSE);
        $this->db->where('user_id', $user_id);
        $this->db->update('points');
    }

    public function get_poin($user_id) {
        $query = $this->db->get_where('points', array('user_id' => $user_id));
        return $query->row_array();
    }

    public function redeem_points($user_id, $product_id) {
        $this->db->select('points');
        $this->db->from('points');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $user_points = $query->row()->points;

        $this->db->select('points, name');
        $this->db->from('products');
        $this->db->where('product_id', $product_id);
        $product = $this->db->get()->row();

        if ($user_points >= $product->points) {
            $new_points = $user_points - $product->points;
            $this->db->set('points', $new_points);
            $this->db->where('user_id', $user_id);
            $this->db->update('points');

            $redeem_code = uniqid('redeem_'); // Generate unique code
            $transaction_data = array(
                'user_id' => $user_id,
                'product_id' => $product_id,
                'redeem' => $redeem_code,
                'deskripsi' => 'point',
                'amount' => $product->points,
                'date' => date('Y-m-d H:i:s')
            );
            $this->db->insert('transactions', $transaction_data);

            return $redeem_code;
        }

        return false;
    }
}
?>
