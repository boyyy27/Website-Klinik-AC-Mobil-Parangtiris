<?php
// application/models/Barang_model.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

    public function get_all_barang() {
        $query = $this->db->query("
            SELECT ID_Barang, Nama_Barang FROM ganti_oli
            UNION ALL
            SELECT ID_Barang, Nama_Barang FROM ac_mobil
            UNION ALL
            SELECT ID_Barang, Nama_Barang FROM servis_mesin_ringan
        ");
        
        return $query->result_array();
    }

    public function get_barang_keluar($date_from = null, $date_to = null) {
        if ($date_from && $date_to) {
            $this->db->where('TanggalKeluar >=', $date_from);
            $this->db->where('TanggalKeluar <=', $date_to);
        }
        $query = $this->db->get('barangkeluar'); // Pastikan nama tabel benar
        return $query->result_array();
    }

    public function get_total_harga($date_from = null, $date_to = null) {
        if ($date_from && $date_to) {
            $this->db->where('TanggalKeluar >=', $date_from);
            $this->db->where('TanggalKeluar <=', $date_to);
        }
        $this->db->select('SUM(HargaPerUnit * JumlahBarang) AS total_harga');
        $query = $this->db->get('barangkeluar'); // Pastikan nama tabel benar
        return $query->row()->total_harga;
    }

    public function format_rupiah($amount) {
        return 'Rp' . number_format($amount, 2, ',', '.');
    }

    public function get_barang_masuk() {
        $query = $this->db->get('barangmasuk');
        return $query->result_array();
    }

    public function get_total_harga_masuk() {
        $this->db->select('SUM(HargaPerUnit * JumlahBarang) AS total_harga');
        $query = $this->db->get('barangmasuk');
        return $query->row()->total_harga;
    }

    public function get_total_barang_masuk() {
        $this->db->select('SUM(JumlahBarang) AS total_barang_masuk');
        $query = $this->db->get('barangmasuk');
        return $query->row()->total_barang_masuk;
    }

    public function get_total_barang_keluar() {
        $this->db->select('SUM(JumlahBarang) AS total_barang_keluar');
        $query = $this->db->get('barangkeluar');
        return $query->row()->total_barang_keluar;
    }

    public function get_stok_barang() {
        $this->db->select('bm.NamaBarang, (SUM(bm.JumlahBarang) - COALESCE(SUM(bk.JumlahBarang), 0)) AS stok');
        $this->db->from('barangmasuk bm');
        $this->db->join('barangkeluar bk', 'bm.ID_Barang = bk.ID_Barang', 'LEFT');
        $this->db->group_by('bm.ID_Barang, bm.NamaBarang');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_recent_barang_masuk() {
        $this->db->order_by('TanggalMasuk', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get('barangmasuk');
        return $query->result_array();
    }

    public function get_recent_barang_keluar() {
        $this->db->order_by('TanggalKeluar', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get('barangkeluar');
        return $query->result_array();
    }

    
    public function count_total_barang_masuk() {
        $this->db->select('SUM(JumlahBarang) AS total_barang_masuk');
        $query = $this->db->get('barangmasuk');
        return $query->row()->total_barang_masuk;
    }

    public function count_total_barang_keluar() {
        $this->db->select('SUM(JumlahBarang) AS total_barang_keluar');
        $query = $this->db->get('barangkeluar');
        return $query->row()->total_barang_keluar;
    }
    
    public function count_stok_barang() {
        $this->db->select('SUM(bm.JumlahBarang) - COALESCE(SUM(bk.JumlahBarang), 0) AS stok_barang', false);
        $this->db->from('barangmasuk bm');
        $this->db->join('barangkeluar bk', 'bm.ID_Barang = bk.ID_Barang', 'LEFT');
        $query = $this->db->get();
        return $query->row()->stok_barang;
    }

}
?>
