<?php
class Notifications_model extends CI_Model {

    public function get_admin_notifications() {
        return $this->db->get_where('notifications', ['user_role' => 'admin'])->result_array();
    }

    public function mark_as_read($notification_id) {
        $this->db->set('is_read', 1)
                 ->where('id', $notification_id)
                 ->update('notifications');
    }

    public function get_notifications() {
        // Ambil notifikasi dari database atau sumber data lain
        $this->db->select('message');
        $query = $this->db->get('notifications'); // Sesuaikan dengan tabel yang benar
        return $query->result_array();
    }
}
?>