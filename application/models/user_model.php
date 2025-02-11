<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_users()
    {
        $this->db->where('role_id', 2);  // Filter hanya yang memiliki role_id = 2
        return $this->db->get('user')->result_array();  // Mengembalikan hasil sebagai array
    }

    public function get_catalog_by_user($user_id) {
        $this->db->where('user_id', $user_id);  // Filter by user ID
        return $this->db->get('katalog')->result_array();  // Get the filtered catalog items
    }
    
   
}
?>