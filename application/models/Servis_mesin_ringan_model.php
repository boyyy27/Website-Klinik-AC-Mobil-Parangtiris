<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servis_mesin_ringan_model extends CI_Model {
    public function get_all() {
        return $this->db->get('servis_mesin_ringan')->result_array();
    }

    public function add($data) {
        return $this->db->insert('servis_mesin_ringan', $data);
    }

    public function update_servis_mesin_ringan($id) {
        $data = array(
            'Nama_Barang' => $this->input->post('nama_barang'),
            'Harga_Satuan' => $this->input->post('harga_satuan'),
            'Jumlah_Stok' => $this->input->post('jumlah_stok')
        );

        $this->db->where('ID_Barang', $id);
        return $this->db->update('servis_mesin_ringan', $data);
    }

    public function delete($id) {
        $this->db->where('ID_Barang', $id);
        $this->db->delete('servis_mesin_ringan');
    }

    public function get_servis_mesin_ringan_by_id($id) {
        $this->db->where('ID_Barang', $id);
        return $this->db->get('servis_mesin_ringan')->row_array();
    }
    
}
