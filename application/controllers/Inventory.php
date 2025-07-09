<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ac_mobil_model');
        $this->load->model('Ganti_oli_model');
        $this->load->model('Servis_mesin_ringan_model');
        $this->load->model('Inventory_model');
        $this->load->model('BarangMasuk_model');
        $this->load->model('Barangkeluar_model');
        $this->load->model('Barang_model');



        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('utility');
        if ($this->router->fetch_method() !== 'verifikasi') {
            $this->_check_inventory();
        }

    }    
    private function _check_inventory() {
        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('role');

        if (!$user_id || $user_role !== 'inventory') {
            redirect('inventory/verifikasi');
        }
    }
    public function verifikasi() {
        $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
        $this->load->view('inventory/layout/header');
        $this->load->view('inventory/layout/footer'); 
        $this->load->view('inventory/verifikasi',$data);
    }
    public function dashboard() {
        $this->load->model('Barang_model');
        $this->load->model('sparepart_model');
    $data['stokBarang'] = $this->Barang_model->get_stok_barang();
    $data['totalBarangMasuk'] = $this->Barang_model->get_total_barang_masuk(); // Misalnya method untuk menghitung total barang masuk
    $data['totalBarangKeluar'] = $this->Barang_model->get_total_barang_keluar(); // Misalnya method untuk menghitung total barang keluar
    $data['recentBarangMasuk'] = $this->Barang_model->get_recent_barang_masuk(); // Misalnya method untuk mendapatkan barang masuk terbaru
    $data['recentBarangKeluar'] = $this->Barang_model->get_recent_barang_keluar(); // Misalnya method untuk mendapatkan barang keluar terbaru
    $data['format_rupiah'] = array($this->Barang_model, 'format_rupiah');

    $pending_requests_count = $this->Inventory_model->count_pending_requests();
        $data['pending_requests_count'] = $pending_requests_count;
        $data['requests'] = $this->Inventory_model->get_pending_requests();
        $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
        
        $this->load->view('inventory/layout/header', $data);
        $this->load->view('inventory/dashboard', $data);
        $this->load->view('inventory/layout/footer',$data);
    }
    public function change_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->Inventory_model->update_request_status($id, $status);
        echo json_encode(['status' => 'success']);
    }
    


        // Dashboard view for each category
        public function ac_mobil() {
            $data['ac_mobil'] = $this->Ac_mobil_model->get_all();
            $pending_requests_count = $this->Inventory_model->count_pending_requests();
            $data['pending_requests_count'] = $pending_requests_count;
            $data['requests'] = $this->Inventory_model->get_pending_requests();
    
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
            $this->load->view('inventory/layout/header', $data);
            $this->load->view('inventory/ac_mobil', $data);
            $this->load->view('inventory/layout/footer');
        }

        public function add_ganti_oli_view() {
            $pending_requests_count = $this->Inventory_model->count_pending_requests();
            $data['pending_requests_count'] = $pending_requests_count;
            $data['requests'] = $this->Inventory_model->get_pending_requests();
    
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
            $this->load->view('inventory/layout/header', $data);            $this->load->view('inventory/add_ganti_oli');
            $this->load->view('inventory/layout/footer');
        }
        
    
        public function ganti_oli() {
            $data['ganti_oli'] = $this->Ganti_oli_model->get_all();
            $pending_requests_count = $this->Inventory_model->count_pending_requests();
            $data['pending_requests_count'] = $pending_requests_count;
            $data['requests'] = $this->Inventory_model->get_pending_requests();
    
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
            $this->load->view('inventory/layout/header', $data);            $this->load->view('inventory/ganti_oli', $data);
            $this->load->view('inventory/layout/footer');
        }
    
        public function add_servis_mesin_ringan_view() {
            $pending_requests_count = $this->Inventory_model->count_pending_requests();
            $data['pending_requests_count'] = $pending_requests_count;
            $data['requests'] = $this->Inventory_model->get_pending_requests();
    
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
            $this->load->view('inventory/layout/header', $data);            $this->load->view('inventory/add_servis_mesin_ringan');
            $this->load->view('inventory/layout/footer');
        }
        
        public function servis_mesin_ringan() {
            $data['servis_mesin_ringan'] = $this->Servis_mesin_ringan_model->get_all();
            $pending_requests_count = $this->Inventory_model->count_pending_requests();
            $data['pending_requests_count'] = $pending_requests_count;
            $data['requests'] = $this->Inventory_model->get_pending_requests();
    
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
            $this->load->view('inventory/layout/header', $data);            $this->load->view('inventory/servis_mesin_ringan', $data);
            $this->load->view('inventory/layout/footer');
        }
    
        public function add_ac_mobil_view() {
            $pending_requests_count = $this->Inventory_model->count_pending_requests();
            $data['pending_requests_count'] = $pending_requests_count;
            $data['requests'] = $this->Inventory_model->get_pending_requests();
    
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
            $this->load->view('inventory/layout/header', $data);            $this->load->view('inventory/add_ac_mobil');
            $this->load->view('inventory/layout/footer');
        }
        
        // CRUD Operations for AC Mobil
        public function add_ac_mobil() {
            $data = array(
                'Nama_Barang' => $this->input->post('Nama_Barang'),
                'Harga_Satuan' => $this->input->post('Harga_Satuan'),
                'Jumlah_Stok' => $this->input->post('Jumlah_Stok')
            );
            $this->Ac_mobil_model->add($data);
            redirect('inventory/ac_mobil');
        }
    
        public function update_ac_mobil($id) {
            // Fetch item details
            $data['item'] = $this->Ac_mobil_model->get_ac_mobil_by_id($id);
    
            // Set form validation rules
            $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
            $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric');
            $this->form_validation->set_rules('jumlah_stok', 'Jumlah Stok', 'required|integer');
    
            if ($this->form_validation->run() === FALSE) {
                // Load the edit view
                $pending_requests_count = $this->Inventory_model->count_pending_requests();
                $data['pending_requests_count'] = $pending_requests_count;
                $data['requests'] = $this->Inventory_model->get_pending_requests();
        
                $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
                $this->load->view('inventory/layout/header', $data);                $this->load->view('inventory/update_ac_mobil', $data);
                $this->load->view('inventory/layout/footer');
            } else {
                // Update the item
                $this->Ac_mobil_model->update_ac_mobil($id);
                // Set success message and redirect to the inventory list
                $this->session->set_flashdata('message', 'Item updated successfully!');
                redirect('inventory/ac_mobil');
            }
        }
      
    
        // CRUD Operations for Ganti Oli
        public function add_ganti_oli() {
            $data = array(
                'Nama_Barang' => $this->input->post('Nama_Barang'),
                'Harga_Satuan' => $this->input->post('Harga_Satuan'),
                'Jumlah_Stok' => $this->input->post('Jumlah_Stok')
            );
            $this->Ganti_oli_model->add($data);
            redirect('inventory/ganti_oli');
        }
    
        public function update_ganti_oli($id) {
            // Fetch item details
            $data['item'] = $this->Ganti_oli_model->get_ganti_oli_by_id($id);
        
            // Set form validation rules
            $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
            $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric');
            $this->form_validation->set_rules('jumlah_stok', 'Jumlah Stok', 'required|integer');
        
            if ($this->form_validation->run() === FALSE) {
                // Load the edit view
                $pending_requests_count = $this->Inventory_model->count_pending_requests();
                $data['pending_requests_count'] = $pending_requests_count;
                $data['requests'] = $this->Inventory_model->get_pending_requests();
        
                $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
                $this->load->view('inventory/layout/header', $data);
                $this->load->view('inventory/update_ganti_oli', $data); // Sesuaikan dengan nama view yang sesuai
                $this->load->view('inventory/layout/footer');
            } else {
                // Update the item
                $this->Ganti_oli_model->update_ganti_oli($id);
                // Set success message and redirect to the inventory list
                $this->session->set_flashdata('message', 'Item updated successfully!');
                redirect('inventory/ganti_oli');
            }
        }
        
    
       
        public function approve($id_permintaan) {
            if ($this->Inventory_model->approve_request($id_permintaan)) {
                $this->session->set_flashdata('success', 'Request approved and inventory updated.');
            } else {
                $this->session->set_flashdata('error', 'Failed to approve request.');
            }
    
            redirect('inventory/requests');
        }
    
        public function approve_request($id_permintaan) {
            $request = $this->db->get_where('permintaan_sparepart', ['ID_Permintaan' => $id_permintaan])->row_array();
    
            if ($request) {
                $table = '';
                switch ($request['Nama_Barang']) {
                    case 'Compressor Densos':
                        $table = 'ac_mobil';
                        break;
                }
    
                // If a valid table is found, update the stock
                if ($table) {
                    $this->db->set('Jumlah_Stok', 'Jumlah_Stok-' . $request['Jumlah'], FALSE)
                             ->where('ID_Barang', $request['ID_Barang'])
                             ->update($table);
    
                    // Mark the request as approved
                    $this->db->set('Status', 'Approved')
                             ->where('ID_Permintaan', $id_permintaan)
                             ->update('permintaan_sparepart');
    
                    // Create a notification for the admin
                    $this->db->insert('notifications', [
                        'user_role' => 'admin',
                        'message' => 'Permintaan anda telah di approve! Mohon tunggu barang sampai.',
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
    
                    return true;
                }
            }
    
            return false;
        }
        public function requests() {
            $data['requests'] = $this->db->get_where('permintaan_sparepart', ['Status' => 'Pending'])->result_array();
            $this->load->view('inventory/requests', $data);
        }
        // CRUD Operations for Servis Mesin Ringan
        public function add_servis_mesin_ringan() {
            $data = array(
                'Nama_Barang' => $this->input->post('Nama_Barang'),
                'Harga_Satuan' => $this->input->post('Harga_Satuan'),
                'Jumlah_Stok' => $this->input->post('Jumlah_Stok')
            );
            $this->Servis_mesin_ringan_model->add($data);
            redirect('inventory/servis_mesin_ringan');
        }
    
        public function update_servis_mesin_ringan($id) {
    // Fetch item details
    $data['item'] = $this->Servis_mesin_ringan_model->get_servis_mesin_ringan_by_id($id);

    // Set form validation rules
    $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
    $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric');
    $this->form_validation->set_rules('jumlah_stok', 'Jumlah Stok', 'required|integer');

    if ($this->form_validation->run() === FALSE) {
        // Load the edit view
        $pending_requests_count = $this->Inventory_model->count_pending_requests();
        $data['pending_requests_count'] = $pending_requests_count;
        $data['requests'] = $this->Inventory_model->get_pending_requests();

        $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
        $this->load->view('inventory/layout/header', $data);
        $this->load->view('inventory/update_servis_mesin_ringan', $data); // Sesuaikan dengan nama view yang sesuai
        $this->load->view('inventory/layout/footer');
    } else {
        // Update the item
        $this->Servis_mesin_ringan_model->update_servis_mesin_ringan($id);
        // Set success message and redirect to the inventory list
        $this->session->set_flashdata('message', 'Item updated successfully!');
        redirect('inventory/servis_mesin_ringan');
    }
}


        public function delete_ac_mobil($id) {
            $this->Ac_mobil_model->delete($id);
            redirect('inventory/ac_mobil');
        }
    
        // Delete function for Ganti Oli
        public function delete_ganti_oli($id) {
            $this->Ganti_oli_model->delete($id);
            redirect('inventory/ganti_oli');
        }
    
        // Delete function for Servis Mesin Ringan
        public function delete_servis_mesin_ringan($id) {
            $this->Servis_mesin_ringan_model->delete($id);
            redirect('inventory/servis_mesin_ringan');
        }
    
        

        public function barang_keluar() {
            $this->load->model('sparepart_model');

            $data['pending_requests_count'] = $this->Inventory_model->count_pending_requests();
            $data['requests'] = $this->Inventory_model->get_pending_requests();
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
            
            $this->load->view('inventory/layout/header', $data);
            $this->load->view('inventory/barang_keluar', $data);
            $this->load->view('inventory/layout/footer');
        }

        public function add_barang_keluar_view() {
            $data['pending_requests_count'] = $this->Inventory_model->count_pending_requests();
            $data['requests'] = $this->Inventory_model->get_pending_requests();
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
        
            $data['ganti_oli_items'] = $this->Ganti_oli_model->get_all();
            $data['servis_mesin_ringan_items'] = $this->Servis_mesin_ringan_model->get_all();
            $data['ac_mobil_items'] = $this->Ac_mobil_model->get_all();

            // Load view with header, add_barang_keluar content, and footer
            $this->load->view('inventory/layout/header', $data);
            $this->load->view('inventory/add_barang_keluar', $data);
            $this->load->view('inventory/layout/footer');
        }
        

        public function add_barang_keluar()
        {
            $this->load->model('BarangKeluar_model');

            // Ambil data dari form
            $data = array(
                'TanggalKeluar' => $this->input->post('TanggalKeluar'),
                'NamaPenerima' => $this->input->post('NamaPenerima'),
                'ID_Barang' => $this->input->post('ID_Barang'),
                'NamaBarang' => $this->input->post('NamaBarang'),
                'JumlahBarang' => $this->input->post('JumlahBarang'),
                'HargaPerUnit' => $this->input->post('HargaPerUnit'),
                'Keterangan' => $this->input->post('Keterangan')
            );
        
            // Simpan data menggunakan model BarangKeluar_model
            $this->BarangKeluar_model->add($data);
        
            // Update stock in the appropriate table
            $this->update_stock($data['ID_Barang'], $data['JumlahBarang'], 'keluar');
        
            // Redirect kembali ke halaman barang_keluar setelah berhasil
            redirect('inventory/barang_keluar');
        }

        public function update_barang_keluar($NomorTransaksi) {
            // Fetch item details
            $this->load->model('BarangKeluar_model');

            $data['item'] = $this->BarangKeluar_model->get_barang_keluar_by_id($NomorTransaksi);
        
            // Set form validation rules
            $this->form_validation->set_rules('TanggalKeluar', 'Tanggal Keluar', 'required');
            $this->form_validation->set_rules('NamaPenerima', 'Nama Penerima', 'required');
            $this->form_validation->set_rules('ID_Barang', 'ID Barang', 'required');
            $this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'required');
            $this->form_validation->set_rules('JumlahBarang', 'Jumlah Barang', 'required|integer');
            $this->form_validation->set_rules('Keterangan', 'Keterangan', 'required');
        

            $data['ganti_oli_items'] = $this->Ganti_oli_model->get_all();
        $data['servis_mesin_ringan_items'] = $this->Servis_mesin_ringan_model->get_all();
        $data['ac_mobil_items'] = $this->Ac_mobil_model->get_all();
            // Fetch additional data
            $data['pending_requests_count'] = $this->Inventory_model->count_pending_requests();
            $data['requests'] = $this->Inventory_model->get_pending_requests();
            $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
        
            if ($this->form_validation->run() === FALSE) {
                // Load the update view with validation errors or initial data
                $this->load->view('inventory/layout/header', $data);
                $this->load->view('inventory/update_barang_keluar', $data);
                $this->load->view('inventory/layout/footer');
            } else {
                // Prepare updated data
                $updated_data = array(
                    'TanggalKeluar' => $this->input->post('TanggalKeluar'),
                    'NamaPenerima' => $this->input->post('NamaPenerima'),
                    'ID_Barang' => $this->input->post('ID_Barang'),
                    'NamaBarang' => $this->input->post('NamaBarang'),
                    'JumlahBarang' => $this->input->post('JumlahBarang'),
                    'Keterangan' => $this->input->post('Keterangan')
                    // Add more fields as needed
                );
        
                // Update the item in the database
                $this->BarangKeluar_model->update_barang_keluar($NomorTransaksi, $updated_data);
        
                // Set success message and redirect to the inventory list
                $this->session->set_flashdata('message', 'Barang keluar updated successfully!');
                redirect('inventory/barang_keluar');
            }
        }
        

        public function delete_barang_keluar($ID_Permintaan) {
            // Load the model
            $this->load->model('sparepart_model');
    
            // Fetch item details
            $item = $this->sparepart_model->get_barang_keluar_by_id($ID_Permintaan);
    
            if ($item) {
                // Update stock by increasing the deleted quantity
                $this->update_stock($item['ID_Barang'], $item['Jumlah'], 'masuk');
    
                // Delete the item from the database
                $deleted = $this->sparepart_model->delete_barang_keluar($ID_Permintaan);
    
                // Check if the delete operation was successful
                if ($deleted) {
                    // Set a success message
                    $this->session->set_flashdata('message', 'Barang keluar deleted successfully!');
                } else {
                    // Set an error message
                    $this->session->set_flashdata('error', 'Failed to delete barang keluar.');
                }
            } else {
                // Set error message if item not found
                $this->session->set_flashdata('error', 'Item not found!');
            }
    
            // Redirect to the barang keluar list
            redirect('inventory/barang_keluar');
        }

    public function barang_masuk() {
        $data['barang_masuk'] = $this->BarangMasuk_model->get_all();
        $data['pending_requests_count'] = $this->Inventory_model->count_pending_requests();
        $data['requests'] = $this->Inventory_model->get_pending_requests();
        $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
        
        $this->load->view('inventory/layout/header', $data);
        $this->load->view('inventory/barang_masuk', $data);
        $this->load->view('inventory/layout/footer');
    }

    public function add_barang_masuk_view() {
        $data['pending_requests_count'] = $this->Inventory_model->count_pending_requests();
        $data['requests'] = $this->Inventory_model->get_pending_requests();
        $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
    
        $data['ganti_oli_items'] = $this->Ganti_oli_model->get_all();
        $data['servis_mesin_ringan_items'] = $this->Servis_mesin_ringan_model->get_all();
        $data['ac_mobil_items'] = $this->Ac_mobil_model->get_all();
        // Load view with header, add_barang_masuk content, and footer
        $this->load->view('inventory/layout/header', $data);
        $this->load->view('inventory/add_barang_masuk', $data);
        $this->load->view('inventory/layout/footer');
    }
    

    public function add_barang_masuk()
{
    // Ambil data dari form
    $data = array(
        'TanggalMasuk' => $this->input->post('TanggalMasuk'),
        'NamaPemasok' => $this->input->post('NamaPemasok'),
        'ID_Barang' => $this->input->post('ID_Barang'),
        'NamaBarang' => $this->input->post('NamaBarang'),
        'JumlahBarang' => $this->input->post('JumlahBarang'),
        'HargaPerUnit' => $this->input->post('HargaPerUnitNumeric'), // Use the numeric value
        'Keterangan' => $this->input->post('Keterangan')
    );

    // Simpan data menggunakan model BarangMasuk_model
    $this->BarangMasuk_model->add($data);

    // Update stock in the appropriate table
    $this->update_stock($data['ID_Barang'], $data['JumlahBarang'], 'masuk');

    // Redirect kembali ke halaman barang_masuk setelah berhasil
    redirect('inventory/barang_masuk');
}

private function update_stock($id_barang, $jumlah, $action)
{
    $tables = ['ac_mobil', 'ganti_oli', 'servis_mesin_ringan'];

    foreach ($tables as $table) {
        $this->db->where('ID_Barang', $id_barang);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            $current_stock = $query->row()->Jumlah_Stok;

            if ($action == 'masuk') {
                $new_stock = $current_stock + $jumlah;
            } else if ($action == 'keluar') {
                $new_stock = $current_stock - $jumlah;
            }

            $this->db->where('ID_Barang', $id_barang);
            $this->db->update($table, ['Jumlah_Stok' => $new_stock]);
        }
    }
}


