<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function google_login() {
        $input = json_decode($this->input->raw_input_stream, true);
        $googleUser = $input['googleUser'];

        if ($googleUser) {
            $user = $this->Auth_model->get_user_by_google_id($googleUser['id']);
            if (!$user) {
                $data = array(
                    'google_id' => $googleUser['id'],
                    'google_email' => $googleUser['email'],
                    'Username' => $googleUser['displayName'],
                    'Role' => 'user'
                );
                $this->Auth_model->insert_google_user($data);
                $user = $this->Auth_model->get_user_by_google_id($googleUser['id']);
            }
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('user_id', $user['ID_User']);
            $this->session->set_userdata('username', $user['Username']);
            $this->session->set_userdata('role', $user['Role']);
            $this->session->set_userdata('google_login', true);
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            $response = array('success' => false, 'message' => 'Google login failed');
            echo json_encode($response);
        }
    }

    public function do_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->Auth_model->login($username, md5($password));
        if ($user) {
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('user_id', $user['ID_User']);
            $this->session->set_userdata('username', $user['Username']);
            $this->session->set_userdata('role', $user['Role']);
            if ($user['Role'] == 'admin') {
                redirect('admin/dashboard');
            } elseif ($user['Role'] == 'inventory') {
                redirect('inventory/dashboard');
            } else {
                redirect('welcome/');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah');
            redirect('welcome/login');
        }
    }

    public function login()
    {
        $this->load->view('auth/login');
    }

    public function signup()
    {
        $this->load->view('auth/signup');
    }

    public function check_phone_number()
    {
        $phone_number = $this->input->post('phone_number');
        if ($this->Auth_model->is_phone_number_registered($phone_number)) {
            $response = array('status' => 'error', 'message' => 'Nomor telepon sudah terdaftar.');
        } else {
            $response = array('status' => 'success');
        }
        echo json_encode($response);
    }

    public function do_signup()
    {
        $is_verified = $this->input->post('is-verified');
        if ($is_verified != 1) {
            $this->session->set_flashdata('error', 'Nomor telepon belum diverifikasi.');
            redirect('auth/signup');
            return;
        }

        $phone_number = $this->input->post('phone');
        if ($this->Auth_model->is_phone_number_registered($phone_number)) {
            $this->session->set_flashdata('error', 'Nomor telepon sudah terdaftar.');
            redirect('auth/signup');
            return;
        }

        $data = array(
            'Nama' => $this->input->post('nama'),
            'Username' => $this->input->post('username'),
            'Password' => md5($this->input->post('password')),
            'Email' => $this->input->post('email'),
            'Nomor_Telepon' => $phone_number,
            'Role' => 'user',
            'status' => 1
        );

        if ($this->Auth_model->signup($data)) {
            $this->session->set_flashdata('success', 'Pendaftaran berhasil. Silakan login.');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Pendaftaran gagal. Silakan coba lagi.');
            redirect('auth/signup');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('welcome/');
    }
}
?>
