<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ganti_oli_model extends CI_Model {
    public function get_all() {
        return $this->db->get('ganti_oli')->result_array();
    }

    public function add($data) {
        return $this->db->insert('ganti_oli', $data);
    }
    public function get_ganti_oli_by_id($id) {
        $this->db->where('ID_Barang', $id);
        return $this->db->get('ganti_oli')->row_array();
    }

    public function update_ganti_oli($id) {
        $data = array(
            'Nama_Barang' => $this->input->post('nama_barang'),
            'Harga_Satuan' => $this->input->post('harga_satuan'),
            'Jumlah_Stok' => $this->input->post('jumlah_stok')
        );

        $this->db->where('ID_Barang', $id);
        return $this->db->update('ganti_oli', $data);
    }

    public function delete($id) {
        $this->db->where('ID_Barang', $id);
        $this->db->delete('ganti_oli');
    }
    
}
