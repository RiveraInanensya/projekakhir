<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rentalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Katalog_model'); // Tambahkan model Katalog_model
    }

    public function index() {
        $data['users'] = $this->User_model->get_users();
        $this->load->view('user/rentalan', $data);
    }

    // Method untuk menampilkan katalog berdasarkan user_id
    public function view_katalog($user_id) {
        $this->load->model('Katalog_model');  // Pastikan model dimuat
        $data['katalogs'] = $this->Katalog_model->get_katalog_by_user($user_id);  // Ambil katalog berdasarkan user_id
        $this->load->view('user/katalog', $data);  // Load view untuk menampilkan katalog
    }
}    
?>
