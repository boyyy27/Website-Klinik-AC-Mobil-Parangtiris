<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Product_model');
        $this->load->model('Point_model');
        $this->load->model('User_model');
        
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user($user_id);
        $data['products'] = $this->Product_model->get_products();
        $this->load->view('user/user', $data);
    }

    public function add_transaction() {
        $user_id = $this->input->post('user_id');
        $amount = $this->input->post('amount');
        $this->Point_model->add_points($user_id, $amount);
        redirect('user');
    }

    public function redeem_points($product_id) {
        $user_id = $this->session->userdata('user_id');
        $redeem_code = $this->Point_model->redeem_points($user_id, $product_id);
        if ($redeem_code) {
            $this->session->set_flashdata('success', 'Your code: ' . $redeem_code);
        } else {
            $this->session->set_flashdata('error', 'Insufficient points or other error');
        }
        redirect('user');
    }

    public function edit_profile() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user($user_id);

        $this->form_validation->set_rules('Nama', 'Nama', 'required');
        $this->form_validation->set_rules('Nomor_Telepon', 'Nomor Telepon', 'required');

        if (!$this->session->userdata('google_login')) {
            $this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/edit_profile', $data);
        } else {
            $update_data = array(
                'Nama' => $this->input->post('Nama'),
                'Nomor_Telepon' => $this->input->post('Nomor_Telepon')
            );

            if ($this->session->userdata('google_login')) {
                $update_data['google_email'] = $data['user']['google_email'];
            } else {
                $update_data['Email'] = $this->input->post('Email');
            }

            $update_status = $this->User_model->update_user($user_id, $update_data);

            if ($update_status) {
                $this->session->set_flashdata('success', 'Profile updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update profile.');
            }
            redirect('user/edit_profile');
        }
    }

    public function riwayat_transaksi() {
    $user_id = $this->session->userdata('user_id');
    $transactions = $this->User_model->get_transactions($user_id);

    foreach ($transactions as &$transaction) {
        if (!empty($transaction['redeem']) && strpos($transaction['redeem'], 'redeem') === 0) {
            $transaction['deskripsi'] = 'point';
        }
    }

    $data['transactions'] = $transactions;
    $this->load->view('user/riwayat_transaksi', $data);
}

    public function upload_photo() {
        $config['upload_path'] = 'assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // 2MB
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
        } else {
            $data = $this->upload->data();
            $user_id = $this->session->userdata('user_id');
            $update_data = array('foto' => $data['file_name']);
            
            if ($this->User_model->update_user($user_id, $update_data)) {
                $this->session->set_flashdata('success', 'Foto profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui foto profil.');
            }
        }
        redirect('user/edit_profile');
    }
    public function detail_transaksi($transaction_id) {
        $transaction = $this->User_model->get_transaction($transaction_id);
        $data['transaction'] = $transaction;
        $this->load->view('user/detail_transaksi', $data);
    }
}
?>
