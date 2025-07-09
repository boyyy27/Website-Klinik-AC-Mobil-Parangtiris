<?php
class Inventory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_spareparts() {
        $ac_mobil = $this->db->get('ac_mobil')->result_array();
        $ganti_oli = $this->db->get('ganti_oli')->result_array();
        $servis_mesin_ringan = $this->db->get('servis_mesin_ringan')->result_array();

        $spareparts = array_merge($ac_mobil, $ganti_oli, $servis_mesin_ringan);

        return $spareparts;
    }

    public function approve_request($id_permintaan) {
        // Fetch request details
        $request = $this->db->get_where('permintaan_sparepart', ['ID_Permintaan' => $id_permintaan])->row_array();
    
        // Debugging: Log or print request details
        log_message('debug', 'Request details: ' . print_r($request, true));
    
        // Determine table to update based on Nama_Barang
        $table = '';
        switch ($request['Nama_Barang']) {
            case 'Compressor Densos':
                $table = 'ac_mobil';
                break;
            // Add other cases for different spare parts if needed
            default:
                // Handle default case if Nama_Barang does not match known cases
                break;
        }
    
        // Debugging: Log or print table selection
        log_message('debug', 'Selected table: ' . $table);
    
        // If a valid table is found, update the stock
        if ($table) {
            // Begin transaction (optional but recommended)
            $this->db->trans_begin();
    
            // Update stock
            $this->db->set('Jumlah_Stok', 'Jumlah_Stok - ' . $request['Jumlah'], FALSE)
                     ->where('ID_Barang', $request['ID_Barang'])
                     ->update($table);
    
            // Check if transaction is successful
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                log_message('error', 'Failed to update stock');
                return false;
            } else {
                // Mark the request as approved
                $this->db->set('Status', 'Approved')
                         ->where('ID_Permintaan', $id_permintaan)
                         ->update('permintaan_sparepart');
    
                // Create a notification for the admin
                $this->db->insert('notifications', [
                    'user_role' => 'admin',
                    'message' => 'Permintaan Anda telah diapprove! Mohon tunggu barang sampai.',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
    
                // Commit transaction
                $this->db->trans_commit();
    
                log_message('debug', 'Request approved and stock updated');
                return true;
            }
        }
    
        log_message('debug', 'No valid table found for update');
        return false;
    }
    public function get_pending_requests() {
        $this->db->where('Status', 'Pending');
        $query = $this->db->get('permintaan_sparepart');
        return $query->result_array();
    }


    public function get_user($user_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('ID_User', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function count_pending_requests() {
        // Query to count pending requests
        $this->db->where('Status', 'Pending');
        $query = $this->db->get('permintaan_sparepart');
        return $query->num_rows();
    }

    public function update_request_status($id, $status) {
        $this->db->where('ID_Permintaan', $id);
        $this->db->update('permintaan_sparepart', ['Status' => $status]);
    }

    

    public function getHargaPerUnitById($id_barang) {
        // Query to get HargaPerUnit from your 'barang' table based on id_barang
        $query = $this->db->select('HargaPerUnit')
                          ->from('barang')
                          ->where('id_barang', $id_barang)
                          ->get();

        // Check if query returns a row
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->HargaPerUnit;
        } else {
            return 'Harga tidak tersedia'; // Adjust as per your application's logic
        }
    }

}
?>
