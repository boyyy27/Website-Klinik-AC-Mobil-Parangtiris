<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangkeluar_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->get('barangkeluar')->result_array();
    }

    public function add($data)
    {
        $this->db->insert('barangkeluar', $data);
    }

    public function get_barang_keluar_by_id($NomorTransaksi)
    {
        return $this->db->get_where('barangkeluar', ['NomorTransaksi' => $NomorTransaksi])->row_array();
    }

    public function update_barang_keluar($NomorTransaksi)
    {
        $data = array(
            'TanggalKeluar' => $this->input->post('TanggalKeluar'),
            'NamaPenerima' => $this->input->post('NamaPenerima'),
            'ID_Barang' => $this->input->post('ID_Barang'),
            'NamaBarang' => $this->input->post('NamaBarang'),
            'JumlahBarang' => $this->input->post('JumlahBarang'),
            'HargaPerUnit' => $this->input->post('HargaPerUnit'),
            'Keterangan' => $this->input->post('Keterangan')
        );

        $this->db->where('NomorTransaksi', $NomorTransaksi);
        $this->db->update('barangkeluar', $data);
    }

    public function delete_barang_keluar($NomorTransaksi)
    {
        $this->db->delete('barangkeluar', ['NomorTransaksi' => $NomorTransaksi]);
    }
}
