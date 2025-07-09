<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ac_mobil_model extends CI_Model {
    public function get_all() {
        return $this->db->get('ac_mobil')->result_array();
    }

    public function add($data) {
        return $this->db->insert('ac_mobil', $data);
    }


    public function delete($id) {
        $this->db->where('ID_Barang', $id);
        $this->db->delete('ac_mobil');
    }

    public function get_ac_mobil_by_id($id) {
        $query = $this->db->get_where('ac_mobil', array('ID_Barang' => $id));
        return $query->row_array();
    }

    public function update_ac_mobil($id) {
        $data = array(
            'Nama_Barang' => $this->input->post('nama_barang'),
            'Harga_Satuan' => $this->input->post('harga_satuan'),
            'Jumlah_Stok' => $this->input->post('jumlah_stok')
        );

        $this->db->where('ID_Barang', $id);
        return $this->db->update('ac_mobil', $data);
    }
    
}
