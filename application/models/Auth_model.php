<?php
class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user_by_google_id($google_id) {
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('google_id', $google_id);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }

        return false;
    }

    public function insert_google_user($data) {
        return $this->db->insert('User', $data);
    }

    public function login($username, $password) {

        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('Username', $username);
        $this->db->where('Password', $password);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }

        return false;
    }

    public function signup($data) {
        $this->db->where('Username', $data['Username']);
        $query = $this->db->get('User');

        if ($query->num_rows() > 0) {
            return false;
        }

        return $this->db->insert('User', $data);
    }

    public function is_phone_number_registered($phone_number) {
        $this->db->where('Nomor_Telepon', $phone_number);
        $query = $this->db->get('User');

        return $query->num_rows() > 0;
    }
}

    

?>
