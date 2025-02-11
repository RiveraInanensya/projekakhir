<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Ambil data user berdasarkan email
    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        return $query->row_array();
    }

    // Update data user
    public function update_user($email, $data) {
        $this->db->where('email', $email);
        return $this->db->update('user', $data);
    }


}