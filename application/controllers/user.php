<?php

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function home() {
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        // Mendapatkan user_id dari session
        $user_id = $this->session->userdata('user_id');
        
        // Mengambil data katalog yang sesuai dengan user_id pengguna yang sedang login
        $data['katalog'] = $this->db->get_where('katalog', ['user_id' => $user_id])->result_array();
        
        // Load view
        $this->load->view('user/home', $data);
    }

    public function user_catalog() {
        $user_id = $this->input->get('user_id');  // Get the user ID from the URL
        $data['catalogs'] = $this->katalog_model->get_catalog_by_user($user_id);  // Fetch items for this user
        $this->load->view('catalog/user_catalog', $data);  // Load the view with filtered items
    }

    
}



?>
