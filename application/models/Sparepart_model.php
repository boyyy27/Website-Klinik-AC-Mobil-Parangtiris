<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sparepart_model extends CI_Model {

    public function get_all() {
        $ac_mobil = $this->db->get('ac_mobil')->result_array();
        $ganti_oli = $this->db->get('ganti_oli')->result_array();
        $servis_mesin_ringan = $this->db->get('servis_mesin_ringan')->result_array();

        $spareparts = array_merge($ac_mobil, $ganti_oli, $servis_mesin_ringan);

        return $spareparts;
    }
    public function get_price_by_name($name) {
        $tables = ['ac_mobil', 'ganti_oli', 'servis_mesin_ringan'];
        foreach ($tables as $table) {
            $this->db->where('Nama_Barang', $name);
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->row_array()['Harga_Satuan'];
            }
        }
        return 0;  // Return 0 if not found
    }
    public function get_by_id($id) {
        // Cari di tabel ac_mobil
        $this->db->where('ID_Barang', $id);
        $query = $this->db->get('ac_mobil');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        // Cari di tabel ganti_oli
        $this->db->where('ID_Barang', $id);
        $query = $this->db->get('ganti_oli');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        // Cari di tabel servis_mesin_ringan
        $this->db->where('ID_Barang', $id);
        $query = $this->db->get('servis_mesin_ringan');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }

        return false;
    }


    public function get_barang_keluar_by_id($ID_Permintaan) {
        return $this->db->get_where('permintaan_sparepart', ['ID_Permintaan' => $ID_Permintaan])->row_array();
    }

    public function delete_barang_keluar($ID_Permintaan) {
        $this->db->where('ID_Permintaan', $ID_Permintaan);
        return $this->db->delete('permintaan_sparepart');
    }
    
        public function get_stock_by_name($Nama_Barang) {
            $this->db->select('stock');
            $this->db->from('inventory');
            $this->db->where('Nama_Barang', $Nama_Barang);
            $query = $this->db->get();
            $result = $query->row_array();
            return $result ? $result['stock'] : 0;
        }
    
        public function update_stock($Nama_Barang, $new_stock) {
            $this->db->where('Nama_Barang', $Nama_Barang);
            $this->db->update('inventory', ['stock' => $new_stock]);
        }
    }