public function update_barang_masuk($NomorTransaksi) {
    // Fetch item details
    $data['item'] = $this->BarangMasuk_model->get_barang_masuk_by_id($NomorTransaksi);

    // Set form validation rules
    $this->form_validation->set_rules('TanggalMasuk', 'Tanggal Masuk', 'required');
    $this->form_validation->set_rules('NamaPemasok', 'Nama Pemasok', 'required');
    $this->form_validation->set_rules('ID_Barang', 'ID Barang', 'required');
    $this->form_validation->set_rules('NamaBarang', 'Nama Barang', 'required');
    $this->form_validation->set_rules('JumlahBarang', 'Jumlah Barang', 'required|integer');
    $this->form_validation->set_rules('HargaPerUnit', 'Harga Per Unit', 'required|numeric');
    $this->form_validation->set_rules('Keterangan', 'Keterangan', 'required');

    // Fetch additional data for dropdown options
    $data['ganti_oli_items'] = $this->Ganti_oli_model->get_all();
    $data['servis_mesin_ringan_items'] = $this->Servis_mesin_ringan_model->get_all();
    $data['ac_mobil_items'] = $this->Ac_mobil_model->get_all();

    // Fetch additional data
    $data['pending_requests_count'] = $this->Inventory_model->count_pending_requests();
    $data['requests'] = $this->Inventory_model->get_pending_requests();
    $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));

    if ($this->form_validation->run() === FALSE) {
        // Load the update view with validation errors or initial data
        $this->load->view('inventory/layout/header', $data);
        $this->load->view('inventory/update_barang_masuk', $data);
        $this->load->view('inventory/layout/footer');
    } else {
        // Prepare updated data
        $updated_data = array(
            'TanggalMasuk' => $this->input->post('TanggalMasuk'),
            'NamaPemasok' => $this->input->post('NamaPemasok'),
            'ID_Barang' => $this->input->post('ID_Barang'),
            'NamaBarang' => $this->input->post('NamaBarang'),
            'JumlahBarang' => $this->input->post('JumlahBarang'),
            'HargaPerUnit' => $this->input->post('HargaPerUnit'),
            'Keterangan' => $this->input->post('Keterangan')
        );

        // Fetch the old quantity of the item
        $old_data = $this->BarangMasuk_model->get_barang_masuk_by_id($NomorTransaksi);
        $old_quantity = $old_data['JumlahBarang'];
        $new_quantity = $this->input->post('JumlahBarang');
        $quantity_difference = $new_quantity - $old_quantity;

        // Determine the action for stock update
        if ($quantity_difference > 0) {
            $this->update_stock($this->input->post('ID_Barang'), abs($quantity_difference), 'masuk');
        } else if ($quantity_difference < 0) {
            $this->update_stock($this->input->post('ID_Barang'), abs($quantity_difference), 'keluar');
        }

        // Update the item in the database
        $this->BarangMasuk_model->update_barang_masuk($NomorTransaksi, $updated_data);

        // Set success message and redirect to the inventory list
        $this->session->set_flashdata('message', 'Barang masuk updated successfully!');
        redirect('inventory/barang_masuk');
    }
}

    public function delete_barang_masuk($NomorTransaksi) {
    // Fetch item details
    $item = $this->BarangMasuk_model->get_barang_masuk_by_id($NomorTransaksi);
    
    if ($item) {
        // Update stock by reducing the deleted quantity
        $this->update_stock($item['ID_Barang'], $item['JumlahBarang'], 'keluar');
        
        // Delete the item from the database
        $this->BarangMasuk_model->delete_barang_masuk($NomorTransaksi);

        // Set success message and redirect to the inventory list
        $this->session->set_flashdata('message', 'Barang masuk deleted successfully!');
        redirect('inventory/barang_masuk');
    } else {
        // Set error message if item not found and redirect to the inventory list
        $this->session->set_flashdata('error', 'Item not found!');
        redirect('inventory/barang_masuk');
    }
}

        
    public function laporan_barang_keluar() {
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $this->load->model('sparepart_model');

        
        // Fetch data with optional date range filter
        $data['barang_keluar'] = $this->Barang_model->get_barang_keluar($date_from, $date_to);
        $data['total_harga'] = $this->Barang_model->get_total_harga($date_from, $date_to);
        $data['format_rupiah'] = array($this->Barang_model, 'format_rupiah');
        
        $data['pending_requests_count'] = $this->Inventory_model->count_pending_requests();
    $data['requests'] = $this->Inventory_model->get_pending_requests();
    $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));

        // Load header, main content, and footer views
        $this->load->view('inventory/layout/header', $data);
        $this->load->view('inventory/laporan_barang_keluar', $data);
        $this->load->view('inventory/layout/footer');
    }

    public function check_notifications() {
        // Ambil data notifikasi dari model atau tempat lain
        $notifications = $this->Notifications_model->get_notifications(); // Sesuaikan dengan model dan metode yang benar
    
        // Kirim data notifikasi sebagai respons JSON
        echo json_encode($notifications);
    }

    public function laporan_barang_masuk() {
        // Mendapatkan data barang masuk
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $data['barang_masuk'] = $this->Barang_model->get_barang_masuk();
        $data['total_harga'] = $this->Barang_model->get_total_harga_masuk();
        $data['format_rupiah'] = array($this->Barang_model, 'format_rupiah');
    
        $data['pending_requests_count'] = $this->Inventory_model->count_pending_requests();
    $data['requests'] = $this->Inventory_model->get_pending_requests();
    $data['user'] = $this->Inventory_model->get_user($this->session->userdata('user_id'));
        // Memuat view
        $this->load->view('inventory/layout/header', $data);
        $this->load->view('inventory/laporan_barang_masuk', $data);
        $this->load->view('inventory/layout/footer');
    }
    
}
       
    
    