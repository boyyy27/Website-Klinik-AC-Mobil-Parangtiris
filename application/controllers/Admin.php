<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->load->model('Sparepart_model');
        $this->load->model('Request_model');
        $this->load->model('Point_model'); 
        if ($this->router->fetch_method() !== 'verifikasi') {
            $this->_check_admin();
        }
    }

    private function _check_admin() {
        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('role');

        if (!$user_id || $user_role !== 'admin') {
            redirect('admin/verifikasi');
        }
    }
    public function suku_cadang() {
        $data['countPending'] = $this->Request_model->count_pending_requests();
        $data['check'] = $this->Request_model->get_all_request_statuses();
        $data['user'] = $this->Admin_model->get_user($this->session->userdata('user_id'));
        $data['suku_cadang'] = $this->Sparepart_model->get_all();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/suku_cadang', $data);
        $this->load->view('admin/layout/footer'); 
    }

public function transaksi() {
    $data['countPending'] = $this->Request_model->count_pending_requests();
    $data['check'] = $this->Request_model->get_all_request_statuses();
    $data['user'] = $this->Admin_model->get_user($this->session->userdata('user_id'));
    $data['transactions'] = $this->Admin_model->get_all_transactions();
    $this->load->view('admin/layout/header', $data);
    $this->load->view('admin/transaksi', $data);
    $this->load->view('admin/layout/footer'); 
}
public function delete_transaksi($id) {
    $transaction = $this->Admin_model->get_transaction_by_id($id);

    if ($transaction) {
        $this->Admin_model->delete_transaction($id);
        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus.');
    } else {
        $this->session->set_flashdata('error', 'Transaksi tidak ditemukan.');
    }

    redirect('admin/transaksi');
}
public function add_transaksi() {
    $data['countPending'] = $this->Request_model->count_pending_requests();
    $data['check'] = $this->Request_model->get_all_request_statuses();
    $data['user'] = $this->Admin_model->get_user($this->session->userdata('user_id'));
    $data['members'] = $this->Admin_model->get_members_with_role('user');
    $data['suku_cadang'] = $this->Sparepart_model->get_all();
    $this->load->view('admin/layout/header',$data);
    $this->load->view('admin/add_transaksi', $data);
    $this->load->view('admin/layout/footer');
}
public function save_transaksi() {
    $status = $this->input->post('status');
    $user_id = $status === 'member' ? $this->input->post('user_id') : NULL;
    $amount = $this->input->post('amount');
    $sparepart = $this->input->post('sparepart');
    $sparepart_price = $this->Sparepart_model->get_price_by_name($sparepart);
    $total_price = $amount + $sparepart_price;

    $data = array(
        'user_id' => $user_id,
        'sparepart' => $sparepart,
        'deskripsi' => $this->input->post('deskripsi'),
        'amount' => $amount,
        'date' => date('Y-m-d H:i:s')
    );

    $this->Admin_model->insert_transaction($data);

    if ($status === 'member' && $total_price > 90000) {
        $this->Point_model->add_points($user_id, 1);
    }

    $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan.');
    redirect('admin/transaksi');
}

public function data_member(){
    $data['user'] = $this->Admin_model->get_user($this->session->userdata('user_id'));
    $data['countPending'] = $this->Request_model->count_pending_requests();
    $data['check'] = $this->Request_model->get_all_request_statuses();
        $members = $this->Admin_model->get_members();
                foreach ($members as &$member) {
            $login_info = $this->Admin_model->get_login_info($member['ID_User']);
            if (!empty($login_info['google_id'])) {
                $member['Login'] = 'menggunakan Google';
            } else {
                $member['Login'] = 'menggunakan username';
            }
        }
        
        $data['members'] = $members;
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/member_list', $data);
        $this->load->view('admin/layout/footer');

}

    
    public function request_sparepart($id_barang) {
        $barang = $this->Sparepart_model->get_by_id($id_barang);

        if ($barang) {
            $data = array(
                'ID_Barang' => $id_barang,
                'Nama_Barang' => $barang['Nama_Barang'],
                'Jumlah' => 1,
                'Tanggal_Permintaan' => date('Y-m-d H:i:s'),
                'Status' => 'Pending'
            );

            $this->Request_model->create($data);
            $this->session->set_flashdata('success', 'Permintaan sparepart berhasil dibuat.');
        } else {
            $this->session->set_flashdata('error', 'Barang tidak ditemukan.');
        }

        redirect('admin/suku_cadang');
    }


    public function verifikasi() {
        $data['user'] = $this->Admin_model->get_user($this->session->userdata('user_id'));
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/footer'); 
        $this->load->view('admin/verifikasi',$data);
    }
    public function dashboard() {
        $data['countPending'] = $this->Request_model->count_pending_requests();
        $data['check'] = $this->Request_model->get_all_request_statuses();
        $data['user'] = $this->Admin_model->get_user($this->session->userdata('user_id'));
        $data['totalUsers'] = $this->Admin_model->count_all_users();  // Assuming a method to count all users
        $data['totalTransactions'] = $this->Admin_model->count_all_transactions();  // Assuming a method to count all transactions
        $data['totalPoints'] = $this->Admin_model->sum_all_points();  // Assuming a method to sum all points
        $data['recentTransactions'] = $this->Admin_model->get_recent_transactions();  // Assuming a method to get recent transactions
        $data['recentRequests'] = $this->Request_model->get_recent_requests();  // Assuming a method to get recent requests
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layout/footer', $data);
    }
    public function laporan() {
        $data['countPending'] = $this->Request_model->count_pending_requests();
        $data['check'] = $this->Request_model->get_all_request_statuses();
        $data['user'] = $this->Admin_model->get_user($this->session->userdata('user_id'));

        $filters = array(
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to')
        );

        $data['transactions'] = $this->Admin_model->get_filtered_transactions($filters);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('admin/layout/footer', $data);
    }
    
}
?>
