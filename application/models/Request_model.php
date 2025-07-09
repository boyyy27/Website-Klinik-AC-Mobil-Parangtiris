    <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Request_model extends CI_Model {

        public function create($data) {
            return $this->db->insert('permintaan_sparepart', $data);
        }
        
        public function get_all_request_statuses() {
            $this->db->select('ID_Permintaan,Nama_Barang, Jumlah, Status');
            $this->db->from('permintaan_sparepart');
            $this->db->order_by("CASE WHEN Status = 'Pending' THEN 0 ELSE 1 END");
            $query = $this->db->get();
            return $query->result_array();
        }
        public function count_pending_requests() {
            $this->db->from('permintaan_sparepart');
            $this->db->where('Status', 'Pending');
            return $this->db->count_all_results();
        }
        public function get_recent_requests($limit = 5) {
            $this->db->order_by('Tanggal_Permintaan', 'DESC');
            $this->db->limit($limit);
            $query = $this->db->get('permintaan_sparepart');
            return $query->result_array();
        }
        
        
    }
