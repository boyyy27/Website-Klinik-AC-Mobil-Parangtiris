<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasuk_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->get('barangmasuk')->result_array();
    }

    public function add($data)
    {
        $this->db->insert('barangmasuk', $data);
    }

    public function get_barang_masuk_by_id($NomorTransaksi)
    {
        return $this->db->get_where('barangmasuk', ['NomorTransaksi' => $NomorTransaksi])->row_array();
    }

    public function update_barang_masuk($NomorTransaksi, $updated_data)
    {
        $this->db->where('NomorTransaksi', $NomorTransaksi);
        $this->db->update('barangmasuk', $updated_data);
    }

    public function delete_barang_masuk($NomorTransaksi)
    {
        $this->db->delete('barangmasuk', ['NomorTransaksi' => $NomorTransaksi]);
    }
}

